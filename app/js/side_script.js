

function createFile(name,type){
    var data = "request=createFile&namefile="+name+"&typefile="+type;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // alert(this.responseText);
            if (this.responseText === 'true') {
                // alert("فایل ساخته شد");
                location.reload();
            }else if (this.responseText === 'exist') {
                alert("فایلی با نام مشابه وجود دارد");
            }else {
                alert('خطا در ساخت فایل');
            }
            // hideIt('new_file');
            // checkCodes();

        }
    };

    xmlhttp.open("GET", "../../ajaxcenter.php?" + data, true);
    xmlhttp.send();
}
function saveFile(id){
    for (var index=0; index <allTabNames.length; index++){
        if (allTabNames[index] === id){
            tabindexsave = index;
        }
    }
    var index_body = document.getElementsByClassName('CodeMirror-scroll')[tabindexsave].innerText;
    var codearray = index_body.split('\n');
    newcode = '';
    for (var indexline = 1; indexline < codearray.length ; indexline += 2){
        newcode += codearray[indexline]+'%0A';
    }
    type = id.split('.');
    name = type[0];
    type = type[1];
    var data = "request=saveCode&namefile="+name+"&typefile="+type+"&code="+newcode;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // alert(this.responseText);
            if (this.responseText === 'true') {
                alert("ذخیره شد");
            }else {
                alert('خطا در ذخیره فایل');
            }
            // hideIt('new_file');
            // checkCodes();

        }
    };
    xmlhttp.open("GET", "../../ajaxcenter.php?" + data, true);
    xmlhttp.send();
}

function renameFile(old_name,old_type,name,type){
    var data = "request=renameFile&old_namefile="+old_name+"&old_typefile="+old_type+"&namefile="+name+"&typefile="+type;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // alert(this.responseText);
            if (this.responseText === 'true') {
                // alert("نام فایل تغییر کرد");
                location.reload();
            }else if (this.responseText === 'exist') {
                alert("نام فایل تکراری");
            }else {
                alert('خطا در تغییر نام فایل');
            }
            // hideIt('rename_file');
            // checkCodes();

        }
    };

    xmlhttp.open("GET", "../../ajaxcenter.php?" + data, true);
    xmlhttp.send();
}



function hideIt(id){
    document.getElementById(id).style.display = 'none';
}
function showIt(id){
    document.getElementById(id).style.display = 'block';
}

function checkCodes(){

    var data = "request=checkCodes";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // alert(this.responseText);
            try {
                allFiles = JSON.parse(this.responseText);
                newcode = ``;
                // firstTab = allFiles[0]['name']+'.'+allFiles[0]['typefile'];
                // TabNames = [firstTab];
                // allTabNames = [];
                // var inclosebtns = document.getElementsByClassName('CloseNavIcon');
                // for(const inclose of inclosebtns){
                //     inclose.click();
                // }
                // var inTabCode = document.getElementsByClassName('TabCode');
                // for(const intab of inTabCode){
                //     intab.remove();
                // }


                newallcode = ``;
                var helper = 0;
                for(const file of allFiles){
                    helper += 1;
                    allTabNames.push(file['name']+'.'+file['typefile']);
                    newcode += ` <div class="Files FilesLight ">
                                <i class="fa-regular fa-file FileIcon "></i><span
                                        class="EngFont">`+file['name']+`.`+file['typefile']+`</span>
                            </div>`;

                    // readTextFile(file['name']+'.'+file['typefile'],helper === allFiles.length);

                }
                document.getElementById('all_file').innerHTML = newcode;

            }catch (e) {

            }
        }
    };

    xmlhttp.open("GET", "../../ajaxcenter.php?" + data, true);
    xmlhttp.send();
}


function checkName(){
    name = document.getElementById('new_file_name').value;
    if (name.includes('.')){
        type = name.split('.');
        if (type.length > 2){
            alert("در نام از نقطه فقط برای مشخص کردن نوع فایل استفاده کنید.");
        }else{
            name = type[0];
            type = type[1];
            createFile(name,type);
        }
    }else {
        createFile(name,'txt');
    }
}

function changeName(old_name, old_type){
    name = document.getElementById('rename_file').value;
    if (name.includes('.')){
        type = name.split('.');
        if (type.length > 2){
            alert("در نام از نقطه فقط برای مشخص کردن نوع فایل استفاده کنید.");
        }else{
            name = type[0];
            type = type[1];
            renameFile(old_name,old_type,name,type);
        }
    }else {
        renameFile(old_name,old_type,name,'txt');
    }
}

function changeAllColor(){
    var allFiles = document.getElementsByClassName('Files');

    for(const file of allFiles){
        file.style.color = 'black';
    }
}
function allOnclick(function_ready){
    var allFiles = document.getElementsByClassName('Files');

    for(const file of allFiles){
        file.style.color = 'blue';
        file.onclick = function (){
            name = file.innerText
            type = name.split('.');
            name = type[0];
            type = type[1];
            if (function_ready === "deleteFile"){
                deleteFile(name,type);
            }else if (function_ready === "rename"){
                file.innerHTML = `<i class="fa-regular fa-file FileIcon "></i>
                    <input id="rename_file" onchange="changeName('`+name+`','`+type+`')" class="EngFont" >`;
                file.onclick = function (){

                }
            }
            changeAllColor();
        }
    }



}


function deleteFile(name,type){
    var data = "request=deleteFile&namefile="+name+"&typefile="+type;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // alert(this.responseText);
            if (this.responseText === 'true') {
                // alert("فایل حذف شد");
                location.reload();
            }else {
                alert('خطا در حذف فایل');
            }
            // checkCodes();

        }
    };

    xmlhttp.open("GET", "../../ajaxcenter.php?" + data, true);
    xmlhttp.send();
}


function downloadFile(name,type){
    var file = "https://tradicoders.ir/app/codes/"+userid+"/"+name+".txt";
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", file, false);
    rawFile.onreadystatechange = function () {
        if (rawFile.readyState === 4) {
            if (rawFile.status === 200 || rawFile.status == 0) {
                var allText = rawFile.responseText;
                const a = document.createElement("a");
                const file = new Blob([allText],
                    { type: "text/plain;charset=utf-8" });
                const url = window.URL.createObjectURL(file);
                a.href = url;
                a.download = name+"."+type;
                a.click();
            }
        }
    }
    rawFile.send(null);


}

ThemeChanger(them, false);

eventSize();


