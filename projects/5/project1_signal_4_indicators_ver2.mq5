//+------------------------------------------------------------------+
//|                                          signal_4_indicators.mq5 |
//|                                  Copyright 2021, MetaQuotes Ltd. |
//|                                             https://www.mql5.com |
//+------------------------------------------------------------------+
#property copyright "Copyright 2021, MetaQuotes Ltd."
#property link      "https://www.mql5.com"
#property version   "1.00"
#property indicator_chart_window

#property indicator_buffers 2
#property indicator_plots 2

//+------------------------------------------------------------------+
//| includes                                                                 |
//+------------------------------------------------------------------+

#resource  "\\Indicators\\heiken_ashi.ex5"

//+------------------------------------------------------------------+
//|  inputs                                                                |
//+------------------------------------------------------------------+
input string               p0="";                        //-------indicator Params--------------
input color                buyArrowColor=clrDodgerBlue;  //Color Of Buy Arrows
input color                sellArrowColor=clrRed;        //Color Of Sell Arrows
input int                  arrowSize=2;                  //Size Of Arrows
input int                  countedCandeles=400;          //Calculated Candeles
input string               p1="";                        //-------PSar Params--------------
input double               PSarStep=0.02;                //PSar step
input double               PSarMax=0.2;                  //PSar Maximum

input string               p2="";                        //-------Bollingar Bands Params--------------
input int                  bollPeriod=20;                //Period
input double               bollDeviations=2.0;           //Deviations
input int                  bollShift=0;                  //Shift
input ENUM_APPLIED_PRICE   bollAppliedPrice=PRICE_CLOSE; //Applied Price
//+------------------------------------------------------------------+
//| Globals                                                                 |
//+------------------------------------------------------------------+
double buffer0[],buffer1[];//indicator buffers
MqlRates currentRates[];
int handle_boolinger,handle_Sar,handle_heiken,handle_fractal;
double boolinger_buffer[],PSar_buffer[],heiken_buffer[],fractal_buffer0[],fractal_buffer1[];


enum signalType
{
   buy,
   sell,
   both,
};
//+------------------------------------------------------------------+
//| Custom indicator initialization function                         |
//+------------------------------------------------------------------+
int OnInit()
{
//--- indicator buffers mapping
   setBuffersSetting();

   ArraySetAsSeries(currentRates,true);
   CopyRates(_Symbol,PERIOD_CURRENT,0,Bars(_Symbol,PERIOD_CURRENT),currentRates);
   
   
   setHandles();
//---
   return(INIT_SUCCEEDED);
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
   CopyRates(_Symbol,PERIOD_CURRENT,0,Bars(_Symbol,PERIOD_CURRENT),currentRates);//refresh currentRates
   
   for(int i=rates_total-prev_calculated-1;i>=0;i--)
   {
   
      if(i>rates_total-10 || i>countedCandeles)
      {
         continue;
      }
      
      
     
      buffer0[0]=EMPTY_VALUE;
      buffer1[0]=EMPTY_VALUE;
      buffer0[i+1]=EMPTY_VALUE;
      buffer1[i+1]=EMPTY_VALUE;
      
   
      
      //---check buy signal 
      if( checkPSar(buy,i))
         if(checkHeiken(buy,i))
            if(checkFractal(i)==buy || checkFractal(i)==both)
               if(checkBool(buy,i))
               {
                  buffer0[i+1]=iLow(_Symbol,PERIOD_CURRENT,i+1);//buy signal on previous candel
                  Alert("BUY SIGNAL ON SYMBOL: ",_Symbol," ON CANDEL: ",iTime(_Symbol,PERIOD_CURRENT,i+1));
               }
               
      //---check sell signal
      if( checkPSar(sell,i))
         if(checkHeiken(sell,i))
            if(checkFractal(i)==sell || checkFractal(i)==both)
               if(checkBool(sell,i))
               {
                  buffer1[i+1]=iHigh(_Symbol,PERIOD_CURRENT,i+1);//sell signal on previous candel
                  Alert("SELL SIGNAL ON SYMBOL: ",_Symbol," ON CANDEL: ",iTime(_Symbol,PERIOD_CURRENT,i+1));
               
               }
   }
   
//--- return value of prev_calculated for next call
   return(rates_total);
}
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void setBuffersSetting()
{
   SetIndexBuffer(0,buffer0,INDICATOR_DATA);
   
   PlotIndexSetInteger(0,PLOT_DRAW_TYPE,DRAW_ARROW);
   PlotIndexSetInteger(0,PLOT_ARROW,233);
   PlotIndexSetInteger(0,PLOT_LINE_WIDTH,arrowSize);
   PlotIndexSetInteger(0,PLOT_LINE_COLOR,buyArrowColor);
   PlotIndexSetString(0,PLOT_LABEL,"buy");
   
   ArraySetAsSeries(buffer0,true);
   //
   SetIndexBuffer(1,buffer1,INDICATOR_DATA);
   
   PlotIndexSetInteger(1,PLOT_DRAW_TYPE,DRAW_ARROW);
   PlotIndexSetInteger(1,PLOT_ARROW,234);
   PlotIndexSetInteger(1,PLOT_LINE_WIDTH,arrowSize);
   PlotIndexSetInteger(1,PLOT_LINE_COLOR,sellArrowColor);
   PlotIndexSetString(1,PLOT_LABEL,"sell");
   
   ArraySetAsSeries(buffer1,true);

}
//+------------------------------------------------------------------+
//| initial set handles                                                               |
//+------------------------------------------------------------------+
void setHandles()
{
   handle_boolinger=iBands(_Symbol,PERIOD_CURRENT,bollPeriod,bollShift,bollDeviations,bollAppliedPrice);
   ArraySetAsSeries(boolinger_buffer,true);
   
   handle_Sar=iSAR(_Symbol,PERIOD_CURRENT,PSarStep,PSarMax);
   ArraySetAsSeries(PSar_buffer,true);
   
   handle_heiken=iCustom(_Symbol,PERIOD_CURRENT,"::Indicators\\heiken_ashi");
   ArraySetAsSeries(heiken_buffer,true);
   
   handle_fractal=iFractals(_Symbol,PERIOD_CURRENT);
   ArraySetAsSeries(fractal_buffer0,true);
   ArraySetAsSeries(fractal_buffer1,true);
   
}
//+------------------------------------------------------------------+
//|  check PSar conditions                                                       |
//+------------------------------------------------------------------+

bool checkPSar(signalType type,int candelIndex)
{
   
   CopyBuffer(handle_Sar,0,candelIndex,3,PSar_buffer);
   
   if(type==sell)
   {
      if(PSar_buffer[1] > currentRates[candelIndex+1].close)
      {
         if(PSar_buffer[2] > currentRates[candelIndex+2].close)
         {
            return true;
         }   
      }
   
   }
   //
   else if(type==buy)
   {
      
      if(PSar_buffer[1] < currentRates[candelIndex+1].close)
      {
         if(PSar_buffer[2] < currentRates[candelIndex+2].close)
         {
            return true;
         }   
      }
   
   }
   
   return false;
}
//+------------------------------------------------------------------+
//|check heiken conditions                                             |
//+------------------------------------------------------------------+
bool checkHeiken(signalType type , int candelIndex)
{
   
   if(type==sell)
   {
      CopyBuffer(handle_heiken,2,candelIndex,3,heiken_buffer);
      
      if(heiken_buffer[1]<heiken_buffer[2])
      {
         return true;
      }
   }
   //
   if(type==buy)
   {
      CopyBuffer(handle_heiken,1,candelIndex,3,heiken_buffer);
      
      if(heiken_buffer[1]>heiken_buffer[2])
      {
         return true;
      }
   }
   
   return false;
}
//+------------------------------------------------------------------+
//|check fractal conditions                                             |
//+------------------------------------------------------------------+
signalType checkFractal(int candelIndex)
{
   CopyBuffer(handle_fractal,0,candelIndex,50,fractal_buffer0);
   CopyBuffer(handle_fractal,1,candelIndex,50,fractal_buffer1);
   double emptyValue=NormalizeDouble(EMPTY_VALUE,Digits());
   for(int i=1;i<49;i++)
   {
      if((i+candelIndex)>(Bars(_Symbol,PERIOD_CURRENT)-2))//Array exeed bars
         return NULL;
         
      if(NormalizeDouble(fractal_buffer0[i],Digits()) != emptyValue)//sell fractal signal
      {
         if(NormalizeDouble(fractal_buffer1[i],Digits()) != emptyValue)
            return both;
         
         return sell;
      }
      if(NormalizeDouble(fractal_buffer1[i],Digits()) != emptyValue)//buy fractal signal
      {  
         
         return buy;
      }
   }
      
   return NULL;  
}
//+------------------------------------------------------------------+
//|  check boolinger conditions                                                       |
//+------------------------------------------------------------------+

bool checkBool(signalType type,int candelIndex)
{
   
   CopyBuffer(handle_boolinger,0,candelIndex,3,boolinger_buffer);
   
   if(type==sell)
   {
      if(currentRates[candelIndex+1].close <boolinger_buffer[1])
      {
         return true;
      }
   
   }
   //
   else if(type==buy)
   {
      if(currentRates[candelIndex+1].close > boolinger_buffer[1])
      {
         return true;
      }
   
   } 
   
    
   return false;
}
