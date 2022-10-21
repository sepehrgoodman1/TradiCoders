const IconClose = document.querySelector(".CloseIcon");
const IconMenu = document.querySelector(".IconToggle");
const MobileNav = document.querySelector(".P_ItemNavbar");

IconClose.addEventListener('click',()=>{
    MobileNav.classList.remove("ShowNav");
});
IconMenu.addEventListener('click',()=>{
    MobileNav.classList.add("ShowNav");
})

// Select element with box class, assign to box variable
const box = document.querySelector(".P_ItemNavbar")
// Detect all clicks on the document
document.addEventListener("click", function(event) {
  // If user clicks inside the element, do nothing
  if (event.target.closest(".P_ItemNavbar") || event.target.closest(".IconToggle")) return
  // If user clicks outside the element, hide it!
  box.classList.remove("ShowNav")
})