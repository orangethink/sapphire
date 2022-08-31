
<?php
/** 
* Utils.php
* 
* @author      OrangeThinK-sapphire
* @version     0.1
* 
*/ 
?>

<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

//global $toc;
//global $curid;
/*function parseTOC_callback($matchs){
    $GLOBALS['curid']=$GLOBALS['curid']+1;
    $GLOBALS['toc'].='<li onclick="$(this).siblings(`li`).removeClass(`toc-active`);$(this).attr(`class`,`toc-active`)"><a href="#TOC-'.(string)$GLOBALS['curid'].'" onclick="$.scrollTo(`#TOC-'.(string)$GLOBALS['curid'].'`,300);$(`button[data-fancybox-close]`).click();" class="toc-item toc-level-'.$matchs[1].'">'.(string)$GLOBALS['curid'].'.'.$matchs[2].'</a></li>';
    return '<h'.$matchs[1].' id="TOC-'.(string)$GLOBALS['curid'].'">'.$matchs[2].'</h'.$matchs[1].'>';
}
function parseBoard_callback($matchs){
    return '<a target="_blank" href="'.$matchs[2].'" class="board-item link-item"><div class="board-thumb" style="background-image:url('.$matchs[3].')"></div><div class="board-title">'.$matchs[1].'</div></a>';
}
*/
class Utils {   
	/**
	 * 站点已运行时间
	 */
	public static function getBuildTime($start_time){
	// 设置时区
	date_default_timezone_set('Shanghai');
	// 在下面按格式输入本站创建的时间
	$site_create_time = $start_time?strtotime($start_time):'';
	$time = time() - $site_create_time;
	if(is_numeric($time)){
	$value = array(
	"years" => 0, "days" => 0, "hours" => 0,
	"minutes" => 0,
	);
	if($time >= 31556926){
	$value["years"] = floor($time/31556926);
	$time = ($time%31556926);
	}
	if($time >= 86400){
	$value["days"] = floor($time/86400);
	$time = ($time%86400);
	}
	if($time >= 3600){
	$value["hours"] = floor($time/3600);
	$time = ($time%3600);
	}
	if($time >= 60){
	$value["minutes"] = floor($time/60);
	$time = ($time%60);
	}
	 
	echo '<span class="btime">'."站点已安全运行".$value['years'].'年'.$value['days'].'天'.$value['hours'].'小时'.$value['minutes'].'分</span>';
	}else{
	echo '';
	}
	}

      /**
     * 获取ICP备案信息
     */
    public static function getIcpInfo($beianinfo){
      $arr=[];
      $n=stripos($beianinfo,"备");
      $arr[0]=mb_substr($beianinfo,0,$n+3); 
       $arr[1]=mb_substr($beianinfo,$n+3); 
       return $arr;
    }
	
    /**
     * 获取第一管理员名称
  
    public static function getAdminScreenName(){
        $db = Typecho_Db::get();
        //$name = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', 1))['screenName'];
        $name = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', 1));
        $name = $name['screenName'];
        return $name;
    }
   */
    /**
     * 获取第一管理员邮箱
    
    public static function getAdminMail(){
        $db = Typecho_Db::get();
        $mail = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', 1));
        $mail = $mail['mail'];
        return $mail;
    }
 */
    /**
     * 文章上一篇
     */
    public static function thePrev($archive){
        $db = Typecho_Db::get();
        $content = $db->fetchRow($db->select()->from('table.contents')->where('table.contents.created < ?', $archive->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $archive->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_DESC)
        ->limit(1));

        if ($content) {
            $content = $archive->filter($content);
            echo '<a data-title="'.$content['title'].'" href="'.$content['permalink'].'"><i class="fa fa-hand-o-left"></i>'.$content['title'].'</a>';
        } else {
            echo '<a data-title="真的没有啦！"><span>没有啦~</span></a>';
        }

    }

    /**
     * 文章下一篇
     */
    public static function theNext($archive){
        $db = Typecho_Db::get();
        $content = $db->fetchRow($db->select()->from('table.contents')->where('table.contents.created > ? AND table.contents.created < ?',
            $archive->created, Helper::options()->gmtTime)
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.type = ?', $archive->type)
            ->where('table.contents.password IS NULL')
            ->order('table.contents.created', Typecho_Db::SORT_ASC)
            ->limit(1));

        if ($content) {
            $content = $archive->filter($content);
          echo '<a data-title="'.$content['title'].'" href="'.$content['permalink'].'"><i class="fa fa-hand-o-right"></i> '.$content['title'].'</a>';
         
        } else {
            echo '<a data-title="真的没有啦！"><span>没有啦~</span></a>';
       
        }
    }
    
	
	/**
	 * NAV文章上一篇
	 */
	public static function theNavPrev($archive){
	    $db = Typecho_Db::get();
	    $content = $db->fetchRow($db->select()->from('table.contents')->where('table.contents.created < ?', $archive->created)
	    ->where('table.contents.status = ?', 'publish')
	    ->where('table.contents.type = ?', $archive->type)
	    ->where('table.contents.password IS NULL')
	    ->order('table.contents.created', Typecho_Db::SORT_DESC)
	    ->limit(1));
	
	    if ($content) {
	        $content = $archive->filter($content);
	        echo '<li id="nav_pre"><a data-title="'.$content['title'].'" href="'.$content['permalink'].'"><i class="fa fa-hand-o-left"></i>'.'上一篇'.'</a></li>';
	    } else {
	      
	    }
	
	}
	
	/**
	 * Nav文章下一篇
	 */
	public static function theNavNext($archive){
	    $db = Typecho_Db::get();
	    $content = $db->fetchRow($db->select()->from('table.contents')->where('table.contents.created > ? AND table.contents.created < ?',
	        $archive->created, Helper::options()->gmtTime)
	        ->where('table.contents.status = ?', 'publish')
	        ->where('table.contents.type = ?', $archive->type)
	        ->where('table.contents.password IS NULL')
	        ->order('table.contents.created', Typecho_Db::SORT_ASC)
	        ->limit(1));
	
	    if ($content) {
	        $content = $archive->filter($content);
	      echo '<li id="nav_next"><a data-title="'.$content['title'].'" href="'.$content['permalink'].'"><i class="fa fa-hand-o-right"></i> '.'下一篇'.'</a></li>';
	     
	    } else {

	    }
	}
    /**
     * 编辑界面添加owoButton
     */
    public static function addButton(){
        echo '<script src="/usr/themes/sapphire/assets/owo/owo_custom.js"></script>';
        echo '<script type="text/javascript" src="/usr/themes/sapphire/assets/owo/admin_owo.js"></script>';
        echo '<<link rel="stylesheet" href="/usr/themes/sapphire/assets/owo/admin_owo.css"></script>';
        echo '<link rel="stylesheet" href="/usr/themes/sapphire/assets/owo/owo.min.css" />';
    }

    /**
     * 输出算术验证码
     
    public static function antiSpam(){
        $num1=rand(1,49);
        $num2=rand(1,49);
        echo '<input type="text" name="dalabengba" value="" placeholder="'.$num1.' + '.$num2. ' = ?" />';
        echo '<input type="hidden" name="benborba" value="'.$num1.'" />';
        echo '<input type="hidden" name="baborben" value="'.$num2.'" />';
    }
*/
    /**
     * 算术验证码检查
    
    public static function filterComments($comment, $post){
        if($_POST['dalabengba']!=$_POST['benborba']+$_POST['baborben']){
            throw new Typecho_Widget_Exception(_t('好像验证码算错了哦…… <a href="javascript:history.back(-1)">再来一次</a>吧！','评论失败'));
        }
        return $comment;
    }
 */

    /**
     * 解析器
     * 
     * 用以解析图片集、ruby、表情等
     * 
     * @param string    $content
     */
    static public function parseAll($content,$parseBoard=false){
      //  $new  = self::parsePhotoSet(self::parseBiaoQing(self::parseFancyBox(self::parseRuby($content))));
      $new  = self::parseBiaoQing(self::parseFancyBox($content));
        if($parseBoard){
            return self::parseBoard($new);
        }
        else{
            return $new;
        }
    }

    /**
     * 解析照片集
     *
  
    static public function parsePhotoSet($content){
        $reg='/\[photos.*?des="(.*?)"\](.*?)\[\/photos\]/s';
        $rp='<div class="photos" data-des="${1}">${2}</div>';
        $new=preg_replace($reg,$rp,$content);
        return $new;
    }
   */
  
    /**
     * 解析表情
     * 
     * 文章与评论可用
     */
    /*static public function parseBiaoQing($content){
        $content = preg_replace_callback('/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
            array('Utils', 'parsePaopaoBiaoqingCallback'), $content);
        $content = preg_replace_callback('/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
            array('Utils', 'parseAruBiaoqingCallback'), $content);

        return $content;
    }*/
      static public function parseBiaoQing($content){
       $content = preg_replace_callback('/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
          function($match){
               return '<img class="biaoqing" src="/usr/themes/sapphire/assets/owo/biaoqing/paopao/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
            }, $content);
        $content = preg_replace_callback('/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
            function($match){
               return '<img class="biaoqing" src="/usr/themes/sapphire/assets/owo/biaoqing/aru/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
            }, $content);

        return $content;
    }

  
 
    
    
    /**
     * 解析目录
     * 
     * @return array
     * 
     
    static public function parseTOC($content){
        global $toc;
        $GLOBALS['curid']=0;
        $GLOBALS['toc']='<ul id="toc-ul">';
        $new=preg_replace_callback('/<h([2-6]).*?>(.*?)<\/h.*?>/s', 'parseTOC_callback', $content);
        $GLOBALS['toc'].='</ul>';
        return array('content'=>$new,'toc'=>$toc);
    }
*/
  
      static public function parseTOC($content){
        global $toc;
        $GLOBALS['curid']=0;
        $GLOBALS['toc']='<ul id="toc-ul">';
        $new=preg_replace_callback('/<h([2-6]).*?>(.*?)<\/h.*?>/s', function($matchs){
         $GLOBALS['curid']=$GLOBALS['curid']+1;
    $GLOBALS['toc'].='<li onclick="$(this).siblings(`li`).removeClass(`toc-active`);$(this).attr(`class`,`toc-active`)"><a href="#TOC-'.(string)$GLOBALS['curid'].'" onclick="$.scrollTo(`#TOC-'.(string)$GLOBALS['curid'].'`,300);$(`button[data-fancybox-close]`).click();" class="toc-item toc-level-'.$matchs[1].'">'.(string)$GLOBALS['curid'].'.'.$matchs[2].'</a></li>';
    return '<h'.$matchs[1].' id="TOC-'.(string)$GLOBALS['curid'].'">'.$matchs[2].'</h'.$matchs[1].'>';

        }, $content);
        $GLOBALS['toc'].='<li><i class="fa fa-comments"></i><a href="#comments">我要评论</a></li></ul>';
        return array('content'=>$new,'toc'=>$toc);
    }
  
    /**
     * 解析 fancybox
     * 
     * @return string
     */
    static public function parseFancyBox($content){
        $reg='/<img(.*?)src="(.*?)"(.*?)>/s';
        $rp='<a data-fancybox="gallery" href="${2}"><img${1}src="${2}"${3}></a>';
        $new=preg_replace($reg,$rp,$content);
        return $new;
    }

    /**
     * 解析友情链接
     * 
     * @return string
     */
    static public function parseBoard($string){
        $reg='/\[(.*?)\]\((.*?)\)\+\((.*?)\)/s';
      //  $new=preg_replace_callback($reg, 'parseBoard_callback', $string);
        $new=preg_replace_callback($reg, function(){
        return '<a target="_blank" href="'.$matchs[2].'" class="board-item link-item"><div class="board-thumb" style="background-image:url('.$matchs[3].')"></div><div class="board-title">'.$matchs[1].'</div></a>';
        }, $string);
        $rp='<a target="_blank" href="${2}" class="board-item link-item"><div class="board-thumb" style="background-image:url(${3})"></div><div class="board-title">${1}</div></a>';
       $new=preg_replace($reg,$rp,$string);
        return $new;
    }


    /**
     * 解析 ruby
     * 
     * @return string
     * 

    static public function parseRuby($string){
        $reg='/\{\{(.*?):(.*?)\}\}/s';
        $rp='<ruby>${1}<rp>(</rp><rt>${2}</rt><rp>)</rp></ruby>';
        $new=preg_replace($reg,$rp,$string);
        return $new;
    }
     */

   
    /**
     * 导出标题
     * 
     * @return void
     */
    static public function title(Widget_Archive $archive){
        $archive->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - ');
        Helper::options()->title();
    }

    public static function formatDate($time, $format) {
        if (strtoupper($format) == 'NATURAL') {
            return self::naturalDate($time);
        }
        return date($format, $time);
    }
    /**
     * 自然日期
     * 
     * @return void
     */
    public static function naturalDate($from) {
        $now = time();
        $between = time() - $from;
        if ($between > 31536000) {
            return date('Y-m-d', $from);
        } else if ($between > 0 && $between < 172800                                // 如果是昨天
            && (date('z', $from) + 1 == date('z', $now)                             // 在同一年的情况
                || date('z', $from) + 1 == date('L') + 365 + date('z', $now))) {    // 跨年的情况
            return sprintf('昨天 %s', date('H:i', $from));
        } else if ($between == 0) {
            return '刚刚';
        }
        $f = array(
            '31536000' => '%d 年前',
            '2592000' => '%d 个月前',
            '604800' => '%d 星期前',
            '86400' => '%d 天前',
            '3600' => '%d 小时前',
            '60' => '%d 分钟前',
            '1' => '%d 秒前',
        );
        foreach ($f as $k => $v) {
            if (0 != $c = floor($between / (int)$k)) {
                if ($c == 1) {
                    return sprintf($v, $c);
                }
                return sprintf($v, $c);
            }
        }
        return "";
    }

    /**
     * 导出文章 meta
     * 
     * @return string
     */
    static public function exportPostMeta(Widget_Archive $archive,$type){
        echo '<i class="fa fa-calendar"></i>&nbsp;'.self::formatDate($archive->created,'Y年m月d日');
     /* echo $archive->viewsNum();
        if(self::isPluginAvailable('TePostViews')&&!$type=='1'){
            echo ' • <i class="fa fa-eye"></i>&nbsp;';
            $archive->viewsNum();
        }*/
        echo ' • <a href="'.$archive->permalink.'#comments"><i class="fa fa-commenting-o"></i>&nbsp';
        $archive->commentsNum();
        echo '</a>';
    }

    /**
     * 导出 header
     * 
     * @return void

    static public function exportHeader(Widget_Archive $archive,$img) {
		echo '<title>';
		self::title($archive);
		echo '</title>';
        $html = '';
        $site=Helper::options()->title;
        $description='';
        $createTime = date('c', $archive->created);
        $modifyTime = date('c', $archive->modified);
        $link=$archive->permalink;
        $type='';
        $author=$archive->author->screenName;
        if($archive->is("index")){
            $description=Helper::options()->description;
            $type='website';
        }
        elseif ($archive->is("post") || $archive->is("page")) {
            if($archive->fields->excerpt && $archive->fields->excerpt!=''){
                $description=$archive->fields->excerpt;
            }
            else{
                $description = Typecho_Common::subStr(strip_tags($archive->excerpt), 0, 100, "...");
            }
            $type='article';
        }

        echo '<meta name="description" content="';
        echo $description;
        echo '" />
<meta property="og:title" content="';
        self::title($archive);
        $html = <<< EOF
" />
<meta name="author" content="{$author}" />
<meta property="og:site_name" content="{$site}" />
<meta property="og:type" content="{$type}" />
<meta property="og:description" content="{$description}" />
<meta property="og:url" content="{$link}" />
<meta property="og:image" content="{$img}" />
<meta property="article:published_time" content="{$createTime}" />
<meta property="article:modified_time" content="{$modifyTime}" />
<meta name="twitter:title" content="
EOF;
        echo $html;
        self::title($archive);
        $html = <<<EOF
" />
<meta name="twitter:description" content="{$description}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="{$img}" />\n
EOF;
        echo $html;
    }
     */
	/**
     * 移动设备识别
     *
     * @return boolean
   
    public static function isMobile(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_browser = Array(
            "mqqbrowser", // 手机QQ浏览器
            "opera mobi", // 手机opera
            "juc","iuc", 'ucbrowser', // uc浏览器
            "fennec","ios","applewebKit/420","applewebkit/525","applewebkit/532","ipad","iphone","ipaq","ipod",
            "iemobile", "windows ce", // windows phone
            "240x320","480x640","acer","android","anywhereyougo.com","asus","audio","blackberry",
            "blazer","coolpad" ,"dopod", "etouch", "hitachi","htc","huawei", "jbrowser", "lenovo",
            "lg","lg-","lge-","lge", "mobi","moto","nokia","phone","samsung","sony",
            "symbian","tablet","tianyu","wap","xda","xde","zte"
        );
        $is_mobile = false;
        foreach ($mobile_browser as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }
  */
    /**
     * 手机识别
     * 
     * @return boolean

    public static function isPhone(){
        $ua=strtolower($_SERVER["HTTP_USER_AGENT"]);
        $devices=array("Android", 'iPhone', 'iPod', 'Phone');
        foreach ($devices as $device) {
            if(strpos($ua, strtolower($device))){
                return true;
            }
        }
        return false;
    }
         */
    /**
     * 判断插件是否存在并启用
     * 
     * @return boolean

    public static function isPluginAvailable($name) {
        if (class_exists($name.'_Plugin')){
            $plugins = Typecho_Plugin::export();
            $plugins = $plugins['activated'];
            return is_array($plugins) && array_key_exists($name, $plugins);
        }
    }
         */
}