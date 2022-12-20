//...
extern string MA2_Set = "Moving Average2 Setting";//MA 2 Setting
extern int    Moving2_Period = 74;//Moving Period 2
extern ENUM_MA_METHOD Moving2_Method = MODE_SMA;//Moving Method 2
extern ENUM_APPLIED_PRICE Moving2_Price = PRICE_CLOSE;//Moving Applied Price 2
//...
//...
extern string BB_Set = "Bollinger Band Setting";
extern int    BB_Period = 21;
extern int    BB_Shift  = 0;
extern double BB_Deviation = 2;
//...
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
double GetBB(int bar,string sym,int mode)
  {
//---
      double BBValue = iBands(sym,PERIOD_CURRENT,BB_Period,BB_Deviation,BB_Shift,PRICE_CLOSE,mode,bar);
      return(BBValue);
//---  
  }
//+------------------------------------------------------------------+  
void CheckSignal(string sym)
{
    if(Open[2]== Close[1] && Open[2]<Open[1])
     {
        Trend = OP_BUY;
     }
    if(Open[2]== Close[1] && Open[2]>Open[1])
     {
        Trend = OP_SELL;     
     }
     
}
