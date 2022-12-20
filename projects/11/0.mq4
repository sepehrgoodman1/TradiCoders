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
    if(Open[2]== Close[1] && Open[2]<Open[1])
     {
        Trend = OP_BUY;
     }
    if(Open[2]== Close[1] && Open[2]>Open[1])
     {
        Trend = OP_SELL;     
     }
     
//---Start ATR Logic
      if(GetATR(1,sym)<ATR_Cross_Level && GetATR(2,sym)>ATR_Cross_Level)
       {
        Trend = OP_SELL;
       }
      if(GetATR(1,sym)>ATR_Cross_Level && GetATR(2,sym)<ATR_Cross_Level)
       {
        Trend = OP_BUY;       
       }
//---End ATR Logic      

//---Start MA Logic
    if(Close[1]<Close[2]&& (Close[1]-Open[1])>(Close[2]-Open[2]))
     {
        Trend = OP_BUY;
     }
    if(Close[1]>Close[2]&& (Close[1]-Open[1])<(Close[2]-Open[2]))
     {
        Trend = OP_SELL;     
     }
//---End MA Logic

//---Start MACD Logic
      if(GetMACD(2,sym)>MACD_Cross_Level && GetMACD(1,sym)<MACD_Cross_Level)
       {
       	Trend = OP_SELL;
       }
      if(GetMACD(2,sym)<MACD_Cross_Level && GetMACD(1,sym)>MACD_Cross_Level)
       {
        Trend = OP_BUY;       
       }
//---End MACD Logic
//---Start RSI Logic
      if(GetRSI(2,sym)>RSI_High_Level && GetRSI(1,sym)<RSI_High_Level)
       {
        Trend = OP_SELL;
       }
      if(GetRSI(2,sym)<RSI_Low_Level && GetRSI(1,sym)>RSI_Low_Level)
       {
        Trend = OP_BUY;       
       }
//---End RSI Logic      
//---Start Ichimuko Logic
    if(GetIchimuko(1,sym,MODE_TENKANSEN)>GetIchimuko(1,sym,MODE_KIJUNSEN) && GetIchimuko(2,sym,MODE_TENKANSEN)<GetIchimuko(2,sym,MODE_KIJUNSEN))
     {
        Trend = OP_BUY;
     }
    if(GetIchimuko(1,sym,MODE_TENKANSEN)<GetIchimuko(1,sym,MODE_KIJUNSEN) && GetIchimuko(2,sym,MODE_TENKANSEN)>GetIchimuko(2,sym,MODE_KIJUNSEN))
     {
        Trend = OP_SELL;     
     }
//---End Ichimuko Logic
//---Start MA Logic
    if(Open[1]<GetMA1(1,sym)&& Close[1]>GetMA1(1,sym))
     {
        Trend = OP_BUY;
     }
    if(Open[1]>GetMA1(1,sym)&& Close[1]<GetMA1(1,sym))
     {
        Trend = OP_SELL;     
     }
//---End MA Logic

    if(Open[2]<Open[3] && ((MathAbs(Low[1]-Open[1]))/(MathAbs(Close[1]-Open[1])))>=2)
     {
        Trend = OP_BUY;
     }
    if(Open[2]>Open[3] && ((MathAbs(High[1]-Open[1]))/(MathAbs(Close[1]-Open[1])))>=2)
     {
        Trend = OP_SELL;     
     }
    if(conitiues_candles_detection(TotalCandles)== 0)
     {
        Trend = OP_BUY;
     }
    if(conitiues_candles_detection(TotalCandles)== 1)
     {
        Trend = OP_SELL;     
     }
if(MathAbs(Open[1]-Low[1])/MathAbs(Open[1]-Close[1])>= 3 && Low[1]<Low[2] && Close[1] >= Close[2])
     {
        Trend = OP_BUY;
     }
    if(MathAbs(Open[1]-High[1])/MathAbs(Open[1]-Close[1])>= 3 && High[1]>High[2] && Open[1]>= Open[2])
     {
        Trend = OP_SELL;     
     }
   if(Open[3]>Close[3] && Open[1]>Close[3] && Open[1]<Close[1]&& MathAbs(High[2]-Close[2])>MathAbs(Open[1]-Close[1])&&MathAbs(Low[2]-Open[2])>MathAbs(Open[2]-Close[2]))
     {
        Trend = OP_BUY;
     }
    if(MathAbs(Open[3]-Close[3])>MathAbs(High[3]-Close[3]) && Open[3]<Close[3] && Open[2]<Close[2] && MathAbs(High[2]-Close[2])>MathAbs(Open[2]-Close[2])&& Open[1] > Close[1] && Open[1]>Open[2] && MathAbs(Open[1]-Close[1])>MathAbs(High[1]-Open[1]))
     {
        Trend = OP_SELL;     
     }
if(GetCustom(1,sym,IndCustom_BuyBuffer)== 0)
     {
        Trend = OP_BUY;
     }
    if(GetCustom(1,sym,IndCustom_BuyBuffer)== 1)
     {
        Trend = OP_SELL;     
     }
//+------------------------------------------------------------------+ 
//---Start CCI Logic
      if(GetCCI(2,sym)>CCI_Above_Level && GetCCI(1,sym)<CCI_Above_Level)
       {
        Trend = OP_SELL;
       }
      if(GetCCI(2,sym)<CCI_Below_Level && GetCCI(1,sym)>CCI_Below_Level)
       {
        Trend = OP_BUY;       
       }
//--- End  CCI Logic 
//+------------------------------------------------------------------+  
      double BreakOutLine = 0;
    if(Open[1]<BreakOutLine && Close[1]>BreakOutLine)
     {
        Trend = OP_BUY;
     }
    if(Open[1]>BreakOutLine && Close[1]<BreakOutLine)
     {
        Trend = OP_SELL;     
     }
//+------------------------------------------------------------------+  
}
