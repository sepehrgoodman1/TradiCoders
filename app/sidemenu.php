<!-- Side Menu -->
<div class="LeftSide LeftSideLight">
    <div class="LeftContent PosRel LightLeftContent">
        <!-- Icon Open Side Menu -->
        <i class="fa-solid fa-caret-left CarretSlide DisNone" id="CarretOpen"></i>
        <div>
            <!-- Icon -->
            <div>
                <a href="https://tradicoders.ir">
                    <img
                            src="https://tradicoders.ir/assets/images/Logo.gif"
                            class="TradiLogo"
                            alt="TradiLogo"
                    />
                </a>
            </div>
            <!-- Icon -->
            <div class="TextCenter">
                <i class="fa-solid fa-code IconLefts IconLeftsLight ActiveIcon black"></i>
            </div>
            <!-- Icon -->
<!--            <div class="TextCenter">-->
<!--                <i class="fa-solid fa-laptop-code IconLefts IconLeftsLight"></i>-->
<!--            </div>-->
            <!-- Icon -->
            <div class="TextCenter">
                <i class="fa-solid fa-chalkboard-user IconLefts IconLeftsLight"></i>
            </div>
            <!-- Icon -->
<!--            <div class="TextCenter">-->
<!--                <i class="fa-solid fa-store IconLefts IconLeftsLight"></i>-->
<!--            </div>-->
        </div>

        <div>
            <?php if ($userid > 0){ ?>
            <div class="TextCenter Mb15">
                <i class="fa-solid fa-gear IconLefts IconLeftsLight"></i>
            </div>
            <?php } ?>
        </div>

    </div>
    <div class="RightContent RightContentLight PosRel  TitleFont">
        <!-- Icon Close Side Menu -->
        <i class="fa-solid fa-caret-left CarretSlide" id="Carret"></i>

        <!-- First pannel -->
        <div class="TabOfSideMenu">


            <div class="TextCenter TitleTabs TitleTabsLight Fs20">میز توسعه</div>
            <div class="P_IconWork Plr10">
                <i onclick="showIt('new_file')" class="fa-solid fa-square-plus IconRightSide" title="فایل جدید"></i>
                <i onclick="allOnclick('rename')" class="fa-solid fa-file-signature IconRightSide"
                   title="تغییر نام"></i>
                <i onclick="allOnclick('deleteFile')" class="fa-solid fa-trash-can IconRightSide" title="حذف کردن"></i>
                <i onclick="checkCodes()" class="fa-solid fa-refresh IconRightSide" title="بروزرسانی"></i>
            </div>
            <!-- Files -->
            <div id="all_file" class="Mt20 Plr10 style-scroll">

                <?php
                if ($userid > 0) {
                    $sql_files = selectQuery_tc_codes("userid='$userid'");
                    foreach ($sql_files as $file) {
                        ?>
                        <div style="width: 80%; float: left;" ondblclick="OpenFile('<?php echo $file['name'] . '.' . $file['typefile']; ?>')"
                             class="Files FilesLight ">
                            <i class="fa-regular fa-file FileIcon "></i><span
                                    class="EngFont"><?php echo $file['name'] . '.' . $file['typefile']; ?></span>
                            <div style="float: right; width: 20%;">
                                <i onclick="saveFile('<?php echo $file['name'] . '.' . $file['typefile']; ?>')"
                                   class="fa-regular fa-save FileIcon "></i>
                                <i onclick="downloadFile('<?php echo $file['name']; ?>','<?php echo $file['typefile']; ?>')"
                                   class="fa-regular fas fa-file-download FileIcon "></i>
                            </div>

                        </div>
                        <?php
                    }
                }
                ?>
                <div id="new_file" class="Files FilesLight " style="display: none">
                    <i class="fa-regular fa-file FileIcon "></i>
                    <input onchange="checkName()" class="EngFont" id="new_file_name">
                </div>
            </div>
        </div>
        <!-- Second pannel -->
<!--        <div class="TabOfSideMenu">-->
<!--            <div class="TextCenter TitleTabs Fs20">کدساز</div>-->
<!---->
<!--        </div>-->

        <!-- third pannel -->
        <div class="TabOfSideMenu">
            <div class="TextCenter TitleTabs Fs20">آموزش</div>
            <div id="all_file"  class="Mt20 Plr10 style-scroll">
                <?php
                $sql_files = selectQuery_tc_Academy();
                foreach ($sql_files as $file) {
                    ?>
                   <a href="<?php echo $file['name']."__".$file['id']?>" class="NormalLink"> <div id=""
                         class="Files FilesLight ">
                        <i class="fa-regular fa-file FileIcon "></i><span
                                class="EngFont"><?php echo $file['name']; ?></span>
                    </div></a>
                    <?php
                }
                ?>
            </div>
        </div>

        <!-- Four pannel -->
<!--        <div class="TabOfSideMenu">-->
<!--            <div class="TextCenter TitleTabs Fs20">فروشگاه</div>-->
<!--        </div>-->
        <!-- Four pannel -->
        <?php if ($userid > -1){ ?>
        <div class="TabOfSideMenu" >
            <div class="TextCenter TitleTabs Fs20">تنظیمات</div>
            <div class="P_Themes RegFont ">
                <div class="TitleFont SecSetting SecSettingLight">تم ها</div>
                <div class="Plr10">
                    <label class="P_CheckMark">
                        <input type="radio" <?php if ($them == 'light'){echo 'checked="checked"';} ?> name="radio" onclick="ThemeChanger('light')">
                        <span class="checkmark"></span>
                        <span class="TextTheme TextThemeLight"> روشن </span>
                    </label>
                    <label class="P_CheckMark">
                        <input type="radio" name="radio" <?php if ($them == 'dark'){echo 'checked="checked"';} ?> onclick="ThemeChanger('dark')">
                        <span class="checkmark"></span>
                        <span class="TextTheme TextThemeLight"> تاریک </span>
                    </label>
                </div>
            </div>


        </div>
        <?php } ?>
    </div>
</div>




<!-- End Side Menu -->

