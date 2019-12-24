<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    session_start();
    if (isset($_SESSION['uid'])) {
    $login = TRUE;
    $user = $_SESSION['uid'];
    } else {
    $login = FALSE;
    }
    if (!$login) {
    $user = 0;
    }
    include('../conn.php');
    function php_self(){
    $php_self=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
    return $php_self;
    }
    $phpself=php_self();
    $result1 = $connection->query("SELECT uid FROM things
    WHERE pid='$phpself'");
    $row = $result1->fetch_array(MYSQLI_NUM);

    $uid = $row[0];



    ?>
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
        <link rel="stylesheet" href="../css/base.css">
        <link rel="stylesheet" href="../css/vendor.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="../css/login.css">


        <!-- script
        ================================================== -->
        <script src="../js/modernizr.js"></script>
        <script src="../js/pace.min.js"></script>
        <script src="../js/jquery-2.1.3.min.js"></script>
        <style>
            .gz{
                position: relative;
                bottom: 41px;
                left: 50px;
            }
            .jy{
                position: relative;
                bottom: 100px;
                left: 110px;
            }
        </style>
        <title>冗易——物品信息</title>
    </head>

    <body id="top">
        <!-- header 
        ================================================== -->
        <header class="short-header">

            <div class="gradient-block"></div>
            <div class="row header-content">

                <div class="logo">
                    <a href="../index.php">Author</a>
                </div>

                <nav id="main-nav-wrap">
                    <ul class="main-navigation sf-menu">
                        <li>
                            <a href="../index.php" title="">首页</a>
                        </li>
                        <li class="has-children">
                            <a href="../category.php" title="">商品</a>
                            <ul class="sub-menu current">
                                <li><a href="../category.php?class=elec">电子设备</a></li>
                                <li><a href="../category.php?class=daily">日用品</a></li>
                                <li><a href="../category.php?class=book">书籍</a></li>
                                <li><a href="../category.php?class=ornament">饰品</a></li>
                                <li><a href="../category.php?class=play">玩具</a></li>
                                <li><a href="../category.php?class=other">其他</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="../indiv.php" title="">用户信息</a>
                        </li>
                        <li class="has-children">
                        <li class="has-children">                       
                            <a href="../myapply.php" title="">我的交易</a>
                            <ul class="sub-menu">
                                <li><a href="../myobs.php">我的物品</a></li>
                                <li><a href="../upload.html">上传商品</a></li>
                                <li><a href="../mygz.php">我的关注</a></li>
                                <li><a href="../myapply.php">我的申请</a></li>
                                <li><a href="../getapply.php">收到的申请</a></li>
                            </ul>
                        </li>	
                        </li>
                        <li>
                            <a href="../contact.html" title="">联系我们</a>
                        </li>
                    </ul>
                </nav>
                <!-- end main-nav-wrap -->
                <div class="search-wrap">
                    <form role="search" method="get" class="search-form" action="../search.php">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="search-field" placeholder="Type Your Keywords" value="" name="s" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="Search">
                    </form>

                    <a href="#" id="close-search" class="close-btn">Close</a>

                </div>
                <!-- end search wrap -->

                <div class="triggers">
                    <a class="search-trigger" href="#">
                        <i class="fa fa-search"></i>
                    </a>
                    <a class="menu-toggle" href="#">
                        <span>Menu</span>
                    </a>
                </div>
                <!-- end triggers -->

            </div>
        </header>
        <!-- end header -->

        <!-- content
   ================================================== -->
        <section id="content-wrap" class="blog-single">
            <div class="row">
                <div class="col-twelve">

                    <article class="format-standard">

                        <div class="brick entry featured-grid animate-this">
                            <div class="entry-content">
                                <div id="featured-post-slider" class="flexslider">
                                    <ul class="slides">

                                        <li>
                                            <div class="featured-post-slide">

                                                <div class="post-background" style="background-image:url('../things/50-1.jpeg');"></div>



                                            </div>
                                        </li>
                                        <!-- /slide -->

                                        <li>
                                            <div class="featured-post-slide">

                                                <div class="post-background" style="background-image:url('../things/50-2.jpeg');"></div>



                                            </div>
                                        </li>
                                        <!-- /slide -->

                                        <li>
                                            <div class="featured-post-slide">

                                                <div class="post-background" style="background-image:url('../things/50-3.jpeg');"></div>





                                            </div>
                                        </li>
                                        <!-- end slide -->

                                    </ul>
                                    <!-- end slides -->
                                </div>
                                <!-- end featured-post-slider -->
                            </div>
                            <!-- end entry content -->
                        </div>

                        <div class="primary-content">
                            <br>


                            <h1 class="page-title">大嘴猴杯子</h1>

                            <ul class="entry-meta">
                                <li class="date">2019-05-09</li>
                                <li class="cat">
                                    <a href="">日用品</a>
                                    <a href="">七成新</a>

                                </li>
                            </ul>

                            <p class="lead">装水装酒装满你的心</p>
                            <br>
                            <h3>
                                对方的需求：
                            </h3>
                            <br>
                            <?php 
                            $things = '一把菜刀';
                            $services = '';
                            $money = '25';
                            if($things != NULL){
                            ?>
                            <p>
                                物品：&nbsp;&nbsp;一把菜刀
                            </p>
                            <?php } 
                            if($services != NULL){
                            ?>
                            <p>
                                服务：&nbsp;&nbsp;
                            </p>
                            <?php } 
                            if($money != NULL){
                            ?>
                            <p>
                                给个价：&nbsp;&nbsp;￥25
                            </p>
                            <?php } ?>
                            <p class="tags">
                                <span>Tagged in :</span>
                                <a href="#">日用品</a>
                                <a href="#">七成新</a>

                            </p>
                            <?php

                            $result2 = $connection->query("SELECT * FROM users WHERE uid='$uid'");
                            if ($result2->num_rows) {
                            $row = $result2->fetch_array(MYSQLI_ASSOC);
                            $uname = stripslashes($row['username']);
                            }
                            $result3 = $connection->query("SELECT * FROM userinformation WHERE uid='$uid'");
                            if ($result3->num_rows) {
                            $row = $result3->fetch_array(MYSQLI_ASSOC);

                            if ($row['school'] == "") {
                            $school = '尚未填写所在学校';
                            } else {
                            $school = stripslashes($row['school']);
                            }
                            if ($row['need'] == "") {
                            $need = '尚未填写过近期需求';
                            } else {
                            $need = stripslashes($row['need']);
                            }
                            }else{
                            $school = '尚未填写所在学校';
                            $need = '尚未填写过近期需求';
                            }
                            if (file_exists("../faces/$user.jpg")) {
                            $face = $uid . '.jpg';
                            } elseif (file_exists("../faces/$user.png")) {
                            $face = $uid . '.png';
                            } else {
                            $face = '0.jpg';
                            }
                            ?>
                            <div class="author-profile">
                                <img src="../faces/<?php echo $face; ?>" alt="">

                                <div class="about">
                                    <h4>
                                        <a href="#"><?php echo $uname; ?></a>
                                    </h4>

                                    <p>学校：<?php echo $school; ?> 
                                        <br>近期需求：<?php echo $need; ?>
                                    </p>


                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                            </div>
                            <!-- end author-profile -->

                        </div>
                        <!-- end entry-primary -->



                    </article>
                    <?php if($user == $uid ){ ?>
                    <div class="gz">
                        <a id="xg" href="../php/xiugai.php?pid=50">
                            <img src="images/xg.jpg" alt="">
                        </a>
                    </div>
                    <div class="jy">
                        <a href="../php/xiajia.php?pid=50">
                            <img src="images/sc.jpg" alt="">
                        </a>
                    </div> 
                    <?php }
                    else{ ?>
                    <div class="gz" id="guanzhu">
                            
                                        <a id="gz" href="">
                                            <?php
                                            $result = $connection->query("SELECT * FROM guanzhu WHERE uid = '$user'");
                                            if ($result->num_rows) {
                                                $rowss = $result->fetch_array(MYSQLI_NUM);
                                                $rowssize = count($rowss);
                                                $isset[$j] = 0;
                                                for ($i = 1; $i < $rowssize; $i++) {
                                                    if ($rowss[$i] == 50) {
                                                        echo '<img src="obpage/images/gzcg.jpg" alt="">';
                                                        $isset[$j] = 1;
                                                    }
                                                }
                                                if ($isset[$j] == 0) {
                                                    echo '<img src="obpage/images/gz.jpg" alt="">';
                                                    $isset[$j] = 1;
                                                }
                                            } else {
                                                echo '<img src="obpage/images/gz.jpg" alt="">';
                                            }
                                        
                                            ?>
                          </a>
                          
                          
                    </div>
                    <div class="jy" id="jiaoyi">
                        <a href="../message/client.php?from=<?php echo $user; ?>&to=<?php echo $uid; ?>&pid=<?php echo $phpself; ?>">
                            <img src="images/jy.jpg" alt="">
                        </a>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $("#gz").click(function (e) {
                                e.preventDefault();
                                $.post("../php/guanzhu.php",
                                        {
                                            pid: "50"
                                        },
                                        function (data, status) {
                                            $("#gz").html(data);
                                        });
                            });
                        });
                    </script>
                    <?php } ?>


                </div>
                <!-- end col-twelve -->
            </div>
            <!-- end row -->


        </section>
        <!-- end content -->



        <div id="preloader">
            <div id="loader"></div>
        </div>

        <!-- Java Script
   ================================================== -->
        <script src="../js/jquery-2.1.3.min.js"></script>
        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>

    </body>

</html>