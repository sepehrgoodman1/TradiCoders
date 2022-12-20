
    <div id="bottom_panel" onmouseup="eventSize()" class="BgWhite">
      <div class="NavConsole NavOfConsole">
        <i class="fa-solid fa-angles-down IconConsole AlmostBlack" id="ArrowDown" onmousedown="setTimeout(eventSize, 100)"></i>
        <i class="fa-solid fa-ban IconConsole AlmostBlack" id="Clear"></i>

        <i class="fa-solid fa-magnifying-glass IconConsole AlmostBlack"></i>
        <input type="text" class="InputConsole BgWhite AlmostBlack" />
      </div>
      <div id="console_body" class="ConsoleOutput EngFont AlmostBlack">Hello world ...</div>
    </div>

    <script>
        function eventSize() {
            height_center = parseInt(100-($('#bottom_panel').height () / (($(window).height()-document.getElementsByClassName('TopNavigation')[0].offsetHeight) /100)));
            if (height_center > 60){
                height_center += 5;
            }else if (height_center < 30){
                height_center -= 5;
            }
            document.getElementById('all_tabs').style.height = height_center+"%";
        }
        oldconsole = document.getElementById('console_body').innerHTML;
        document.getElementById('console_body').innerHTML = oldconsole+`<br> open file `+firstTab;
    </script>
