const Item = document.querySelector(".ConfirmItemBtn");
let RowOfItems = document.querySelector(".RowOfItems");

Item.addEventListener("click", () => {
  const Box = RowOfItems.querySelector(".Box");
  Box.remove();

  // Add Box To Existing Row
  RowOfItems.innerHTML += `
          <div class="BoxSquare">ایتم 
            <div class="And SecondaryBG">And</div>
            <div class="Or OrangeBG">Or</div>
          </div>
          <div
            class="Box"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
          >
            <div>
              <i class="fa fa-plus"></i>
            </div>
          </div>
      `;
});

