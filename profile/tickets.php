<?php
require("backend_header.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <?php
      $title = 'پروفایل | پروژه ها';
      $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
      $description = 'شما می توانید از این بخش پروژه های خود را مشاهده و کنترل کنید';
      $icon = '../tradi-coders-logo-final.gif';
      defualtMetaAndStyleProfile($title, $keywords, $description, $icon); ?>
    <!-- Css Codes -->
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/login.css" />
    <link rel="stylesheet" href="css/profile.css" />

    <!-- Font Awesome Icon-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Bootstrap 5 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>

    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="assets/images/Logo.gif" />

    <title></title>
  </head>
  <body class="hold-transition sidebar-mini">
  <!-- Navbar -->
  <?php require_once("navbar.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Sidebar -->
  <?php require_once("sidebar.php"); ?>
    <div class="WraperSup content-wrapper">
      <div class="MyTeckets">تیکت های من</div>
      <div class="PAllBoxs">
        <div class="P_Boxs">
          <!-- Ticket Item -->
          <div onclick="changestatus('open')" class="Boxs">
            <div>
              <i id="open_status_icon" class="fa-regular fa-folder-open IconSup ActiveTab"></i>
            </div>
            <div id="open_status_text" class="TextSup ActiveTab">تیکت های باز</div>
          </div>
          <!-- Ticket Item -->
          <div onclick="changestatus('pending')" class="Boxs">
            <div>
              <i id="pending_status_icon" class="fa-solid fa-folder-tree IconSup"></i>
            </div>
            <div id="pending_status_text" class="TextSup">درحال بررسی</div>
          </div>
          <!-- Ticket Item -->
          <div onclick="changestatus('waiting')" class="Boxs">
            <div>
              <i id="waiting_status_icon" class="fa-regular fa-folder IconSup"></i>
            </div>
            <div id="waiting_status_text" class="TextSup">پاسخ داده شده</div>
          </div>
          <!-- Ticket Item -->
          <div onclick="changestatus('close')" class="Boxs">
            <div>
              <i id="close_status_icon" class="fa-solid fa-folder-closed IconSup"></i>
            </div>
            <div id="close_status_text" class="TextSup">بسته شده</div>
          </div>
        </div>
      </div>
      <div class="Mt50">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">عنوان</th>
              <th scope="col">شناسه</th>
              <th scope="col">وضعیت</th>
              <th scope="col">عملیات</th>
            </tr>
          </thead>
            <?php
            $sql_ticket_open = selectQuery_tc_ticket("userid='$userid' and status = 'open'");
            $sql_ticket_pending = selectQuery_tc_ticket("userid='$userid' and status = 'pending'");
            $sql_ticket_waiting = selectQuery_tc_ticket("userid='$userid' and status = 'waiting'");
            $sql_ticket_close = selectQuery_tc_ticket("userid='$userid' and status = 'close'");
            ?>
            <tbody id="open_table" class="table_ticket">
            <?php foreach ($sql_ticket_open as $ticket){ ?>
                <tr>
                    <th scope="row"><?php echo $ticket['subject']; ?></th>
                    <td>#<?php echo $ticket['id']; ?></td>
                    <td>
                        <span class="WaitingStatus"> باز </span>
                    </td>
                    <td>
                        <button class="Show">مشاهده</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <tbody id="close_table" class="table_ticket" style="display: none">
            <?php foreach ($sql_ticket_close as $ticket){ ?>
                <tr>
                    <th scope="row"><?php echo $ticket['subject']; ?></th>
                    <td>#<?php echo $ticket['id']; ?></td>
                    <td>
                        <span class="Replyed"> بسته شده </span>
                    </td>
                    <td>
                        <button class="Show">مشاهده</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <tbody id="pending_table" class="table_ticket" style="display: none">
            <?php foreach ($sql_ticket_pending as $ticket){ ?>
                <tr>
                    <th scope="row"><?php echo $ticket['subject']; ?></th>
                    <td>#<?php echo $ticket['id']; ?></td>
                    <td>
                        <span class="WaitingStatus"> در حال بررسی </span>
                    </td>
                    <td>
                        <button class="Show">مشاهده</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <tbody id="waiting_table" class="table_ticket" style="display: none">
            <?php foreach ($sql_ticket_waiting as $ticket){ ?>
                <tr>
                    <th scope="row"><?php echo $ticket['subject']; ?></th>
                    <td>#<?php echo $ticket['id']; ?></td>
                    <td>
                        <span class="Replyed"> پاسخ داده شده </span>
                    </td>
                    <td>
                        <button class="Show">مشاهده</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <!-- WaitingStatus -->
        </table>
      </div>
      <button onclick="window.open('support.php','_self')" class="SendInfo  mt-3">افزودن</button>

    </div>
  <?php defualtScriptProfile(); ?>
  <script>
      let status_selected = 'open';
      function changestatus(status) {
          icons = document.getElementsByClassName('IconSup');
          for (const icon of icons) {
              icon.classList.remove('ActiveTab');
          }

          texts = document.getElementsByClassName('TextSup');
          for (const text of texts) {
              text.classList.remove('ActiveTab');
          }

          table_ticket = document.getElementsByClassName('table_ticket');
          for (const text of table_ticket) {
              text.style.display = "none";
          }

          document.getElementById(status + '_status_icon').classList.add('ActiveTab');
          document.getElementById(status + '_status_text').classList.add('ActiveTab');
          document.getElementById(status + '_table').style.display = "contents";
          status_selected = status;
      }

      $.widget.bridge('uibutton', $.ui.button)
  </script>
  </body>
</html>
