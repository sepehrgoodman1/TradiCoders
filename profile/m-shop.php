<!DOCTYPE html>
<html lang="fa-IR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- My Css -->
    <link rel="stylesheet" href="https://tradicoders.ir/css/global.css" />
    <link rel="stylesheet" href="css/profile.css" />
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css" />

    <title>مدیریت محصولات</title>
  </head>
  <body class="Rtl P30">
    <div class="content-wrapper">
      <div class="P_Tab_Prod">
        <div class="Prod_Filter Active_Prod">محصولات فعال</div>
        <div class="Prod_Filter">حذف شده ها</div>
      </div>
      <div class="P_Table">
        <table class="table table-striped">
          <thead>
            <tr class="TextStart">
              <th scope="col">ایدی</th>
              <th scope="col">محصول</th>
              <th scope="col">تخفیف %</th>
              <th scope="col">قیمت (تومان)</th>
              <th scope="col">تعغیرات</th>
            </tr>
          </thead>
          <tbody>
            <tr class="TextStart">
              <th scope="row" class="W40">1</th>
              <td>
                <div>
                  <img
                    src="https://tradicoders.ir/assets/images/wordpress.jpg"
                    alt="image product"
                    class="ImgProd"
                  />
                  <span class="TextProd">محصول شماره یک</span>
                </div>
              </td>
              <td>
                <input type="text" value="55%" class="InputOfPrice" />
              </td>
              <td>
                <input type="text" value="250000" class="InputOfPrice" />
              </td>
              <td>
                <button class="FastChange">اصلاح سریع</button>
                <button class="NormalChange">اصلاح</button>
                <button class="DeleteProd">حذف</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
