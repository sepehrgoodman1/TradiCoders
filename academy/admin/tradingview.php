<!DOCTYPE html>
<html>
<title>ادمین</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="codemirror.css">
<script src="codemirror.js"></script>
<script src="clike.js"></script>
<link rel="stylesheet" href="learning.css">
<body>
<nav id="navigation">
    <a href="../index.php" class="scroll" ><img class="logo" alt='logo' src='../images/logo1.png'></a>
    <ul id="menu">
        <li>
            <a href="../index.php" class="scroll">صفحه اصلی</a>
        </li>
        <li class="current">
            <a href="#profile" class="scroll">درباره ما</a>
        </li>
        <li>
            <a href="#team" class="scroll">تیم ما</a>
        </li>
        <li>
            <a href="#services" class="scroll">خدمات</a>
        </li>
        <li>
            <a href="#portfolio" class="scroll">کارها</a>
        </li>
        <li>
            <a href="#parallax-4" class="scroll">وبلاگ</a>
        </li>
        <li>
            <a href="#contact" class="scroll">تماس با ما</a>
        </li>
    </ul>
</nav>
<div class="row" style="margin: 0">
    <div class="col-sm-3" style="height: 300px;">
        <div class="titles row">
            <a href="tradingview.php" id="title-items" class="col-sm-4 active">Trading View</a>
            <a href="mql5.php" id="title-items" class="col-sm-4">MQL5</a>
            <a href="learning.php" id="title-items" class="col-sm-4">MQL4</a>
        </div>
        <div class="title-content">
            <a href="" id="content-item" class="content-item-active">تایتل 1</a>
            <a href="" id="content-item">تایتل 2</a>
            <a href="" id="content-item">تایتل 3</a>
            <a href="" id="content-item">تایتل 4</a>
        </div>
    </div>
    <div class="col-sm-9" style="border: 1px solid #d2d2d2;margin-top: 25px;padding: 20px;padding-top:0;text-align: right">
        <div class="left-box">
            <div id="code-box" style=";border: 1px solid #d2d2d2;width: 100%;margin: 5px;margin-right: 0;margin-bottom:20px;background: #f8f8f8">
                <div id="code-box-title">Trading View</div>
                <style>
                    #toselect-item
                    {
                        text-align: right;
                        padding: 10px;
                    }
                    .selected-item
                    {
                        cursor: pointer;
                        transition: all 0.2s;
                        display: inline-block;
                        width: 100px;
                        border: 1px solid #D2D2D2;
                        text-align: center;
                        padding: 3px;
                        border-radius: 3px;
                    }
                    .selected-item:hover
                    {
                        background: #949494;
                        color: #eeeeee;
                    }
                </style>
                <div id="toselect-item">
                    <div id="selected-item3" class="selected-item" onclick="item_code()" style="background: #202020;color: #eee;">کد ها</div>
                    <div id="selected-item2" class="selected-item" onclick="item_content()">مطالب</div>
                    <div id="selected-item1" class="selected-item" onclick="item_example()">نمونه کد ها</div>
                </div>
            </div>
            <style>
                #example_code_download
                {
                    text-align: center;
                    border: 1px solid #5b5b5b;
                    padding: 5px;
                    border-radius: 3px;
                    background: #d4d4d4;
                    color: #202020;
                    font-size: 15px;
                    font-weight: bold;
                    text-decoration: none;
                }
                #example_code_download a
                {
                    color: #202020;
                    text-decoration: none;
                }
                .title-dcp
                {
                    text-align: justify;
                    width: 750px;
                }
            </style>
            <div id="examplecode_box" style="display: none">
                <div class="row" style="margin: 5px;padding-left: 15px;padding-right: 15px">
                    <div class="col-sm-3" id="">
                        <div id="example_code_download">
                            <div style="margin: 10px"><span>120</span> دانلود شده </div>

                            <input type="file" style="width: 72px">
                        </div>
                    </div>
                </div>
            </div>

            <div id="content_box" style="display: none">
                <div style="margin: 10px">
                    <h4 class="title"><input type="text" name="content_box_title" id="content_box_title" placeholder="سر متن.."></h4>
                    <div class="title-dcp">
                        <textarea name="code_box_content" id="code_box_content" cols="50" rows="7">
لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                        </textarea>
                    </div>
                    <hr>
                    <h4 class="title"><input type="text" name="content_box_title2" id="content_box_title2" placeholder="سر متن.."></h4>
                    <div class="title-dcp">
                        <textarea name="code_box_content" id="code_box_content" cols="50" rows="7">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                        </textarea>
                    </div>
                </div>
            </div>

            <div id="code_box">
                <style>
                    .CodeMirror
                    {
                        text-align: left;
                    }
                </style>
                <div style="margin: 10px">
                    <h4 class="title"><input type="text" name="code_box_title" id="code_box_title" placeholder="سر متن.."></h4>
                    <div class="title-dcp">
                        <textarea name="code_box_content" id="code_box_content" cols="50" rows="5">
لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                        </textarea>
                    </div>
                </div>
                <article>
                    <div>
                        <textarea id="c-code" style="text-align: left"></textarea>
                    </div>
                    <script>
                        var cEditor = CodeMirror.fromTextArea(document.getElementById("c-code"), {
                            lineNumbers: true,
                            matchBrackets: true,
                            mode: "text/x-csrc"
                        });
                        var cppEditor = CodeMirror.fromTextArea(document.getElementById("cpp-code"), {
                            lineNumbers: true,
                            matchBrackets: true,
                            mode: "text/x-c++src"
                        });
                        var javaEditor = CodeMirror.fromTextArea(document.getElementById("java-code"), {
                            lineNumbers: true,
                            matchBrackets: true,
                            mode: "text/x-java"
                        });
                        var objectivecEditor = CodeMirror.fromTextArea(document.getElementById("objectivec-code"), {
                            lineNumbers: true,
                            matchBrackets: true,
                            mode: "text/x-objectivec"
                        });
                        var scalaEditor = CodeMirror.fromTextArea(document.getElementById("scala-code"), {
                            lineNumbers: true,
                            matchBrackets: true,
                            mode: "text/x-scala"
                        });
                        var kotlinEditor = CodeMirror.fromTextArea(document.getElementById("kotlin-code"), {
                            lineNumbers: true,
                            matchBrackets: true,
                            mode: "text/x-kotlin"
                        });
                        var ceylonEditor = CodeMirror.fromTextArea(document.getElementById("ceylon-code"), {
                            lineNumbers: true,
                            matchBrackets: true,
                            mode: "text/x-ceylon"
                        });
                        var mac = CodeMirror.keyMap.default == CodeMirror.keyMap.macDefault;
                        CodeMirror.keyMap.default[(mac ? "Cmd" : "Ctrl") + "-Space"] = "autocomplete";
                    </script>
                </article>
                <div style="margin: 10px">
                    <div class="title-dcp">
                        <textarea name="code_box_content2" id="code_box_content2" cols="50" rows="3">
لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                        </textarea>
                    </div>
                </div>
                <div id="code-box" style="margin-top: 10px">
                    آپلود عکس
                    <input type="file" accept="image" style="margin: 20px;" name="code_box_img">
                </div>

            </div>

            <script>
                function item_example()
                {
                    document.getElementById("selected-item1").style.background="#202020";
                    document.getElementById("selected-item1").style.color="#eee";
                    ////
                    document.getElementById("selected-item2").style.background="#fff";
                    document.getElementById("selected-item2").style.color="#202020";
                    ////
                    document.getElementById("selected-item3").style.background="#fff";
                    document.getElementById("selected-item3").style.color="#202020";
                    /////////////////////////////////////////////
                    document.getElementById("examplecode_box").style.display="inherit";
                    document.getElementById("content_box").style.display="none";
                    document.getElementById("code_box").style.display="none";
                }
                function item_content()
                {
                    document.getElementById("selected-item2").style.background="#202020";
                    document.getElementById("selected-item2").style.color="#eee";
                    ////
                    document.getElementById("selected-item1").style.background="#fff";
                    document.getElementById("selected-item1").style.color="#202020";
                    ////
                    document.getElementById("selected-item3").style.background="#fff";
                    document.getElementById("selected-item3").style.color="#202020";
                    /////////////////////////////////////////////
                    document.getElementById("content_box").style.display="inherit";
                    document.getElementById("examplecode_box").style.display="none";
                    document.getElementById("code_box").style.display="none";
                }
                function item_code()
                {
                    document.getElementById("selected-item3").style.background="#202020";
                    document.getElementById("selected-item3").style.color="#eee";
                    ////
                    document.getElementById("selected-item1").style.background="#fff";
                    document.getElementById("selected-item1").style.color="#202020";
                    ////
                    document.getElementById("selected-item2").style.background="#fff";
                    document.getElementById("selected-item2").style.color="#202020";
                    /////////////////////////////////////////////
                    document.getElementById("code_box").style.display="inherit";
                    document.getElementById("content_box").style.display="none";
                    document.getElementById("examplecode_box").style.display="none";
                }
            </script>
        </div>
    </div>
</div>
</body>
</html>
