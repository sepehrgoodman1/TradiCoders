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
extern string RSI_Set = "RSI Setting";
extern int    RSI_Period = 14;
extern ENUM_APPLIED_PRICE RSI_Price = PRICE_CLOSE;
extern double RSI_High_Level = 70;
extern double RSI_Low_Level = 30;
//...
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
      //I am new one      
        //---Start MA Logic
    if(GetMA1(1,sym)>GetMA2(1,sym) && GetMA1(2,sym)<GetMA2(2,sym))
     {
        Trend = OP_BUY;
     }
    if(GetMA1(1,sym)<GetMA2(1,sym) && GetMA1(2,sym)>GetMA2(2,sym))
     {
     	Trend = OP_SELL;     
     }
//---End MA Logic
}
