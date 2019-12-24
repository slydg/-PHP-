<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
session_start();
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
        <script src="js/jquery-2.1.3.min.js"></script>
        <style>
            /*body{
                background:url(image/345.jpg) center center ;
                background-size: auto;
            }*/
            .gz{
                position: relative;
                bottom: -69px;
                left: 0px;
            }
            .jy{
                position: relative;
                bottom: -10px;
                left: 60px;
            }
        </style>
        <title>冗易——商品</title>
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
                        <li class="has-children current">
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
                        <li><a href="indiv.php" title="">用户信息</a></li>
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
        <!-- page header
        ================================================== -->
        <?php
        if (isset($_SESSION['uid'])) {
            $user = $_SESSION['uid'];
          $login = 1;
        } else {
            $login = 0;
        }
        if (isset($_GET['class'])) {
            switch ($_GET['class']) {
                case "elec": $class = '电子设备';
                    break;
                case "daily": $class = '日用品';
                    break;
                case "book": $class = '书籍';
                    break;
                case "ornament": $class = '饰品';
                    break;
                case "play": $class = '玩具';
                    break;
                case "other": $class = '其他';
                    break;
            }
        } else {
            $class = '所有物品';
        }
        ?>
        <section id="page-header">
            <div class="row current-cat">
                <div class="col-full">
                    <h1><?php echo $class; ?></h1>
                </div>   		
            </div>
        </section>


        <!-- masonry
        ================================================== -->
        <section id="bricks" class="with-top-sep" >

            <div class="row masonry">

                <!-- brick-wrapper -->
                <div class="bricks-wrapper">

                    <div class="grid-sizer"></div>

                    <?php
                    if ($class == '所有物品') {
                        $result1 = $connection->query("SELECT * FROM things");
                    } else {
                        $result1 = $connection->query("SELECT * FROM things WHERE class = '$class'");
                    }
                    $rows = $result1->num_rows;
                    for ($j = 0; $j < $rows; ++$j) {
                        $result1->data_seek($j);
                        $row = $result1->fetch_array(MYSQLI_NUM);
                        ?>
                        <article class="brick entry format-standard animate-this">

							<div class="entry-thumb">
                              <a class="thumb-link" href="obpage/<?php echo $row[0] ?>.php">
                                <img alt="building" src="things/<?php echo $row[7] ?>">
                              </a>
                              
                             </div>
                          
                          
                            <div class="entry-text">    
                                <div class="entry-header">

                                    <div class="entry-meta">
                                        <span class="cat-links">
                                            <a href="#"><?php echo $row[1]; ?></a> 

                                            <a href="#"><?php echo $row[5]; ?></a>
                                            <a href="#"><?php echo $row[6]; ?></a>
                                        </span>			
                                    </div>

                                    <h1 class="entry-title"><a href="obpage/<?php echo $row[0] ?>.php"><?php echo $row[3]; ?></a></h1>

                                </div>
                                <div class="entry-excerpt">
                                    <?php echo $row[4] ?>
                                </div>
                                <div class="gz" id="guanzhu<?php echo $row[0]; ?>">
                                    <?php if ($login != 0) { ?>
                                        <a id="gz<?php echo $row[0]; ?>" href="">
                                            <?php
                                            $result = $connection->query("SELECT * FROM guanzhu WHERE uid = '$user'");
                                            if ($result->num_rows) {
                                                $rowss = $result->fetch_array(MYSQLI_NUM);
                                                $rowssize = count($rowss);
                                                $isset[$j] = 0;
                                                for ($i = 1; $i < $rowssize; $i++) {
                                                    if ($rowss[$i] == $row[0]) {
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
                                        } else {
                                            ?>
                                            <a id="gz" href="login.html">
                                                <img src="obpage/images/gz.jpg" alt="">
                                                <?php
                                            }
                                            ?>
                                        </a>
                                </div>
                                <div class="jy" id="jiaoyi<?php echo $row[0]; ?>">
                                    <?php if ($login != 0) { ?>
                                        <a id="jy<?php echo $row[0]; ?>" href="message/client.php?from=<?php echo $user; ?>&to=<?php echo $row[2]; ?>&pid=<?php echo $row[0] ?>">
                                        <?php } else {
                                            ?><a id="jy<?php echo $row[0]; ?>" href="message/client.php?from=0&to=<?php echo $row[2]; ?>&pid=<?php echo $row[0] ?>">
                                        <?php }
                                        ?>
                                            <img src="obpage/images/jy.jpg" alt="">
                                        </a>
                                </div>
                            </div>
                        </article> <!-- end article -->

                        <script>
                            $(document).ready(function () {
                                $("#gz<?php echo $row[0]; ?>").click(function (e) {
                                    e.preventDefault();
                                    $.post("php/guanzhu.php",
                                            {
                                                pid: "<?php echo $row[0]; ?>"
                                            },
                                            function (data, status) {
                                                $("#gz<?php echo $row[0]; ?>").html(data);
                                            });

                                });
                            });
                        </script>
                        <?php
                    }
                    ?>




                </div> <!-- end brick-wrapper --> 

            </div> <!-- end row -->

            <!--         <div class="row">
     
                         <nav class="pagination">
                             <span class="page-numbers prev inactive">Prev</span>
                             <span class="page-numbers current">1</span>
                             <a href="#" class="page-numbers">2</a>
                             <a href="#" class="page-numbers">3</a>
                             <a href="#" class="page-numbers">4</a>
                             <a href="#" class="page-numbers">5</a>
                             <a href="#" class="page-numbers">6</a>
                             <a href="#" class="page-numbers">7</a>
                             <a href="#" class="page-numbers">8</a>
                             <a href="#" class="page-numbers">9</a>
                             <a href="#" class="page-numbers next">Next</a>
                         </nav>
     
                     </div> -->

        </section> <!-- bricks -->


        <footer id="foot">

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

        <script src="js/plugins.js"></script>
        <script src="js/jquery.appear.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>

