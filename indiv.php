<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
session_start();
if (isset($_SESSION['uid'])) {
    $user = $_SESSION['uid'];
} else {
    header('location:login.html');
    exit;
}
include ('conn.php');
// put your code here
?>   
<html>
    <head>
        <meta charset="UTF-8">
        <!-- mobile specific metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="renderer" content="webkit">
        <meta name="keywords" content="交易平台主页框架">
        <meta name="description" content="交易平台主页框架">
        <meta name="robots" content="all">
        <meta name="HandheldFriendly" content="true">
        <!-- CSS
================================================== -->
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="css/vendor.css">  
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/indiv.css">


        <!-- script
        ================================================== -->
        <script src="js/modernizr.js"></script>
        <script src="js/pace.min.js"></script>

        <style>
            /*body{
                background:url(image/345.jpg) center center ;
                background-size: auto;
            }*/
        </style>
        <title>冗易——用户信息</title>
    </head>
    <body id="top">
        <!-- header 
        ================================================== -->
        <header class="short-header">   

            <div class="gradient-block"></div>	
            <div class="row header-content">

                <div class="logo">
                    <a href="index.php">Author</a>
                </div>
                <nav id="main-nav-wrap">
                    <ul class="main-navigation sf-menu" style="">
                        <li><a href="index.php" title="">首页</a></li>									
                        <li class="has-children">
                            <a href="category.php" title="">商品</a>
                            <ul class="sub-menu">
                                <li><a href="category.php?class=elec">电子设备</a></li>
                                <li><a href="category.php?class=daily">日用品</a></li>
                                <li><a href="category.php?class=book">书籍</a></li>
                                <li><a href="category.php?class=ornament">饰品</a></li>
                                <li><a href="category.php?class=play">玩具</a></li>
                                <li><a href="category.php?class=other">其他</a></li>
                            </ul>
                        </li>
                        <li><a class="current" href="indiv.php" title="">用户信息</a></li>
                        <li class="has-children">                       
                            <a href="myapply.php" title="">我的交易</a>
                            <ul class="sub-menu">
                                <li><a href="myobs.php">我的物品</a></li>
                                <li><a href="upload.html">上传商品</a></li>
                                <li><a href="mygz.php">我的关注</a></li>
                                <li><a href="myapply.php">我的申请</a></li>
                                <li><a href="getapply.php">收到的申请</a></li>
                            </ul>
                        </li>	
                        <li><a href="contact.html" title="">联系我们</a></li>										
                    </ul>
                </nav> <!-- end main-nav-wrap -->
                <div class="search-wrap">
                    <form role="search" method="get" class="search-form" action="search.php">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="search-field" placeholder="Type Your Keywords" value="" name="s" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="Search">
                    </form>

                    <a href="#" id="close-search" class="close-btn">Close</a>

                </div> <!-- end search wrap -->	

                <div class="triggers">
                    <a class="search-trigger" href="#"><i class="fa fa-search"></i></a>
                    <a class="menu-toggle" href="#"><span>Menu</span></a>
                </div> <!-- end triggers -->	

            </div>    
        </header> <!-- end header -->

        <?php
        $result2 = $connection->query("SELECT * FROM users WHERE uid='$user'");
        if ($result2->num_rows) {
            $row = $result2->fetch_array(MYSQLI_ASSOC);
            $uname = stripslashes($row['username']);
            $tel = stripslashes($row['tel']);
            $email = stripslashes($row['email']);
        } else {
            $uname = '出现错误';
            $tel = '出现错误';
            $email = '出现错误';
        }
        $result3 = $connection->query("SELECT * FROM userinformation WHERE uid='$user'");
        if ($result3->num_rows) {
            $row = $result3->fetch_array(MYSQLI_ASSOC);
            if ($row['address'] == "") {
                $address = '暂时无需填写';
            } else {
                $address = stripslashes($row['address']);
            }
            if ($row['school'] == "") {
                $school = '您尚未填写所在学校';
            } else {
                $school = stripslashes($row['school']);
            }
            if ($row['need'] == "") {
                $need = '您还没有填写过您的近期需求哦~';
            } else {
                $need = stripslashes($row['need']);
            }
        } else {
            $address = '暂时无需填写';
            $need = '您还没有填写过您的近期需求哦~';
            $school = '尚未填写所在学校';
        }
        ?>



        <section id="page-header">
            <div class="row current-cat">
                <div class="col-full">
                    <h1>嘿！让我们了解彼此吧~</h1>
                </div>   		
            </div>
        </section>



        <section id="bricks" class="with-top-sep">



            <div class="row masonry">

                <!-- brick-wrapper -->
                <div class="bricks-wrapper">
                    <div class="grid-sizer"></div>

                    <article class="brick entry format-standard animate-this">



                        <div id="fac">
                            <div class="entry-header">
                                <h1 class="entry-title"><a href="">很高兴认识你！</a></h1>
                                <div class="entry-meta">
                                    <span class="cat-links">
                                        <a href="#">更换头像</a> 
                                    </span>			
                                </div>
                                <div class="facediv">
                                    <a id="facea" href="img/index.html ">
<?php
if (file_exists("faces/$user.jpg")) {
    echo "<img id=\"face\" src='faces/$user.jpg'>";
} elseif (file_exists("faces/$user.png")) {
    echo "<img id=\"face\" src='faces/$user.png'>";
} else {
    echo "<img id=\"face\" src='faces/0.jpg'>";
}
?>            
                                    </a>

                                </div>
                                <div class="entry-excerpt">
                                    &nbsp;&nbsp;&nbsp;点击图片更换头像
                                </div>
                                <br>



                            </div>

                        </div>
                    </article> <!-- end article -->

                    <article class="brick entry format-standard animate-this">
                        <div id="content">
                            <div class="entry-header">
                                <h1 class="entry-title"><a href="">如何联系到你？</a></h1>
                                <div class="entry-meta">
                                    <span class="cat-links">
                                        <a href="#">昵称和联系方式</a> 

                                    </span>			
                                </div>
                            </div>

                            <form action="php/content.php" method="post"  id="cont">
                                <label>
                                    <span>昵称 :</span>
                                    <input id="name" type="text" name="name" value="<?php echo $uname ?>">

                                </label>
                                <label>
                                    <span>邮箱 :</span>
                                    <input id="school" type="text" name="email"  value="<?php echo $email ?>" />
                                </label>
                                <label>
                                    <span>手机 :</span>
                                    <input id="detail" name="phone" type="text" value="<?php echo $tel ?>"/>
                                </label>



                                <button id="denglubt" type="submit" class="button" >Submit</button>

                            </form>
                        </div>
                    </article>


                    <article class="brick entry format-standard animate-this">

                        <div id="address">
                            <div class="entry-header">
                                <h1 class="entry-title"><a href="">请告诉我们你在哪里！</a></h1>
                                <div class="entry-meta">
                                    <span class="cat-links">
                                        <a href="#">详细地址</a> 
                                    </span>			
                                </div>
                            </div>

                            <form action="php/address.php" method="post"  id="adr">

                                <label>
                                    <span>学    校 :</span>
                                    <input id="school" type="text" name="school" value="<?php echo $school ?>"/>
                                </label>
                                <label>
                                    <span>详细地址 :</span>
                                    <input id="detail" name="detail" type="text" value="<?php echo $address ?>"/>
                                </label>



                                <button id="denglubt" type="submit" class="button" >Submit</button>

                            </form>
                        </div>
                    </article>        	





                    <article class="brick entry format-standard animate-this">

                        <div id="need">
                            <div class="entry-header">


                                <h1 class="entry-title"><a href="">告诉我们你想要什么！</a></h1>
                                <div class="entry-meta">
                                    <span class="cat-links">
                                        <a href="#">近期需求</a> 

                                    </span>			
                                </div>
                            </div>
                            <form action="php/need.php" method="post"  id="cont">
                                <label>
                                    <span>近期需求 :</span>
                                    <textarea id="school"  name="need" ><?php echo $need ?></textarea>
                                </label>

                                <button id="denglubt" type="submit" class="button" >Submit</button>
                            </form>
                        </div>
                    </article>




                </div>
            </div>
        </section>

<?php
?>

        <footer>

            <!--            <div id="beian" style="text-align:center;">
                            <span><a href="http://www.miitbeian.gov.cn/" target="_blank">闽ICP备17030727</a></span> 
                        </div>
            -->      <div class="footer-bottom">
                <div class="row">

                    <div class="col-twelve">


                        <div id="go-top">
                            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon icon-arrow-up"></i></a>
                        </div>         
                    </div>

                </div> 
            </div> <!-- end footer-bottom -->  


        </footer> 
        <div id="preloader"> 
            <div id="loader"></div>
        </div> 
        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/jquery.appear.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
