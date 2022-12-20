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
#property copyright "Copyright 2019, Made by EEECAD"
#property link      "https://www.eeecad.ir"
#property version   "1.00"
#property strict
extern int    StopLoss=0;//Stop Loss
extern int    TakeProfit=0;//Take Profit
extern int    MagicNumber = 123;//Magic Number
extern double LotSize = 0.01;//Lot Size
extern bool   Close_By_Reverse_Signal = true;//Close By Reverse Signal
//Indicator Setting
#property copyright "Copyright 2019, Powered by "
#property description "Indicator"
#property link      "https://www.mql5.com"
#property version   "1.00"
#property strict
#property indicator_chart_window
#property indicator_buffers 2
//...
#property indicator_color1 Blue
#property indicator_type1 DRAW_ARROW
#property indicator_width1 2
//...
#property indicator_color2 Red
#property indicator_type2 DRAW_ARROW
#property indicator_width2 2
//...
 //...
extern string TR_Set = "Trailing Stop Setting";//Trail Setting
extern bool   Trail_Enable = false;//Trail Enable
extern int    TrailStep=10;//Trail Step
//...
//...
extern string BE_Set = "Break Even Setting";//Break Even Setting
extern bool   BreakEven_Enable = false;//Break Even Enable
extern int    BreakEvenSpace=20;//Break Even Space
//...
 //...
extern string DSL_Set = "Dollar PL Close";//$ P/L Close
extern double Dollar_SL = 0;//$ SL(0=disable)
extern double Dollar_TP = 0;//$ TP(0=disable)
//...
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
extern string MA1_Set = "Moving Average1 Setting";//MA1 Setting
extern int    Moving1_Period = 21;//Moving Period 1
extern ENUM_MA_METHOD Moving1_Method = MODE_SMA;//Moving Method 1
extern ENUM_APPLIED_PRICE Moving1_Price = PRICE_CLOSE;//Moving Applied Price 1
//...
//...
extern string MA2_Set = "Moving Average2 Setting";//MA 2 Setting
extern int    Moving2_Period = 74;//Moving Period 2
extern ENUM_MA_METHOD Moving2_Method = MODE_SMA;//Moving Method 2
extern ENUM_APPLIED_PRICE Moving2_Price = PRICE_CLOSE;//Moving Applied Price 2
//...
//...
extern string MA3_Set = "Moving Average3 Setting";
extern int    Moving3_Period = 120;
extern ENUM_MA_METHOD Moving3_Method = MODE_SMA;
extern ENUM_APPLIED_PRICE Moving3_Price = PRICE_CLOSE;
//...
//...
extern string MACD_Set = "MACD Setting";
extern int    Fast_EMA_Period = 12;
extern int    Slow_EMA_Period = 26;
extern int    Signal_EMA_Period = 9;
extern ENUM_APPLIED_PRICE MACD_Price = PRICE_CLOSE;
extern double MACD_Cross_Level = 0;
//...
//...
extern string Stoch_Set = "STOCH Setting";
extern int    K_Period = 5;
extern int    D_Period = 3;
extern int    Slowing  = 3;
extern ENUM_MA_METHOD Stoch_MA_Method = MODE_SMA;
extern double Stoch_OverBought_Level = 80;
extern double Stoch_OverSold_Level = 20;
//...
//...
extern string RSI_Set = "RSI Setting";
extern int    RSI_Period = 14;
extern ENUM_APPLIED_PRICE RSI_Price = PRICE_CLOSE;
extern double RSI_High_Level = 70;
extern double RSI_Low_Level = 30;
//...
//...
extern string ATR_Set = "ATR Setting";
extern int    ATR_Period = 14;
extern double ATR_Cross_Level = 0;
//...
//...
extern string BB_Set = "Bollinger Band Setting";
extern int    BB_Period = 21;
extern int    BB_Shift  = 0;
extern double BB_Deviation = 2;
//...
//...
extern string PSAR_Set = "PSAR Setting";
extern double PSAR_Step = 0.02;
extern double PSAR_Maximum = 2;
//...
//...
extern string ZigZag_Set = "ZigZag Setting";
extern int    InpDepth = 12;
extern int    InpDeviation = 5;
extern int    InpBackstep  = 3;
//...
 
 
 //...
extern string ADX_Setting = "ADX Setting";
extern int    ADX_Period  = 14;
//...
extern bool MM_Enable = true;//Money Management Enable
extern double Risk      = 10;//Risk% of Account Balance
extern string IndCustom = "Custom.ex4";//Custom Indicator Name
extern int       IndCustom_BuyBuffer  = 0;//Custom Indicator Buy Buffer
extern int       IndCustom_SellBuffer = 1;//Custom Indicator Sell Buffer
extern bool SendFTP_Enable = true; 
extern bool SendMail_Enable = true; 
extern string EmailSubject      = "Email Subject";
//...
extern string ScreenShot_FileName = "ScreenShot.gif";
extern int    ScreenShot_Width    = 100;
extern int    ScreenShot_Height   = 100;
extern ENUM_ALIGN_MODE    ScreenShot_Align   =ALIGN_CENTER;
//...
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
//+----------------Local variable --------------------+
datetime LastTime;
int      Trend=2;
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
void OnStart()
  {
//---
      
//---
  }
//+------------------------------------------------------------------+
void GetOrder(string sym)
  {
      double SL=0;
      double TP=0;
      double ask = MarketInfo(sym,MODE_ASK);
      double bid = MarketInfo(sym,MODE_BID);      
      double point = MarketInfo(sym,MODE_POINT);      
      int    Ticket=0;
      if(Trend==0 && TotalOrder(0,sym)==0)
       {
         if(StopLoss>0)
          SL=ask-StopLoss*point;  
         //...
         if(TakeProfit>0)
          TP=ask+TakeProfit*point;  
         //...
         Ticket=OrderSend(sym,OP_BUY,CalcLot(sym),ask,5,SL,TP,"Buy Order",MagicNumber,0,clrBlue);
       }
      //...
      if(Trend==1 && TotalOrder(1,sym)==0)
       {
         if(StopLoss>0)
          SL=bid+StopLoss*point;  
         //...
         if(TakeProfit>0)
          TP=bid-TakeProfit*point;
         //...
         Ticket=OrderSend(Symbol(),OP_SELL,CalcLot(sym),bid,5,SL,TP,"Sell Order",MagicNumber,0,clrRed);  
       }
  }
//+------------------------------------------------------------------+
double CalcLot(string sym)
  {
      double L = LotSize;
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

//Function body
double BuyArrow[];
double SellArrow[];
int    Space = 50;
datetime expiretime = D'2030.01.01';
string IndName = "MyIndicator";
//+------------------------------------------------------------------+
//| Custom indicator initialization function                         |
//+------------------------------------------------------------------+
int OnInit()
  {
//--- indicator buffers mapping
   SetIndexBuffer(0,BuyArrow);
   SetIndexArrow(0,233);
   SetIndexBuffer(1,SellArrow);   
   SetIndexArrow(1,234);      
   IndicatorShortName(IndName);
//---
   return(INIT_SUCCEEDED);
  }
//+------------------------------------------------------------------+    
void OnDeinit(const int reason)
  {
//---
   
  }
//+------------------------------------------------------------------+
//| Custom indicator iteration function                              |
//+------------------------------------------------------------------+
int OnCalculate(const int rates_total,
                const int prev_calculated,
                const datetime &time[],
                const double &open[],
                const double &high[],
                const double &low[],
                const double &close[],
                const long &tick_volume[],
                const long &volume[],
                const int &spread[])
  {
//---
   int bar = iBars(Symbol(),PERIOD_CURRENT)-10;
   ArrayResize(BuyArrow,bar+1);
   ArrayResize(SellArrow,bar+1);   
   ArrayInitialize(BuyArrow,EMPTY_VALUE);
   ArrayInitialize(SellArrow,EMPTY_VALUE);   
   for(int i=1; i<bar; i++)
    {
      if(IndCheckSignal(i)==OP_BUY)
       BuyArrow[i] = Low[i]-Space*_Point;
      if(IndCheckSignal(i)==OP_SELL)
       SellArrow[i] = High[i]+2*Space*_Point;      
    }
//--- return value of prev_calculated for next call
   Security();
   return(rates_total);
  }
//+------------------------------------------------------------------+
void IndDrawHLine(string name, double price, color cl)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_HLINE,0,0,price);
      ObjectSet(name,OBJPROP_COLOR,cl);
//---  
  }
//+------------------------------------------------------------------+  
void IndDrawVLine(string name, datetime time, color cl)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_VLINE,0,time,0);
      ObjectSet(name,OBJPROP_COLOR,cl);
//---  
  }
//+------------------------------------------------------------------+  
void IndDrawTLine(string name, datetime time1, double price1, datetime time2, double price2, bool ray, color cl)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_TREND,0,time1,price1,time2,price2);
      ObjectSet(name,OBJPROP_COLOR,cl);
      ObjectSet(name,OBJPROP_RAY,ray);      
//---  
  }
//+------------------------------------------------------------------+  
void IndDrawArrow(string name, datetime time, double price, color cl, int code)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_ARROW,0,time,price);
      ObjectSet(name,OBJPROP_COLOR,cl);
      ObjectSet(name,OBJPROP_ARROWCODE,code);            
//---  
  }
//+------------------------------------------------------------------+
void IndDrawText(string name, datetime time, double price, color cl, string text)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_TEXT,0,time,price);
      ObjectSet(name,OBJPROP_COLOR,cl);
      ObjectSetText(name,text,10,"Arial",cl);
//---  
  }    
//+------------------------------------------------------------------+ 
void IndDrawLabel(string name, int hpos, int vpos, color cl, string text)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_LABEL,0,0,0);
      ObjectSet(name,OBJPROP_COLOR,cl);
      ObjectSet(name,OBJPROP_XDISTANCE,hpos);
      ObjectSet(name,OBJPROP_YDISTANCE,vpos);            
      ObjectSetText(name,text,10,"Arial",cl);
//---  
  }    
//+------------------------------------------------------------------+
void Security()
  {
//---
      if(TimeCurrent()>expiretime)
       {        
         if(ChartIndicatorDelete(ChartID(),0,IndName)==true)
          Alert("Indicator has been expired, please contact by developer");         
       }   
//---  
  }
//+------------------------------------------------------------------+  
//+------------------------------------------------------------------+
void TrailingStop(string sym)
  {
      //---
      bool Check=false;
      for(int i=0; i<=OrdersTotal(); i++)
       if(OrderSelect(i,SELECT_BY_POS,MODE_TRADES)==true)
        {
            if(OrderType()==0 && OrderMagicNumber()==MagicNumber && OrderSymbol()==sym)
             if(TRPipProfit()>TrailStep && (StopDistance(0)>=2*TrailStep || OrderStopLoss()==0))
              if((Bid-TrailStep*_Point)>OrderStopLoss() || OrderStopLoss()==0)
               Check=OrderModify(OrderTicket(),OrderOpenPrice(),Bid-TrailStep*_Point,OrderTakeProfit(),OrderExpiration(),clrGold);
            //---
            if(OrderType()==1 && OrderMagicNumber()==MagicNumber && OrderSymbol()==sym)
             if(TRPipProfit()>TrailStep && (StopDistance(1)>=2*TrailStep || OrderStopLoss()==0))
              if((Ask+TrailStep*_Point)<OrderStopLoss() || OrderStopLoss()==0)
               Check=OrderModify(OrderTicket(),OrderOpenPrice(),Ask+TrailStep*_Point,OrderTakeProfit(),OrderExpiration(),clrGold);
            //---
        }
      //---
  }
//+------------------------------------------------------------------+
double TRPipProfit()
  {
      double netprofit = OrderProfit()+OrderCommission()+OrderSwap();
      double R = netprofit/OrderLots()/MarketInfo(OrderSymbol(),MODE_TICKVALUE);
      return(NormalizeDouble(R,0));
  }
//+------------------------------------------------------------------+
double StopDistance(int T)
  {
      double R=0;
      if(T==0)
       {
         R=(Bid-OrderStopLoss())*MathPow(10,_Digits);
       }
      //---
      if(T==1)
       {
         R=(OrderStopLoss()-Bid)*MathPow(10,_Digits);         
       }
      return(NormalizeDouble(R,0));
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
void BreakEven(string sym)
  {
//---
      bool Check=false;
      for(int i=0; i<=OrdersTotal(); i++)
       {
         if(OrderSelect(i,SELECT_BY_POS,MODE_TRADES)==true)
          if(OrderMagicNumber()==MagicNumber && OrderSymbol()==sym)
           {
              if(OrderType()==0)
               if(BEPipProfit()>BreakEvenSpace && (OrderStopLoss()<OrderOpenPrice() || OrderStopLoss()==0))
                Check=OrderModify(OrderTicket(),OrderOpenPrice(),OrderOpenPrice(),OrderTakeProfit(),OrderExpiration(),clrLime);                         
              //---
              if(OrderType()==1)
               if(BEPipProfit()>BreakEvenSpace && (OrderStopLoss()>OrderOpenPrice() || OrderStopLoss()==0))
                Check=OrderModify(OrderTicket(),OrderOpenPrice(),OrderOpenPrice(),OrderTakeProfit(),OrderExpiration(),clrLime);                         
           }
       }
//---
  }
//+------------------------------------------------------------------+
double BEPipProfit()
  {
      double NetProfit = OrderProfit()+OrderCommission()+OrderSwap();
      double R=NetProfit/OrderLots()/MarketInfo(OrderSymbol(),MODE_TICKVALUE);
      return(NormalizeDouble(R,0));
  }
//+------------------------------------------------------------------+
 //+------------------------------------------------------------------+   
void DollarSL(string sym)
  {
//---
      double CurrentProfit = TotalProfit(sym);
      if(CurrentProfit<0 && MathAbs(CurrentProfit)>=Dollar_SL && Dollar_SL>0)
       {
          CloseAll(6,sym);
          DeleteAll(6,sym);
       }
//---  
  }
//+------------------------------------------------------------------+
void DollarTP(string sym)
  {
//---
      double CurrentProfit = TotalProfit(sym);
      if(CurrentProfit>=Dollar_TP && Dollar_TP>0)
       {
          CloseAll(6,sym);
          DeleteAll(6,sym);
       }
//---  
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
double GetMA1(int bar,string sym)
  {
//---
      double MAValue = iMA(sym,PERIOD_CURRENT,Moving1_Period,0,Moving1_Method,Moving1_Price,bar);
      return(MAValue);
//---  
  }
//+------------------------------------------------------------------+ 
//+------------------------------------------------------------------+  
double GetMA2(int bar,string sym)
  {
//---
      double MAValue = iMA(sym,PERIOD_CURRENT,Moving2_Period,0,Moving2_Method,Moving2_Price,bar);
      return(MAValue);
//---  
  }
//+------------------------------------------------------------------+  
//+------------------------------------------------------------------+  
double GetMA3(int bar,string sym)
  {
//---
      double MAValue = iMA(sym,PERIOD_CURRENT,Moving3_Period,0,Moving3_Method,Moving3_Price,bar);
      return(MAValue);
//---  
  }
//+------------------------------------------------------------------+  
//+------------------------------------------------------------------+  
double GetMACD(int bar,string sym)
  {
//---
      double MACDValue = iMACD(sym,PERIOD_CURRENT,Fast_EMA_Period,Slow_EMA_Period,Signal_EMA_Period,MACD_Price,MODE_MAIN,bar);
      return(MACDValue);
//---  
  }
//+------------------------------------------------------------------+  
//+------------------------------------------------------------------+  
double GetStoch(int bar, string sym)
  {
//---
      double StochValue = iStochastic(sym,PERIOD_CURRENT,K_Period,D_Period,Slowing,Stoch_MA_Method,0,MODE_MAIN,bar);
      return(StochValue);
//---  
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
//+------------------------------------------------------------------+ 
double GetATR(int bar,string sym)
  {
//---
      double ATRValue = iATR(sym,PERIOD_CURRENT,ATR_Period,bar);
      return(ATRValue);
//---  
  }
//+------------------------------------------------------------------+ 
//+------------------------------------------------------------------+  
double GetBB(int bar,string sym,int mode)
  {
//---
      double BBValue = iBands(sym,PERIOD_CURRENT,BB_Period,BB_Deviation,BB_Shift,PRICE_CLOSE,mode,bar);
      return(BBValue);
//---  
  }
//+------------------------------------------------------------------+  
//+------------------------------------------------------------------+  
double GetPSAR(int bar,string sym)
  {
//---
      double PSARValue = iSAR(sym,PERIOD_CURRENT,PSAR_Step,PSAR_Maximum,bar);
      return(PSARValue);
//---  
  }
//+------------------------------------------------------------------+ 
//+------------------------------------------------------------------+  
double GetZigZag(int bar,string sym)
  {
//---
      double ZZValue = iCustom(sym,PERIOD_CURRENT,"ZigZag",InpDepth,InpDeviation,InpBackstep,0,bar);
      return(ZZValue);
//---  
  }
//+------------------------------------------------------------------+  
//+------------------------------------------------------------------+  
double GetFractal(int bar,string sym,int mode)
  {
//---
      double FRVValue = iFractals(sym,PERIOD_CURRENT,mode,bar);
      return(FRVValue);
//---  
  }
//+------------------------------------------------------------------+ 
//+------------------------------------------------------------------+
int GetHA(int bar,string sym)
  {
//---
      double HeikenAshi_White1 = iCustom(sym,PERIOD_CURRENT,"Heiken Ashi",0,1);             
      double HeikenAshi_Red1 = iCustom(sym,PERIOD_CURRENT,"Heiken Ashi",1,1);             
      double HeikenAshi_White2 = iCustom(sym,PERIOD_CURRENT,"Heiken Ashi",2,1);             
      double HeikenAshi_Red2 = iCustom(sym,PERIOD_CURRENT,"Heiken Ashi",3,1);           
      double WhiteSum = HeikenAshi_White1+HeikenAshi_White2;        
      double RedSum   = HeikenAshi_Red1+HeikenAshi_Red2;    
      if(WhiteSum>RedSum)
       return(OP_BUY);
      if(RedSum>WhiteSum)
       return(OP_SELL);
      return(2);
//---  
  }
//+------------------------------------------------------------------+  
//I am new one
//+------------------------------------------------------------------+  
double GetADX(int bar,string sym,int buffer)
  {
//---
      double ADXValue = iADX(sym,PERIOD_CURRENT,ADX_Period,PRICE_CLOSE,buffer,bar);
      return(ADXValue);
//---  
  }
//+------------------------------------------------------------------+ 
//+------------------------------------------------------------------+ 
double GetCustom(int bar,string sym,int buffer)
  {
//---
      double value = iCustom(sym,PERIOD_CURRENT,IndCustom,buffer,bar);
//---  
      return(value);
  }
//+------------------------------------------------------------------+  
//+------------------------------------------------------------------+     
void SendInfoToFTP(string info)
  {
//---
      if(SendFTP_Enable==false)
       return;
      if(SendFTP(info,NULL)==true)
       Print("Information has been sent to FTP successfully at "+TimeToString(TimeCurrent()));
      else
       Print("EA unable to connect FTP, last error was : "+IntegerToString(GetLastError()));
//---
  }
//+------------------------------------------------------------------+  
//+------------------------------------------------------------------+     
void SendInfoToMail(string info)
  {
//---
      if(SendMail_Enable==false)
       return;
      if(SendMail(EmailSubject,info)==true)
       Print("Information has been sent to Mail successfully at "+TimeToString(TimeCurrent()));
      else
       Print("EA unable to connect Mail, last error was : "+IntegerToString(GetLastError()));
//---
  }
//+------------------------------------------------------------------+  
void TakeScreenShot()
  {
//---
      ChartScreenShot(ChartID(),ScreenShot_FileName,ScreenShot_Width,ScreenShot_Height,ScreenShot_Align);
//---  
  }
//+------------------------------------------------------------------+       
void CheckSignal(string sym)
{
}
