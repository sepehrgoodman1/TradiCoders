
let RowOfItems = document.querySelector(".RowOfItems");
let array_logic_create = [];
let count = 0;

function addItem() {
  count ++;
  const Box = RowOfItems.querySelector(".Box");
  const Box2 = RowOfItems.querySelector(".Box2");
  var logics = JSON.parse(document.getElementById('logics_selector').value);
  var name_logic = logics['name'];
  var id_logic = count+"_"+logics['id'];
  Box.remove();
  Box2.remove();

  array_logic_create.push(id_logic);

  // Add Box To Existing Row
  RowOfItems.innerHTML += `
          <div class="BoxSquare"> `+name_logic+`
            <div onclick="changeLogic('`+id_logic+`')" id="and_`+id_logic+`" class="And SecondaryBG">And</div>
            <div onclick="changeLogic('`+id_logic+`')" id="or_`+id_logic+`" style="display: none" class="And OrangeBG">Or</div>
            <input type="hidden" value="0" id="input_`+id_logic+`">
          </div>
          <div
            class="Box"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            <div>
              <i class="fa fa-plus"></i>
            </div>
          </div>
         <div onclick="createLogic()"  style="height: 50px; width: 150px;" class="Box2 ConfirmItemBtn PrimaryBG">
              ساخت لاجیک
          </div>
      `;
}

function changeLogic(id){
  var input_logic = document.getElementById('input_'+id).value;
  if (input_logic === '0'){
    document.getElementById('input_'+id).value = '1';
    document.getElementById('and_'+id).style.display = "none";
    document.getElementById('or_'+id).style.display = "block";
  }else {
    document.getElementById('input_'+id).value = '0';
    document.getElementById('and_'+id).style.display = "block";
    document.getElementById('or_'+id).style.display = "none";
  }
}

function create_custom_logic(body) {
  var LogicDescription = document.getElementById('LogicDescription').value;
  var LogicName = document.getElementById('LogicName').value;
  var language = document.getElementById('ProjectLang').value;
  var data = "request=create_custom_logic&language="+language+"&body=" + body+"&name="+LogicName+"&description="+LogicDescription;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // alert(this.responseText);
      var response = this.responseText;
      if (response.includes('finish_create')){
        openLink('builderCode.php');
      }else {
        alert('خطا در ساخت لاجیک');
      }
    }
  };
  xmlhttp.open("GET", "create_custom_logic.php?" + data, true);
  xmlhttp.send();
}

function createLogic(){
  var help = 0;
  logic_finish = "";
  for(const id_logic of array_logic_create){
    help ++;
    input_logic = document.getElementById('input_'+id_logic).value;
    if (input_logic === "0"){
      input_logic = "and";
    }else {
      input_logic = "or";
    }
    if (help !== count){
      logic_finish += id_logic+input_logic;
    }else {
      logic_finish += id_logic;
    }
  }
  create_custom_logic(logic_finish);
}

