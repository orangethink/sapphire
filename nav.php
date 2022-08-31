<?php
/** 
* nav-left.php
* 
* 导航栏
* 
* @author      OrangeThinK
* @version     0.1
* 
*/ 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
  <?php //$this->header('generator=&pingback=&xmlrpc=&wlw=&atom=&rss1=&rss2='); ?>
    <!-- 通过自有函数输出HTML头部信息 -->
   <link rel="stylesheet" href="<?php $this->options->themeUrl('/style.css'); ?>" />
   <script src="https://s0.pstatp.com/cdn/expire-1-M/jquery/3.3.1/jquery.min.js" type="application/javascript"></script>
  <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php $this->options->themeUrl('/assets/owo/owo.min.css'); ?>" rel="stylesheet">
  <link href="<?php $this->options->themeUrl('/assets/hljs/styles/atom-one-dark.css'); ?>" rel="stylesheet">
  <link href="<?php $this->options->themeUrl('/assets/fancybox/jquery.fancybox.min.css'); ?>" rel="stylesheet">

  <script src="https://s2.pstatp.com/cdn/expire-1-M/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js" type="application/javascript"></script>
    <!-- 使用url函数转换相关路径 -->

    <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

  <?php if ($this->options->ibgUrl): ?>
 <style type="text/css">
@media(max-width:767px) {
 body{
   background:url(<?php echo $this->options->ibgUrl ?>) !important; 
  }
  <?php else: ?>
 body{
   background:url(<?php echo $this->options->themeUrl."/images/iphonebg.jpg" ?>) !important; 
  }
  <?php endif; ?>
     }
</style>
</head>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->
  <?php if ($this->options->bgUrl): ?>
<body style="background-image:url(<?php echo $this->options->bgUrl ?>)">
<?php else: ?>
<body style="background-image:url(<?php echo $this->options->themeUrl."/images/ibg.jpg"?>)">
  <?php endif; ?>


  <header>
  <?php if ($this->options->logoUrl): ?>
<?php if ($this->options->logo_a): ?>
                <a id="logo" href="<?php $this->options->logo_a() ?>">

   <?php else: ?>
 
 <a id="logo" href="<?php $this->options->siteUrl(); ?>">
<?php endif; ?>
                    <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" /><span id="nav_title"><?php $this->options->title(); ?></span>
                </a>
   <?php endif; ?>
    <ul id="sidenav" style="margin-bottom: 10%;">
       <?php
       if($this->options->myword&&$this->options->myword!=''){
       $data=explode(PHP_EOL,$this->options->myword);
		// 随机获取一行索引
 		$result = $data[array_rand($data)]; 
		// 去除多余的换行符（保险起见）
		 $result = str_replace(array("\r","\n","\r\n"), '', $result); 
		echo  "<p id='info'>$result </p>";
  
       }  
  
  ?>
		<li><a class="fa fa-home"<?php if($this->is('index')): ?> class="current fa fa-home"<?php endif; ?> href="/"><?php _e('首页'); ?></a></li>
		<?php $parsed=Utils::parseTOC(Utils::parseAll($this->content));$GLOBALS['TOC_O']=$parsed['toc']; ?>
		<?php if($this->options->nav_pn=='two'||$this->options->nav_pn=='three'): ?>
		<li><a href="#" class="fa fa-arrow-up"><?php _e('返回顶部'); ?></a></li>
		<?php endif; ?>
		<?php if($this->is('post')&&($this->options->nav_pn=='one'||$this->options->nav_pn=='three')): ?>
		<?php Utils::theNavPrev($this);?>
		<?php endif; ?>
		<?php if($this->is('post')&&$this->options->show_toc=='show'&&strlen($GLOBALS['TOC_O'])>21): ?>
		<li><a id="menu" class="fa fa-list-ol" href="javascript:void(0);"><?php _e('目录'); ?></a>
			</li>
		<?php endif; ?>
		<?php if($this->is('post')&&($this->options->nav_pn=='one'||$this->options->nav_pn=='three')): ?>
		<?php Utils::theNavNext($this);?>
		<?php endif; ?>

       <div>
                <?php 
                    if($this->options->headernav&&$this->options->headernav!=''){
                        $navs=explode(PHP_EOL,$this->options->headernav);
                        foreach ($navs as $value) {
                            $value=str_replace("\r",'', $value);
                            $temp=explode(',',$value);
                            echo '<a class="nav-link flex justify-content-center align-items-center" href="'.$temp[2].'"><i class="fa fa-fw  fa-'.$temp[0].'"></i>'.$temp[1].'</a>';
                        }
                    }
                ?>
             
				
            </div>
		
			
	

    </ul>

	  <?php 
                    if($this->options->left_footer&&$this->options->left_footer!=''){
                        $left_footer=explode(PHP_EOL,$this->options->left_footer);
                       echo '<div id="left_footer">';
                        foreach ($left_footer as $value) {
                            $value=str_replace("\r",'', $value);
                            $temp=explode(',',$value);
                            echo '<a class="fa fa-'.$temp[0].'" href="'.$temp[2].'">'.$temp[1].'</a>';
                        }
                      echo '</div>';
                    }
                ?>
             
</header>

	 		<?php if($this->is('post')&&$this->options->show_toc=='show'&&strlen($GLOBALS['TOC_O'])>21):
	                    echo $GLOBALS['TOC_O']; 
	                   ?>
<?php endif; ?>


	
<main>
     <!-- <p id='info'>我赠你当下春绿、夏红、秋黄，余生你欠我冬季白首</p>-->
 <script>
  $("#menu").click(function(){
 	$("#toc-ul")[0].style['display']="block";
  });   
  $("main").click(function(){
    $("#toc-ul")[0].style['display']="none";
  });   

       
 		  </script>