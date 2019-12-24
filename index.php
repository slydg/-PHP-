<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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

        <!-- script
        ================================================== -->
        <script src="js/modernizr.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <style>
            body{
                background:url(image/345.jpg) center center ;
                background-size:cover;
            }
        </style>
        <title>冗易——物物交换平台</title>
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
                <div id="log">

                </div>
                <nav id="main-nav-wrap">
                    <ul class="main-navigation sf-menu" style="">
                        <?php
                        session_start();
                        if (isset($_SESSION['uid'])) {
                            ?>

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
                            <li><a href="logout.php">[注销]</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="login.html">登录</a></li>
                            <li><a href="signup.html">注册</a></li>
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
                            <li><a href="contact.html" title="">联系我们</a></li>										

                            <?php
                        }
                        ?>									


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
// put your code here
        ?>
        <section id="bricks">
            <div class="row masonry">
                <div class="bricks-wrapper">
                    <div class="grid-sizer"></div>
                    <div class="brick entry featured-grid animate-this">
                        <div class="entry-content">
                            <div id="featured-post-slider" class="flexslider">
                                <ul class="slides">

                                    <li>
                                        <div class="featured-post-slide">

                                            <div class="post-background" style="background-image:url('image/about-us.jpg');"></div>

                                            <div class="overlay"></div>			   		

                                            <div class="post-content">
                                                <ul class="entry-meta">
                                                    <li>December, 2017</li> 
                                                    <li><a href="#" >冗易</a></li>				
                                                </ul>	

                                                <h1 class="slide-title"><a href="" title="">中国第一个自由的物物交换平台</a></h1> 
                                            </div> 				   					  

                                        </div>
                                    </li> <!-- /slide -->

                                    <li>
                                        <div class="featured-post-slide">

                                            <div class="post-background" style="background-image:url('image/123.jpg');"></div>

                                            <div class="overlay"></div>			   		

                                            <div class="post-content">
                                                <ul class="entry-meta">
                                                    <li>December, 2017</li>
                                                    <li><a href="#">冗易</a></li>					
                                                </ul>	

                                                <h1 class="slide-title"><a href="" title="">更简洁，更“容易”，更自由</a></h1>
                                            </div>		   				   					  

                                        </div>
                                    </li> <!-- /slide -->

                                    <li>
                                        <div class="featured-post-slide">

                                            <div class="post-background" style="background-image:url('image/456.jpg');;"></div>

                                            <div class="overlay"></div>			   		

                                            <div class="post-content">
                                                <ul class="entry-meta">
                                                    <li>December, 2017</li>
                                                    <li><a href="#" class="author">冗易</a></li>					
                                                </ul>	

                                                <h1 class="slide-title"><a href="" title="">初次见面，请多多关照</a></h1>
                                            </div>

                                        </div>
                                    </li> <!-- end slide -->

                                </ul> <!-- end slides -->
                            </div> <!-- end featured-post-slider -->        			
                        </div> <!-- end entry content -->         		
                    </div>


                    <article class="brick entry format-standard animate-this">

                        <div class="entry-thumb">
                            <a href="" class="thumb-link">
                                <img src="images/thumbs/diagonal-pattern.jpg" alt="building">             
                            </a>
                        </div>

                        <div class="entry-text">
                            <div class="entry-header">

                                <div class="entry-meta">
                                    <span class="cat-links">
                                        <a href="">关于我们</a> 

                                    </span>			
                                </div>

                                <h1 class="entry-title"><a href="">为什么“冗易”？</a></h1>

                            </div>
                            <div class="entry-excerpt">
                                冗易：冗物易之。象征着将自己多余或是用不到的事物进行交换，恰好符合本平台的主旨。“冗易”又音为“容易”，简单易懂。可以在人群中迅速被接受，也在潜意识中引导用户产生平台操作容易上手，过程简单方便。偏古风的名称与现代化的平台构建相结合在制造发差的同时，又在二者之间建立密切的联系，近一方面加深用户对平台的使用印象和形象认知。
                            </div>
                        </div>

                    </article> <!-- end article -->


                    <article class="brick entry format-quote animate-this" >

                        <div class="entry-thumb">                  
                            <blockquote>
                                <p id="state"></p>

                                <cite>您收到的信息和申请</cite> 
                            </blockquote>	          
                        </div>   
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $.get('php/inform.php',
                                        function (data, status) {
                                            $("#state").html(data);
                                        }
                                );
                            });
                            window.setInterval(function () {
                                $.get('php/inform.php',
                                        function (data, status) {
                                            $("#state").html(data);
                                        }
                                );
                            }, 10000);
                        </script>
                    </article> <!-- end article -->




                    <article class="brick entry format-standard animate-this">

                        <div class="entry-thumb">
                            <a href="contact.html" class="thumb-link">
                                <img src="image/123.jpg" alt="building">             
                            </a>
                        </div>

                        <div class="entry-text">
                            <div class="entry-header">

                                <div class="entry-meta">
                                    <span class="cat-links">
                                        <a href="contact.html">联系我们</a> 

                                    </span>			
                                </div>

                                <h1 class="entry-title"><a href="contact.html">请问有何指教？</a></h1>

                            </div>
                            <div class="entry-excerpt">

                            </div>
                        </div>

                    </article> <!-- end article -->






                </div>

            </div>

        </section>











        <footer id="foot">

            <!--            <div id="beian" style="text-align:center;">
                            <span><a href="http://www.miitbeian.gov.cn/" target="_blank">闽ICP备17030727</a></span> 
                        </div>
            -->      <div class="footer-bottom">
                <div class="row">

                    <div class="col-twelve">
                        <div class="copyright">
                            <span><a id="ba" href="http://www.miitbeian.gov.cn/" target="_blank">闽ICP备17030727</a></span>  
                        </div>

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
        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/jquery.appear.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
