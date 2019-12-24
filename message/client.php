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
if ($user !== $_GET['from']) {
    header('location:../login.html');
}if ($user == $_GET['to']) {
    header('location:../category.php');
}
$senderUid = (int) $_GET['from'];
$reciverUid = (int) $_GET['to'];
$pid = (int) $_GET['pid'];
date_default_timezone_set('Asia/Shanghai');

$getrecord1 = $link->query("SELECT * FROM chatown WHERE pid = '$pid' AND applier = '$senderUid'");
$record1 = $getrecord1->num_rows;
$getrecord2 = $link->query("SELECT * FROM chatown WHERE pid = '$pid' AND applier = '$reciverUid'");
$record2 = $getrecord2->num_rows;
if ($record1 == 0 && $record2 == 0) {
    $torecord = $link->query("INSERT INTO chatown(pid,owner,applier) VALUES('$pid','$reciverUid','$senderUid')");
}
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
        <style>
            #message-list {
                position: relative;
                margin: 0 auto;
                /*border: solid 1px #666;*/
                width: 100%;
                height: 400px;
                overflow: auto;
                left: 0%;
                float: left;
            }
            #message-box {
                position: relative;
                width: 100%;
                margin-bottom: 3rem;
                display: block;
                height: 6rem;
                padding: 1.5rem 2.5rem;
                border: 0;
                outline: none;
                vertical-align: middle;
                color: rgba(0, 0, 0, 0.7);
                font-family: "roboto-regular", sans-serif;
                font-size: 1.5rem;
                line-height: 3rem;
                max-width: 100%;
                background: rgba(0, 0, 0, 0.1);
                border: none;
                -moz-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                -webkit-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;

            }
            #message-box:focus{
                background: #151515;
                color: white;
            }


            #message-send{
                position: relative;
                transform: translate(0,20px);
                height: 0px;
            }
            #ask{
                position: relative;
                top: 2px;
            }


        </style>

        <!-- script
        ================================================== -->
        <script src="../js/jquery-2.1.3.min.js"></script>
        <script src="../js/modernizr.js"></script>
        <script src="../js/pace.min.js"></script>

        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript">
            var reciver_uid = <?php echo $senderUid; ?>;
            var sender_uid = <?php echo $reciverUid; ?>;
            var url = './GetMessage.php';
            $(document).ready(function () {
                get_message_reply(url, reciver_uid, sender_uid, 'get_message', '');
            });


            //获取消息并应答
            //get_get_message_reply()
            //param request_type  请求类型 详解：
            //      get_message   获取信息
            //      comfrim_read  确认已经读取了信息
            function get_message_reply(url, reciver_uid, sender_uid, request_type, send_data) {
                var setting = {
                    url: url,
                    data: {
                        'request_type': request_type,
                        'reciver_uid': reciver_uid,
                        'sender_uid': sender_uid,
                        'send_data': send_data,
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 1) {
                            if (response.response_type == 'is_read') {
                                //将消息写入到消息盒子
                                var messages = response.info;
                                var message_str = '';
                                var id_arr = new Array();
                                for (var i in messages) {
                                    id_arr.push(messages[i]['id']);
                                    message_str += '<p class="you"><p style="color:#6f4242;font-weight:bold">' + messages[i]['send_time'] + '&nbsp;' + messages[i]['sender'] + '说：</p>' + messages[i]['content'] + '</p>';
                                }
                                $('#message-list').append(message_str);
                                get_message_reply(url, reciver_uid, sender_uid, 'comfrim_read', id_arr);
                            } else if (response.response_type == 'is_connecting') {
                                get_message_reply(url, reciver_uid, sender_uid, 'get_message', '');
                            }
                        }

                    }
                };
                $.ajax(setting);
            }
            window.setInterval("get_message_reply(url, reciver_uid, sender_uid, 'get_message', '');", 5000);
        </script>

        <title>冗易——联系对方</title>
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
                    <article class="format-gallery">


                        <div class="brick entry featured-grid animate-this">
                            <div class="entry-content">
                                <div id="featured-post-slider" class="flexslider">
                                    <ul class="slides">

                                        <li>
                                            <div class="featured-post-slide">

                                                <div class="post-background" style="background-image:url('                                            <?php
                                                if (file_exists("../things/$pid-1.jpg")) {
                                                    echo "../things/$pid-1.jpg";
                                                } elseif (file_exists("../things/$pid-1.png")) {
                                                    echo "../things/$pid-1.png";
                                                } elseif (file_exists("../things/$pid-1.gif")) {
                                                    echo "../things/$pid-1.gif";
                                                } elseif (file_exists("../things/$pid-1.jpeg")) {
                                                    echo "../things/$pid-1.jpeg";
                                                }
                                                ?>');"></div>

                                            </div>
                                        </li>
                                        <!-- /slide -->

                                        <li>
                                            <div class="featured-post-slide">

                                                <div class="post-background" style="background-image:url('                                            <?php
                                                if (file_exists("../things/$pid-2.jpg")) {
                                                    echo "../things/$pid-2.jpg";
                                                } elseif (file_exists("../things/$pid-2.png")) {
                                                    echo "../things/$pid-2.png";
                                                } elseif (file_exists("../things/$pid-2.gif")) {
                                                    echo "../things/$pid-2.gif";
                                                } elseif (file_exists("../things/$pid-2.jpeg")) {
                                                    echo "../things/$pid-2.jpeg";
                                                }
                                                ?>');"></div>

                                            </div>
                                        </li>
                                        <!-- /slide -->

                                        <li>
                                            <div class="featured-post-slide">

                                                <div class="post-background" style="background-image:url('                                            <?php
                                                if (file_exists("../things/$pid-3.jpg")) {
                                                    echo "../things/$pid-3.jpg";
                                                } elseif (file_exists("../things/$pid-3.png")) {
                                                    echo "../things/$pid-3.png";
                                                } elseif (file_exists("../things/$pid-3.gif")) {
                                                    echo "../things/$pid-3.gif";
                                                } elseif (file_exists("../things/$pid-3.jpeg")) {
                                                    echo "../things/$pid-3.jpeg";
                                                }
                                                ?>');"></div>


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


                        <br>
                        <br>


                        <h1 class="entry-title"><?php
                            $result = $link->query("SELECT * FROM things
            WHERE pid='$pid'");

                            if ($result->num_rows == 0) {
                                $error = "上传失败";
                                // header('location:../category.html');
                            } else {
                                $row = $result->fetch_array(MYSQLI_NUM);
                                $obname = $row[3];
                                $uptime = $row[6];
                                $obnew = $row[5];
                                $obclass = $row[1];
                                echo $obname;
                            }
                            ?></h1>

                        <ul class="entry-meta">
                            <li class="date"><?php echo $uptime; ?></li>
                            <li class="cat">
                                <a href=""><?php echo $obclass; ?></a>
                                <a href=""><?php echo $obnew; ?></a>
                            </li>
                        </ul>
                        <div id="messages">
                            <?php
                            $sql1 = "select * from users where uid='{$reciverUid}'";
                            $result1 = mysqli_query($link, $sql1);
                            if ($result1) {
                                $row1 = mysqli_fetch_assoc($result1);
                                $reciver = $row1['username'];
                            }
                            ?>

                            <div id="message-list">
                                <?php
                                $result5 = $link->query("select * from message where sender_uid in ('$reciverUid','$senderUid') and reciver_uid in ('$reciverUid','$senderUid') and status='2' order by create_time");
                                $rows5 = $result5->num_rows;
                                for ($j = 0; $j < $rows5; ++$j) {
                                    $result5->data_seek($j);
                                    $row5 = $result5->fetch_array(MYSQLI_NUM);
                                    ?>
                                    <p class="you">
                                        <?php
                                        if ($row5[2] == $senderUid) {
                                            echo '<p style="color:green;font-weight:bold">';
                                        } else {
                                            echo '<p style="color:#6f4242;font-weight:bold">';
                                        }
                                        $row5['send_time'] = date('m/d/Y, H:i:s', $row5[4]);
                                        echo $row5['send_time'];
                                        if ($row5[2] == $senderUid) {
                                            echo '&nbsp;您';
                                        } else {
                                            $sql6 = "select username from users where uid='$row5[2];'";
                                            $result6 = mysqli_query($link, $sql6);
                                            if ($result6) {
                                                $row6 = mysqli_fetch_assoc($result6);
                                                $thesender = $row6['username'];
                                            }
                                            echo '&nbsp;';
                                            echo $thesender;
                                        }
                                        ?>
                                        说：
                                        <?php
                                        echo '</p>';
                                        echo $row5[3];
                                        ?>
                                    </p>
                                    <?php
                                }

                                $result7 = $link->query("select * from message where sender_uid = '$senderUid' and reciver_uid ='$reciverUid' and status='1' order by create_time");
                                $rows7 = $result7->num_rows;
                                for ($k = 0; $k < $rows7; ++$k) {
                                    $result7->data_seek($k);
                                    $row7 = $result7->fetch_array(MYSQLI_NUM);
                                    ?>
                                    <p class="you">
                                        <?php
                                        echo '<p style="color:green;font-weight:bold">';
                                        $row7['send_time'] = date('m/d/Y, H:i:s', $row7[4]);
                                        echo $row7['send_time'];
                                        echo '&nbsp;您';
                                        ?>
                                        说：
                                        <?php
                                        echo '</p>';
                                        echo $row7[3];
                                        ?>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>

                        </div>

                        <div id="message-send">
                            <input type="textarea" id="message-box"/>
                            <input type="button" id="submit-message" value="发送消息">
                            <a id="ask" href="ask.php?pid=<?php echo $pid; ?>">&nbsp;&nbsp;申请交换</a>
                            <br>
                            <br>
                            <br>
                        </div>

                        <?php
                        $time = time();
                        $send_time = date('Y-m-d H:i:s', $time);
                        ?>
                        <script type="text/javascript">
                            //-------------发送消息---------

                            $(function () {
                                var reciver_uid = <?php echo $reciverUid; ?>;
                                var sender_uid = <?php echo $senderUid; ?>;
                                $('#submit-message').on('click', function () {
                                    var message_content = $('#message-box').val();
                                    if (message_content != '') {
                                        $(this).attr('disabled', 'disabled');
                                        var send_url = './SendMessage.php';
                                        var myDate = new Date();
                                        var mytime = myDate.toLocaleString();
                                        var send_data = {
                                            'message': message_content,
                                            'reciver_uid': reciver_uid,
                                            'sender_uid': sender_uid,
                                        };
                                        $.post(send_url, send_data, function (response) {
                                            if (response.status == 1) {
                                                $('#message-box').val('');
                                                $('#submit-message').removeAttr('disabled');
                                                var send_message_str = '<p class="my"><p style="color:green;font-weight:bold">';
                                                send_message_str += mytime;
                                                send_message_str += '&nbsp;您说：</p>' + send_data.message;
                                                send_message_str += '</p>';
                                                $('#message-list').append(send_message_str);
                                            } else {
                                                console.log('发送失败!！');
                                            }
                                        }, 'json');
                                    }
                                });
                            });
                        </script>

                    </article>

                    <!-- end col-twelve -->
                </div>
                <!-- end row -->
            </div>

        </section>
        <!-- end content -->
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
        <!-- Java Script
   ================================================== -->
        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>