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
//...
extern string MM_Set   ="-------Pro MM Setting------";//Pro MM Setting
extern int    MM_MagicNumber = 123;//Pro MM Magic Number
extern double MM_LossStep = 1;//Loss Step
extern double MM_StopLoss = 100;//Stop Loss
//...
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
extern string Dash_Set         = "GUI Setting";//GUI Setting
extern int    Graphic_HPos     = 20;//Graphic Horizental Position
extern int    Graphic_VPos     = 20;//Graphic Vertical Position
extern int    Graphic_HSize    = 200;//Graphic Horizental Size
extern int    Graphic_VSize    = 170;//Graphic Vertical Size
color  DDBGColor        = clrWhiteSmoke;//Drop Down BG Color
extern string Font             = "Arial Bold";//Font
extern int       FontSize      = 10;//Font Size
extern color  FontColor        = clrBlack;//FontColor
extern color  PanelBGColor     = clrLavender;//Panel BG Color
int    row              = 25;//Row Distance
string   datainfo[5];
//....
#import "Telegram4Mql.dll"
   string TelegramSendTextAsync(string ApiKey, string ChatId, string ChatText);
   string TelegramSendText(string ApiKey, string ChatId, string ChatText);
   string TelegramGetUpdates(string ApiKey, string ChatId, bool Flag);
#import
//+------------------------------------------------------------------+
extern string Tele_Set = "Telegram Channel Setting";//Telegram Setting
extern string Telegram_Channel_Token = "611957429:AAEU6y1xIkYqAISbnB-rBa1iVhVdDZzsvvg";
extern string Telegram_Channel_ChatID = "-1001177722439";
//+------------------------------------------------------------------+
//....
//...
extern string MySql_Set                  = "MySQL Setting";//My SQL Setting
extern string ServerName                 = "ServerName";//Server Name
extern string UserName                   = "UserName";//User Name
extern string Password                   = "Password";//Password
extern string DBName                     = "DBName";//Data base name
extern string PhpUrl                     = "https://www.mql4ocean.com/MySQL_DB/index.php";//Php URL
extern string StoreFileName              = "LastResponse.txt";//Log File Name
//...
string URLAddress  = PhpUrl;
//...
//...
//...
extern string Ich_set    = "Ichmuko Setting";
extern int    Tenken_Sen = 9;
extern int    Kijun_Sen  = 26;
extern int    Senku_Sen  = 52;
//...
//...
extern string Ex_Set = "Excel Reader";
extern string InpFileName = "Market 2019.csv";//Excel File Name
extern string InpDirectoryName = "MyFile";//Excel Directory Name
//...
extern int TotalCandles;
3
//...
extern string CCI_Set = "CCI Setting";
extern int    CCI_Period = 14;
extern ENUM_APPLIED_PRICE CCI_Mode = PRICE_CLOSE;
extern double CCI_Above_Level = 100;
extern double CCI_Below_Level = -100;
//...
//---
extern ptype  Pen_Type = BUYLIMIT;
extern int Pen_Total = 5;
extern int Pen_Distence = 150;
extern double Lot_Increase = 1;
extern double Base_Lot_Size = 0.01;
//---
//---
extern ptype ENUUpOrderType = BUYLIMIT;
extern ptype DownOrdeerType= SELLLIMIT;
extern int Grid_Pen_Total = 5;
extern int Grid_Pen_Distence=30;
extern double BaseLotSize= 0.01;
//---
extern int MaximumAllowedSpread  = 30;//Maximum Allowed Spread 
extern string apiKey = "944745323:AAHFL2k1b4y0bwwDflkXGo9Sqqk8Rb3TJXE";
extern string chatId = "-1001172187588";
test
CheckSignal=(){if(
GetMA1(1,sym)>GetMA2(1,sym) && GetMA1(2,sym)<GetMA2(2,sym) || GetStoch(2,sym)<Stoch_OverSold_Level && GetStoch(1,sym)>Stoch_OverSold_Level){
        Trend = OP_BUY;
     }if(GetMA1(1,sym)<GetMA2(1,sym) && GetMA1(2,sym)>GetMA2(2,sym) || GetStoch(2,sym)>Stoch_OverBought_Level && GetStoch(1,sym)<Stoch_OverBought_Level){
        Trend = OP_SELL;
     }}//+----------------------Local variable------------------------------+
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

//+------------------------------------------------------------------+
double ProMM(int loss,string sym)
  {
//---  
      double L = 0;
      double ValidLoss = GetContinuesProfit(sym)+MM_LossStep;
      if(loss>0)
       L = ValidLoss/(loss*MarketInfo(sym,MODE_TICKVALUE));
      while(AccountFreeMarginCheck(sym,OP_SELL,L)<0)
       {       
         L -= MarketInfo(sym,MODE_MINLOT);
         if(L<MarketInfo(sym,MODE_MINLOT))
          break;
       }
      if(L>MarketInfo(sym,MODE_MAXLOT))
       L = MarketInfo(sym,MODE_MAXLOT);
      if(L<MarketInfo(sym,MODE_MINLOT))
       L = MarketInfo(sym,MODE_MINLOT);       
      return(NormalizeDouble(L,2));      
//---      
  }
//+------------------------------------------------------------------+
double GetContinuesProfit(string sym)
  {
//---
      double   P = 0;
      for(int i=OrdersHistoryTotal(); i>=0; i--)
      if(OrderSelect(i,SELECT_BY_POS,MODE_HISTORY)==true)
      if(OrderMagicNumber()==MM_MagicNumber && OrderSymbol()==sym)      
       {
         if(OrderProfit()>0)
          P+=OrderProfit();
         else
          break;
       }
//---  
      return(P);
  }
//+------------------------------------------------------------------+ 
int Distance(double price1, double price2)
  {
//---
      int Diss = int((price1-price2)*MathPow(10,_Digits));  
      if(price1==0 || price2==0)
       Diss = 100;      
      return(MathAbs(Diss));
//---
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
//+------------------------------------------------------------------+
void MakePanel()
  {
//---
       UpgradeDataInfo();
       string lablestext[5]  = {"...","...","...","...","..."};       
       color  lablecolors[5] = {clrRed,clrBlue,clrGreen,clrYellow,clrOrange};
       MakeBackGround("BG",Graphic_HPos,Graphic_VPos,Graphic_HSize,Graphic_VSize,PanelBGColor,0,true);
       MakeGroupLable(lablestext,lablecolors,CORNER_LEFT_UPPER,Graphic_HPos,Graphic_VPos,"");
       UpgradeDataInfo();       
//---  
  }
//+------------------------------------------------------------------+
void MakeBackGround(string name, int hpos, int vpos, int hsize, int vsize, color cl, int zorder, bool select)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_RECTANGLE_LABEL,0,0,0);
      ObjectSet(name,OBJPROP_XDISTANCE,hpos);
      ObjectSet(name,OBJPROP_YDISTANCE,vpos);
      ObjectSet(name,OBJPROP_XSIZE,hsize);
      ObjectSet(name,OBJPROP_YSIZE,vsize);
      ObjectSet(name,OBJPROP_BGCOLOR,cl);
      ObjectSet(name,OBJPROP_SELECTABLE,select);
      ObjectSet(name,OBJPROP_BORDER_COLOR,clrBlack);
      ObjectSet(name,OBJPROP_BORDER_TYPE,BORDER_SUNKEN);
//---  
  }
//+------------------------------------------------------------------+
void MakeButton(string name, string text, int fontsize, int hpos, int vpos, int hsize, int vsize, color cl, color fontcl, bool select, string font)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_BUTTON,0,0,0);
      ObjectSet(name,OBJPROP_XDISTANCE,hpos);
      ObjectSet(name,OBJPROP_YDISTANCE,vpos);
      ObjectSet(name,OBJPROP_XSIZE,hsize);
      ObjectSet(name,OBJPROP_YSIZE,vsize);
      ObjectSet(name,OBJPROP_BGCOLOR,cl);      
      TextSetFont(name,fontsize,FONT_STRIKEOUT,FW_BLACK);
      ObjectSetText(name,text,fontsize,font,fontcl);            
      ObjectSet(name,OBJPROP_COLOR,fontcl);
      ObjectSet(name,OBJPROP_SELECTABLE,select);
//---  
  }
//+------------------------------------------------------------------+
void MakeDropDown(string name, string text, string &item[], color cl, int hpos, int vpos, int hsize, int vsize, bool DDStatus)
  {
//---
      int i = 0;
      MakeButton(name,text,10,hpos,vpos,hsize,22,cl,clrBlack,false,Font);
      MakeLable(name+"arrow",CharToString(218),"WingDings",10,hpos+hsize-15,vpos+2,clrBlack,CORNER_LEFT_UPPER);
      if(DDStatus==true)
       {
         MakeBackGround(name+"List",hpos+2,vpos+20,hsize-1,row*ArraySize(item)+5,cl,1,false);
         for(i=0; i<ArraySize(item); i++)
          MakeLable(name+"Lable"+IntegerToString(i),item[i],Font,8,hpos+5,(vpos+5)+((i+1)*row),clrBlack,CORNER_LEFT_UPPER);
       }
      else
       {
         ObjectDelete(ChartID(),name+"List");
         for(i=0; i<ArraySize(item); i++)
          ObjectDelete(ChartID(),name+"Lable"+IntegerToString(i));         
       }
//---  
  }
//+------------------------------------------------------------------+
void MakeLable(string name, string text, string font, int fontsize, int hpos, int vpos, color cl, ENUM_BASE_CORNER corner)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_LABEL,0,0,0);
      ObjectSetText(name,text,fontsize,font,cl);              
      ObjectSet(name,OBJPROP_XDISTANCE,hpos);
      ObjectSet(name,OBJPROP_YDISTANCE,vpos);
      ObjectSet(name,OBJPROP_COLOR,cl);      
      ObjectSet(name,OBJPROP_CORNER,corner);
      ObjectSet(name,OBJPROP_SELECTABLE,false);
      TextSetFont(name,fontsize,FONT_STRIKEOUT,FW_BLACK);
//---  
  }
//+------------------------------------------------------------------+
void DrawVLine(string name, datetime time, color cl)
  {
//---
      ObjectDelete(ChartID(),name);
      ObjectCreate(ChartID(),name,OBJ_VLINE,0,time,0);
      ObjectSet(name,OBJPROP_COLOR,cl);      
//---  
  }
//+------------------------------------------------------------------+
void MakeEditBox(string name, string lable, string value, int hpos, int vpos, int hsize, int vsize, int fontsize, string font, color cl)
  {
//---
      ObjectCreate(ChartID(),name,OBJ_EDIT,0,0,0);
      ObjectSet(name,OBJPROP_XDISTANCE,hpos);
      ObjectSet(name,OBJPROP_YDISTANCE,vpos);
      ObjectSet(name,OBJPROP_XSIZE,hsize);
      ObjectSet(name,OBJPROP_YSIZE,vsize);
      ObjectSet(name,OBJPROP_BGCOLOR,clrWhite);
      ObjectSet(name,OBJPROP_COLOR,cl);
      ObjectSet(name,OBJPROP_ALIGN,ALIGN_CENTER);
      ObjectSetText(name,value,fontsize,font,cl);
//---
      if(StringLen(value)>0)
       {
         MakeButton(name+"btnup","",10,hpos+hsize+1,vpos-2,15,12,clrWhiteSmoke,clrBlack,false,Font);         
         MakeButton(name+"btndn","",10,hpos+hsize+1,vpos+10,15,12,clrWhiteSmoke,clrBlack,false,Font);
         MakeLable(name+"up",CharToString(217),"WingDings",10,hpos+hsize+1,vpos-3,clrBlack,CORNER_LEFT_UPPER);       
         MakeLable(name+"dn",CharToString(218),"WingDings",10,hpos+hsize+1,vpos+6,clrBlack,CORNER_LEFT_UPPER);  
       }
      if(StringLen(lable)>0)
       MakeLable(name+"lable",lable,Font,10,hpos-35,vpos,clrBlack,CORNER_LEFT_UPPER);
//---  
  }
//+------------------------------------------------------------------+    
void UpDownAction(string editname, bool flag, double step, int dg)
  {
//---
      double value = double(StringToDouble(ObjectGetString(ChartID(),editname,OBJPROP_TEXT)));      
      if(flag==true)
       value = value + step;
      if(flag==false)       
       value = value - step;                    
      ObjectSetString(ChartID(),editname,OBJPROP_TEXT,DoubleToString(NormalizeDouble(value,dg),dg));      
//---  
  }
//+------------------------------------------------------------------+
int GetArrayIndex(string text, string &array[])
  {
//---
      for(int i=0; i<ArraySize(array); i++)
      if(text==array[i])
       return(i);       
//---
     return(0);  
  }
//+------------------------------------------------------------------+
void DisableDropDown(string name,string &item[])
  {
//---
         int hpos    = int(ObjectGetInteger(ChartID(),name,OBJPROP_XDISTANCE)); 
         int vpos    = int(ObjectGetInteger(ChartID(),name,OBJPROP_YDISTANCE));
         int hsize   = int(ObjectGetInteger(ChartID(),name,OBJPROP_XSIZE));
         int vsize   = int(ObjectGetInteger(ChartID(),name,OBJPROP_YSIZE));
         string text = ObjectGetString(ChartID(),name,OBJPROP_TEXT);
         MakeDropDown(name,text,item,DDBGColor,hpos,vpos,hsize,vsize,false);
//---  
  }
//+------------------------------------------------------------------+  
void CheckDropDownEvent(string &darray[], string sparam, string ddname, string disablename1, string disablename2)//, string text)
  {
             int hpos    = int(ObjectGetInteger(ChartID(),ddname,OBJPROP_XDISTANCE)); 
             int vpos    = int(ObjectGetInteger(ChartID(),ddname,OBJPROP_YDISTANCE));
             int hsize   = int(ObjectGetInteger(ChartID(),ddname,OBJPROP_XSIZE));
             int vsize   = int(ObjectGetInteger(ChartID(),ddname,OBJPROP_YSIZE));  
             string text = ObjectGetString(ChartID(),ddname,OBJPROP_TEXT);
             if(sparam==ddname || sparam==ddname+"arrow")
              {
                  //---                     
                     if(ObjectFind(ChartID(),ddname+"List")>=0)
                      {
                        MakeDropDown(ddname,text,darray,DDBGColor,hpos,vpos,hsize,vsize,false);
                      }
                     else
                      {
                        DisableAllDropDown();
                        MakeDropDown(ddname,text,darray,DDBGColor,hpos,vpos,hsize,vsize,true);                      
                      }
                  //---                  
              }
             for(int i=0; i<ArraySize(darray); i++)
              {
                  string name = ddname+"Lable"+IntegerToString(i);
                  if(sparam==name)
                   {                   
                     MakeDropDown(ddname,darray[i],darray,DDBGColor,hpos,vpos,hsize,vsize,false);                      
                   }
              }  
   }
//+------------------------------------------------------------------+
void DisableAllDropDown()
  {
//---
      //All Drop Down Box can be diable one by one here
      //++++++++++++Example Code Is Here+++++++++++++++
//---  
  }
//+------------------------------------------------------------------+  
void OnChartEvent(const int id,         // Event ID 
                  const long& lparam,   // Parameter of type long event 
                  const double& dparam, // Parameter of type double event 
                  const string& sparam  // Parameter of type string events 
  )
  {
//---
         //All Chart Events can ve detect here
         //++++++++++++Here Is An Example Code+++++++++++++         
         if(id==CHARTEVENT_OBJECT_CLICK)
          { 
                        
          } 
         if(id==CHARTEVENT_CLICK)
          {
          }
         //++++++++++++++++++++++++++++++++++++++++++++//        
   }
//+------------------------------------------------------------------+
void Update()
 {
      UpgradeDataInfo();
      for(int i=0; i<ArraySize(datainfo); i++)
       {
             ObjectSetString(ChartID(),"Lable_"+IntegerToString(i),OBJPROP_TEXT,datainfo[i]);
       }
 }     
//+------------------------------------------------------------------+
void UpgradeDataInfo()
  {
      datainfo[0] = "Total Buy : ";
      datainfo[1] = "Total Sell : ";
      datainfo[2] = "Equity : "+DoubleToString(AccountEquity(),2)+"$";
      datainfo[3] = "Time : "+TimeToString(TimeCurrent(),TIME_SECONDS);
      datainfo[4] = "Profit : "+DoubleToString(MathAbs(AccountEquity()-AccountBalance()),2)+"$";
  }
//+-------------------------------------------------------
void MakeGroupButton(int number, string &text[], color &cl[], ENUM_BASE_CORNER corner, int hposoffset, int vposoffset, string extraname)
  {
//---
      for(int i=0; i<MathMin(ArraySize(text),ArraySize(cl)); i++)
       {
         string name = "But_"+IntegerToString(i)+extraname;
         int hsize = 100;//Button Width
         int vsize = 40;//Button Height
         int hpos  = hposoffset+20;//Button Horizental Position
         int vpos  = i * (vsize+5)+vposoffset+20;//Button Vertical Position
         if(corner==CORNER_LEFT_UPPER)
          vpos  = i * (vsize+5)+vposoffset+20;//Button Vertical Position
         if(corner==CORNER_LEFT_LOWER)
          vpos  = i * (vsize+5)+vsize+vposoffset+20;//Button Vertical Position
         if(corner==CORNER_RIGHT_UPPER)
          hpos  = hposoffset+hpos+hsize;//Button Horizental Position          
         if(corner==CORNER_RIGHT_LOWER)
          {
            vpos  = i * (vsize+5)+vsize+vposoffset+20;//Button Vertical Position                    
            hpos  = hposoffset+hpos+hsize;//Button Horizental Position          
          }
         MakeButton(name,text[i],FontSize,hpos,vpos,hsize,vsize,cl[i],FontColor,true,Font);                  
       }
//---  
  }
//+------------------------------------------------------------------+
void MakeGroupLable(string &text[], color &cl[], ENUM_BASE_CORNER corner, int hposoffset, int vposoffset, string extraname)
  {
//---
      for(int i=0; i<MathMin(ArraySize(text),ArraySize(cl)); i++)
       {
         string name = "Lable_"+IntegerToString(i)+extraname;
         int hsize = 100;//Lable Width
         int vsize = 15;//Lable Height
         int hpos  = hposoffset+5;//Button Horizental Position
         int vpos  = i * (vsize+5)+vposoffset+20;//Button Vertical Position
         if(corner==CORNER_LEFT_UPPER)
          vpos  = i * (vsize+5)+vposoffset+20;//Button Vertical Position
         if(corner==CORNER_LEFT_LOWER)
          vpos  = i * (vsize+5)+vposoffset+20;//Button Vertical Position
         if(corner==CORNER_RIGHT_UPPER)
          hpos  = hpos;//Button Horizental Position          
         if(corner==CORNER_RIGHT_LOWER)
          {
            vpos  = i * (vsize+5)+20;//Button Vertical Posi3tion                    
            hpos  = hpos;//Button Horizental Position          
          }
         MakeLable(name,text[i],Font,FontSize,hpos,vpos,FontColor,corner);
       }
//---  
  }
//+------------------------------------------------------------------+
void MakeTableLable(int number, string &text[], color &cl[], ENUM_BASE_CORNER corner)
  {
//---
      for(int i=0; i<MathMin(ArraySize(text),ArraySize(cl)); i++)
       {
         string name = "Lable_"+IntegerToString(i);
         int hsize = 100;//Button Width
         int vsize = 40;//Button Height
         int hpos  = 20;//Button Horizental Position
         int vpos  = i * (vsize+5)+20;//Button Vertical Position
         if(corner==CORNER_LEFT_UPPER)
          vpos  = i * (vsize+5)+20;//Button Vertical Position
         if(corner==CORNER_LEFT_LOWER)
          vpos  = i * (vsize+5)+20;//Button Vertical Position
         if(corner==CORNER_RIGHT_UPPER)
          hpos  = hpos;//Button Horizental Position          
         if(corner==CORNER_RIGHT_LOWER)
          {
            vpos  = i * (vsize+5)+20;//Button Vertical Posi3tion                    
            hpos  = hpos;//Button Horizental Position          
          }
         MakeLable(name,text[i],Font,FontSize,hpos,vpos,cl[i],corner);
       }
//---  
  }
//+------------------------------------------------------------------+
void MakeTableButton(int rownum, int colnum, string &text[][], color &cl[], ENUM_BASE_CORNER corner)
  {
//---
      for(int j=0; j<colnum; j++)
      for(int i=0; i<MathMin(rownum,colnum); i++)
       {
         string name = "But_"+IntegerToString(i)+"_"+IntegerToString(j);
         int hsize   = int((ChartGetInteger(ChartID(),CHART_WIDTH_IN_PIXELS,0)/2)/colnum);//Button Width
         int vsize   = int((ChartGetInteger(ChartID(),CHART_HEIGHT_IN_PIXELS,0)-50)/rownum);//Button Height
         int hpos    = (j*hsize+5)+20;//Button Horizental Position
         int vpos    = i * (vsize+5)+20;//Button Vertical Position
         if(corner==CORNER_LEFT_UPPER)
          vpos  = i * (vsize+5)+20;//Button Vertical Position
         if(corner==CORNER_LEFT_LOWER)
          vpos  = i * (vsize+5)+vsize+20;//Button Vertical Position
         if(corner==CORNER_RIGHT_UPPER)
          hpos  = hpos+hsize;//Button Horizental Position          
         if(corner==CORNER_RIGHT_LOWER)
          {
            vpos  = i * (vsize+5)+vsize+20;//Button Vertical Position                    
            hpos  = hpos+hsize;//Button Horizental Position          
          }
         MakeButton(name,"",FontSize,hpos,vpos,hsize,vsize,cl[i],FontColor,true,Font);
         string lable[4] = {"1","2","3","4"};                    
         MakeGroupLable(lable,cl,CORNER_LEFT_UPPER,hpos,vpos,"_"+IntegerToString(j)+"_"+IntegerToString(i));
       }
//---  
  }
//+------------------------------------------------------------------+
void ButtonAction(string name)
  {
//---
         int hpos    = int(ObjectGetInteger(ChartID(),name,OBJPROP_XDISTANCE)); 
         int vpos    = int(ObjectGetInteger(ChartID(),name,OBJPROP_YDISTANCE));
         int hsize   = int(ObjectGetInteger(ChartID(),name,OBJPROP_XSIZE));
         int vsize   = int(ObjectGetInteger(ChartID(),name,OBJPROP_YSIZE));
         color cl    = color(ObjectGetInteger(ChartID(),name,OBJPROP_BGCOLOR));
         string text = ObjectGetString(ChartID(),name,OBJPROP_TEXT);
         ObjectDelete(ChartID(),name);
         Sleep(200);
         MakeButton(name,text,FontSize,hpos,vpos,hsize,vsize,cl,FontColor,true,"Arial");
//---  
  }
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+
string InsertQuary()
  {
//---
      string InsertQuary = "";
      return(InsertQuary);
//---  
  }
//+------------------------------------------------------------------+
string MakeTableQuery()
  {
//---
      string MakeQuery = "";
      return(MakeQuery);
//---  
  }
//+------------------------------------------------------------------+
string EditQuary()
  {
//---
      string EditQuery = "";
      return(EditQuery);
//---  
  }
//+------------------------------------------------------------------+
string DeleteQuery()
  {
//---
      string DeleteQuery = "";
      return(DeleteQuery);
//---  
  }
//+------------------------------------------------------------------+
void MakeConnection(string Query)
  {
//--- 
   char data[5];   
   string info = "";
   info += "svname = "+ServerName;
   info += "&uname  = "+UserName;
   info += "&Password = "+Password;
   info += "&dbname = "+DBName;
   info += "&query  = "+Query; 
   StringToCharArray(info,data,0,WHOLE_ARRAY,CP_UTF8);
   char   result[];  
   string headers;
//--- Resetting error code 
   ResetLastError(); 
//--- Authorization request 
   int ServerResponse = WebRequest("POST",URLAddress,NULL,"",5000,data,5,result,headers); 
   if(ServerResponse<0)
    Alert("Connection Error : "+IntegerToString(GetLastError()));
   else
    {      
      int filehandle = FileOpen(StoreFileName,FILE_WRITE|FILE_TXT);
      if(filehandle!=INVALID_HANDLE) 
        { 
         //--- Save the contents of the result[] array to a file 
         FileWriteArray(filehandle,result,0,ArraySize(result)); 
         //--- Close the file 
         FileClose(filehandle); 
         //---
         Comment("Response loged in "+StoreFileName);
        }      
    }
//---  
  }  
//+------------------------------------------------------------------+

void SendNotify(string str)
  {
//---

     TelegramSendText(Telegram_Channel_Token,Telegram_Channel_ChatID,str);
       
//---  
  }
//+------------------------------------------------------------------+    
string GetMessage()
  {
//---
      string message = TelegramGetUpdates(Telegram_Channel_Token, Telegram_Channel_ChatID, false);
      Print("Message is : "+message);
      return(message);
//---  
  }
//+------------------------------------------------------------------+  
void SendMobileNotification(string info)
  {
//---
      SendNotification(info);
//---  
  }
//+------------------------------------------------------------------+  
//+------------------------------------------------------------+
double GetIchimuko(int bar,string sym, int mode)
  {
//---
      double ichimukovalue = iIchimoku(sym,PERIOD_CURRENT,Tenken_Sen,Kijun_Sen,Senku_Sen,mode,bar);
//---  
      return(ichimukovalue);
  }
//+------------------------------------------------------------+ 
//+------------------------------------------------------------------+
void ExcelReader()
  {
                     int file_handle=FileOpen(InpDirectoryName+"//"+InpFileName,FILE_READ|FILE_SHARE_READ); 
                     if(file_handle!=INVALID_HANDLE) 
                       { 
                        //--- additional variables                         
                        string str; 
                        string result[];
                        //--- read data from the file 
                        while(!FileIsEnding(file_handle)) 
                          { 
                           str=FileReadString(file_handle);//,str_size); 
                           //--- print the string 
                           int K = StringSplit(str,StringGetChar(",",0),result);
                           double lot = 0;
                           double selltp = 0;
                           double sellprice = 0;
                           double buytp = 0;
                           double buyprice = 0;                           
                           if(K>4)
                            {
                              lot        = StringToDouble(result[0]);
                              selltp     = StringToDouble(result[1]);
                              sellprice  = StringToDouble(result[2]);
                              buytp      = StringToDouble(result[3]);
                              buyprice   = StringToDouble(result[4]);
                              if(lot>0 && result[0]!="Lot")
                               {                                 
                                 Print("EA Find Trade Row by detail : Lot : "+result[0]+" : sell tp : "+result[1]+" : sell price : "+result[2]+" : buy tp : "+result[3]+" : buy price : "+result[4]);
                               }                              
                            }                           
                          } 
                        //--- close the file 
                        FileClose(file_handle); 
                        PrintFormat("Data is read, %s file is closed",InpFileName); 
                       } 
                     else 
                        PrintFormat("Failed to open %s file, Error code = %d",InpFileName,GetLastError());  
       }
//+------------------------------------------------------------------+ 
//+----------------------------------------------------------------+
bool SpreadCheck()
{
//-
int Spread = MarketInfo(Symbol(),MODE_SPREAD);
if(Spread>MaximumAllowedSpread && MaximumAllowedSpread>0)
return(false);
//-
return(true);
}
//+----------------------------------------------------------------+
//+------------------------------------------------------------------+  
int conitiues_candles_detection(int a){

int check_Bullish = 0;
int check_Bearish = 0;
for(int i = (a + 2);i>2;i--)
{
   if(Open[i]<Open[i-1])
     {
         check_Bullish = check_Bullish + 1;
     }
}
for(int k = (a + 2);k>2;k--)
{
   if(Open[k]>Open[k-1])
     {
         check_Bearish = check_Bearish + 1;
     }
}

    if(check_Bearish == a && Open[1]>Open[2])
     {
        return(0);
     }
    else if(check_Bullish == a && Open[1]<Open[2])
     {
        return(1);
     }
    else
    {
        return(2);
    }
}
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+  
double GetCCI(int bar, string sym)
  {
//---
      double CCIValue = iCCI(sym,PERIOD_CURRENT,CCI_Period,CCI_Mode,bar);
      return(CCIValue);
//---  
  }
//+------------------------------------------------------------------+  

//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void DoMartingle(string sym)
  {

//---
   MartingaleLogic();
   GetOrder(sym,Base_Lot_Size);
//---
   double Price = 0;
   double L = Base_Lot_Size;//Base Lot Size will be input value

   for(int i=1; i<=Pen_Total; i++)
     {
      if(Pen_Type==4 || Pen_Type==3)
         Price = Bid + (i*Pen_Distence)*_Point;
      if(Pen_Type==5 || Pen_Type==2)
         Price = Bid - (i*Pen_Distence)*_Point;
      L = L * Lot_Increase;

      PlacePending(sym,Pen_Type,Price,L);
     }
//---
  }
//+----------------------------------------------------------------+
int GetTypeNumber()
  {
//-
   if(Pen_Type==BUYSTOP)
      return(4);
   if(Pen_Type==BUYLIMIT)
      return(2);
   if(Pen_Type==SELLSTOP)
      return(5);
   if(Pen_Type==SELLLIMIT)
      return(3);
//-
   return(-1);
  }
//+----------------------------------------------------------------+
void MartingaleLogic()
  {

  //---
   if(Pen_Type==2 || Pen_Type==4)
      Trend = 0;
//---
   if(Pen_Type==3 || Pen_Type==5)
      Trend = 1;
      
  }
//+----------------------------------------------------------------+
//+------------------------------------------------------------------+ 
void DoGride(string sym)
  {
   double up_price = 0;
   double down_price=0;
   double L = BaseLotSize;//Base Lot Size will be input value
   for(int i=1; i<=Grid_Pen_Total; i++)
     {
      up_price   = Bid + i*Grid_Pen_Distence;
      down_price = Bid - i*Grid_Pen_Distence;
      PlacePending(sym,ENUUpOrderType,up_price,L);
      PlacePending(sym,DownOrdeerType,down_price,L);
     }
  }
//+------------------------------------------------------------------+ 
int Telegram_Sendtext(string api,string Id,string message)
 {      
   //...
   string Text = "&chat_id="+ Id + "&text="+message;
   //++++++++++
   string url = "https://api.telegram.org/bot" + api + "/sendMessage";
   string cookie=NULL,headers; 
   char post[],result[]; 
   int res;   
   ArrayResize(post,StringToCharArray(Text,post,0,WHOLE_ARRAY,CP_UTF8)-1);
   ResetLastError(); 
   int timeout=5000;
   res = WebRequest("POST",url,"",NULL,3000,post,ArraySize(post),result,headers); 
   //---Checking errors 
   
   if(res==-1) 
     { 
      Print("Error in WebRequest. Error code  =",GetLastError()); 
     }
   //----
   return(0);
 }
//+------------------------------------------------------------------+ 

