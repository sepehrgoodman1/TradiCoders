<?php
$action = "academy";
$them = 'light';
if ($userid > 0) {
    $directory = "codes/$userid";
    if (!is_dir($directory)) {
        mkdir($directory, 0777);
    }
    $tabnames = selectQuery_tc_codes("userid='$userid'");
    $tabtype = $tabnames[0]['typefile'];
    $tabname = $tabnames[0]['name'];
    $sql_them = selectQuery_tc_attr("userid='$userid' and attr='them-academy'",'value');
    if (sizeof($sql_them) > 0){
        $them = $sql_them[0]['value'];
    }
}

?>
<script>
    let firstTab = '<?php echo $tabname . '.' . $tabtype;?>';
    let userid = '<?php echo $userid;?>';
    let allTabNames = [];
    let descriptions = [];
    let firstPanel = 0;
    let them = '<?php echo $them?>';
    function addTab() {
        nowTab = document.getElementById('').innerHTML;
    }

    let newallcode = ``;

    function readTextFile(Name, lastbl) {

        type = Name.split('.');
        name = type[0];
        type = type[1];
        file = 'https://tradicoders.ir/app/codes/' + userid + '/' + name + '.txt';
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", file, false);
        rawFile.onreadystatechange = function () {
            if (rawFile.readyState === 4) {
                if (rawFile.status === 200 || rawFile.status == 0) {
                    var allText = rawFile.responseText;
                    newallcode += `<textarea id="` + Name + `" name="code" class="CodeArea">` +
                        allText +
                        `</textarea>`;
                    if (lastbl) {
                        finishRead();
                    }

                    // var data2 = "request=baseCodes&namefile="+name+"&typefile="+type;
                    // var xmlhttp2 = new XMLHttpRequest();
                    // xmlhttp2.onreadystatechange = function () {
                    //     if (this.readyState == 4 && this.status == 200) {
                    //         var basecode = JSON.parse(this.responseText);
                    //
                    //     }
                    // };
                    // xmlhttp2.open("GET", "../../ajaxcenter.php?" + data2, true);
                    // xmlhttp2.send();
                }
            }
        }
        rawFile.send(null);
    }

    function finishRead() {
        newallcode += ` <div class="P_AllTextArea">
              <div class="P_TextAreaApp">
                <textarea name="" class="TextAreaApp BgWhite AlmostBlack"></textarea>
              </div>
              <div class="P_TextArea">
                <textarea name="" class="TextAreaApp BgWhite AlmostBlack"></textarea>
              </div>
            </div>`;

        alert(newallcode);
        document.getElementById('all_tabs').innerHTML = newallcode;
        SwitchNavItem();
        ShowNav(0, 'close_' + firstTab);
    }
</script>
<!DOCTYPE html>
<html lang="fa-IR">

<head>
  

    <!-- Css Codes -->
    <link rel="stylesheet" href="https://tradicoders.ir/css/global.css"/>
    <link rel="stylesheet" href="https://tradicoders.ir/css/main.css"/>
    <link rel="stylesheet" href="../css/fonts.css"/>
    <link rel="stylesheet" href="./css/index.css"/>

    <!-- Dynamic Meta Deskription -->
    <?php
    $sql_meta = selectQuery_tc_meta("action='$action'");
    $sql_meta = $sql_meta[0];
    $title = $sql_meta['title'];
    $keywords = $sql_meta['keywords'];
    $description = $sql_meta['description'];
    defualtMeta($title, $keywords, $description); ?>

    <link rel="icon" type="image/x-icon" href="https://tradicoders.ir/assets/images/Logo.gif">

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

    <!-- Font Awesome Icon-->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />

    <!-- Cide Mirror Css -->
    <link rel="stylesheet" href="plugin/codemirror/doc/docs.css"/>
    <link rel="stylesheet" href="plugin/codemirror/lib/codemirror.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/3024-day.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/3024-night.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/abbott.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/abcdef.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/ambiance.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/ayu-dark.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/ayu-mirage.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/base16-dark.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/bespin.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/base16-light.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/blackboard.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/cobalt.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/colorforth.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/dracula.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/duotone-dark.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/duotone-light.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/eclipse.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/elegant.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/erlang-dark.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/gruvbox-dark.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/hopscotch.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/icecoder.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/isotope.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/juejin.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/lesser-dark.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/liquibyte.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/lucario.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/material.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/material-darker.css"/>
    <link
            rel="stylesheet"
            href="plugin/codemirror/theme/material-palenight.css"
    />
    <link rel="stylesheet" href="plugin/codemirror/theme/material-ocean.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/mbo.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/mdn-like.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/midnight.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/monokai.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/moxer.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/neat.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/neo.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/night.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/nord.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/oceanic-next.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/panda-syntax.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/paraiso-dark.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/paraiso-light.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/pastel-on-dark.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/railscasts.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/rubyblue.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/seti.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/shadowfox.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/solarized.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/the-matrix.css"/>
    <link
            rel="stylesheet"
            href="plugin/codemirror/theme/tomorrow-night-bright.css"
    />
    <link
            rel="stylesheet"
            href="plugin/codemirror/theme/tomorrow-night-eighties.css"
    />
    <link rel="stylesheet" href="plugin/codemirror/theme/ttcn.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/twilight.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/vibrant-ink.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/xq-dark.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/xq-light.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/yeti.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/idea.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/darcula.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/yonce.css"/>
    <link rel="stylesheet" href="plugin/codemirror/theme/zenburn.css"/>

    <script src="plugin/codemirror/lib/codemirror.js"></script>
    <script src="plugin/codemirror/mode/javascript/javascript.js"></script>
    <script src="plugin/codemirror/addon/selection/active-line.js"></script>
    <script src="plugin/codemirror/addon/edit/matchbrackets.js"></script>

     <!-- Hotjar Tracking Code for https://tradicoders.ir/ -->
        <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:3267684,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

</head>
<body style="height:fit-content; overflow: hidden">
<?php require('../navbar.php') ?>
<div class="P_Main">
        <!-- Side Menu -->
        <h1 style="display:none">اجرای کد برنامه نویسی به صورت انلاین</h1>

        <?php require_once("sidemenu.php") ?>

        <!-- End Side Menu -->

        <!-- Right Side -->
        <div class="RightSideOfCode BgWhite PosRel">
            <?php require("nav.php") ?>

            <div id="all_tabs" class="P_TabCode">
                <!-- Tab One  -->
                <?php foreach ($tabnames as $tabname) {
                    $tabtype = $tabname['typefile'];
                    $tabname = $tabname['name']; ?>
                    <script>
                        allTabNames.push('<?php echo $tabname . '.' . $tabtype; ?>')
                    </script>
                    <div class="TabCode">
                        <?php require("code.php"); ?>
                    </div>
                <?php } ?>

                <div>

                    <?php require_once("console.php") ?>

                </div>
                <!-- End Right Side -->

            </div>
        </div>

        <!-- My Js -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script src="js/index.js"></script>
        <script src="js/side_script.js"></script>

    </div>
</div>
</body>
</html>
