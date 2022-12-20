// Open And Close Line of Texts
const AllProjects =  document.querySelector(".WrapperAllProjects");

AllProjects.addEventListener('click', event=>{
    const Current = event.target;

    const IsReadMoreBtn = Current.className.includes("ReadMoreBtn");

    if(!IsReadMoreBtn){
        return;
    }

    const currenText = event.target.parentNode.querySelector('.ReadMoreText');

    currenText.classList.toggle("ReadMoreText_Show");

    Current.textContent = Current.textContent.includes("بیشتر")? "بستن": "بیشتر...";
});

function addOrder(product_id){
    var data = "request=addOrder&product_id=" + product_id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };

    xmlhttp.open("GET", "../ajaxcenter.php?" + data, true);
    xmlhttp.send();
}


