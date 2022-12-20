var cEditor = CodeMirror.fromTextArea(document.getElementById("Ccode"), {
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

function CopyToClipboard(id)
{
    var r = document.createRange();
    r.selectNode(document.getElementById(id));
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(r);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
}
var cEditor = CodeMirror.fromTextArea(document.getElementById("Ccode2"), {
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

function CopyToClipboard(id)
{
    var r = document.createRange();
    r.selectNode(document.getElementById(id));
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(r);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
}

function editformcodebox()
{
    // var x = document.getElementById("textcopy").innerHTML;
    document.getElementById("editboxform").style.display="block";
    document.getElementById("textcopy").style.display="none";
}
function item_code()
{
    document.getElementById("selected-item1").classList.add("ItemsOfCode");
    ////
    document.getElementById("selected-item2").classList.remove("ItemsOfCode");
    ////
    document.getElementById("selected-item3").classList.remove("ItemsOfCode");
    ////
    document.getElementById("selected-item4").classList.remove("ItemsOfCode");
    /////////////////////////////////////////////
    document.getElementById("code_box1").style.display="inherit";
    document.getElementById("code_box2").style.display="none";
    document.getElementById("code_box3").style.display="none";
    document.getElementById("code_box4").style.display="none";
}
function item_content()
{
    document.getElementById("selected-item2").classList.add("ItemsOfCode");
    ////
    document.getElementById("selected-item1").classList.remove("ItemsOfCode");
    ////
    document.getElementById("selected-item3").classList.remove("ItemsOfCode");
    ////
    document.getElementById("selected-item4").classList.remove("ItemsOfCode");
    /////////////////////////////////////////////
    document.getElementById("code_box2").style.display="inherit";
    document.getElementById("code_box1").style.display="none";
    document.getElementById("code_box3").style.display="none";
    document.getElementById("code_box4").style.display="none";
}
function inputFunction()
{
    document.getElementById("selected-item3").classList.add("ItemsOfCode");
    ////
    document.getElementById("selected-item2").classList.remove("ItemsOfCode");
    ////
    document.getElementById("selected-item1").classList.remove("ItemsOfCode");
    ////
    document.getElementById("selected-item4").classList.remove("ItemsOfCode");
    /////////////////////////////////////////////
    document.getElementById("code_box3").style.display="inherit";
    document.getElementById("code_box2").style.display="none";
    document.getElementById("code_box1").style.display="none";
    document.getElementById("code_box4").style.display="none";
}
function outputFunction()
{
    document.getElementById("selected-item4").classList.add("ItemsOfCode");
    ////
    document.getElementById("selected-item2").classList.remove("ItemsOfCode");
    ////
    document.getElementById("selected-item3").classList.remove("ItemsOfCode");
    ////
    document.getElementById("selected-item1").classList.remove("ItemsOfCode");
    /////////////////////////////////////////////
    document.getElementById("code_box4").style.display="inherit";
    document.getElementById("code_box2").style.display="none";
    document.getElementById("code_box3").style.display="none";
    document.getElementById("code_box1").style.display="none";
}

function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("form")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

