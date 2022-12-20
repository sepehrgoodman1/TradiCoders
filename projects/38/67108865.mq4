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
void CheckSignal(string sym)
{
}
