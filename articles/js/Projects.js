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


