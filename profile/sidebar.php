<?php

function permissionPage($pageName)
{
    global $userid, $conn;
    $sql3 = "SELECT *  FROM tc_page_access WHERE userid='$userid' and pagename='$pageName'";
    $result3 = $conn->query($sql3);
    if ($result3->num_rows > 0) {
// output data of each row
        while ($row3 = $result3->fetch_assoc()) {
            if ($row3['access'] == 'true') {
                return true;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}

?>
<aside class="main-sidebar MainSideMenu sidebar-dark-primary elevation-4 MainBlackBg Pb100 M_H100">
    <!-- Brand Logo ss-->
    <a href="../index.php" class="brand-link LogoProfile">
        <img src="../assets/images/Logo.gif" alt="TradicodersLogo" style="width: 50%;">
    </a>
    <div class="sidebar Fs14 Fw600" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) zzzzzzz-->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <!-- <div class="ms-2 col-2">
                    <li><a href="https://www.tradicoders.ir/?destroy=-1" style="font-size:20px; color:white;"><span class="fa fa-sign-out"></span> </a></li>
                </div> -->
                <div class="image col-3 LogoProfileAdmin">
                    <img src="<?php echo $imgurl; ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info col-6">
                    <a href="profile.php" class="d-block TextDecNone Fs16" ><?php echo $fullname; ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2 Plr10">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open W100">
                        <a href="index.php" class="nav-link MainBgColor Mt20 active">
                        <i class="fa-solid fa-bars-progress IconSide"></i>
                            <p>
                                مدیریت پروژه
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link">
                                <i class="fa-solid fa-list-check IconSide"></i>
                                <p>تمامی پروژه ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?status=open" class="nav-link">
                                <i class="fa-solid fa-envelope-open-text IconSide"></i>
                                    <p>پروژه های باز</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?status=close" class="nav-link">
                                <i class="fa-solid fa-folder-closed IconSide"></i>
                                <p>پروژه های بسته</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview menu-open W100">
                        <a href="index.php" class="nav-link MainBgColor Mt20 active">
                            <i class="nav-icon fa fa-money IconSide"></i>
                            <p>
                                امور مالی
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="accounting.php" class="nav-link">
                                <i class="fa-solid fa-wallet IconSide"></i>
                                    <p>کیف پول</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview menu-open W100">
                        <a href="index.php" class="nav-link MainBgColor Mt20 active">
                            <i class="fa-solid fa-gear IconSide"></i>
                            <p>
                                تنظیمات
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="profile.php" class="nav-link">
                                    <i class="fa-solid fa-user IconSide"></i>
                                    <p>پروفایل</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="tickets.php" class="nav-link">
                                    <i class="fa-solid fa-user IconSide"></i>
                                    <p>تیکت و پشتیبانی</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="support.php" class="nav-link">
                                    <i class="fa-solid fa-user IconSide"></i>
                                    <p>افزودن پشتیبانی</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <?php if ($role != 'developer' && $role != 'user') {

                        $sql2 = "SELECT *  FROM tc_all_page WHERE type='base'";
                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                $basename = $row2['basename'];
                                $namepage = $row2['namepage'];
                                $addresspage = $row2['addresspage'];
                                ?>

                                <li class="nav-item has-treeview menu-open W100">
                                    <a href="<?php echo $addresspage ?>" class="nav-link MainBgColor Mt20 active">
                                    <i class="fa-solid fa-bars-progress IconSide"></i>
                                        <p>
                                            <?php echo $namepage ?>
                                            <i class="right fa fa-angle-left"></i>
                                        </p>
                                    </a>

                                    <?php

                                    $sql = "SELECT *  FROM tc_all_page WHERE type='subset' and basename='$basename'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $namepage = $row['namepage'];
                                            $addresspage = $row['addresspage'];
                                            if (permissionPage($addresspage) || $role == "admin") {
                                                ?>

                                                <ul class="nav nav-treeview">
                                                    <li class="nav-item">
                                                        <a href="<?php echo $addresspage ?>.php" class="nav-link">
                                                            <i class="fa fa-circle-o nav-icon"></i>
                                                            <p><?php echo $namepage ?></p>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </li>

                                <?php
                            }
                        }

                    } ?>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>

</aside>