const NavAllTabs = document.querySelectorAll(".TabCode");
let NavAllButtons = document.querySelectorAll(".NavItem");
let CloseFile = document.querySelectorAll(".CloseNavIcon");
let TabNames = [firstTab];
const LeftContent = document.querySelector(".LeftContent");
const IconLefts = document.querySelectorAll(".IconLefts");
const LeftSide = document.querySelector(".LeftSide");
const TextCenter = document.querySelectorAll(".TextCenter");
const IconRightSide = document.querySelectorAll(".IconRightSide");
const Files = document.querySelectorAll(".Files");
const ActiveIcon = document.querySelector(".ActiveIcon");
const SecSetting = document.querySelectorAll(".SecSetting");
const TextTheme = document.querySelectorAll(".TextTheme");
const CarretClose = document.querySelector("#Carret");
const CarretOpen = document.querySelector("#CarretOpen");
const RightContent = document.querySelector(".RightContent");
const RightSideOfCode = document.querySelector(".RightSideOfCode");
const P_NavItems = document.querySelector(".P_NavItems");
const AllTabs = document.querySelectorAll(".TabOfSideMenu");
const BottomPanel = document.querySelector("#bottom_panel");
const ConsoleOutput = document.querySelector(".ConsoleOutput");
const panel = document.getElementById("bottom_panel");
const ArrowDown = document.getElementById("ArrowDown");
const ClearBtn = document.getElementById("Clear");
const NavConsole = document.querySelector(".NavConsole");
const InputConsole = document.querySelector(".InputConsole");
const IconConsole = document.querySelectorAll(".IconConsole");
const TextAreaApp = document.querySelectorAll(".TextAreaApp");
const TitleTabs = document.querySelectorAll(".TitleTabs");
const P_IconWork = document.querySelectorAll(".P_IconWork");
// const CodeMirror_scroll = document.querySelector(".CodeMirror-scroll");

var ThemeMode = "light";



// Theme Of Code

// function UpdateCodeArea() {
  

//     for (let i = 0; i < AllCodeArea.length; i++) {
//       let NameOfTheme;
//       if (ThemeMode == "light") {
//         NameOfTheme = i % 2 == 0 ? "xq-light" : "3024-day";
//       } else {
//         NameOfTheme = i % 2 == 0 ? "dracula" : "blackboard";
//       }

//       var editor = CodeMirror.fromTextArea(AllCodeArea[i], {
//         lineNumbers: true,
//         styleActiveLine: true,
//         matchBrackets: true,
//         theme: NameOfTheme,
//         extraKeys: { "Ctrl-Space": "autocomplete" },
//       });
//     }
// }
// $(document).ready(function () {
//   UpdateCodeArea();
// });

$(document).ready(function () {
    const AllCodeArea = document.querySelectorAll(".CodeArea");
    for (let i = 0; i < AllCodeArea.length; i++) {
      let NameOfTheme;
      if (ThemeMode == "light") {
        NameOfTheme = i % 2 == 0 ? "xq-light" : "3024-day";
      } else {
        NameOfTheme =  "dracula";
      }

      var editor = CodeMirror.fromTextArea(AllCodeArea[i], {
        lineNumbers: true,
        styleActiveLine: true,
        matchBrackets: true,
        theme: NameOfTheme,
        extraKeys: { "Ctrl-Space": "autocomplete" },
      });
    }
});


// Switch Nav Tabs
function SwitchNavItem(bl=false) {

  CloseFile = document.querySelectorAll(".CloseNavIcon");
  for (let i = 0; i < NavAllButtons.length; i++) {
      if (descriptions.length > 0 && bl){
        inid = NavAllButtons[i].id;
        inid = inid.replace('close_','');
        inid = inid.split('.');
        inid = inid[0];
        document.getElementById('description_body').innerHTML = descriptions[inid];
        document.getElementById('description_body').style.display = "block";
      }
    NavAllButtons[i].addEventListener("click", () => {

      if (descriptions.length > 0){
        inid = NavAllButtons[i].id;
        inid = inid.replace('close_','');
        inid = inid.split('.');
        inid = inid[0];
        document.getElementById('description_body').innerHTML = descriptions[inid];
        document.getElementById('description_body').style.display = "block";
      }
      if (!CloseFile[i].dataset.clicked) {
        // ShowNav(i);
      }
    });
  }

}

function ShowNav(PanelIndex,idbtn) {
  NavInButton = document.getElementById(idbtn);
  NavAllButtons.forEach((button) => {
    button.classList.remove("ActiveNav");
    if (ThemeMode === "light"){
      button.classList.remove("ActiveNavLight");
    }else {
      button.classList.remove("ActiveNavDark");
    }

  });
  try {
    NavInButton.classList.add("ActiveNav");
    if (ThemeMode === "light"){
      NavInButton.classList.add("ActiveNavLight");
    }else {
      NavInButton.classList.add("ActiveNavDark");
    }

  }catch (e) {

  }

  let i = 0;
  NavAllTabs.forEach((Tab) => {
    if (PanelIndex != i) {
      Tab.classList.add("DisNone");
    } else {
      Tab.classList.remove("DisNone");
    }
    i++;
  });
}

SwitchNavItem(true);
ShowNav(0, 'close_'+firstTab);



// Add File
function OpenFile(filename){
  for (var index=0; index < allTabNames.length ; index++){
    if (allTabNames[index] === filename){
      navindex = index;
    }
  }
  // indexbtn = TabNames.length;
  for (const Name of TabNames){
    if (filename === Name){
      return;
    }
  }
  oldconsole = document.getElementById('console_body').innerHTML;
  document.getElementById('console_body').innerHTML = oldconsole+`<br> open file `+filename;
  TabNames.push(filename);
  P_NavItems.innerHTML += `
  <div id="close_`+filename+`" onclick="ShowNav(`+navindex+`,'close_`+filename+`')" class="NavItem EngFont NavItemBorder AlmostBlack">
          <i class="fa-solid fa-xmark CloseNavIcon"></i>
          `+filename+`
          <i class="fa-brands fa-php IconOfProg"></i>
        </div>
  `;
  UpdateButtons();
  ShowNav(navindex,'close_'+filename);
};



function UpdateButtons() {
  CloseFile = document.querySelectorAll(".CloseNavIcon");
  NavAllButtons = document.querySelectorAll(".NavItem");

  for (let i = 0; i < CloseFile.length; i++) {
    CloseFile[i].addEventListener("click", () => {
      CloseFile[i].dataset.clicked = "true";
      CloseFile[i].parentElement.remove();
      // for (var index=0; index <TabNames.length; index++){
      //   if (TabNames[index] === filename){
          TabNames.splice(i,i);
      //   }
      //   console.log(TabNames);
      // }

    });
  }
  // Switch Nav Tabs
  SwitchNavItem();
}

UpdateButtons();

// Theme Start
function ThemeChanger(Theme = "light", sendbl = true) {
  ThemeMode = Theme;
  // UpdateCodeArea();


  if (sendbl){
    var data = "request=attr&attr=them-academy&value=" + Theme;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // alert(this.responseText);
        location.reload();
      }
    };

    xmlhttp.open("GET", "../ajaxcenter.php?" + data, true);
    xmlhttp.send();

  }else {
    if (ThemeMode == "light") {
      LeftContent.classList.add("LightLeftContent");

      for (let i = 0; i < IconLefts.length; i++) {
        IconLefts[i].classList.add("IconLeftsLight");
      }

      LeftSide.classList.add("LeftSideLight");

      for (let i = 0; i < TextCenter.length; i++) {
        TextCenter[i].classList.add("TextCenterLight");
      }

      for (let i = 0; i < IconRightSide.length; i++) {
        IconRightSide[i].classList.add("IconRightSideLight");
      }

      for (let i = 0; i < Files.length; i++) {
        Files[i].classList.add("FilesLight");
      }

      RightContent.classList.add("RightContentLight");

      for (let i = 0; i < SecSetting.length; i++) {
        SecSetting[i].classList.add("SecSettingLight");
      }

      for (let i = 0; i < TextTheme.length; i++) {
        TextTheme[i].classList.add("TextThemeLight");
      }

      IconLefts[IconLefts.length - 1].classList.add("black");

      BottomPanel.classList.add("BgWhite");

      ConsoleOutput.classList.add("AlmostBlack");

      NavConsole.classList.add("NavOfConsole");

      InputConsole.classList.add("BgWhite");

      for (let i = 0; i < IconConsole.length; i++) {
        IconConsole[i].classList.add("AlmostBlack");
      }

      InputConsole.classList.add("AlmostBlack");

      P_NavItems.classList.add("BgWhite");

      for (let i = 0; i < NavAllButtons.length; i++) {
        NavAllButtons[i].classList.add("AlmostBlack");
        NavAllButtons[i].classList.add("NavItemBorder");
      }

      RightSideOfCode.classList.add("BgWhite");

      for (let i = 0; i < TextAreaApp.length; i++) {
        TextAreaApp[i].classList.add("BgWhite");
        TextAreaApp[i].classList.add("AlmostBlack");
      }
      for (let i = 0; i < TitleTabs.length; i++) {
        TitleTabs[i].classList.remove("TitleTabsLight");
      }
      for (let i = 0; i < P_IconWork.length; i++) {
        P_IconWork[i].classList.add("P_IconWorkLight");
      }


      for (const ActiveNav of document.getElementsByClassName('ActiveNav')){
        ActiveNav.classList.remove('ActiveNavDark');
        ActiveNav.classList.add('ActiveNavLight');
      }
      // CodeMirror_scroll.classList.add("CodeMirror_vscrollbarLight")

      // PNavItems.classList.add(".P_NavItemsLight");
    } else {
      LeftContent.classList.remove("LightLeftContent");

      for (let i = 0; i < IconLefts.length; i++) {
        IconLefts[i].classList.remove("IconLeftsLight");
      }

      LeftSide.classList.remove("LeftSideLight");

      for (let i = 0; i < TextCenter.length; i++) {
        TextCenter[i].classList.remove("TextCenterLight");
      }

      for (let i = 0; i < IconRightSide.length; i++) {
        IconRightSide[i].classList.remove("IconRightSideLight");
      }

      for (let i = 0; i < Files.length; i++) {
        Files[i].classList.remove("FilesLight");
      }

      RightContent.classList.remove("RightContentLight");

      for (let i = 0; i < SecSetting.length; i++) {
        SecSetting[i].classList.remove("SecSettingLight");
      }

      for (let i = 0; i < TextTheme.length; i++) {
        TextTheme[i].classList.remove("TextThemeLight");
      }

      IconLefts[IconLefts.length - 1].classList.remove("black");

      BottomPanel.classList.remove("BgWhite");

      ConsoleOutput.classList.remove("AlmostBlack");

      NavConsole.classList.remove("NavOfConsole");

      InputConsole.classList.remove("BgWhite");

      InputConsole.classList.remove("AlmostBlack");

      for (let i = 0; i < IconConsole.length; i++) {
        IconConsole[i].classList.remove("AlmostBlack");
      }

      P_NavItems.classList.remove("BgWhite");

      for (let i = 0; i < NavAllButtons.length; i++) {
        NavAllButtons[i].classList.remove("AlmostBlack");
        NavAllButtons[i].classList.remove("NavItemBorder");
      }

      RightSideOfCode.classList.remove("BgWhite");

      for (let i = 0; i < TextAreaApp.length; i++) {
        TextAreaApp[i].classList.remove("BgWhite");
        TextAreaApp[i].classList.remove("AlmostBlack");
      }

      for (let i = 0; i < TitleTabs.length; i++) {
        TitleTabs[i].classList.add("TitleTabsLight");
      }
      for (let i = 0; i < P_IconWork.length; i++) {
        P_IconWork[i].classList.remove("P_IconWorkLight");
      }



      for (const ActiveNav of document.getElementsByClassName('ActiveNav')){
        ActiveNav.classList.remove('ActiveNavLight');
        ActiveNav.classList.add('ActiveNavDark');
      }
      // CodeMirror_scroll.classList.remove("CodeMirror_vscrollbarLight")

      // PNavItems.classList.remove(".P_NavItemsLight");
    }
  }


}



// Change Side Menu Tabs

for (let i = 0; i < IconLefts.length; i++) {
  IconLefts[i].addEventListener("click", () => {

    if (i === 0){
      if (userid > -1){
        window.open('./editor','_self');
      }else {
        alert("برای استفاده از ادیتور، وارد فضای کاربری خود شوید");
        openLink("https://tradicoders.ir/login.php?url_redirect=https://app.tradicoders.ir/editor");
      }
    }else if (i === 1){
      window.open('فیلتر زمانی 1__1','_self');
    }else{
      ShowPannel(i);
    }
  });
}

function ShowPannel(PanelIndex) {
  IconLefts.forEach((button) => {
    button.classList.remove("ActiveIcon");
    button.classList.remove("black");
  });
  IconLefts[PanelIndex].classList.add("ActiveIcon");

  if (ThemeMode == "light") {
    IconLefts[PanelIndex].classList.add("black");
    console.log('hahah')
  }
  

  let i = 0;
  AllTabs.forEach((Tab) => {
    if (PanelIndex != i) {
      Tab.classList.add("DisNone");
    } else {
      Tab.classList.remove("DisNone");
    }
    i++;
  });
}

ShowPannel(firstPanel);

// When Going to Close
CarretClose.addEventListener("click", () => {
  RightContent.classList.add("RightContent_Close");
  RightSideOfCode.classList.add("FullWidthRight");
  RightSideOfCode.classList.remove("MinWidthRight");


  setTimeout(() => {
    CarretOpen.classList.remove("DisNone");
    if (ThemeMode == "dark") {
      CarretOpen.classList.add("ColorWhite");
    } else {
      CarretOpen.classList.add("black");
    }
  }, 500);
});
// When Going to Open
CarretOpen.addEventListener("click", () => {
  RightContent.classList.remove("RightContent_Close");
  CarretOpen.classList.add("DisNone");
  RightSideOfCode.classList.add("MinWidthRight");
  RightSideOfCode.classList.remove("FullWidthRight");
});

// Start Terminal

const BORDER_SIZE = 7;

// height of console
let MinHeight = 60;
let MedHeight = 196;

// Change Draggable Size
let m_pos;
function resize(e) {
  const dx = m_pos - e.y;
  m_pos = e.y;

  panel.style.height = parseInt(getComputedStyle(panel, "").height) + dx + "px";

  if (parseInt(getComputedStyle(panel, "").height) < 90) {
    ConsoleOutput.classList.add("DisNone");
  } else {
    ConsoleOutput.classList.remove("DisNone");
  }
}

panel.addEventListener(
  "mousedown",
  function (e) {
    if (e.offsetY < BORDER_SIZE) {
      m_pos = e.y;
      document.addEventListener("mousemove", resize, false);
    }
  },
  false
);

document.addEventListener(
  "mouseup",
  function () {
    document.removeEventListener("mousemove", resize, false);
  },
  false
);

// Change Console Height Size
ArrowDown.addEventListener("click", () => {
  // if console Is In bottom
  if (parseInt(getComputedStyle(panel, "").height) <= MinHeight) {
    panel.style.height = `${MedHeight}px`;
    ArrowDown.style.transform = " rotate(0deg)";
    ConsoleOutput.classList.remove("DisNone");
  } else {
    panel.style.height = `${MinHeight}px`;
    ArrowDown.style.transform = " rotate(180deg)";
    ConsoleOutput.classList.add("DisNone");
  }
});

// Clear Console
ClearBtn.addEventListener("click", () => {
  ConsoleOutput.innerText = "";
});




