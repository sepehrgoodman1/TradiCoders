const Item = document.querySelector(".ConfirmItemBtn");
let RowOfItems = document.querySelector(".RowOfItems");

Item.addEventListener("click", () => {
  // Add Box To Existing Row
  RowOfItems.innerHTML += `
    <div class="BoxSquare">ایتم 
    <div class="And SecondaryBG">And</div>
    <div class="Or OrangeBG">Or</div>
  </div>
      `;
});

// const WrapperRow = document.querySelector(".WrapperBody");
// const Item = document.querySelectorAll(".ItemBox");
// let RowOfItems = document.querySelectorAll(".RowOfItems");

// // Add New Box After Selecting
// var NumRow = 0;

// for (let i = 0; i < Item.length; i++) {
//   Item[i].addEventListener("click", () => {
//     // Add Box To Existing Row
//     RowOfItems[NumRow].innerHTML += `
//       <div class="Box" data-bs-toggle="modal" data-bs-target="#exampleModal">
//             <div>
//               <i class="fa fa-plus"></i>
//             </div>
//           </div>

//       `;

//     // Add New Row

//     RowOfItems = document.querySelectorAll(".RowOfItems");

//     let BoxAdd = RowOfItems[NumRow].querySelectorAll(".Box");

//     console.log(BoxAdd.length);
//     if (BoxAdd.length == 2) {
//       WrapperRow.innerHTML += `
//         <div class="RowOfItems">
//         <div
//           class="Box"
//           data-bs-toggle="modal"
//           data-bs-target="#exampleModal"
//         >
//           <div>
//             <i class="fa fa-plus"></i>
//           </div>
//         </div>
//       </div>
//         `;
//       RowOfItems = document.querySelectorAll(".RowOfItems");

//       for (let j = 0; j < RowOfItems.length; j++) {
//         RowOfItems[j].addEventListener("click", () => {
//           NumRow = j;
//         });
//       }
//     }
//   });
// }
