//...
extern string BE_Set = "Break Even Setting";//Break Even Setting
extern bool   BreakEven_Enable = false;//Break Even Enable
extern int    BreakEvenSpace=20;//Break Even Space
//...
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
void CheckSignal(string sym)
{
}
