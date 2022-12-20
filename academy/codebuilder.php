<?php
require('../config.php');
require("../central.php");
require('../access.php');
require('../sessionchecker.php');
$action = 'academy';
?>
<html>
<title>آموزش کد نویسی</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="codemirror.css">
<script src="codemirror.js"></script>
<script src="clike.js"></script>
<link rel="stylesheet" href="learning.css">
<!-- Favicons -->
<link rel="stylesheet" href="css/academy.css">
<link href="../tradi-coders-logo-final.gif" rel="shortcut icon" type="image/x-icon">
<link href="../tradi-coders-logo-final.gif" rel="apple-touch-icon">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


<body style="overflow-x:hidden;">
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_POST["codeEditSubmit"]))
    {
        $id = $_POST["funcid"];
        $newCode = $_POST["Ccode"];

        $sql = "UPDATE tc_Academy SET code='$newCode' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully  id was : ".$id;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    if(isset($_POST["mql4funcsubmit"]))
    {
        $funcid = $_POST["funcid"];
        $funcname = $_POST["funcname"];
        $public = 1001;
        $sql = "SELECT * FROM tc_Academy WHERE id=$funcid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $funcname = $row["name"];
                $funccode = $row["code"];
                $funcdesc = $row["description"];
                $funcinput  = $row["input"];
                $funcoutput = $row["output"];
            }
        }
    }
}
?>


<!--menu-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="lines-wrap">
    <div class="lines-inner">
        <div class="lines"></div>
    </div>
</div>

<div>
    <!-- heder -->
    <?php require('../header.php'); ?>
    <!-- heder end -->
</div>

<div class="row" style="margin: 0;margin-top:45px;">
    <div class="col-sm-3" style="height: 300px;">
        <div class="titles row">
            <a href="tradingview.php" id="title-items" class="col-sm-4">Trading View</a>
            <a href="mql5.php" id="title-items" class="col-sm-4">MQL5</a>
            <a href="index.php" id="title-items" class="col-sm-4 active">MQL4</a>
        </div>
        <div class="title-content">

            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

            <ul id="myUL">
                <?php
                $sql = "SELECT * FROM tc_Academy WHERE language='mql4'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <li>
                            <form method="post" name="Mql4Function" style="">
                                <span style="font-size: 0.1px;"><?php echo $row['name'];?></span>
                                <input type="hidden" name="funcid" value = "<?php echo $row['id']?>">
                                <input type="hidden" name="funcname" value = "<?php echo $row['name']?>">
                                <input type="submit" name="mql4funcsubmit" value = "<?php echo $row['name'];?>" style="width: 100%;background: #444;border: none;padding: 10px;border-radius: 5px;color: white;margin-bottom: 5px;">
                            </form>
                        </li>
                        <?php
                    }
                }else{
                    ?>
                    <h4>این بخش در دست ساخت است</h4>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="col-sm-9" style="border: 1px solid #d2d2d2;margin-top: 25px;padding: 20px;padding-top:0;text-align: right">
        <div class="left-box">
            <div id="code-box" style=";border: 1px solid #d2d2d2;width: 100%;margin: 5px;margin-right: 0;margin-bottom:20px;background: #f8f8f8">
                <div id="code-box-title">توابع کاربردی در متا ادیتور 4</div>
               
                <div id="toselect-item">
                    <div id="selected-item1" class="selected-item" onclick="item_code()" style="background: #202020;color: #eee;">کد</div>
                    <div id="selected-item2" class="selected-item" onclick="item_content()">عملکرد</div>
                    <div id="selected-item3" class="selected-item" onclick="inputFunction()">ورودی تابع</div>
                    <div id="selected-item4" class="selected-item" onclick="outputFunction()">خروجی تابع</div>
                </div>
            </div>
            <div id="code_box1">
                <div style="margin: 10px">
                    <h4 class="title">نام فانیشن : <span><?php echo $funcname;?></span></h4>
                    <div class="title-dcp"></div>
                </div>
                <form action="" id="codeEditSubmit" method="post">
                    <input type="hidden" name="funcid" id="funcid" value="<?php echo $funcid;?>">
                    <article id="editboxform" style="text-align: left;font-family: inherit !important;">
                        <div>
                            <textarea name="Ccode" id="Ccode"><?php echo $funccode; ?></textarea>
                        </div>
                        <?php
                        if($userid==7)
                        {
                            ?>
                            <button type="submit" name="codeEditSubmit" id="codeEditSubmit">ثبت</button>
                            <?php
                        }
                        ?>
                    </article>
                </form>
                <div style="background: #eee;width: 100%;margin: auto;border: 1px solid #dfdfdf;padding: 15px;border-radius: 5px;height: 500px;overflow-y: scroll;text-align: left;direction: ltr;display:none;" id="textcopy"><?php echo $funccode; ?></div>



                <?php
                if($userid==7)
                {
                    ?>
                    <button type="button" onclick="editformcodebox()" style="margin: 10px 0 10px 0;width: 150px;border: 1px solid #011117;border-radius: 5px;background: #045575;float: left;color: white;position: absolute;left: 20px;top: 95px;padding: 5px;">ویرایش</button>
                    <?php
                }else
                {
                    ?>
                    <button type="button" onclick="CopyToClipboard('textcopy');return false;" style="margin: 10px 0 10px 0;width: 150px;border: 1px solid #011117;border-radius: 5px;background: #045575;float: left;color: white;position: absolute;left: 20px;top: 95px;padding: 5px;">کپی</button>
                    <?php
                }
                ?>

            </div>
            <div id="code_box2" style="display: none">
                <div style="margin: 10px">
                    <h4 class="title">این کد چگونه کار می کند</h4>
                    <div class="title-dcp" style="text-align: right;border: 1px solid #ebebeb;padding: 10px;border-radius: 5px;">
                        <?php echo $funcdesc; ?>
                    </div>
                </div>
            </div>
            <div id="code_box3" style="display: none">
                <div style="margin: 10px">
                    <h4 class="title">ورودی تابع </h4>
                    <div class="title-dcp"></div>
                </div>
                <form action="" id="codeEditSubmit" method="post">
                    <article id="editboxform" style="text-align: left;font-family: inherit !important;">
                        <div>
                            <textarea name="Ccode2" id="Ccode2"><?php echo $funcinput; ?></textarea>
                        </div>
                    </article>
                </form>
                <div style="background: #eee;width: 100%;margin: auto;border: 1px solid #dfdfdf;padding: 15px;border-radius: 5px;height: 500px;overflow-y: scroll;text-align: left;direction: ltr;display:none;" id="textcopy2"><?php echo $funcinput; ?></div>

                <button type="button" onclick="CopyToClipboard('textcopy2');return false;" style="margin: 10px 0 10px 0;width: 150px;border: 1px solid #011117;border-radius: 5px;background: #045575;float: left;color: white;position: absolute;left: 20px;top: 95px;padding: 5px;">کپی</button>

            </div>
            <div id="code_box4" style="display: none">
                <div style="margin: 10px">
                    <h4 class="title">این تابع در نهایت چه چیزی بر می گرداند ؟</h4>
                    <div class="title-dcp" style="text-align: right;border: 1px solid #ebebeb;padding: 10px;border-radius: 5px;">
                        <?php
                        echo $funcoutput;
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src='academy.js' crossorigin='anonymous'></script>
<?php
$conn->close();
?>
</body>
</html>
