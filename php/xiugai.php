        
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
        header('location:../login.html');
        exit;
    }
    include('../conn.php');

    $pid = $_GET['pid'];
    $result1 = $connection->query("SELECT * FROM things WHERE pid = '$pid'");
    if ($result1->num_rows) {
        $row = $result1->fetch_array(MYSQLI_ASSOC);
        $obname = stripslashes($row['obname']);
        $class = stripslashes($row['class']);
        $new = stripslashes($row['new']);
        $descrip = stripslashes($row['descrip']);
        $money = stripslashes($row['money']);
        $tothings = stripslashes($row['tothings']);
        $toservices = stripslashes($row['toservices']);
    } else {
        header('location:../myobs.php');
    }
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
            .pic{
                position: relative;
                width: 33%;
                float: left;
                height: 50px;
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





        <section id="content-wrap" class="blog-single">
            <div class="row">
                <div class="col-twelve">

                    <article class="format-gallery">  
                        <div class="primary-content">
                            <h1>请修改需要修改的信息</h1> <br>
                            <form action="xg.php" method="post" id="upload" enctype='multipart/form-data'>
                                <span>请上传三张照片</span>
                                <div>
                                    <div class="pic">
                                        <a href="javascript:;" id="upload1">点击选择第一张照片<input type="file" id="img1" name="obpic1"></a>

                                    </div>
                                    <div class="pic">
                                        <a href="javascript:;" id="upload2">点击选择第二张照片<input type="file" id="img2" name="obpic2"></a>

                                    </div>
                                    <div class="pic">
                                        <a href="javascript:;" id="upload3">点击选择第三张照片<input type="file" id="img3" name="obpic3"></a>

                                    </div>
                                </div>
                                <?php
                                if (file_exists("../things/$pid-1.jpg")) {
                                    echo "<img id=\"preview1\" src='../things/$pid-1.jpg'/>";
                                } elseif (file_exists("../things/$pid-1.png")) {
                                    echo "<img id=\"preview1\" src='../things/$pid-1.png'/>";
                                } elseif (file_exists("../things/$pid-1.gif")) {
                                    echo "<img id=\"preview1\" src='../things/$pid-1.gif'/>";
                                } elseif (file_exists("../things/$pid-1.jpeg")) {
                                    echo "<img id=\"preview1\" src='../things/$pid-1.jpeg'/>";
                                }
                                ?>  
                                <?php
                                if (file_exists("../things/$pid-2.jpg")) {
                                    echo "<img id=\"preview2\" src='../things/$pid-2.jpg'/>";
                                } elseif (file_exists("../things/$pid-2.png")) {
                                    echo "<img id=\"preview2\" src='../things/$pid-2.png'/>";
                                } elseif (file_exists("../things/$pid-2.gif")) {
                                    echo "<img id=\"preview2\" src='../things/$pid-2.gif'/>";
                                } elseif (file_exists("../things/$pid-2.jpeg")) {
                                    echo "<img id=\"preview2\" src='../things/$pid-2.jpeg'/>";
                                }
                                ?>  
                                <?php
                                if (file_exists("../things/$pid-3.jpg")) {
                                    echo "<img id=\"preview3\" src='../things/$pid-3.jpg'/>";
                                } elseif (file_exists("../things/$pid-3.png")) {
                                    echo "<img id=\"preview3\" src='../things/$pid-3.png'/>";
                                } elseif (file_exists("../things/$pid-3.gif")) {
                                    echo "<img id=\"preview3\" src='../things/$pid-3.gif'/>";
                                } elseif (file_exists("../things/$pid-3.jpeg")) {
                                    echo "<img id=\"preview3\" src='../things/$pid-3.jpeg'/>";
                                }
                                ?>  
                                <label>
                                    <span>名称 :</span>
                                    <input type="text" id="obname" class="full-width" name="obname" value="<?php echo $obname; ?>">
                                </label> 
                                <label>
                                    <span>分类 :</span>
                                    <select id="class" class="full-width" name="class">
                                        <option value="电子设备"<?php
                                        if ($class == '电子设备') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>电子设备</option>
                                        <option value="日用品"<?php
                                        if ($class == '日用品') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>日用品</option>
                                        <option value="书籍"<?php
                                        if ($class == '书籍') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>书籍</option>
                                        <option value="饰品"<?php
                                        if ($class == '饰品') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>饰品</option>
                                        <option value="玩具"<?php
                                        if ($class == '玩具') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>玩具</option>
                                        <option value="其他"<?php
                                        if ($class == '其他') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>其他</option>
                                    </select>
                                </label>

                                <label>
                                    <span>成色 :</span>
                                    <select id="new" class="full-width" name="new">
                                        <option value="全新"<?php
                                        if ($new == '全新') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>全新</option>
                                        <option value="九成新"<?php
                                        if ($new == '九成新') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>九成新</option>
                                        <option value="八成新"<?php
                                        if ($new == '八成新') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>八成新</option>
                                        <option value="七成新"<?php
                                        if ($new == '七成新') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>七成新</option>
                                        <option value="六成新及以下"<?php
                                        if ($new == '六成新及以下') {
                                            echo 'selected = "selected"';
                                        }
                                        ?>>六成新及以下</option>
                                    </select>
                                </label>

                                <label>
                                    <span>描述 :</span>
                                    <textarea id="descrip" class="full-width" name="descrip" rows="5"><?php echo $descrip; ?></textarea>
                                </label> <br>
                                <h2>您想要用它换些什么？（请至少填写一项）</h2> 
                                <label>
                                    <span>给个价钱（RMB） :</span>
                                    <input type="number" id="money" class="full-width" name="money" value="<?php echo $money; ?>">
                                </label> 
                                <label>
                                    <span>物品 :</span>
                                    <input type="text" id="tothings" class="full-width" name="tothings" value="<?php echo $tothings; ?>">
                                </label>
                                <label>
                                    <span>服务 :</span>
                                    <input type="text" id="toservices" class="full-width" name="toservices" value="<?php echo $toservices; ?>">
                                </label>
                                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                                <button id="denglubt" type="submit"  class="button" >Submit</button>
                            </form>

                        </div>
                        <script>
                            document.getElementById('img1').onchange = function () {
                                reader = new FileReader();
                                reader.onload = function (e) {
                                    document.getElementById('preview1').src = e.target.result;
                                };
                                reader.readAsDataURL(this.files[0]);
                            };

                            document.getElementById('img2').onchange = function () {
                                reader = new FileReader();
                                reader.onload = function (e) {
                                    document.getElementById('preview2').src = e.target.result;
                                };
                                reader.readAsDataURL(this.files[0]);
                            };

                            document.getElementById('img3').onchange = function () {
                                reader = new FileReader();
                                reader.onload = function (e) {
                                    document.getElementById('preview3').src = e.target.result;
                                };
                                reader.readAsDataURL(this.files[0]);
                            };

                        </script>
                    </article>
                </div> <!-- end col-twelve -->
            </div> <!-- end row -->


            <br>
            <br>
        </section> <!-- end content -->




        <!-- end content -->
        <div id="preloader">
            <div id="loader"></div>
        </div>
        <!-- Java Script
   ================================================== -->
        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>