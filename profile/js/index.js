const ButtonHarvest = document.querySelectorAll('.TypeHarvest');

for (let i = 0; i < ButtonHarvest.length; i++) {
    ButtonHarvest[i].addEventListener('click', ()=>{
        ButtonHarvest.forEach((button)=>{
            button.classList.remove("ActiveHarvest");
        })
        ButtonHarvest[i].classList.add('ActiveHarvest');
    })
}

