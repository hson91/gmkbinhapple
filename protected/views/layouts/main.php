
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="" type="image/x-icon" />
<link href="<?php echo Yii::app()->baseUrl;?>/static/vendor/bxslider/jquery.bxslider.css" type="text/css" rel="stylesheet" />
<link href="<?php echo Yii::app()->baseUrl;?>/static/css/style.css" type="text/css" rel="stylesheet" />
<script src="<?php echo Yii::app()->baseUrl;?>/static/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/static/vendor/bxslider/jquery.bxslider.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/static/js/app.js" type="text/javascript"></script>
<link rel="shortcut icon" href="favicon.png"type="image/x-icon" />
<meta name="title" content="Apple" />
<meta name="description" content="Apple" />
<meta name="keywords" content="Apple" />
<title>Apple</title>
</head>
<body>
    <nav id="main-nav">
        <div class="nav-content">
            <ul class="nav-list">
                <li class="btnMenu"><div id="btnMenu"><i>&#xf0c9;</i></div></li>
                <li class="hompage"><a href="" class="homepage"></a></li>
                <li><a href="">Mac</a></li>
                <li><a href="">iPad</a></li>
                <li><a href="">iPhone</a></li>
                <li><a href="">Watch</a></li>
                <li><a href="">TV</a></li>
                <li><a href="">Music</a></li>
                <li><a href="">Support</a></li>
                <li><div class="search"></div></li>
                <li class="cart"><a href="" class="cart"></a></li>
            </ul>
            <ul class="nav-list-mobile" id="nav-list-mobile">
                <li style="border-top: 1px solid #2D2C2C;"><a href="">Mac</a></li>
                <li><a href="">iPad</a></li>
                <li><a href="">iPhone</a></li>
                <li><a href="">Watch</a></li>
                <li><a href="">TV</a></li>
                <li><a href="">Music</a></li>
                <li><a href="">Support</a></li>
                <li><div class="search"><input type="text" placeholder="Search Apple.com"></div></li>
            </ul>
        </div>
    </nav>
    <div class="slide">
        <ul id="slide">
            <li><a href="">
                <div class="text">
                    <img src="<?php echo Yii::app()->baseUrl;?>/static/images/watch_medium.png" class="img-slide-header">
                    <span>You. At a glance.</span>
                </div>
                <div class="item-img">
                    <img src="<?php echo Yii::app()->baseUrl;?>/static/images/slides/apple_watch_trio_medium.jpg">
                </div>
            </a></li>
            <li><a href="">
                <div class="text">
                    <img src="<?php echo Yii::app()->baseUrl;?>/static/images/iphone_6s_medium.png" class="img-slide-header">
                    <span>3D Touch. 12MP photos. 4K video. One powerful phone.</span>
                </div>
                <div class="item-img">
                    <img src="<?php echo Yii::app()->baseUrl;?>/static/images/slides/iphone_6s_medium.jpg">
                </div>
            </a></li>
        </ul>
        <script>
            $(function(){
                $('#slide').bxSlider({
                    captions: true,
                    pager: true,
                    auto:false,
                });
            });
        </script>
    </div>
    <div class="contents" id="contents">
        <?php echo $content;?>
    </div><!--/// END Contents-->
    <div class="clearfix"></div>
    <div class="footer">
        <div class="footer-content">
            <ul class="footer-item">
                <li class="title">Shop and Learn</li>
                <li><a href="">Mac</a></li>
                <li><a href="">iPad</a></li>
                <li><a href="">iPhone</a></li>
                <li><a href="">Watch</a></li>
                <li><a href="">TV</a></li>
                <li><a href="">Music</a></li>
                <li><a href="">Itunes</a></li>
                <li><a href="">iPod</a></li>
            </ul>
            <ul class="footer-item">
                <li class="title">Apple Store</li>
                <li><a href="">Genius Bar</a></li>
                <li><a href="">Workshops and Learning</a></li>
                <li><a href="">Youth Programs</a></li>
                <li><a href="">Apple Store App</a></li>
                <li><a href="">Refurbished</a></li>
                <li><a href="">Financing</a></li>
                <li><a href="">Reuse and Recycling</a></li>
                <li><a href="">Order Status</a></li>
            </ul>
            <ul class="footer-item">
                <li class="title">For Education</li>
                <li><a href="">Apple and Education</a></li>
                <li><a href="">Shop for College</a></li>
            </ul>
            <ul class="footer-item">
                <li class="title">Account</li>
                <li><a href="">Manage Your Apple ID</a></li>
                <li><a href="">Apple Store Account</a></li>
                <li><a href="">iCloud.com</a></li>
            </ul>
            <ul class="footer-item">
                <li class="title">About Apple</li>
                <li><a href="">Apple Info</a></li>
                <li><a href="">Job Opportunities</a></li>
                <li><a href="">Press Info</a></li>
                <li><a href="">Investors</a></li>
            </ul>
            <div class="footer-bottom">
                <p class="footer-header">More ways to shop: Visit an <a href="">Apple Store</a>, call 1-800-MY-APPLE, or <a href="">find a reseller</a>.</p>
                <div class="menu-fotter">
                    <ul class="">
                        <li class="footer-right">Copyright © 2016 Apple Inc. All rights reserved.</li>
                        <li><a href="">Privacy Policy</a></li>
                        <li><a href="">Terms of Use</a></li>
                        <li><a href="">Sales and Refunds</a></li>
                        <li><a href="">Legal</a></li>
                        <li class="sitemap"><a href="">Site maps</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>