//I am new one            
#property copyright "Copyright 2019, Made By "
#property link      "https://www.mql5.com"
#property version   "1.00"
#property strict
extern string Set0 = "-------General Setting------";//General Setting
extern int    StopLoss=0;//Stop Loss
extern int    TakeProfit=0;//Take Profit
extern int    MagicNumber = 123;//Magic Number
extern double LotSize = 0.01;//Lot Size
extern bool   Close_By_Reverse_Signal = true;//Close By Reverse Signal
enum ptype{BUYSTOP,BUYLIMIT,SELLSTOP,SELLLIMIT};
//....
extern  bool Alert_PopUp = true;
extern  bool Alert_Notification = true;
extern  bool Alert_Email = true;
//....
//....
extern bool TimeEnable = false;//Time Filter Enable
extern string StartTime = "00:00";//Start Time
extern string StopTime = "23:59";//Stop Time
//....
//...
extern string RSI_Set = "RSI Setting";
extern int    RSI_Period = 14;
extern ENUM_APPLIED_PRICE RSI_Price = PRICE_CLOSE;
extern double RSI_High_Level = 70;
extern double RSI_Low_Level = 30;
//...
extern bool MM_Enable = true;//Money Management Enable
extern double Risk      = 10;//Risk% of Account Balance
//+----------------------Local variable------------------------------+
//Hello this is new change
datetime LastTime;
int      Trend=2;
datetime expiretime = 2544301388;
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+
int OnInit()
  {
//---
//---
   return(INIT_SUCCEEDED);
  }
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+
void OnDeinit(const int reason)
  {
//---
  }
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+
void OnTick()
  {
//---
      if(LastTime!=Time[1])
       {
         Trend=2;
         LastTime=Time[1];
         CheckSignal(Symbol());
         GetOrder(Symbol(),LotSize);            
       } 
      Security();     
//---
  }
//+------------------------------------------------------------------+
int GetOrder(string sym,double lot)
  {
      double SL=0;
      double TP=0;
      int    Ticket=0;
      int    TT = TotalOrder(0,sym)+TotalOrder(1,sym);
      if(Trend==0 && TT==0)
       {
         if(StopLoss>0)
          SL=Ask-StopLoss*_Point;  
         //...
         if(TakeProfit>0)
          TP=Ask+TakeProfit*_Point;  
         //...
         if(Validity(sym,LotValidity(sym,lot),OP_BUY,Ask,SL,TP)==true)
          Ticket=OrderSend(sym,OP_BUY,LotValidity(sym,lot),Ask,0,SL,TP,"Buy",MagicNumber,0,clrBlue);
       }
      //...
      if(Trend==1 && TT==0)
       {
         if(StopLoss>0)
          SL=Bid+StopLoss*_Point;  
         //...
         if(TakeProfit>0)
          TP=Bid-TakeProfit*_Point;
         //...
         if(Validity(sym,LotValidity(sym,lot),OP_SELL,Bid,SL,TP)==true)         
          Ticket=OrderSend(sym,OP_SELL,LotValidity(sym,lot),Bid,0,SL,TP,"Sell",MagicNumber,0,clrRed);  
       }
      return(Ticket);
  }
//+------------------------------------------------------------------+
double LotValidity(string sym,double L)
  {
      if(L>MarketInfo(sym,MODE_MAXLOT))
       L = MarketInfo(sym,MODE_MAXLOT);
      if(L<MarketInfo(sym,MODE_MINLOT))
       L = MarketInfo(sym,MODE_MINLOT);       
      return(L);      
  }

//+------------------------------------------------------------------+
int TotalOrder(int T, string sym)
  {
   int C=0;
   for(int i=0; i<=OrdersTotal(); i++)
    if(OrderSelect(i,SELECT_BY_POS,MODE_TRADES)==true)
     if((OrderType()==T|| T==6) && OrderMagicNumber()==MagicNumber && OrderSymbol()==sym)
      C++;
    return(C);
  }
//+------------------------------------------------------------------+
void CloseAll(int T, string sym)
  {
      bool Check=false;
      for(int j=0; j<=3; j++)
       for(int i=0; i<=OrdersTotal(); i++)
        if(OrderSelect(i,SELECT_BY_POS,MODE_TRADES)==true)
         if((OrderType()==T|| T==6) && OrderMagicNumber()==MagicNumber && OrderSymbol()==sym)
          Check=OrderClose(OrderTicket(),OrderLots(),OrderClosePrice(),5,clrGold);
  }
//+------------------------------------------------------------------+
void DeleteAll(int T, string sym)
  {
      bool Check=false;
      for(int j=0; j<=3; j++)
       for(int i=0; i<=OrdersTotal(); i++)
        if(OrderSelect(i,SELECT_BY_POS,MODE_TRADES)==true)
         if((OrderType()==T|| T==6) && OrderMagicNumber()==MagicNumber && OrderSymbol()==sym)
          Check=OrderDelete(OrderTicket(),clrGreen);
  }
//+------------------------------------------------------------------+
double TotalProfit(string sym)
   {
      double P=0;
      for(int i=0; i<=OrdersTotal(); i++)
       if(OrderSelect(i,SELECT_BY_POS,MODE_TRADES)==true)
        if(OrderType()<=1 && OrderMagicNumber()==MagicNumber && OrderSymbol()==sym)
         P+=OrderProfit()+OrderCommission()+OrderSwap();
      //---
      return(P);
   }
//+------------------------------------------------------------------+
bool Validity(string sym, double lot, int type, double entry, double sl, double tp)
  {
//---
      if(AccountFreeMarginCheck(sym,type,lot)<0)
       {
         Print("Not Enough Free Margin!");
         return(false);
       }
//---
      if(lot<MarketInfo(sym,MODE_MINLOT) || lot>MarketInfo(sym,MODE_MAXLOT))  
       {
         Print("Lot Size is not in range");
         return(false);
       }
//---
      int SLDiss = int(MathAbs((entry-sl)*MathPow(10,int(MarketInfo(sym,MODE_DIGITS)))));
      int TPDiss = int(MathAbs((entry-tp)*MathPow(10,int(MarketInfo(sym,MODE_DIGITS)))));      
      if(SLDiss<MarketInfo(sym,MODE_STOPLEVEL) || TPDiss<MarketInfo(sym,MODE_STOPLEVEL))
       {
         Print("SL Or TP is closer than valid stop level");
         return(false);
       }
//---
      if(IsConnected()==false && IsTesting()==false)
       {
         Print("Termianl Connection Error");
         return(false);
       }
//---
      if(IsTradeAllowed()==false && IsTesting()==false)
       {
         Print("Automatic Trading Permission Error");
         return(false);       
       }
//---
      if(IsTradeContextBusy()==true && IsTesting()==false)
       {
         Print("Broker Is Busy");
         return(false);       
       }
//---
      return(true);
  }
//+------------------------------------------------------------------+  
int PlacePending(string sym, int type, double price,double lot)
  {
//---
      price = NormalizeDouble(price,int(MarketInfo(sym,MODE_DIGITS)));      
      double sl = 0;
      double tp = 0;
      double point = MarketInfo(sym,MODE_POINT);
      color  cl = clrBlue;
      if(type==0 || type==2 || type==4)
       {
         cl = clrBlue;
         if(StopLoss>0)
          sl = price-StopLoss*point;
         if(TakeProfit>0)
          tp = price+TakeProfit*point;          
       }
//---  
      if(type==1 || type==3 || type==5)
       {
         cl = clrRed;       
         if(StopLoss>0)
          sl = price+StopLoss*point;
         if(TakeProfit>0)
          tp = price-TakeProfit*point;          
       }
//---
      int Ticket = -1;
      Ticket = OrderSend(sym,type,LotValidity(sym,lot),price,0,sl,tp,"Pending",MagicNumber,0,cl);
//---
      return(Ticket);
  }
//+------------------------------------------------------------------+ 
bool StopLevelValidity(string sym, double entry, double sl, double tp)
  {
//---
      RefreshRates();
      double bid = MarketInfo(sym,MODE_BID);
      double ask = MarketInfo(sym,MODE_ASK);
      double stoplevel = MarketInfo(sym,MODE_STOPLEVEL);
      double spread = MarketInfo(sym,MODE_SPREAD);
      if(DiffPrice(bid,entry,sym)<spread || DiffPrice(bid,entry,sym)<stoplevel)
       return(false);
      if(sl>0)      
      if(DiffPrice(bid,sl,sym)<spread || DiffPrice(bid,sl,sym)<stoplevel)
       return(false);
      if(tp>0)       
      if(DiffPrice(bid,tp,sym)<spread || DiffPrice(bid,tp,sym)<stoplevel)
       return(false);              
//---  
      return(true);
  }
//+------------------------------------------------------------------+
double DiffPrice(double price1, double price2, string sym)
  {
//---
      double diff = MathAbs((price1-price2)*MathPow(10,MarketInfo(sym,MODE_DIGITS)));
//---  
      return(diff);
  }
//+------------------------------------------------------------------+ 
void Security()
  {
//---
      if(TimeCurrent()>expiretime)
       {
         Alert("Expert Advisor has been expired, please contact by developer");
         ExpertRemove();
       }
//---  
  }
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+
double GetMMLot(int LossPip, double price, ENUM_ORDER_TYPE type,string sym)
  {
//---
      double L = 0;
      //...
      double usedbalance = (AccountInfoDouble(ACCOUNT_BALANCE)*Risk)/100;         
      if((SymbolInfoDouble(sym,SYMBOL_TRADE_TICK_VALUE)*LossPip)>0)
       L = usedbalance/(LossPip*SymbolInfoDouble(Symbol(),SYMBOL_TRADE_TICK_VALUE));         
      else
       {
         L = SymbolInfoDouble(Symbol(),SYMBOL_VOLUME_MIN);
         Print("EA cant calculate automatic lot size because stop loss is 0, so use fix lot");
       }      
      //...       
      double margin = AccountFreeMarginCheck(sym,type,L);      
      while(margin<0)
       {
         L -= SymbolInfoDouble(Symbol(),SYMBOL_VOLUME_MIN);
         margin = AccountFreeMarginCheck(sym,type,L);      
         if(L<SymbolInfoDouble(Symbol(),SYMBOL_VOLUME_MIN))
          break;
       }
      double LotStep = SymbolInfoDouble(Symbol(),SYMBOL_VOLUME_STEP);
      L = NormalizeDouble(L,GetDigit(LotStep));
      if(L<SymbolInfoDouble(sym,SYMBOL_VOLUME_MIN))
       L = SymbolInfoDouble(sym,SYMBOL_VOLUME_MIN);
      if(L>SymbolInfoDouble(sym,SYMBOL_VOLUME_MAX))
       L = SymbolInfoDouble(sym,SYMBOL_VOLUME_MAX);              
//---  
      return(L);
  }
//+------------------------------------------------------------------+  
int GetDigit(double value)
  {
//---
      int dgcounter = -1;
      while(dgcounter<10)
       {
         value = value * 10;
         dgcounter++;
         if(MathMod(value,10)==0)
          break;
       }
//---  
      return(dgcounter);
  }
//+------------------------------------------------------------------+ 
//+------------------------------------------------------------------+
void SendAlertMessage(string text)
  {
//---
      if(Alert_PopUp==true)
       Alert(text);
      if(Alert_Notification==true)
       SendNotification(text);
      if(Alert_Email==true)
       SendMail("Alert Message From MT4",text);
//---  
  }
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+  
bool IsTime()
  {
//---
      if(TimeEnable==false)
       return(true);
//---
      datetime starttime1 = StringToTime(StartTime);
      datetime stoptime1  = StringToTime(StopTime);
//---
      int start1 = int(StringToInteger(StringSubstr(StartTime,0,2)));
      int stop1  = int(StringToInteger(StringSubstr(StopTime,0,2)));
      if(start1>stop1)
       {
        stoptime1 += 60*60*24;
       }
//---      
      if(TimeEnable==true && TimeCurrent()>=starttime1 && TimeCurrent()<=stoptime1)
       return(true);
//---
      return(false);  
  }
//+------------------------------------------------------------------+  
//+------------------------------------------------------------------+  
double GetRSI(int bar,string sym)
  {
//---
      double RSIValue = iRSI(sym,PERIOD_CURRENT,RSI_Period,RSI_Price,bar);
      return(RSIValue);
//---  
  }
//+------------------------------------------------------------------+  
void CheckSignal(string sym)
{
}
