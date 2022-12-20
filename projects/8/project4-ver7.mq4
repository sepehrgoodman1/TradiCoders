//+------------------------------------------------------------------+
//|                                                project4-ver1.mq4 |
//|                        Copyright 2021, MetaQuotes Software Corp. |
//|                                             https://www.mql5.com |
//+------------------------------------------------------------------+
#property copyright "Copyright 2021, MetaQuotes Software Corp."
#property link      "https://www.mql5.com"
#property version   "1.00"
#property strict
//+------------------------------------------------------------------+
//| Includes                                                                |
//+------------------------------------------------------------------+
#resource "\\Indicators\\2_Bars_HLF.ex4"
//+------------------------------------------------------------------+
//| INputs                                                               |
//+------------------------------------------------------------------+
input double slPoint=150;//SL (points)
input double tpPoint=200;//TP (points)
input double entryFromTP=250;//Entry distance from TP
input bool   fixVolumeActive=true;//use fix volume
input double fixVolume=0.01;//fix volume
input double volumePercent=5;//volume% of equity
input string s1="----- 2_Bars_HLF SETTING-------";
input ENUM_TIMEFRAMES indTF = PERIOD_CURRENT;       // Required TF
//+------------------------------------------------------------------+
//|Globals                                                               |
//+------------------------------------------------------------------+
datetime currCandelTime;//to check new candel
datetime lastSignalTime;//time of the last signal of indicator
bool positionTrigered=false;//if position of the last signal trigerred?
string signalType=NULL;//"buy"or "sell"
double midLine;
int magic=1234;
//+------------------------------------------------------------------+
//| Expert initialization function                                   |
//+------------------------------------------------------------------+
int OnInit()
  {
//---
   //Print("dddd",MarketInfo(Symbol(),MODE_STOPLEVEL));
   //if(OrderSend(_Symbol,OP_BUYLIMIT,0.01,Ask+0*_Point,5,0,0)<=0)
   ////{
      //Print("Order send error: ",GetLastError()," Line: ",__LINE__);
      
   //}
//---
   return(INIT_SUCCEEDED);
  }

//+------------------------------------------------------------------+
//| Expert tick function                                             |
//+------------------------------------------------------------------+
void OnTick()
  {
   if(Time[0]!=currCandelTime)//new candel
     {
      currCandelTime=Time[0];
      
      int lastSignalCandel=findLastsignalCandel();
      
      if(Time[lastSignalCandel]!=lastSignalTime)//new signal detected
        {
         positionTrigered=false;
         
         lastSignalTime=Time[lastSignalCandel];

         midLine=(High[lastSignalCandel] + Low[lastSignalCandel]) / 2;
         
         if(Open[lastSignalCandel-1] < midLine)
            signalType="buy";
         else //if(Open[lastSignalCandel-1] >= midLine )
            signalType="sell";

         if(lastSignalCandel==1)//if last signal is on previous candel,do not continue
            return;
        }
      //
      
      if(!positionTrigered)
        {
         int breakCandelNum=calcBreakCandel();
         if(breakCandelNum==1)// candel[1] break midLine
            openOrder();

        }
      removePendingIfHitTPs();//check if any pending touches tp,remove it

     }
  }

//+------------------------------------------------------------------+
//|           find candel num of last signal                                          |
//+------------------------------------------------------------------+
int findLastsignalCandel()
  {
   for(int i=1;; i++)
     {
      if(iCustom(_Symbol,_Period,"::Indicators\\2_Bars_HLF.ex4",indTF,"",false,0,i)!=EMPTY_VALUE ||// if there is a buy signal on candel "i"
         iCustom(_Symbol,_Period,"::Indicators\\2_Bars_HLF.ex4",indTF,"",false,1,i)!=EMPTY_VALUE) //or there is a sell signal on candel "i"
         return i;
     }
   return 0;
  }
//+------------------------------------------------------------------+
//|    find candel that break midline                                                              |
//+------------------------------------------------------------------+
int calcBreakCandel()
  {

   int lastSignalCandel=iBarShift(_Symbol,_Period,lastSignalTime,true);
   for(int i=lastSignalCandel-1; i>0; i--)
     {
      if(signalType=="buy")
        {
         if( Close[i]>midLine)//break midline
            return i;
        }
      else
         if(signalType=="sell")
           {
            if( Close[i]<midLine)//break midline
               return i;
           }
     }
   return -1;//no candel was break midLine
  }
//+------------------------------------------------------------------+
//|     Open new order                                                             |
//+------------------------------------------------------------------+
void openOrder()
  {
   double sl,tp,price;
   int orderType;
   calcPriceSlTp(sl,tp,price,orderType);
   if(previouslyTouchTp(tp))//one of previous candels touches tp
   {
      positionTrigered=true;//so the signal is not valid anymore
      return;
   }
   double lot=fixVolume;
   
   if(!fixVolumeActive)
      lot=calculateLot(price,sl);
   
   if(OrderSend(_Symbol,orderType,lot,price,5,sl,tp,NULL,magic)<=0)
   {
      Print("Order send error: ",GetLastError()," Line: ",__LINE__);
      Print("ord props:","price:",price," type:",orderType,"ask:",Ask,"bid:",Bid,"sl:",sl,"tp:",tp);
      return;
   }
   positionTrigered=true;
  }
//+------------------------------------------------------------------+
//|         calc sl , tp , price , orderType
//+------------------------------------------------------------------+
void calcPriceSlTp(double &sl,double &tp,double &price,int &orderType)
  {
   double stopLevel=MarketInfo(Symbol(),MODE_STOPLEVEL)*_Point +5*_Point;
   if(signalType=="buy")
     {
      tp=midLine+tpPoint*_Point;
      sl=midLine-slPoint*_Point;

      price=tp-entryFromTP*_Point;
      
      
      //
      if(price<Ask-stopLevel)
         orderType=OP_BUYLIMIT;
      else if(price>Ask+stopLevel)
         orderType=OP_BUYSTOP;
      else
         orderType=OP_BUY;
     }
   else//if(signalType=="sell")
     {
      tp=midLine-tpPoint*_Point;
      sl=midLine+slPoint*_Point;
      price=tp+entryFromTP*_Point;
      //
      if(price>Bid+stopLevel)
         orderType=OP_SELLLIMIT;
      else if(price<Bid-stopLevel)
         orderType=OP_SELLSTOP;
      else
         orderType=OP_SELL;
     }
   tp=NormalizeDouble(tp,Digits);
   price=NormalizeDouble(price,Digits);
   sl=NormalizeDouble(sl,Digits);
   
   }
//+------------------------------------------------------------------+
//|    calc lot based on % equity                                                       |
//+------------------------------------------------------------------+
double calculateLot(double price,double sl)
  {
   double lot;

   double riskOnTrade=volumePercent*0.01*AccountEquity();

   double distance=price-sl;
   if(distance<0) //for sell orders
      distance=distance*(-1);

   double distanceInPoint=distance/MarketInfo(_Symbol, MODE_TICKSIZE);//ticksize is point
   double distanceValue=distanceInPoint*MarketInfo(_Symbol,MODE_TICKVALUE);//tickvalue is point value
   lot=riskOnTrade/distanceValue;
   lot=MathFloor(lot * 100) / 100;//round lot

   if(lot<MarketInfo(_Symbol,MODE_MINLOT))
   {
      Alert("The calculated lot size is less than min");
   }
   if(lot>MarketInfo(_Symbol,MODE_MAXLOT))
   {
      lot=MarketInfo(_Symbol,MODE_MAXLOT);
      Alert("The calculated lot size is more than max");
   }  

   return lot;

  }
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+
//|       return true if one of previous candels touches tp                                                         |
//+------------------------------------------------------------------+
bool previouslyTouchTp(double tp)
{
   int lastSignalCandel=iBarShift(_Symbol,_Period,lastSignalTime,true);
   for(int i=lastSignalCandel-1; i>0; i--)
     {
      if(signalType=="buy")
        {
         if(High[i]> tp)//touch tp
         {
            //Print("buy OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOps ",i);
            return true;
         }
        }
      else
         if(signalType=="sell")
           {
            if(Low[i]< tp)//touch tp
            {
            //Print("sell OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOps ",i);
            return true;
         }
           }
     }
   return false;//no candel touch tp until now
}
//+------------------------------------------------------------------+
//|  check if any pending touches tp,remove it                                  |
//+------------------------------------------------------------------+
void removePendingIfHitTPs()
{
   for(int i=OrdersTotal()-1;i>=0;i--)
   {
      if(!OrderSelect(i,SELECT_BY_POS,MODE_TRADES))
      {
         Print("order Select error: ",GetLastError());
         continue;
      }
      if(OrderMagicNumber()!=magic)//not opened by this expert
         continue;
      if(OrderType()==OP_BUYLIMIT ||OrderType()==OP_BUYSTOP)
         checkPending("buy");    
      else if(OrderType()==OP_SELLLIMIT ||OrderType()==OP_SELLSTOP)
         checkPending("sell");
   }

}
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void checkPending(string type)
{
   datetime openTime=OrderOpenTime();
   int openCandel=iBarShift(_Symbol,0,openTime);//candel of opened order
   //Print("openTime: ",openTime," candel: ",openCandel);
   double tp=OrderTakeProfit();
   for(int i=0;i<=openCandel;i++)
   {
      if(type=="buy")
      {
         if(High[i]>= tp)//price exceed tp
         {
            //Print("ticket: ",OrderTicket()," tp: ",OrderTakeProfit()," High:",High[i]," buuuuuuuuuuuuuyyyyyyyyyyYYYYyyyyyyyyyyyyyyyyyyyyyyyyyYYYYYYY");
            if(!OrderDelete(OrderTicket()))
               Print("orderDelete error: ",GetLastError());
            return;
         }
      }
      else if(type=="sell")
      {
         if(Low[i]<= tp)//price exceed tp
         {
         //Print("ticket: ",OrderTicket()," tp: ",OrderTakeProfit()," low:",Low[i]," SELLLLLLLLLLLLLLLLLLLLLLLLLLLlllllllllllllllllllllllLLLLLLLL");
            if(!OrderDelete(OrderTicket()))
               Print("orderDelete error: ",GetLastError());
            return;
         }
      }
   }
}