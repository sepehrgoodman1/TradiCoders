const AllTabs = document.querySelectorAll(".MyTab");
const AllButtons = document.querySelectorAll(".ItemFilter");

for (let i = 0; i < AllButtons.length; i++) {
  AllButtons[i].addEventListener("click", () => {
    let j = 0;
    AllButtons.forEach((button) => {
      button.classList.remove("ItemFilter_Atcive");
    });

    AllButtons[i].classList.add("ItemFilter_Atcive");
    ShowPannel(i);
  });
}



function ShowPannel(PanelIndex) {
  AllButtons.forEach((button) => {
    button.classList.remove("ItemFilter_Atcive");
  });
  AllButtons[PanelIndex].classList.add("ItemFilter_Atcive");

  let i = 0;
  AllTabs.forEach((Tab) => {
    if (PanelIndex != i) {
      Tab.style.display = "none";
    } else {
      Tab.style.display = "block";
    }
    i++;
  });
}
ShowPannel(1);
