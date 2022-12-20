<!DOCTYPE html>
<html lang="fa-IR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Css Codes -->
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/main.css" />

    <!-- Font Awesome Icon-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Aos Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="assets/images/Logo.gif" />

    <title>Loading</title>
  </head>
  <body>
    <div id="anim_body" class="BgLoading">
      <div class="P_LodImg">
        <!-- After -->
        <div style="width: 100px" class="LoadingImg">
          <!-- <img src="assets/images/success.gif" class="IconCheckMark" alt=""> -->
          <img src="https://tradicoders.ir/assets/images/Loading.svg" class="LoadingImg" alt="" />
        </div>
        <div class="LoadingText"><?php echo $message; ?></div>
      </div>
    </div>
  </body>
</html>
