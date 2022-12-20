<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | ویرایشگر</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../programer/dist/css/adminlte.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../programer/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="../programer/dist/css/bootstrap-rtl.min.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="../programer/dist/css/custom-style.css">

    <link rel="stylesheet" href="codemirror.css">
    <script src="codemirror.js"></script>
    <script src="clike.js"></script>
    <link rel="stylesheet" href="learning.css">
</head>
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
            <a href="tradingview.php" id="title-items" class="col-sm-4">Trading View</a>
            <a href="mql5.php" id="title-items" class="col-sm-4">MQL5</a>
            <a href="learning.php" id="title-items" class="col-sm-4 active">MQL4</a>
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
                <div id="code-box-title">MQL4</div>
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

            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        ویرایشگر بوت استرپ WYSIHTML۵
                        <small>ساده و سریع</small>
                    </h3>
                    <!-- tools box -->
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-tool btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pad">
                    <div class="mb-3">
                        <ul class="wysihtml5-toolbar" style=""><li class="dropdown">
                                <a class="btn btn-default dropdown-toggle " data-toggle="dropdown">

                                    <span class="fa fa-font"></span>

                                    <span class="current-font">Normal text</span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p" tabindex="-1" href="javascript:;" unselectable="on">Normal text</a></li>
                                    <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" tabindex="-1" href="javascript:;" unselectable="on">Heading 1</a></li>
                                    <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" tabindex="-1" href="javascript:;" unselectable="on">Heading 2</a></li>
                                    <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" tabindex="-1" href="javascript:;" unselectable="on">Heading 3</a></li>
                                    <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4" tabindex="-1" href="javascript:;" unselectable="on">Heading 4</a></li>
                                    <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h5" tabindex="-1" href="javascript:;" unselectable="on">Heading 5</a></li>
                                    <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h6" tabindex="-1" href="javascript:;" unselectable="on">Heading 6</a></li>
                                </ul>
                            </li>
                            <li>
                                <div class="btn-group">
                                    <a class="btn  btn-default" data-wysihtml5-command="bold" title="CTRL+B" tabindex="-1" href="javascript:;" unselectable="on">Bold</a>
                                    <a class="btn  btn-default" data-wysihtml5-command="italic" title="CTRL+I" tabindex="-1" href="javascript:;" unselectable="on">Italic</a>
                                    <a class="btn  btn-default" data-wysihtml5-command="underline" title="CTRL+U" tabindex="-1" href="javascript:;" unselectable="on">Underline</a>

                                    <a class="btn  btn-default" data-wysihtml5-command="small" title="CTRL+S" tabindex="-1" href="javascript:;" unselectable="on">Small</a>

                                </div>
                            </li>
                            <li>
                                <a class="btn  btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="blockquote" data-wysihtml5-display-format-name="false" tabindex="-1" href="javascript:;" unselectable="on">

                                    <span class="fa fa-quote-left"></span>

                                </a>
                            </li>
                            <li>
                                <div class="btn-group">
                                    <a class="btn  btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered list" tabindex="-1" href="javascript:;" unselectable="on">

                                        <span class="fa fa-list-ul"></span>

                                    </a>
                                    <a class="btn  btn-default" data-wysihtml5-command="insertOrderedList" title="Ordered list" tabindex="-1" href="javascript:;" unselectable="on">

                                        <span class="fa fa-list-ol"></span>

                                    </a>
                                    <a class="btn  btn-default" data-wysihtml5-command="Outdent" title="Outdent" tabindex="-1" href="javascript:;" unselectable="on">

                                        <span class="fa fa-outdent"></span>

                                    </a>
                                    <a class="btn  btn-default" data-wysihtml5-command="Indent" title="Indent" tabindex="-1" href="javascript:;" unselectable="on">

                                        <span class="fa fa-indent"></span>

                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="bootstrap-wysihtml5-insert-link-modal modal fade" data-wysihtml5-dialog="createLink">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <a class="close" data-dismiss="modal">×</a>
                                                <h3>Insert link</h3>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input value="http://" class="bootstrap-wysihtml5-insert-link-url form-control" data-wysihtml5-dialog-field="href">
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="bootstrap-wysihtml5-insert-link-target" checked="">Open link in new window
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-default" data-dismiss="modal" data-wysihtml5-dialog-action="cancel" href="#">Cancel</a>
                                                <a href="#" class="btn btn-primary" data-dismiss="modal" data-wysihtml5-dialog-action="save">Insert link</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn  btn-default" data-wysihtml5-command="createLink" title="Insert link" tabindex="-1" href="javascript:;" unselectable="on">

                                    <span class="fa fa-share-square-o"></span>

                                </a>
                            </li>
                            <li>
                                <div class="bootstrap-wysihtml5-insert-image-modal modal fade" data-wysihtml5-dialog="insertImage">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <a class="close" data-dismiss="modal">×</a>
                                                <h3>Insert image</h3>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input value="http://" class="bootstrap-wysihtml5-insert-image-url form-control" data-wysihtml5-dialog-field="src">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-default" data-dismiss="modal" data-wysihtml5-dialog-action="cancel" href="#">Cancel</a>
                                                <a class="btn btn-primary" data-dismiss="modal" data-wysihtml5-dialog-action="save" href="#">Insert image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn  btn-default" data-wysihtml5-command="insertImage" title="Insert image" tabindex="-1" href="javascript:;" unselectable="on">

                                    <span class="fa fa-file-image-o"></span>

                                </a>
                            </li>
                        </ul><textarea class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;" placeholder="لطفا متن خود را وارد کنید"></textarea><iframe class="wysihtml5-sandbox" security="restricted" allowtransparency="true" frameborder="0" width="0" height="0" marginwidth="0" marginheight="0" style="display: inline-block; background-color: rgb(255, 255, 255); border-collapse: separate; border-color: rgb(221, 221, 221); border-style: solid; border-width: 1px; clear: none; float: none; margin: 0px; outline: rgb(0, 0, 0) none 0px; outline-offset: 0px; padding: 10px; position: static; inset: auto; z-index: auto; vertical-align: baseline; text-align: start; box-sizing: border-box; box-shadow: none; border-radius: 0px; width: 100%; height: 200px;"></iframe>
                    </div>
                    <p class="text-sm mb-0">
                        مشاهده <a href="https://github.com/bootstrap-wysiwyg/bootstrap3-wysiwyg">مستندات و توضیحات این ویرایشگر</a>
                    </p>
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
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        CKEditor5
                                        <small>پیشرفته به همراه همه امکانات</small>
                                    </h3>
                                    <!-- tools box -->
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool btn-sm"
                                                data-widget="collapse"
                                                data-toggle="tooltip"
                                                title="Collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool btn-sm"
                                                data-widget="remove"
                                                data-toggle="tooltip"
                                                title="Remove">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="mb-3">
                                        <textarea id="editor1" name="editor1" style="width: 100%">لطفا متن مورد نظر خودتان را وارد کنید</textarea>
                                    </div>
                                    <p class="text-sm mb-0">مشاهده مستندات مربوط به این ویرایشگر متن <a href="https://ckeditor.com/ckeditor-5-builds/#classic">CKEditor</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                    </div>
                    <!-- ./row -->
                </section>
                <style>
                    .CodeMirror
                    {
                        text-align: left;
                    }
                </style>
                <div style="display: none">
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


<!-- jQuery -->
<script src="../programer/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../programer/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../programer/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../programer/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../programer/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="../programer/plugins/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../programer/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(function (editor) {
                // The editor instance
            })
            .catch(function (error) {
                console.error(error)
            })

        // bootstrap WYSIHTML5 - text editor

        $('.textarea').wysihtml5({
            toolbar: { fa: true }
        })
    })
</script>
</body>
</html>
