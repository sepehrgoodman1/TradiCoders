<?php
require('../config.php');
require('../sessionchecker.php');
require('../indexinitial.php');
require('../BcMaker.php');
require('../projectbuilder.php');
$action = 'academy';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TRADICODERS</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicons -->
    <link href="../tradi-coders-logo-final.gif" rel="shortcut icon" type="image/x-icon">
    <link href="../tradi-coders-logo-final.gif" rel="apple-touch-icon">

    <link rel="stylesheet" href="css/academy.css">

    <!-- CSS
	============================================ -->

    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/plugins.min.css">
    <link rel="stylesheet" href="css/style.min.css">

</head>

<body>

    <div id="page">
        <!-- Header Section Start -->
        <div class="lines-wrap">
    <div class="lines-inner">
        <div class="lines"></div>
    </div>
</div>

<div>
    <!-- heder -->
    <?php require('../header.php'); ?>
    <!-- heder end -->
</div>
        <!-- Header Section End -->

        <!-- Page Title Section Start -->
        <div class="page-title-section section">
            <div class="page-title">
                <div class="container">
                    <h1 class="title">جزئیات دوره</h1>
                </div>
            </div>
            <div class="page-breadcrumb">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="index.html">صفحه اصلی</a></li>
                        <li class="current">جزئیات دوره</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Title Section End -->

        <!-- Course Details Section Start -->
        <div class="section">
            <div class="container">
                <div class="row max-mb-n50">

                    <div class="col-lg-8 col-12 order-lg-1 max-mb-50" style="padding:0;">
                        <!-- Course Details Wrapper Start -->
                        <div class="course-details-wrapper">
                            <div class="course-nav-tab">
                                <ul class="nav" style="matgin-bottom:5px;">
                                    <li><a class="active" data-toggle="tab" href="#overview">بررسی اجمالی</a></li>
                                    <li><a data-toggle="tab" href="#curriculum">برنامه درسی</a></li>
                                    <li><a data-toggle="tab" href="#instructor">مربی</a></li>
                                    <li><a data-toggle="tab" href="#reviews">نظرات </a></li>
                                </ul>
                            </div>
                            <div class="tab-content" style="height: 450px;padding: 5px;overflow-y: scroll;border-radius: 10px;">
                                <div id="overview" class="tab-pane fade show active">
                                    <div class="course-overview">
                                        <h3 class="title">توضیحات دوره</h3>

                                        <p>اکنون بیش از هر زمان دیگری ، شرکت ها سرمایه گذاری زیادی در فناوری اطلاعات انجام می دهند. کیفیت این سرمایه گذاری ها بر کار روزانه میلیون ها نفر تأثیر می گذارد.</p>

                                        <p>با این وجود دیدن بررسی های صنعتی که میزان شکست پروژه های IT بیش از 50٪ است ، غیر معمول نیست. می توان بهتر انجام داد و می توان آن را به طور مداوم انجام داد. از بوم مدل کسب و کار برای تمرکز استراتژی شرکت خود و تسهیل خرید سهامداران استفاده کنید.</p>

                                        <div class="overview-course-video">
                                            <iframe title="تحول دیجیتال را با استراتژی های بسترهای نرم افزاری هدایت کنید دیدگاه تحلیل گر فناوری اطلاعات" src="https://www.aparat.com/v/OmyqU"></iframe>
                                        </div>

                                        <p>در این دوره دو هفته ای ، ما چالش های بزرگی را در زمینه IT شرکت و چگونگی رفع آنها با استفاده منظم از تفکر طراحی ، راه اندازی ناب و چابک به عنوان یک چارچوب تیم گام برمی داریم..</p>
                                    </div>
                                </div>

                                <div id="curriculum" class="tab-pane fade">
                                    <div class="course-curriculum">
                                        <ul class="curriculum-sections">
                                            <li class="single-curriculum-section">
                                                <div class="section-header">
                                                    <div class="section-left">

                                                        <h5 class="title">ساده سازی را تغییر دهید</h5>
                                                        <p class="section-desc">معرفی کلی استراتژی های مشتری محوری</p>

                                                    </div>
                                                </div>
                                                <ul class="section-content">

                                                    <li class="course-item">
                                                        <a class="section-item-link lesson" href="JavaScript:Void(0);">
                                                            <span class="item-name">درس 01: اهداف ساده و قابل دستیابی</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta duration">30 دقیقه </span>
                                                                <span class="item-meta item-meta-icon video">
                                                                    <i class="far fa-video"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link lesson" href="JavaScript:Void(0);">
                                                            <span class="item-name">جلسه زنده درباره استراتژی های اینفوتک</span>
                                                            <div class="course-item-meta">
                                                                <i class="fas fa-lock-alt"></i>
                                                                <span class="item-meta item-meta-icon zoom-meeting">
                                                                    <i class="far fa-users-class"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link" href="JavaScript:Void(0);">
                                                            <span class="item-name">مسابقه 1: بله یا خیر؟</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta count-questions">3 سوال </span>
                                                                <span class="item-meta duration">15 دقیقه </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link" href="JavaScript:Void(0);">
                                                            <span class="item-name">مسابقه 2: یک بازی شبیه سازی ساده</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta count-questions">0 سوال </span>
                                                                <span class="item-meta duration">50 دقیقه </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link lesson" href="JavaScript:Void(0);">
                                                            <span class="item-name">درس 02: تست A / B</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta duration">02 ساعت </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link" href="JavaScript:Void(0);">
                                                            <span class="item-name">مسابقه 3: بازی نقش آفرینی</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta count-questions">1 سوال </span>
                                                                <span class="item-meta duration">01 ساعت </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link" href="JavaScript:Void(0);">
                                                            <span class="item-name">مسابقه 4: مصاحبه کوتاه</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta count-questions">9 سوال </span>
                                                                <span class="item-meta duration">10 دقیقه </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link lesson" href="JavaScript:Void(0);">
                                                            <span class="item-name">درس 03: در مورد تست A / B خلاصه کنید</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta duration">30 دقیقه </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link" href="JavaScript:Void(0);">
                                                            <span class="item-name">مسابقه 5: 15 دقیقه سوال بله / خیر </span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta count-questions">3 سوال </span>
                                                                <span class="item-meta duration">10 دقیقه </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link" href="JavaScript:Void(0);">

                                                            <span class="item-name">مسابقه 6: پاسخ سریع</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta count-questions">0 سوال </span>
                                                                <span class="item-meta duration">10 دقیقه </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="single-curriculum-section">
                                                <div class="section-header">
                                                    <div class="section-left">

                                                        <h5 class="title">هیئت مشاوره مشتری</h5>
                                                        <p class="section-desc">با اصول هیئت مشاوره مشتری آشنا شوید</p>

                                                    </div>
                                                </div>
                                                <ul class="section-content">

                                                    <li class="course-item">
                                                        <a class="section-item-link lesson" href="JavaScript:Void(0);">
                                                            <span class="item-name">درس 04: هیئت مشاوره مشتری</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta duration">30 دقیقه </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link lesson" href="JavaScript:Void(0);">
                                                            <span class="item-name">درس 05: نقش هیئت مشاوره مشتری</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta duration">45 دقیقه </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link lesson" href="JavaScript:Void(0);">
                                                            <span class="item-name">درس 06: نهادهای هیئت مشاوره مشتری</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta count-questions">3 سوال </span>
                                                                <span class="item-meta duration">15 دقیقه </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link" href="JavaScript:Void(0);">
                                                            <span class="item-name">آزمون میان مدت: آزمون نوشتاری 60 دقیقه ای</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta count-questions">5 سوال </span>
                                                                <span class="item-meta duration">01 ساعت </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </li>

                                            <li class="single-curriculum-section">
                                                <div class="section-header">
                                                    <div class="section-left">

                                                        <h5 class="title">بررسی بازخورد</h5>
                                                        <p class="section-desc">موارد مهم در مورد انجام نظرسنجی و مدیریت بازخورد</p>

                                                    </div>
                                                </div>
                                                <ul class="section-content">

                                                    <li class="course-item">
                                                        <a class="section-item-link lesson" href="JavaScript:Void(0);">
                                                            <span class="item-name">درس 07: اهمیت بازخورد مشتری</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta duration">30 دقیقه </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link lesson" href="JavaScript:Void(0);">
                                                            <span class="item-name">درس 08: نقش های مشتری</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta duration">45 دقیقه </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link lesson" href="JavaScript:Void(0);">
                                                            <span class="item-name">درس 09: نحوه انجام نظرسنجی</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta duration">01 ساعت </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <li class="course-item">
                                                        <a class="section-item-link" href="JavaScript:Void(0);">
                                                            <span class="item-name">بحث: چگونه سوالات خوب نظرسنجی و نظرسنجی بنویسیم؟</span>
                                                            <div class="course-item-meta">
                                                                <span class="item-meta count-questions">0 سوال </span>
                                                                <span class="item-meta duration">01 ساعت </span>
                                                                <span class="item-meta item-meta-icon">
                                                                    <i class="fas fa-lock-alt"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </li>

                                            <li class="single-curriculum-section">
                                                <div class="section-header">
                                                    <div class="section-left">

                                                        <h5 class="title">استاد برای شبیه سازی یک روزه</h5>
                                                        <p class="section-desc">این شبیه سازی توسط مدرسین و فراگیران بصورت آنلاین برگزار می شود.</p>

                                                    </div>
                                                </div>
                                                <div class="learn-press-message success ml-15 mr-15">
                                                    <i class="fa"></i>هیچ موردی در این بخش وجود ندارد
                                                </div>
                                            </li>

                                            <li class="single-curriculum-section">
                                                <div class="section-header">
                                                    <div class="section-left">

                                                        <h5 class="title">مطالعات موردی رفتار مشتری</h5>
                                                        <p class="section-desc">در این بخش ، فراگیران فرصتی خواهند داشت تا درباره نقش رفتار مشتری در تجارت کاملاً بحث کنند</p>

                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div id="instructor" class="tab-pane fade">
                                    <div class="course-instructor">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="profile-image">
                                                    <img src="assets/images/profile/instructor.jpg" alt="profile">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="profile-info">
                                                    <h5><a href="profile.html">مگی استریکلند</a></h5>
                                                    <div class="author-career">/آموزش دهنده حرفه ای</div>
                                                    <p class="author-bio">مگی یک مربی درخشان است که زندگی اش صرف علوم کامپیوتر و عشق به طبیعت شد. او که زن بود ، با موانع زیادی روبرو شد و توسط خانواده ممنوع الکار شد. او با روحیه واقعی و هدیه ای با استعداد توانست موفق شود و برای دیگران الگویی باشد.</p>


                                                    <ul class="author-social-networks">
                                                        <li class="item">
                                                            <a href="JavaScript:Void(0);" target="_blank" class="social-link"> <i class="fab fa-twitter social-link-icon"></i> </a>
                                                        </li>
                                                        <li class="item">
                                                            <a href="JavaScript:Void(0);" target="_blank" class="social-link"> <i class="fab fa-facebook-f social-link-icon"></i> </a>
                                                        </li>
                                                        <li class="item">
                                                            <a href="JavaScript:Void(0);" target="_blank" class="social-link"> <i class="fab fa-instagram social-link-icon"></i> </a>
                                                        </li>
                                                        <li class="item">
                                                            <a href="JavaScript:Void(0);" target="_blank" class="social-link"> <i class="fab fa-pinterest social-link-icon"></i> </a>
                                                        </li>
                                                        <li class="item">
                                                            <a href="JavaScript:Void(0);" target="_blank" class="social-link"> <i class="fab fa-youtube social-link-icon"></i> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="reviews" class="tab-pane fade">
                                    <div class="course-reviews">
                                        <div class="course-rating">
                                            <h3 class="title">نظرات</h3>
                                            <div class="course-rating-content">
                                                <div class="average-rating">
                                                    <p class="rating-title secondary-color">میانگین امتیازات</p>
                                                    <div class="rating-box">
                                                        <div class="average-value primary-color">
                                                            4.50
                                                        </div>
                                                        <div class="review-star">
                                                            <div class="tm-star-rating">
                                                                <span class="fas fa-star"></span>
                                                                <span class="fas fa-star"></span>
                                                                <span class="fas fa-star"></span>
                                                                <span class="fas fa-star"></span>
                                                                <span class="fas fa-star-half-alt"></span>
                                                            </div>
                                                        </div>
                                                        <div class="review-amount">
                                                            (2 امتیاز)</div>
                                                    </div>
                                                </div>
                                                <div class="detailed-rating">
                                                    <p class="rating-title secondary-color">رتبه بندی دقیق</p>
                                                    <div class="rating-box">
                                                        <div class="rating-rated-item">
                                                            <div class="rating-point">
                                                                <div class="tm-star-rating">
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="fas fa-star"></span>
                                                                </div>
                                                            </div>
                                                            <div class="rating-progress">
                                                                <div class="single-progress-bar">
                                                                    <div class="progress">
                                                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rating-count">1</div>
                                                        </div>

                                                        <div class="rating-rated-item">
                                                            <div class="rating-point">
                                                                <div class="tm-star-rating">
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="far fa-star"></span>
                                                                </div>
                                                            </div>
                                                            <div class="rating-progress">
                                                                <div class="single-progress-bar">
                                                                    <div class="progress">
                                                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rating-count">1</div>
                                                        </div>

                                                        <div class="rating-rated-item">
                                                            <div class="rating-point">
                                                                <div class="tm-star-rating">
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="far fa-star"></span>
                                                                    <span class="far fa-star"></span>
                                                                </div>
                                                            </div>
                                                            <div class="rating-progress">
                                                                <div class="single-progress-bar">
                                                                    <div class="progress">
                                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rating-count">0</div>
                                                        </div>

                                                        <div class="rating-rated-item">
                                                            <div class="rating-point">
                                                                <div class="tm-star-rating">
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="far fa-star"></span>
                                                                    <span class="far fa-star"></span>
                                                                    <span class="far fa-star"></span>
                                                                </div>
                                                            </div>
                                                            <div class="rating-progress">
                                                                <div class="single-progress-bar">
                                                                    <div class="progress">
                                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rating-count">0</div>
                                                        </div>

                                                        <div class="rating-rated-item">
                                                            <div class="rating-point">
                                                                <div class="tm-star-rating">
                                                                    <span class="fas fa-star"></span>
                                                                    <span class="far fa-star"></span>
                                                                    <span class="far fa-star"></span>
                                                                    <span class="far fa-star"></span>
                                                                    <span class="far fa-star"></span>
                                                                </div>
                                                            </div>
                                                            <div class="rating-progress">
                                                                <div class="single-progress-bar">
                                                                    <div class="progress">
                                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rating-count">0</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="course-reviews-area">
                                            <ul class="course-reviews-list">
                                                <li class="review">
                                                    <div class="review-container">
                                                        <div class="review-author">
                                                            <img src="assets/images/review-author/author1.jpg" alt="author">
                                                        </div>
                                                        <div class="review-content">
                                                            <h4 class="title">ادنا واتسون</h4>
                                                            <div class="review-stars-rated" title="5 out of 5 stars">
                                                                <div class="review-stars empty"></div>
                                                            </div>
                                                            <h5 class="review-title">تمام نیازهای من را بپوشانید </h5>
                                                            <div class="review-text">
                                                                این دوره مواردی را که می خواهیم تغییر دهیم مشخص می کند و سپس کارهایی را که باید برای ایجاد نتیجه مطلوب انجام شود ، مشخص می کند. این دوره به من کمک کرد تا به روشنی مشکلات را تعریف کنم و طیف گسترده تری از راه حل های با کیفیت را ایجاد کنم. از تحلیل ساختارهای بیشتر گزینه هایی که منجر به تصمیم گیری بهتر می شوند پشتیبانی کنید.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="review">
                                                    <div class="review-container">
                                                        <div class="review-author">
                                                            <img src="assets/images/review-author/author2.jpg" alt="author">
                                                        </div>
                                                        <div class="review-content">
                                                            <h4 class="title">اوون مسیح</h4>
                                                            <div class="review-stars-rated" title="5 out of 5 stars">
                                                                <div class="review-stars empty"></div>
                                                            </div>
                                                            <h5 class="review-title">جذاب و سرگرم کننده</h5>
                                                            <div class="review-text">
                                                                این دوره مواردی را که می خواهیم تغییر دهیم مشخص می کند و سپس کارهایی را که باید برای ایجاد نتیجه مطلوب انجام شود ، مشخص می کند. این دوره به من کمک کرد تا به روشنی مشکلات را تعریف کنم و طیف گسترده تری از راه حل های با کیفیت را ایجاد کنم. از تحلیل ساختارهای بیشتر گزینه هایی که منجر به تصمیم گیری بهتر می شوند پشتیبانی کنید
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Course Details Wrapper End -->
                    </div>

                    <div class="col-lg-4 col-12 order-lg-2 max-mb-50" id="sticky-sidebar" style="padding:0;">
                        <div class="sidebar-widget-wrapper pr-0">
                            <div class="sidebar-widget">
                                <div class="sidebar-widget-content">
                                    <div class="sidebar-entry-course-info">
                                        <div class="course-price">
                                            <span class="meta-label">
                                                <i class="meta-icon far fa-money-bill-wave"></i>
                                               قیمت	 </span>
                                            <span class="meta-value">
                                                <span class="price">19000 تومان<span class="decimals-separator"></span></span>
                                            </span>
                                        </div>
                                        <div class="course-meta">
                                            <div class="course-instructor">
                                                <span class="meta-label">
                                                    <i class="far fa-chalkboard-teacher"></i>
                                                    مربی	</span>
                                                <span class="meta-value">مگی استریکلند</span>
                                            </div>
                                            <div class="course-duration">
                                                <span class="meta-label">
                                                    <i class="far fa-clock"></i>
                                                    مدت زمان				</span>
                                                <span class="meta-value">15 هفته </span>
                                            </div>
                                            <div class="course-lectures">
                                                <span class="meta-label">
                                                    <i class="far fa-file-alt"></i>
                                                    سخنرانی ها			 </span>
                                                <span class="meta-value">24</span>
                                            </div>

                                            <div class="course-students">
                                                <span class="meta-label">
                                                    <i class="far fa-user-alt"></i>
                                                    ثبت نام شده	</span>
                                                <span class="meta-value">629 دانش آموز</span>
                                            </div>
                                            <div class="course-language">
                                                <span class="meta-label">
                                                    <i class="far fa-language"></i>
                                                   زبان				</span>
                                                <span class="meta-value">انگلیسی</span>
                                            </div>
                                            <div class="course-time">
                                                <span class="meta-label">
                                                    <i class="far fa-calendar"></i>
                                                    ضرب الاجل			</span>
                                                <span class="meta-value">دی 1399</span>
                                            </div>
                                        </div>
                                        <div class="lp-course-buttons">
                                            <button class="btn btn-primary btn-hover-secondary btn-width-100">ثبت نام</button>
                                        </div>
                                        <div class="entry-course-share">
                                            <div class="share-media">

                                                <div class="share-label">اشتراک گذاری این دوره</div>
                                                <span class="share-icon far fa-share-alt"></span>

                                                <div class="share-list">
                                                    <a class="hint--bounce hint--top hint--theme-two" aria-label="فیس بوک" target="_blank" href="JavaScript:Void(0);"><i class="fab fa-facebook-f"></i></a>

                                                    <a class="hint--bounce hint--top hint--theme-two" aria-label="توییتر" target="_blank" href="JavaScript:Void(0);"><i class="fab fa-twitter"></i></a>

                                                    <a class="hint--bounce hint--top hint--theme-two" aria-label="لینکدین" target="_blank" href="JavaScript:Void(0);"><i class="fab fa-linkedin"></i></a>

                                                    <a class="hint--bounce hint--top hint--theme-two" aria-label="تامبلر" target="_blank" href="JavaScript:Void(0);"><i class="fab fa-tumblr-square"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Course Details Section End -->

        <!-- Scroll Top Start -->
        <a href="#" class="scroll-top" id="scroll-top">
            <i class="arrow-top fal fa-long-arrow-up"></i>
            <i class="arrow-bottom fal fa-long-arrow-up"></i>
        </a>
        <!-- Scroll Top End -->
    </div>

    <div id="site-main-mobile-menu" class="site-main-mobile-menu">
        <div class="site-main-mobile-menu-inner">
            <div class="mobile-menu-header">
                <div class="mobile-menu-logo">
                    <a href="index.html"><img src="assets/images/logo/dark-logo.png" alt=""></a>
                </div>
                <div class="mobile-menu-close">
                    <button class="toggle">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-menu-content">
                <nav class="site-mobile-menu">
                    <ul>
                        <li class="has-children position-static">
                            <a href="#"><span class="menu-text">صفحه اصلی</span></a>
                            <span class="menu-toggle"><i class="far fa-angle-down"></i></span>

                            <ul class="mega-menu">
                                <li>
                                    <ul>
                                        <li><a href="index.html"><span class="menu-text">آموزشی مکس کوچ <span class="badge"> داغ </span></span></a></li>
                                        <li><a href="index-2.html"><span class="menu-text">پورتال دوره</span></a></li>
                                        <li><a href="index-3.html"><span class="menu-text">یادگیری از راه دور <span class="badge"> داغ </span></span></a></li>
                                        <li><a href="index-4.html"><span class="menu-text">آموزش چندرسانه ای</span></a></li>
                                        <li><a href="index-5.html"><span class="menu-text">آموزش مدرن</span></a></li>
                                        <li><a href="index-6.html"><span class="menu-text">آموزش از راه دور</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <ul>
                                        <li><a href="index-7.html"><span class="menu-text">مربیگری بهداشت</span></a></li>
                                        <li><a href="index-8.html"><span class="menu-text">مربیگری بدنسازی</span></a></li>
                                        <li><a href="index-9.html"><span class="menu-text">کسب و کار</span></a></li>
                                        <li><a href="index-10.html"><span class="menu-text">هنر <span class="badge primary">جدید</span></span></a></li>
                                        <li><a href="index-11.html"><span class="menu-text">مربی آشپزخانه <span class="badge primary">جدید</span></span></a></li>
                                        <li><a href="index-12.html"><span class="menu-text">انگیزشی <span class="badge primary">جدید</span></span></a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-50">
                                    <ul>
                                        <li><a href="#"><img src="assets/images/menu/mega-menu.jpg" alt="menu-image"></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#"><span class="menu-text">صفحات</span></a>
                            <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                            <ul class="sub-menu">
                                <li><a href="start-here.html"><span class="menu-text">نقطه شروع</span></a></li>
                                <li><a href="success-story.html"><span class="menu-text">داستان موفقیت</span></a></li>
                                <li><a href="about-me.html"><span class="menu-text">درباره من</span></a></li>
                                <li><a href="about-us-1.html"><span class="menu-text">درباره ما 01</span></a></li>
                                <li><a href="about-us-2.html"><span class="menu-text">درباره ما 02</span></a></li>
                                <li><a href="about-us-3.html"><span class="menu-text">درباره ما 03</span></a></li>
                                <li><a href="contact-me.html"><span class="menu-text">تماس با من</span></a></li>
                                <li><a href="contact-us.html"><span class="menu-text">تماس با ما</span></a></li>
                                <li><a href="purchase-guide.html"><span class="menu-text">راهنمای خرید </span></a></li>
                                <li><a href="privacy-policy.html"><span class="menu-text">سیاست حفظ حریم خصوصی</span></a></li>
                                <li><a href="terms-of-service.html"><span class="menu-text">شرایط استفاده از خدمات</span></a></li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#"><span class="menu-text">دوره ها</span></a>
                            <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                            <ul class="sub-menu">
                                <li><a href="courses-grid-1.html"><span class="menu-text">دوره های گرید 01</span></a></li>
                                <li><a href="courses-grid-2.html"><span class="menu-text">دوره های گرید 02</span></a></li>
                                <li><a href="courses-grid-3.html"><span class="menu-text">دوره های گرید 03</span></a></li>
                                <li><a href="membership-levels.html"><span class="menu-text">سطح عضویت</span></a></li>
                                <li><a href="become-a-teacher.html"><span class="menu-text">درخواست معلم شدن</span></a></li>
                                <li><a href="profile.html"><span class="menu-text">پروفایل</span></a></li>
                                <li><a href="checkout.html"><span class="menu-text">پرداخت</span></a></li>
                                <li class="has-children">
                                    <a href="course-details-sticky-feature-bar.html"><span class="menu-text">طرح تک</span></a>
                                    <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                                    <ul class="sub-menu">
                                        <li><a href="course-details-free.html"><span class="menu-text">دوره های رایگان</span></a></li>
                                        <li><a href="course-details-sticky-feature-bar.html"><span class="menu-text">نوار ویژگی های چسبناک</span></a></li>
                                        <li><a href="course-details-standard-sidebar.html"><span class="menu-text">سایدبار استاندارد</span></a></li>
                                        <li><a href="course-details-no-sidebar.html"><span class="menu-text">بدون سایدبار</span></a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#"><span class="menu-text">رویداد ها</span></a>
                            <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                            <ul class="sub-menu">
                                <li><a href="event.html"><span class="menu-text">رویداد ها</span></a></li>
                                <li><a href="zoom-meetings.html"><span class="menu-text">زوم میتینگ</span></a></li>
                                <li><a href="event-details.html"><span class="menu-text">جزئیات رویداد</span></a></li>
                                <li><a href="zoom-event-details.html"><span class="menu-text">جزئیات ملاقات زوم</span></a></li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#"><span class="menu-text">وبلاگ</span></a>
                            <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                            <ul class="sub-menu">
                                <li><a href="blog-grid.html"><span class="menu-text">گرید وبلاگ</span></a></li>
                                <li><a href="blog-masonry.html"><span class="menu-text">وبلاگ ساختمانی</span></a></li>
                                <li><a href="blog-classic.html"><span class="menu-text">وبلاگ کلاسیک</span></a></li>
                                <li><a href="blog-list.html"><span class="menu-text">وبلاگ لیستی</span></a></li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#"><span class="menu-text">فروشگاه</span></a>
                            <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                            <ul class="sub-menu">
                                <li><a href="shop.html"><span class="menu-text">فروشگاه سایدبار راست</span></a></li>
                                <li><a href="shop-right-sidebar.html"><span class="menu-text">فروشگاه سایدبار چپ</span></a></li>
                                <li><a href="shopping-cart.html"><span class="menu-text">سبد خرید</span></a></li>
                                <li><a href="shopping-cart-empty.html"><span class="menu-text">سبد خالی</span></a></li>
                                <li><a href="wishlist.html"><span class="menu-text">علاقه مندیها</span></a></li>
                                <li><a href="product-details.html"><span class="menu-text">تک محصول</span></a></li>
                                <li><a href="my-account.html"><span class="menu-text">حساب کاربری</span></a></li>
                                <li><a href="login-register.html"><span class="menu-text">ثبت نام / ورود</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- JS
============================================ -->

    <!-- Vendors JS -->
    <!-- <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="assets/js/vendor/jquery-3.4.1.min.js"></script>
<script src="assets/js/vendor/jquery-migrate-3.1.0.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script> -->

    <!-- Plugins JS -->
    <!-- <script src="assets/js/plugins/parallax.min.js"></script>
<script src="assets/js/plugins/jquery.ajaxchimp.min.js"></script> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="css/vendor.min.js"></script>
    <script src="css/plugins.min.js"></script>

    <!-- Main Activation JS -->
    <script src="css/main.js"></script>
</body>
</html>
