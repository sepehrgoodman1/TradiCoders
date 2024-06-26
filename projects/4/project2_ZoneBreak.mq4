//+------------------------------------------------------------------+
//|                                                    ZoneBreak.mq4 |
//|                        Copyright 2021, MetaQuotes Software Corp. |
//|                                             https://www.mql5.com |
//+------------------------------------------------------------------+
#property copyright "Copyright 2021, MetaQuotes Software Corp."
#property link      "https://www.mql5.com"
#property version   "1.00"
#property strict
#property indicator_chart_window

#property indicator_buffers 2
#property indicator_label1 "UP_ARROW"
#property indicator_label2 "DOWN_ARROW"

//+------------------------------------------------------------------+
//|  ENUMS                                                        |
//+------------------------------------------------------------------+
enum modes
{
   MINMAX,
   CLOSE,
};

//+------------------------------------------------------------------+
//|       inputs                                                           |
//+------------------------------------------------------------------+
input int countCandel=5;//Previous Counted Candeles
input modes mode=MINMAX;//Mode Of Calculation
input color buyArrowColor=clrDodgerBlue;//Color Of Buy Arrows
input color sellArrowColor=clrRed;//Color Of Sell Arrows
input int arrowSize=2;//Arrows Size
//+------------------------------------------------------------------+
//|  GLOBALS                                                                |
//+------------------------------------------------------------------+
double buffer0[],buffer1[];
//+------------------------------------------------------------------+
//| Custom indicator initialization function                         |
//+------------------------------------------------------------------+
int OnInit()
{
   SetIndexBuffer(0,buffer0);
   SetIndexBuffer(1,buffer1);
   
   SetIndexStyle(0,DRAW_ARROW,EMPTY,arrowSize,buyArrowColor);
   SetIndexStyle(1,DRAW_ARROW,EMPTY,arrowSize,sellArrowColor);

   SetIndexArrow(0,233);
   SetIndexArrow(1,234);  
   
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
   for(int i=rates_total-prev_calculated-1;i>=0;i--)
   {
   
      if(i>rates_total-countCandel-10){    
         continue;
      }
      //
      double highest,lowest;
      if(mode==MINMAX)//for MINMAX mode
      {
         highest=High[iHighest(_Symbol,_Period,MODE_HIGH,countCandel,i+2)];
         lowest=Low[iLowest(_Symbol,_Period,MODE_LOW,countCandel,i+2)];
         if(Close[i+1]>highest)//break up
         {
            buffer0[i+1]=Low[i+1];
            Rectangle(0,"rect"+TimeToStr(Time[i+2]),0,Time[i+2],lowest,Time[i+countCandel+2],highest,buyArrowColor,STYLE_DASH);
         }
         else if(Close[i+1]<lowest)//break down
         {
            buffer1[i+1]=High[i+1];
            Rectangle(0,"rect"+TimeToStr(Time[i+2]),0,Time[i+2],lowest,Time[i+countCandel+2],highest,sellArrowColor,STYLE_DASH);
         }         
      }
      
      else if(mode==CLOSE)//for CLOSE mode
      {
         highest=Close[iHighest(_Symbol,_Period,MODE_CLOSE,countCandel,i+2)];
         lowest=Close[iLowest(_Symbol,_Period,MODE_CLOSE,countCandel,i+2)];
         if(Close[i+1]>highest)//break up
         {
            buffer0[i+1]=Low[i+1];
            Rectangle(0,"rect"+TimeToStr(Time[i+2]),0,Time[i+2],lowest,Time[i+countCandel+2],highest,buyArrowColor,STYLE_DASH);
         }
         else if(Close[i+1]<lowest)//break down
         {
            buffer1[i+1]=High[i+1];
            Rectangle(0,"rect"+TimeToStr(Time[i+2]),0,Time[i+2],lowest,Time[i+countCandel+2],highest,sellArrowColor,STYLE_DASH);
         }         
      }
       
      
   }
//--- return value of prev_calculated for next call
   return(rates_total);
}
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void OnDeinit(const int reason)
{

   ObjectsDeleteAll(0,"rect");
}
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+
//| drawing (Rectangle)                                                |
//+------------------------------------------------------------------+  

bool Rectangle(const long                  chart_ID=0,        
                     const string          name="Rectangle", 
                     const int             sub_window=0,     
                     datetime              time1=0,          
                     double                price1=0,         
                     datetime              time2=0,           
                     double                price2=0,          
                     const color           clr=clrRed,        
                     const ENUM_LINE_STYLE style=STYLE_SOLID, 
                     const int             width=1,           
                     const bool            fill=false,        
                     const bool            back=false,       
                     const bool            selection=false,    
                     const bool            hidden=true,       
                     const long            z_order=0)         
  {
   ResetLastError();
   if(ObjectCreate(chart_ID,name,OBJ_RECTANGLE,sub_window,time1,price1,time2,price2))
     {
      ObjectSetInteger(chart_ID,name,OBJPROP_COLOR,clr);
      ObjectSetInteger(chart_ID,name,OBJPROP_STYLE,style);
      ObjectSetInteger(chart_ID,name,OBJPROP_WIDTH,width);
      ObjectSetInteger(chart_ID,name,OBJPROP_FILL,fill);
      ObjectSetInteger(chart_ID,name,OBJPROP_BACK,back);
      ObjectSetInteger(chart_ID,name,OBJPROP_SELECTABLE,selection);
      ObjectSetInteger(chart_ID,name,OBJPROP_SELECTED,selection);
      ObjectSetInteger(chart_ID,name,OBJPROP_HIDDEN,hidden);
      ObjectSetInteger(chart_ID,name,OBJPROP_ZORDER,z_order);
      ChartRedraw();
      return(true);
           }
     else {
      Print(__FUNCTION__,
             ": failed to create => ",name," object! Error code = ",GetLastError());
      return(false);
          }
  }