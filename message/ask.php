<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$link = mysqli_connect(
        'localhost', /* The host to connect to 连接MySQL地址 */ 'rongyi', /* The user to connect as 连接MySQL用户名 */ 'rongyipass', /* The password to use 连接MySQL密码 */ 'rongyi');    /* The default database to query 连接数据库名称 */

if (!$link) {
    printf("Can't connect to MySQL Server. Errorcode: %s ", mysqli_connect_error());
    exit;
}
session_start();
if (isset($_SESSION['uid'])) {
    $user = $_SESSION['uid'];
} else {
    header('location:../login.html');
    exit;
}
$pid = $_GET['pid'];
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

        <title>冗易——上传商品</title>
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



        <section id="content-wrap" class="blog-single">
            <div class="row">
                <div class="col-twelve">

                    <article class="format-gallery">  
                        <div class="primary-content">
                            <h1>您愿意用什么交换<?php
                                $result = $link->query("SELECT obname,uid FROM things
            WHERE pid='$pid'");
                                if ($result->num_rows == 0) {
                                    $error = "上传失败";
                                    //header('location:../category.html');
                                } else {
                                    $row = $result->fetch_array(MYSQLI_NUM);
                                    $obname = $row[0];
                                    $owner = $row[1];
                                    echo $obname;
                                }
                                ?>？</h1> 
                            <ul class="entry-meta">
                                <li class="date"><?php
                                    date_default_timezone_set('Asia/Shanghai');
                                    $now = date('m/d/Y, H:i:s', time());
                                    echo $now;
                                    ?></li>
                                <li class="cat">
                                    <a href="" style="color: #666">请至少填写一种交换方式</a>

                                </li>
                            </ul>
                            <form action="apply.php" method="post" id="upload" enctype='multipart/form-data'>
                                <label>
                                    <span>选择您拥有的物品</span>
                                    <select id="things" class="full-width" name="things">
                                        <option value="NULL">不以物品交换</option>
                                        <?php
                                        $result3 = $link->query("SELECT pid,obname FROM things WHERE uid='$user'");
                                        $rows1 = $result3->num_rows;
                                        for ($j = 0; $j < $rows1; ++$j) {
                                            $result3->data_seek($j);
                                            $row2 = $result3->fetch_array(MYSQLI_NUM);
                                            ?>
                                            <option value="<?php echo $row2[0]; ?>"><?php echo $row2[1]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                </label>
                                <label>
                                    <span>人民币 :</span>
                                    <input type="number" id="money" class="full-width" name="money" placeholder="0">
                                </label> 
                                <label>
                                    <span>服务 :</span>
                                    <textarea id="service" class="full-width" name="service" rows="5" placeholder="比如帮对方做PPT或者教对方弹吉他"></textarea>
                                </label>
                                <br>
                                <h2>请告诉对方您的信息（可以为空）</h2> 
                                <label>
                                    <span>手机号码 :</span>
                                    <input type="tel" id="tel" class="full-width" name="tel" value="<?php
                                    $result2 = $link->query("SELECT * FROM users WHERE uid='$user'");
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
                                    echo $tel;
                                    ?>">
                                </label> 
                                <label>
                                    <span>电子邮箱 :</span>
                                    <input type="email" id="email" class="full-width" name="email" value="<?php echo $email; ?>">
                                </label>
                                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                                <input type="hidden" name="owner" value="<?php echo $owner; ?>">
                                <button type="submit"  class="button" >Submit</button>
                            </form>

                        </div>
                    </article>
                </div> <!-- end col-twelve -->
            </div> <!-- end row -->


            <br>
            <br>
        </section> <!-- end content -->
        <!-- Java Script
     ================================================== --> 

        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>

    </body>

</html>