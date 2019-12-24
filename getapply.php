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


        <!-- script
        ================================================== -->
        <script src="js/modernizr.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <style>
            .pic{
                position: relative;
                width: 33%;
                float: left;
                height: 50px;
            }
        </style>
        <title>冗易——上传商品</title>
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
                        <li><a href="indiv.php" title="">用户信息</a></li>
                        <li class="has-children current">                       
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




        <section id="page-header">
            <div class="row current-cat">
                <div class="col-full">
                    <h1>您已收到的交换申请</h1>
                </div>   		
            </div>
        </section>
        <section id="bricks" class="with-top-sep">

            <div class="row masonry">

                <!-- brick-wrapper -->
                <div class="bricks-wrapper">

                    <div class="grid-sizer"></div>

                    <?php
                    $result1 = $connection->query("SELECT * FROM apply WHERE owner = '$user' AND status='1'");
                    $rows1 = $result1->num_rows;

                    for ($j = 0; $j < $rows1; ++$j) {
                        $result1->data_seek($j);
                        $row1 = $result1->fetch_array(MYSQLI_NUM);
                        $result2 = $connection->query("SELECT * FROM things WHERE pid = '$row1[7]'");
                        if ($row1[7] != NULL) {
                            $trow = $result2->fetch_array(MYSQLI_NUM);
                            ?>
                            <article class="brick entry format-standard animate-this">

                                <div class="entry-thumb">
                                    <a href="obpage/<?php echo $trow[0]; ?>.php" class="thumb-link">
                                        <img src="things/<?php echo $trow[7]; ?>" alt="Liberty">                      
                                    </a>
                                </div>

                                <div class="entry-text">    
                                    <div class="entry-header">
                                        <h1 class="entry-title"><a href="obpage/<?php echo $trow[0] ?>.php"><?php echo $trow[3]; ?></a></h1>
                                        <div class="entry-meta">
                                            <span class="cat-links">
                                                <a href="#">申请中（您尚未接受或拒绝）</a> 
                                            </span>			
                                        </div>
                                    </div>
                                    <div class="entry-excerpt" style="color:#303030">
                                        申请者信息：<br>
                                        <?php
                                        $result3 = $connection->query("SELECT username FROM users WHERE uid='$row1[6]'");
                                        if ($result3->num_rows) {
                                            $urow = $result3->fetch_array(MYSQLI_ASSOC);
                                            $uname = stripslashes($urow['username']);
                                        } else {
                                            $uname = '出现错误';
                                        }
                                        $result4 = $connection->query("SELECT school FROM userinformation WHERE uid='$row1[6]'");
                                        if ($result4->num_rows) {
                                            $drow = $result4->fetch_array(MYSQLI_ASSOC);
                                            $school = stripslashes($drow[0]);
                                        } else {
                                            $school = '尚未填写';
                                        }
                                        ?>
                                        昵称：
                                        <?php
                                        echo $uname;
                                        ?>
                                        <br>
                                        学校：
                                        <?php
                                        echo $school;
                                        ?>
                                        <br>

                                        <?php
                                        if ($row1[4] != NULL && $row1[4] != 0) {
                                            ?>
                                            手机：
                                            <?php
                                            echo $row1[4];
                                            ?>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($row1[5] != NULL) {
                                            ?>
                                            电子邮箱：
                                            <?php
                                            echo $row1[5];
                                            ?>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        <br>
                                        对方的申请：
                                        <?php
                                        if ($row1[2] != NULL && $row1[2] != 0) {
                                            ?>
                                            <br>人民币：￥
                                            <?php
                                            echo $row1[2];
                                            ?>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($row1[3] != NULL && $row1[3] != '比如帮对方做PPT或者教对方弹吉他') {
                                            ?>
                                            服务：
                                            <?php
                                            echo $row1[3];
                                            ?>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($row1[1] != 0) {
                                            ?>
                                            物品：
                                            <?php
                                            $resultk = $connection->query("SELECT obname FROM things WHERE pid = '$row1[1]'");
                                            $rowk = $resultk->fetch_array(MYSQLI_NUM);
                                            ?>
                                            <a href="obpage/<?php echo $row1[1]; ?>.php" class="thumb-link"><?php
                                                echo $rowk[0];
                                            }
                                            ?></a>
                                    </div>
                                </div>
                                <?php
                                if ($row1[1] != 0) {
                                    ?>
                                    <div class="entry-thumb">
                                        <a href="obpage/<?php echo $row1[1]; ?>.php" class="thumb-link">
                                            <img src="things/<?php
                                            $result3 = $connection->query("SELECT pic FROM things WHERE pid = '$row1[1]'");
                                            $srow = $result3->fetch_array(MYSQLI_NUM);
                                            echo $srow[0];
                                            ?>" alt="Liberty">                      
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?><br><div style="position:relative;text-align: center;">
                                    <a class="button" href="php/accept.php?cid=<?php echo $row1[0]; ?>">接受申请</a>
                                    <a class="button" href="php/refuse.php?cid=<?php echo $row1[0]; ?>">拒绝申请</a></div>
                            </article> <!-- end article -->


                            <?php
                        }
                    }
                    ?>









                    <?php
                    $result5 = $connection->query("SELECT * FROM apply WHERE owner = '$user' AND status='2'");
                    $rows5 = $result5->num_rows;

                    for ($j = 0; $j < $rows5; ++$j) {
                        $result5->data_seek($j);
                        $row5 = $result5->fetch_array(MYSQLI_NUM);
                        $result6 = $connection->query("SELECT * FROM things WHERE pid = '$row5[7]'");
                        if ($row5[7] != NULL) {
                            $trow1 = $result6->fetch_array(MYSQLI_NUM);
                            ?>
                            <article class="brick entry format-standard animate-this">

                                <div class="entry-thumb">
                                    <a href="obpage/<?php echo $trow1[0]; ?>.php" class="thumb-link">
                                        <img src="things/<?php echo $trow1[7]; ?>" alt="Liberty">                      
                                    </a>
                                </div>

                                <div class="entry-text">    
                                    <div class="entry-header">
                                        <h1 class="entry-title"><a href="obpage/<?php echo $trow1[0] ?>.php"><?php echo $trow1[3]; ?></a></h1>
                                        <div class="entry-meta">
                                            <span class="cat-links">
                                                <a href="#">您已接受该申请</a> 
                                            </span>			
                                        </div>
                                    </div>
                                    <div class="entry-excerpt" style="color:#303030">
                                        申请者信息：<br>
                                        <?php
                                        $result7 = $connection->query("SELECT username FROM users WHERE uid='$row5[6]'");
                                        if ($result7->num_rows) {
                                            $urow1 = $result7->fetch_array(MYSQLI_ASSOC);
                                            $uname1 = stripslashes($urow['username']);
                                        } else {
                                            $uname1 = '出现错误';
                                        }
                                        $result8 = $connection->query("SELECT school FROM userinformation WHERE uid='$row5[6]'");
                                        if ($result8->num_rows) {
                                            $drow1 = $result8->fetch_array(MYSQLI_ASSOC);
                                            $school1 = stripslashes($drow1[0]);
                                        } else {
                                            $school1 = '尚未填写';
                                        }
                                        ?>
                                        昵称：
                                        <?php
                                        echo $uname1;
                                        ?>
                                        <br>
                                        学校：
                                        <?php
                                        echo $school1;
                                        ?>
                                        <br>

                                        <?php
                                        if ($row5[4] != NULL && $row5[4] != 0) {
                                            ?>
                                            手机：
                                            <?php
                                            echo $row5[4];
                                            ?>

                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($row5[5] != NULL) {
                                            ?>
                                            <br>电子邮箱：
                                            <?php
                                            echo $row5[5];
                                            ?>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        <br>
                                        对方的申请：
                                        <?php
                                        if ($row5[2] != NULL && $row5[2] != 0) {
                                            ?>
                                            人民币：￥
                                            <?php
                                            echo $row5[2];
                                            ?>

                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($row5[3] != NULL && $row5[3] != '比如帮对方做PPT或者教对方弹吉他') {
                                            ?>
                                            <br>服务：
                                            <?php
                                            echo $row5[3];
                                            ?>

                                            <?php
                                        }
                                        ?><?php
                                        if ($row5[1] != 0) {
                                            ?>
                                            <br>物品：
                                            <?php
                                            $resultk = $connection->query("SELECT obname FROM things WHERE pid = '$row5[1]'");
                                            $rowk = $resultk->fetch_array(MYSQLI_NUM);
                                            ?>
                                            <a href="obpage/<?php echo $row5[1]; ?>.php" class="thumb-link"><?php
                                                echo $rowk[0];
                                            }
                                            ?></a>
                                    </div>
                                </div>
                                <?php
                                if ($row5[1] != 0) {
                                    ?>
                                    <div class="entry-thumb">
                                        <a href="obpage/<?php echo $row5[1]; ?>.php" class="thumb-link">
                                            <img src="things/<?php
                                            $result9 = $connection->query("SELECT pic FROM things WHERE pid = '$row5[1]'");
                                            $srow1 = $result9->fetch_array(MYSQLI_NUM);
                                            echo $srow1[0];
                                            ?>" alt="Liberty">                      
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </article> <!-- end article -->


                            <?php
                        }
                    }
                    ?>







                    <?php
                    $result5 = $connection->query("SELECT * FROM apply WHERE owner = '$user' AND status='3'");
                    $rows5 = $result5->num_rows;

                    for ($j = 0; $j < $rows1; ++$j) {
                        $result5->data_seek($j);
                        $row5 = $result5->fetch_array(MYSQLI_NUM);
                        $result6 = $connection->query("SELECT * FROM things WHERE pid = '$row5[7]'");
                        if ($row5[7] != NULL) {
                            $trow1 = $result6->fetch_array(MYSQLI_NUM);
                            ?>
                            <article class="brick entry format-standard animate-this">

                                <div class="entry-thumb">
                                    <a href="obpage/<?php echo $trow1[0]; ?>.php" class="thumb-link">
                                        <img src="things/<?php echo $trow1[7]; ?>" alt="Liberty">                      
                                    </a>
                                </div>

                                <div class="entry-text">    
                                    <div class="entry-header">
                                        <h1 class="entry-title"><a href="obpage/<?php echo $trow1[0] ?>.php"><?php echo $trow1[3]; ?></a></h1>
                                        <div class="entry-meta">
                                            <span class="cat-links">
                                                <a href="#">您已拒绝该申请</a> 
                                            </span>			
                                        </div>
                                    </div>
                                    <div class="entry-excerpt" style="color:#303030">
                                        申请者信息：<br>
                                        <?php
                                        $result7 = $connection->query("SELECT username FROM users WHERE uid='$row5[6]'");
                                        if ($result7->num_rows) {
                                            $urow1 = $result7->fetch_array(MYSQLI_ASSOC);
                                            $uname1 = stripslashes($urow['username']);
                                        } else {
                                            $uname1 = '出现错误';
                                        }
                                        $result8 = $connection->query("SELECT school FROM userinformation WHERE uid='$row5[6]'");
                                        if ($result8->num_rows) {
                                            $drow1 = $result8->fetch_array(MYSQLI_ASSOC);
                                            $school1 = stripslashes($drow1[0]);
                                        } else {
                                            $school1 = '尚未填写';
                                        }
                                        ?>
                                        昵称：
                                        <?php
                                        echo $uname1;
                                        ?>
                                        <br>
                                        学校：
                                        <?php
                                        echo $school1;
                                        ?>
                                        <br>

                                        <?php
                                        if ($row5[4] != NULL && $row5[4] != 0) {
                                            ?>
                                            手机：
                                            <?php
                                            echo $row5[4];
                                            ?>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($row5[5] != NULL) {
                                            ?>
                                            <br>电子邮箱：
                                            <?php
                                            echo $row5[5];
                                            ?>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        <br>
                                        对方的申请：
                                        <?php
                                        if ($row5[2] != NULL && $row5[2] != 0) {
                                            ?>
                                            <br>人民币：￥
                                            <?php
                                            echo $row5[2];
                                            ?>

                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($row5[3] != NULL && $row5[3] != '比如帮对方做PPT或者教对方弹吉他') {
                                            ?>
                                            <br>服务：
                                            <?php
                                            echo $row5[3];
                                            ?>

                                            <?php
                                        }
                                        ?> <?php
                                        if ($row5[1] != 0) {
                                            ?>
                                            <br>物品:
                                            <?php
                                            $resultk = $connection->query("SELECT obname FROM things WHERE pid = '$row5[1]'");
                                            $rowk = $resultk->fetch_array(MYSQLI_NUM);
                                            ?>
                                            <a href="obpage/<?php echo $row5[1]; ?>.php" class="thumb-link"><?php
                                                echo $rowk[0];
                                            }
                                            ?></a>
                                    </div>
                                </div>
                                <?php
                                if ($row5[1] != 0) {
                                    ?>
                                    <div class="entry-thumb">
                                        <a href="obpage/<?php echo $row5[1]; ?>.php" class="thumb-link">
                                            <img src="things/<?php
                                            $result9 = $connection->query("SELECT pic FROM things WHERE pid = '$row5[1]'");
                                            $srow1 = $result9->fetch_array(MYSQLI_NUM);
                                            echo $srow1[0];
                                            ?>" alt="Liberty">                      
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </article> <!-- end article -->


                            <?php
                        }
                    }
                    ?>




                </div> <!-- end brick-wrapper --> 

            </div> <!-- end row -->

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
        <script src="js/main.js"></script>

    </body>

</html>
