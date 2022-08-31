<?php
/** 
* functions.php
* 
* 初始化主题，添加主题设置面板，添加文章自定义字段设置面板
* 
* @author      OrangeThinK
* @version     0.1
* 
*/ 
?>

<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once("lib/Utils.php");
require_once("lib/Comments.php");



Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Utils', 'addButton'); //全屏、图集、表情
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Utils', 'addButton');

function themeConfig($form) {
    echo '<div id="sapphire-check-update" style="padding:0.1rem 1rem;background:#eeeeee;border-radius:5px;"></div>';
    echo '<script>var sapphire_ver=0.1</script>';
    echo '<script src="/usr/themes/sapphire/assets/check_update.js"></script>';
   //背景配置
    $bgUrl = new Typecho_Widget_Helper_Form_Element_Text('bgUrl', NULL, NULL, _t('站点背景地址'), _t('在这里填入一个图片 URL 地址'));
    $form->addInput($bgUrl);
  //ibg背景配置
    $ibgUrl = new Typecho_Widget_Helper_Form_Element_Text('ibgUrl', NULL, NULL, _t('站点手机背景地址'), _t('在这里填入一个图片 URL 地址'));
    $form->addInput($ibgUrl);	
  //LOGO配置
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);
//LOGO跳转链接
        $logo_a=new Typecho_Widget_Helper_Form_Element_Text('logo_a', NULL,'/', _t('LOGO跳转链接'), NULL);
  	$form->addInput($logo_a);
  //是否开启浏览器判断仅中文语系可评论

  //建站日期
        $start_time=new Typecho_Widget_Helper_Form_Element_Text('start_time', NULL,'2019-02-01 00:00:00', _t('在下面按格式输入本站创建的时间'), _t('按格式输入本站创建的时间 2019-02-01 00:00:00，可留空'));
        $form->addInput($start_time);
//是否开启目录
$show_toc= new Typecho_Widget_Helper_Form_Element_Select('show_toc', array(
        'show' => '显示',
        'hide' => '不显示'
    ), 'show', _t('是否显示目录'), _t('开启后会在文章显示目录'));
    $form->addInput($show_toc);  
//导航栏状态
	$nav_sl= new Typecho_Widget_Helper_Form_Element_Select('nav_sl', array(
	        'one' => '直接显示在导航栏',
			'two' => '切换显示在导航栏',
	    ), 'one', _t('拓展导航栏-多功能模式切换'), _t('可和是否显示目录配合使用，切换则是点击旋转的头像 '));//切换功能未完成
	    $form->addInput($nav_sl);  
	//是否在导航栏开启上一篇下一篇
			$nav_pn= new Typecho_Widget_Helper_Form_Element_Select('nav_pn', array(
			        'one' => '仅开启上一篇下一篇',
					'two' => '仅开启返回顶部',
					'three' => '全部开启',
					'four' => '关闭功能',
			    ), 'one', _t('拓展导航栏-多功能开启'), _t('可和是否显示目录配合使用 '));
			    $form->addInput($nav_pn);  
  	//导航链接
    $headernav=new Typecho_Widget_Helper_Form_Element_Textarea('headernav', NULL, NULL, _t('导航链接'), _t('导航链接，一行一个，格式：图标,名称,链接，例如：home,首页,/ 。图标名称参考<a href="http://fontawesome.dashgame.com//">font-awesome</a>。'));
    $form->addInput($headernav);
    	//底部导航链接
    $left_footer=new Typecho_Widget_Helper_Form_Element_Textarea('left_footer', NULL, NULL, _t('底部导航链接'), _t('底部导航链接，一行一个，建议保持两至三个比较合适，格式：图标,名称,链接，例如：comments,留言板,/ 。图标名称参考<a href="http://fontawesome.dashgame.com//">font-awesome</a>。'));
    $form->addInput($left_footer);
    //一言
   $myword=new Typecho_Widget_Helper_Form_Element_Textarea('myword', NULL, NULL, _t('一言'), _t('一言：一行一个条'));
   $form->addInput($myword);
    // $db = Typecho_Db::get();
    //     $content = $db->fetchRow($db->select()->from('table.contents')->where('table.contents.created < ?', $archive->created)
  	//备案号
  	$beianinfo=new Typecho_Widget_Helper_Form_Element_Text('beianinfo', NULL,'粤ICP备18124517号', _t('备案号'), NULL);
  	$form->addInput($beianinfo);
	//萌备案号
	$mbeianinfo=new Typecho_Widget_Helper_Form_Element_Text('mbeianinfo', NULL, NULL, _t('萌备案号'),'只需要填写数字即可，如20201999');
	$form->addInput($mbeianinfo);
//打赏图
$reward_img=new Typecho_Widget_Helper_Form_Element_Textarea('reward_img', NULL, NULL, _t('打赏二维码'), _t('打赏二维码图片地址，一行一个，格式：变量名,名称,图片链接，例如：wechat,微信,xx.com/wechat.jpg ，若不需要打赏则留空，目前变量名只支持wechat,alipay,qqpay,order '));
   	$form->addInput($reward_img);
  	
$before_footer = new Typecho_Widget_Helper_Form_Element_Textarea('before_footer', NULL, NULL, _t('body 标签结束前输出信息'), _t('将输出在 body 标签结束前，你可以输入 JS 或者 CSS 等。'));
    $form->addInput($before_footer);
  }


?>
