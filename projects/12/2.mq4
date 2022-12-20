#property copyright "Copyright 2019, Made by EEECAD"
#property link      "https://www.eeecad.ir"
#property version   "1.00"
#property strict
extern int    StopLoss=0;//Stop Loss
extern int    TakeProfit=0;//Take Profit
extern int    MagicNumber = 123;//Magic Number
extern double LotSize = 0.01;//Lot Size
extern bool   Close_By_Reverse_Signal = true;//Close By Reverse Signal
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

void CheckSignal(string sym)
{
//---Start Stochastic Logic
      if(GetStoch(2,sym)>Stoch_OverBought_Level && GetStoch(1,sym)<Stoch_OverBought_Level)
       {
        Trend = OP_SELL;
       }
      if(GetStoch(2,sym)<Stoch_OverSold_Level && GetStoch(1,sym)>Stoch_OverSold_Level)
       {
        Trend = OP_BUY;       
       }
//---End Stochastic Logic
}
