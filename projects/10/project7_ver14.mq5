//+------------------------------------------------------------------+
//|                                                project7_ver2.mq5 |
//|                                  Copyright 2021, MetaQuotes Ltd. |
//|                                             https://www.mql5.com |
//+------------------------------------------------------------------+
#property copyright "Copyright 2021, MetaQuotes Ltd."
#property link      "https://www.mql5.com"
#property version   "1.00"
#property indicator_chart_window

#property indicator_buffers 2
#property indicator_plots 2
#property indicator_label1  "low_ATR_Stop_Line"
#property indicator_label2  "High_ATR_Stop_Line"
//+------------------------------------------------------------------+
//| includes                                                                 |
//+------------------------------------------------------------------+

#resource  "ATRStopLoss_Ind.ex5"

//+------------------------------------------------------------------+
//|  inputs                                                                |
//+------------------------------------------------------------------+

input string            p0="";                        //----------LINE COLLORS--------------
input color             High_Line_Color=clrGreen; 
input color             Low_Line_Color=clrRed;
input color             Middle_Line_Color=clrCadetBlue;
input color             Fibo_Line_Colors=clrGray; 
input color             High_PTs_Line_Colors=clrIndigo; 
input color             Low_PTs_Line_Colors=clrDeepPink; 
input color             Atr_Stops_Up_Color=clrBlue;
input color             Atr_Stops_Down_Color=clrRed;
input string            p1="";                        //----------TIME SETTINGS--------------

//input color             sellArrowColor=clrRed;        //Color Of Sell Arrows
//input int               arrowSize=2;                  //Size Of Arrows
//input int               countedCandeles=400;          //Calculated Candeles 
//input string            p0="";                        //----------VISUALS--------------
input string            startTimeStrColection="2:30";          //Start of collection Time
input string            endTimeStrColection="3:00";           //End of collection Time
input string            startTimeStrPainting="4:00"; //start of paintion Time
input string            endTimeStrPainting="23:00";   //End of Paintiong Time
input int               GMT_Offset=0;
input string            p2="";                        //----------ATR SETTINGS--------------
input int               AtrPeriod=14;                 //ATR_Period
input ENUM_TIMEFRAMES   period=PERIOD_CURRENT;        //Check timeFrame
input double            Multiplier=1.5;                 //multiplier 
input string            p3="";                        //----ATR Stop Loss Settings----
input bool              showATRStops=true;
input int               AtrStopsLookbackPeriod=10;    //look back period
input double            AtrStopsKV=2.5;               //KV
input string            p4="";                        //----------OTHER SETTINGS--------------
input bool              showFibo=true;
input bool              send_Alert=false;
input bool              send_Email=false;
input bool              send_Notitication=false;

//+------------------------------------------------------------------+
//| Globals                                                                 |
//+------------------------------------------------------------------+
double   buffer0[];//atr indicator buffers
int      handle_AtrStops,handle_ATR;//handle_AtrStops is for an external indicator
double   buffer0_atrStops_original[],buffer1_atrStops_original[],buffer0_atrStops_copied[],buffer1_atrStops_copied[];//atr stops indicator buffers

int      startHourCollection,startMinCollection,endHourCollection,endMinCollection;//just used in refreshCollectionAndPaintingDate()
int      startHourPainting,startMinPainting,endHourPainting,endMinPainting;
datetime startTimeCollection,endTimeCollection,startTimePainting,endTimePainting;   
double   range_high,range_low,Highest_ATR, range_midle, highPt1,highPt2,lowPt1,lowPt2;
datetime previousCandelTime;
bool     lineHighDrawned[13],lineLowDrawned[13];
//bool     PaintingTime=false;
//+------------------------------------------------------------------+
//| Custom indicator initialization function                         |
//+------------------------------------------------------------------+
int OnInit()
  {
//--- indicator buffers mapping
   IndicatorSetString(INDICATOR_SHORTNAME,"project7");
   setHandles();
   setBuffersSetting();
   setStartAndEndTime();
   Print("Perio:  ",PeriodSeconds());
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

   
   refreshCollectionAndPaintingDate();
//Print("ffffffff:    ",inPaintingTime());   
   if(inPaintingTime()!=0)
      if(showATRStops){
         drawATRStops(1);
         if(prev_calculated==0)//for the first time
         {
            ArrayInitialize(buffer0_atrStops_copied,EMPTY_VALUE);
            ArrayInitialize(buffer1_atrStops_copied,EMPTY_VALUE);
           drawATRStops(findStartCandel("painting",PERIOD_CURRENT));
         }
      }   
   if(iTime(_Symbol,PERIOD_CURRENT,0)!=previousCandelTime) //new candel
   {
      previousCandelTime=iTime(_Symbol,PERIOD_CURRENT,0);
      
      if(inPaintingTime()!=0) 
      {
         /*if(!PaintingTime)//the first time
         {
            PaintingTime=true;
            //Print("yesssssssssssssssss");
            //removePreviousAtrStopsLines();
         }*/
         drawLines();  
         
      }
      else //not in painting time
      {
         ArrayInitialize(lineHighDrawned,false);
         ArrayInitialize(lineLowDrawned,false);
         //PaintingTime=false;
         buffer0_atrStops_copied[0]=EMPTY_VALUE;
         buffer1_atrStops_copied[0]=EMPTY_VALUE;
      }
   
   }
//--- return value of prev_calculated for next call
   return(rates_total);
  }
//+------------------------------------------------------------------+
//+------------------------------------------------------------------+
//| indicator deinitialization function                                 |
//+------------------------------------------------------------------+
void OnDeinit(const int reason)
{
   ObjectsDeleteAll(0,"FiboLevels");
   ObjectsDeleteAll(0,"HLine");
   
}
//+------------------------------------------------------------------+
//|     check we are in painting time                                                             |
//+------------------------------------------------------------------+
int inPaintingTime()
{
   int inPTime=0;//is not in painting time
   datetime curr=TimeCurrent();
   if(curr>=startTimePainting &&curr<=endTimePainting )//in todayPainting time
      inPTime=1;
   
   else if(curr>=(startTimePainting-24*60*60) &&curr<=(endTimePainting-24*60*60) )//in yesterday Painting time
      inPTime=2;
   
   else if(curr>=(startTimePainting+24*60*60) &&curr<=(endTimePainting+24*60*60) )//in tomorrow Painting time
      inPTime=3;
   return inPTime;
}
//+------------------------------------------------------------------+
//|         like mql4                                                         |
//+------------------------------------------------------------------+
int TimeDayMQL4(datetime date)
  {
   MqlDateTime tm;
   TimeToStruct(date,tm);
   return(tm.day);
  }
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
int TimeHourMQL4(datetime date)
  {
   MqlDateTime tm;
   TimeToStruct(date,tm);
   return(tm.hour);
  }
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
int TimeMinuteMQL4(datetime date)
  {
   MqlDateTime tm;
   TimeToStruct(date,tm);
   return(tm.min);
  }
 
//+------------------------------------------------------------------+
//|        draw lines on painting time                                                          |
//+------------------------------------------------------------------+
void drawLines()
{
  //---delete previous lines
   
   ObjectsDeleteAll(0,"HLine");
   
   int startCandel=findStartCandel("collection",period);
   int endCandel=findEndCandel("collection",period);
//Print("startCandel:",startCandel,"_endCandel: ",endCandel,"  _startCandelPain: ",findStartCandel("painting",period));
   if(startCandel==endCandel)
      Alert("ERROR: wrong inputs for collection time for symbol ",_Symbol);
   
   if(startCandel>=0)
   {
      int candelHigh=iHighest(_Symbol,period,MODE_HIGH,startCandel-endCandel,endCandel);
      range_high=iHigh(_Symbol,period,candelHigh);
     
      //
      int candelLow=iLowest(_Symbol,period,MODE_HIGH,startCandel-endCandel,endCandel);
      range_low=iLow(_Symbol,period,candelLow);
      //
      range_midle=(range_high+range_low)/2;
      //
      setHighestAtr(startCandel,endCandel);
      
      drawRangeLines();
      drawPts();
      if(showFibo)
         drawFibo();
      
      
   }
   
}
//+------------------------------------------------------------------+
//|   find index of start candel. type= "collection" or "painting"                                                               |
//+------------------------------------------------------------------+
int findStartCandel(string type,ENUM_TIMEFRAMES per)
{
   int startCandel=-1;
   //
   int shift=0;
   if(inPaintingTime()==2)//yesterday
      shift=24*60*60*(-1);
   else if(inPaintingTime()==3)//tomorrow
      shift=24*60*60;
   //
   for(int i=0;;i++) //loop on candels until exceed start candel
   {
      datetime candelTime=iTime(_Symbol,per,i);
      if(type=="collection")
      {
      
     
         if(candelTime<startTimeCollection+shift)      
            break; 
          
      }
      else if(type=="painting")
      {
         if(candelTime<startTimePainting+shift)
            break;
      }
         
      startCandel=i; 
   }
   return startCandel;
}
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
int findEndCandel(string type,ENUM_TIMEFRAMES per )
{
   //
   int shift=0;
   if(inPaintingTime()==2)//yesterday
      shift=24*60*60*(-1);
   else if(inPaintingTime()==3)//tomorrow
      shift=24*60*60;
   //
   int endCandel=0;
   for(int i=0;;i++) //loop on candels until exceed start candel
   {
      datetime candelTime=iTime(_Symbol,per,i);
      if(type=="collection")
      {
         if(candelTime<endTimeCollection+shift)
            break; 
          
      }
      
         
      endCandel=i+1; 
   }
   return endCandel;
}

//+------------------------------------------------------------------+
//|               calc highest atr in collection time                                                   |
//+------------------------------------------------------------------+
void setHighestAtr(int startCandel,int endCandel)
{
//Print("start Candel: ",startCandel,"  endCandel:",endCandel);
   CopyBuffer(handle_ATR,0,0,startCandel+1,buffer0);
   Highest_ATR=0;
   for(int i=endCandel;i<=startCandel;i++)
   {
      if(buffer0[i]>Highest_ATR)
      {
         Highest_ATR=buffer0[i];  
         //Print("time[i]:  ",iTime(_Symbol,PERIOD_CURRENT,i));
      }
   }
  // Print("Highest_ATR: ",Highest_ATR);
  
}
//+------------------------------------------------------------------+
//|                   update (remove and draw again ) high low and middle line on start of each candel                                               |
//+------------------------------------------------------------------+
void drawRangeLines()
{//static int r=0;
   int startPaintingCandel=findStartCandel("painting",period);
//Print("startPaintingCandel: ",startPaintingCandel);   
   
   ObjectCreate(0,"HLine_rangeHighLine",OBJ_TREND,0,iTime(_Symbol,period,startPaintingCandel),range_high,iTime(_Symbol,period,0)+5*PeriodSeconds(),range_high);
   ObjectSetInteger(0,"HLine_rangeHighLine",OBJPROP_RAY,false);
   ObjectSetInteger(0,"HLine_rangeHighLine",OBJPROP_COLOR,High_Line_Color);
   //
   ObjectCreate(0,"HLine_rangeLowLine",OBJ_TREND,0,iTime(_Symbol,period,startPaintingCandel),range_low,iTime(_Symbol,period,0)+5*PeriodSeconds(),range_low);
   ObjectSetInteger(0,"HLine_rangeLowLine",OBJPROP_RAY,false);
   ObjectSetInteger(0,"HLine_rangeLowLine",OBJPROP_COLOR,Low_Line_Color);
   //
   ObjectCreate(0,"HLine_rangeMiddleLine",OBJ_TREND,0,iTime(_Symbol,period,startPaintingCandel),range_midle,iTime(_Symbol,period,0)+5*PeriodSeconds(),range_midle);
   ObjectSetInteger(0,"HLine_rangeMiddleLine",OBJPROP_RAY,false);
   ObjectSetInteger(0,"HLine_rangeMiddleLine",OBJPROP_COLOR,Middle_Line_Color);
   //
   if(lineHighDrawned[0]==false)//send alert
   {
      
      string alert="new High,Low,midLine,fibo were drawn. ";
      if(send_Alert)
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
   
      lineHighDrawned[0]=true;
   }
}
//+------------------------------------------------------------------+
//|                          update (remove and draw again ) pt lines                                       |
//+------------------------------------------------------------------+
void drawPts()
{
   int startPaintingCandel=findStartCandel("painting",PERIOD_CURRENT);
   if(startPaintingCandel==0) 
      return;
   double highestClose=iClose(_Symbol,PERIOD_CURRENT,iHighest(_Symbol,PERIOD_CURRENT,MODE_CLOSE,startPaintingCandel,1));
   double lowestClose=iClose(_Symbol,PERIOD_CURRENT,iLowest(_Symbol,PERIOD_CURRENT,MODE_CLOSE,startPaintingCandel,1));

   for(int i=0;i<=10;i++)
   {
      //---draw highPt
      
      double highPt=range_high+i*(Highest_ATR*Multiplier);
      if(highestClose>highPt)
      {
     
         double nextHighPt=range_high+(i+1)*(Highest_ATR*Multiplier);
         string name="HLine_highPtLine_"+(string)(i+1);
         if(ObjectCreate(0,name,OBJ_TREND,0,iTime(_Symbol,PERIOD_CURRENT,startPaintingCandel),nextHighPt,iTime(_Symbol,PERIOD_CURRENT,0)+5*PeriodSeconds(),nextHighPt))
         {
            ObjectSetInteger(0,name,OBJPROP_RAY,false);
            ObjectSetInteger(0,name,OBJPROP_COLOR,High_PTs_Line_Colors);
            if(lineHighDrawned[i+1]==false)//send alert
            {
               string alert="new High_PT was drawn. line name= "+name;
               if(send_Alert)
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
               
               lineHighDrawned[i+1]=true;
            }
         }
      }
      //
         //---draw lowPt
      double lowPt=range_low-i*(Highest_ATR*Multiplier);
      if(lowestClose<lowPt)
      {
         double nextLowPt=range_low-(i+1)*(Highest_ATR*Multiplier);
         string name="HLine_lowPtLine_"+(string)(i+1);
         if(ObjectCreate(0,name,OBJ_TREND,0,iTime(_Symbol,PERIOD_CURRENT,startPaintingCandel),nextLowPt,iTime(_Symbol,PERIOD_CURRENT,0)+5*PeriodSeconds(),nextLowPt))
         {
            ObjectSetInteger(0,name,OBJPROP_RAY,false);
            ObjectSetInteger(0,name,OBJPROP_COLOR,Low_PTs_Line_Colors);
            if(lineLowDrawned[i+1]==false)//send alert
            {
               string alert="new low_PT was drawn. line name= "+name;
               if(send_Alert)
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
               
               lineLowDrawned[i+1]=true;
            }
         }
      }
   }
}
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+

void drawFibo()
{
   int startCandel=findStartCandel("painting",period);
   
   double fibo_value;
   
   fibo_value=range_low+0.236*(range_high-range_low);
   ObjectCreate(0,"HLine_FiboLevels_236",OBJ_TREND,0,iTime(_Symbol,period,startCandel),fibo_value,iTime(_Symbol,period,0)+5*PeriodSeconds(),fibo_value);
   ObjectSetInteger(0,"HLine_FiboLevels_236",OBJPROP_RAY,false);
   ObjectSetInteger(0,"HLine_FiboLevels_236",OBJPROP_COLOR,Fibo_Line_Colors);
   
   fibo_value=range_low+0.382*(range_high-range_low);
   ObjectCreate(0,"HLine_FiboLevels_382",OBJ_TREND,0,iTime(_Symbol,period,startCandel),fibo_value,iTime(_Symbol,period,0)+5*PeriodSeconds(),fibo_value);
   ObjectSetInteger(0,"HLine_FiboLevels_382",OBJPROP_RAY,false);
   ObjectSetInteger(0,"HLine_FiboLevels_382",OBJPROP_COLOR,Fibo_Line_Colors);
   
   fibo_value=range_low+0.5*(range_high-range_low);
   ObjectCreate(0,"HLine_FiboLevels_5",OBJ_TREND,0,iTime(_Symbol,period,startCandel),fibo_value,iTime(_Symbol,period,0)+5*PeriodSeconds(),fibo_value);
   ObjectSetInteger(0,"HLine_FiboLevels_5",OBJPROP_RAY,false);
   ObjectSetInteger(0,"HLine_FiboLevels_5",OBJPROP_COLOR,Fibo_Line_Colors);
   
   fibo_value=range_low+0.618*(range_high-range_low);
   ObjectCreate(0,"HLine_FiboLevels_618",OBJ_TREND,0,iTime(_Symbol,period,startCandel),fibo_value,iTime(_Symbol,period,0)+5*PeriodSeconds(),fibo_value);
   ObjectSetInteger(0,"HLine_FiboLevels_618",OBJPROP_RAY,false);
   ObjectSetInteger(0,"HLine_FiboLevels_618",OBJPROP_COLOR,Fibo_Line_Colors);
   
   fibo_value=range_low+0.764*(range_high-range_low);
   ObjectCreate(0,"HLine_FiboLevels_764",OBJ_TREND,0,iTime(_Symbol,period,startCandel),fibo_value,iTime(_Symbol,period,0)+5*PeriodSeconds(),fibo_value);
   ObjectSetInteger(0,"HLine_FiboLevels_764",OBJPROP_RAY,false);
   ObjectSetInteger(0,"HLine_FiboLevels_764",OBJPROP_COLOR,Fibo_Line_Colors);
   
   
}
//+------------------------------------------------------------------+
//| initial set handles                                              |
//+------------------------------------------------------------------+
void setHandles()
{
   handle_ATR=iATR(_Symbol,period,AtrPeriod);
   ArraySetAsSeries(buffer0,true);
   
   handle_AtrStops=iCustom(_Symbol,PERIOD_CURRENT,"::ATRStopLoss_Ind",AtrStopsLookbackPeriod,AtrPeriod,AtrStopsKV);
   ArraySetAsSeries(buffer0_atrStops_original,true);
   ArraySetAsSeries(buffer1_atrStops_original,true);
   
   
}


//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void setBuffersSetting()
{
   SetIndexBuffer(0,buffer0_atrStops_copied,INDICATOR_DATA);
   
   PlotIndexSetInteger(0,PLOT_DRAW_TYPE,DRAW_LINE);
   PlotIndexSetInteger(0,PLOT_LINE_COLOR,Atr_Stops_Down_Color);
  
   ArraySetAsSeries(buffer0_atrStops_copied,true);
   ArrayInitialize(buffer0_atrStops_copied,EMPTY_VALUE);
   //
   SetIndexBuffer(1,buffer1_atrStops_copied,INDICATOR_DATA);
   
   PlotIndexSetInteger(1,PLOT_DRAW_TYPE,DRAW_LINE);
   PlotIndexSetInteger(1,PLOT_LINE_COLOR,Atr_Stops_Up_Color);
   
   ArraySetAsSeries(buffer1_atrStops_copied,true);

   ArrayInitialize(buffer1_atrStops_copied,EMPTY_VALUE);
   //removePreviousAtrStopsLines();
}
//+------------------------------------------------------------------+
//|     use ATRStopLoss_Ind indicator to draw lines                    |
//+------------------------------------------------------------------+
void drawATRStops(int count)
{
   //ArrayFill(buffer0_atrStops_copied,0,100,EMPTY_VALUE);
   //ArrayFill(buffer1_atrStops_copied,0,100,EMPTY_VALUE);
   CopyBuffer(handle_AtrStops,0,0,count,buffer0_atrStops_copied);
   CopyBuffer(handle_AtrStops,1,0,count,buffer1_atrStops_copied);
   
   //ArrayFill(buffer0_atrStops_copied,count,100,EMPTY_VALUE);
   //ArrayFill(buffer1_atrStops_copied,count,100,EMPTY_VALUE);
   /*for(int i=0;i<count;i++)
   {
      buffer0_atrStops_copied[i]=buffer0_atrStops_original[i];
      buffer1_atrStops_copied[i]=buffer1_atrStops_original[i];
   }*/
   //Print("count: ",count);
  // Print("buf0: ",buffer0_atrStops_copied[53]);
   //
  
   //Print(TimeCurrent(),"__ ",buffer0_atrStops_copied[3]);
   //Print(TimeCurrent(),"__ ",buffer1_atrStops_copied[3]);
}
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
//void removePreviousAtrStopsLines()
//{
   //ArrayInitialize(buffer0_atrStops_copied,EMPTY_VALUE);
   //ArrayInitialize(buffer1_atrStops_copied,EMPTY_VALUE);
//}
//+------------------------------------------------------------------+
//|     run at the begining of each day                                              |
//+------------------------------------------------------------------+
void refreshCollectionAndPaintingDate()
{
   static int currentDay;
   if(currentDay!=TimeDayMQL4(TimeCurrent()))//new day
   {
      currentDay=TimeDayMQL4(TimeCurrent());
      //setStartAndEndTime();//(startHourCollection,startMinCollection,endHourCollection,endMinCollection,startHourPainting,startMinPainting,endHourPainting,endMinPainting);
      int currDayStartDate =(int) StringToTime(TimeToString(TimeCurrent(),TIME_DATE));//today date at 00:00
      startTimeCollection=currDayStartDate+startHourCollection*60*60+startMinCollection*60;
      endTimeCollection=currDayStartDate+endHourCollection*60*60+endMinCollection*60;
      startTimePainting=currDayStartDate+startHourPainting*60*60+startMinPainting*60;
      endTimePainting=currDayStartDate+endHourPainting*60*60+endMinPainting*60;
      //Print("aaaaa: ",startTimeCollection,"endTimeCollection",endTimeCollection,"-startTimePainting-",startTimePainting,"-endTimePainting-",endTimePainting);
      if(startTimeCollection >endTimeCollection)
         Alert("error on inputs :end of collection time must be greater than start of collection time!!!");
         
      if(startTimePainting>endTimePainting)
         Alert("error on inputs :end of painting time must be greater than start of painting time!!!");
         
      if(startTimePainting<endTimeCollection)
         Alert("error on inputs :start of painting time must be greater than end of collection time!!!");
      
         
      //Print("ssss:",Date," int:",(int)Date," double:",(double)Date);
//      Print("ssssssssssssss:",startHourCollection," _ ",startMinCollection);//,endHourCollection,endMinCollection,startHourPainting,startMinPainting,endHourPainting,endMinPainting);
      
   }
}

 //+------------------------------------------------------------------+
//|           convert input(string) to start and end value(int)                                                       |
//+------------------------------------------------------------------+
void setStartAndEndTime()//(int &startHourCollection,int &startMinCollection,int &endHourCollection,int &endMinCollection,int &startHourPainting,int &startMinPainting,int &endHourPainting,int &endMinPainting)
{

   string result[];
   StringSplit(startTimeStrColection,':',result);
   startHourCollection=(int)result[0]+GMT_Offset;
   startMinCollection=(int)result[1];
   //
   StringSplit(endTimeStrColection,':',result);
   endHourCollection=(int)result[0]+GMT_Offset;
   endMinCollection=(int)result[1];
   //

   StringSplit(startTimeStrPainting,':',result);
   startHourPainting=(int)result[0]+GMT_Offset;
   startMinPainting=(int)result[1];
   //
   StringSplit(endTimeStrPainting,':',result);
   endHourPainting=(int)result[0]+GMT_Offset;
   endMinPainting=(int)result[1];
   
  
   /*if(startHourCollection<0)
   {
       Alert(" collection time input is refers to yesterday!!!");
       
   }
   if(endHourPainting>=24)
   {
       Alert("painting time input is refers to tomorrow!!!");
       
   }*/
    
}