//+------------------------------------------------------------------+
//|                                                project3-ver1.mq5 |
//|                                  Copyright 2021, MetaQuotes Ltd. |
//|                                             https://www.mql5.com |
//+------------------------------------------------------------------+
#property copyright "Copyright 2021, MetaQuotes Ltd."
#property link      "https://www.mql5.com"
#property version   "1.00"
//+------------------------------------------------------------------+
//|          Includes                                                        |
//+------------------------------------------------------------------+
#include <Trade\Trade.mqh>
//+------------------------------------------------------------------+
//| inputs                                                                 |
//+------------------------------------------------------------------+
input bool     SupplyDemandFilter = true;
input int      SupplyDemandMaxSize = 100;//Supp Dem Max Size
input double   lot=0.01;
input int      slPoint=50;//Stop loss (Points)
input int      tpPoint=100;//Take profit(Points)
input string   commentString="";//Comment
input bool     send_Email=false;
input bool     send_Notitication=false;
//+------------------------------------------------------------------+
//|Globals                                                                |
//+------------------------------------------------------------------+
datetime lastCandelTime;//for checking begin of candel
CTrade myTrade;
//+------------------------------------------------------------------+
//| Expert initialization function                                   |
//+------------------------------------------------------------------+
int OnInit()
{

   return(INIT_SUCCEEDED);
}
//+------------------------------------------------------------------+
//| Expert deinitialization function                                 |
//+------------------------------------------------------------------+
void OnDeinit(const int reason)
{
//---
   
}
//+------------------------------------------------------------------+
//| Expert tick function                                             |
//+------------------------------------------------------------------+
void OnTick()
{
//---
   datetime current=iTime(_Symbol,PERIOD_CURRENT,0);
   if(current!=lastCandelTime)//new candel
   {
      
      if(checkSignal("buy"))
      if(IsSuppDem(0)==0)//Is this signal in demand zone ?
      {
         openPosition("buy");
         string alert="BUY SIGNAL ON "+_Symbol+" AT CANDEL: "+(string)lastCandelTime;
         Alert(alert);
         if(send_Email)
         {
            if(! SendMail(alert,""))
                     Alert("email not sent.error number: ",GetLastError());
         }
         if(send_Notitication)
         {
            if(! SendNotification(alert))
                     Alert("notification not sent.error number: ",GetLastError());
         }
      }
      //...
      if(checkSignal("sell"))
      if(IsSuppDem(1)==1)//Is this signal in supply zone ?         
        {
         openPosition("sell");
         string alert="SELL SIGNAL ON "+_Symbol+" AT CANDEL: "+(string)lastCandelTime;
         Alert(alert);
         
         if(send_Email)
         {
            if(! SendMail(alert,""))
                     Alert("email not sent.error number: ",GetLastError());
         }
         if(send_Notitication)
         {
            if(! SendNotification(alert))
                     Alert("notification not sent.error number: ",GetLastError());
         }
        }
      
      lastCandelTime=current;
   }
}
//+------------------------------------------------------------------+
int IsSuppDem(int type)
  {
//---
     if(SupplyDemandFilter==false)
      return(type);
//---      
     double Bid = SymbolInfoDouble(Symbol(),SYMBOL_BID);
     if(type==0)
      {
         //...
            for(int i=3; i<iBars(Symbol(),PERIOD_CURRENT)-10; i++)
             {
               //...
                  double low1 = iLow(Symbol(),PERIOD_CURRENT,i);
                  double low2 = iLow(Symbol(),PERIOD_CURRENT,i+1);
                  double low3 = iLow(Symbol(),PERIOD_CURRENT,i+2);
                  datetime time2 = iTime(Symbol(),PERIOD_CURRENT,i+1);
                  int lowest = iLowest(Symbol(),PERIOD_CURRENT,MODE_LOW,i+1,1);                  
                  if(Bid>low2-SupplyDemandMaxSize*_Point && Bid<low2+SupplyDemandMaxSize*_Point)
                  if(low2<low1 && low2<low3 && lowest==i+1){                  
                     //...
                        DrawRectangle("Demand_Zone_"+TimeToString(time2),low2-SupplyDemandMaxSize*_Point,low2+SupplyDemandMaxSize*_Point,time2,TimeCurrent(),clrAqua);
                        return(0);
                     //...
                  }
               //...
             }
         //...
      }
//--- 
     if(type==1)
      {
         //...
            for(int i=3; i<iBars(Symbol(),PERIOD_CURRENT)-10; i++)
             {
               //...
                  double high1 = iHigh(Symbol(),PERIOD_CURRENT,i);
                  double high2 = iHigh(Symbol(),PERIOD_CURRENT,i+1);
                  double high3 = iHigh(Symbol(),PERIOD_CURRENT,i+2);
                  datetime time2 = iTime(Symbol(),PERIOD_CURRENT,i+1);
                  int  highest = iHighest(Symbol(),PERIOD_CURRENT,MODE_HIGH,i+1,1);
                  if(Bid<high2+SupplyDemandMaxSize*_Point && Bid>high2-SupplyDemandMaxSize*_Point)
                  if(high2>high1 && high2>high3 && highest==i+1){                  
                     //...
                        DrawRectangle("Supply_Zone_"+TimeToString(time2),high2-SupplyDemandMaxSize*_Point,high2+SupplyDemandMaxSize*_Point,time2,TimeCurrent(),clrRed);
                        return(1);
                     //...
                  }
               //...
             }
         //...     
      }
//--- 
     return(2);
  }
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void DrawRectangle(string name, double price1, double price2, datetime time1, datetime time2, color cl)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_RECTANGLE,0,time1,price1,time2,price2);
      ObjectSetInteger(ChartID(),name,OBJPROP_COLOR,cl);
      ObjectSetInteger(ChartID(),name,OBJPROP_FILL,true);
//---  
  }
//+------------------------------------------------------------------+
bool checkSignal(string type)
{
   double open=iOpen(_Symbol,PERIOD_CURRENT,1);
   double close=iClose(_Symbol,PERIOD_CURRENT,1);
   double high=iHigh(_Symbol,PERIOD_CURRENT,1);
   double low=iLow(_Symbol,PERIOD_CURRENT,1);
   
   double open2=iOpen(_Symbol,PERIOD_CURRENT,2);
   double close2=iClose(_Symbol,PERIOD_CURRENT,2);
   //
   if(type=="buy")//for buy signals
   {
      if(close < open)//descending candel
      {
         if((open-close) < (high-open)/3)//candel body<1/3 upper shadow
         {
            if((high-open) > (close-low))//upper shadow > downer shadow
            {
               if((open-close) < (open2-close2) )//candel body < prev candel body
               {
                  if(close < close2)//close < prev candel close
                  {
                     if((close-low) <= (open-close)/4)
                     {
                        return true;
                     }
                  }
               }
            }
         }
      
      }
   }
   if(type=="sell")//for sell signals
   {
      if(close > open)//ascending candel
      {
         if((close-open) < (open-low)/3)//candel body<1/3 downer shadow
         {
            if((open-low) > (high-close))//upper shadow < downer shadow
            {
               if((close-open) < (close2-open2) )//candel body < prev candel body
               {
                  if(close > close2)//close > prev candel close
                  {
                     if((high-close)<=(close-open)/4)
                     {
                        //Print("*****SELL");
                        return true;
                     }
                     
                  }
               }
            }
         }
      
      }
   }
   
   return false;

}
//+------------------------------------------------------------------+
//| open Position                                                   |
//+------------------------------------------------------------------+
void openPosition(string type)
{
   

   double price=0;
   double sls=0;
   double tps=0;
   if(type=="buy")
   {
      price=SymbolInfoDouble(_Symbol,SYMBOL_ASK);
      if(slPoint!=0)
         sls=SymbolInfoDouble(_Symbol,SYMBOL_ASK)-slPoint*_Point;
      if(tpPoint!=0)
         tps=SymbolInfoDouble(_Symbol,SYMBOL_ASK)+tpPoint*_Point;
       
      if(!myTrade.Buy(lot,NULL,price,sls,tps,commentString))
      Print("open position error Line: ",__LINE__," error Num: ",GetLastError());
   }
   else if(type=="sell")
   {
      price=SymbolInfoDouble(_Symbol,SYMBOL_BID);
      if(slPoint!=0)
         sls=SymbolInfoDouble(_Symbol,SYMBOL_BID)+slPoint*_Point;
      if(tpPoint!=0)
         tps=SymbolInfoDouble(_Symbol,SYMBOL_BID)-tpPoint*_Point;
      if(!myTrade.Sell(lot,NULL,price,sls,tps,commentString))
      Print("open position error Line: ",__LINE__," error Num: ",GetLastError());
   }
   //
 
}
