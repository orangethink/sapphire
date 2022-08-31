<?php
/**
 * footer.php
 * 
 * 尾部
 * 
* @author      OrangeThinK
* @version     0.1
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<!-- start #footer -->
    <footer  role="contentinfo" >
      <p><a  href="https://www.gov.cn" style="background-image: url(<?php $this->options->themeUrl('/images/badge.png'); ?>);width: 32px;height: 21px;background-position: -110px -69px;position: relative;top: 5px;right: -10px;"></a><span style="font-weight: bolder;">&copy; <?php echo date('Y'); ?> By <?php $this->options->title(); ?> </span></p>
      <p>
   
     <a style="background-image: url(<?php $this->options->themeUrl('/images/badge.png'); ?>);background-position: -1px 146px;width: 159px;height: 31px;" href="http://typecho.org/"></a>
     <a style="background-image: url(<?php $this->options->themeUrl('/images/badge.png'); ?>);background-position: -1px 109px;width: 265px;height: 31px;" href="https://www.mochengli.cn/"></a>
    <?php if($this->options->beianinfo): ?>
     <a style="padding-left:0.5em; background: #595c5b;    position: relative;
    top: -10px;" href="http://beian.miit.gov.cn">
     <img style="background: #595c5b;position: relative;top: 5px;" src="http://www.beian.gov.cn/img/ghs.png" width="20px">
    <?php $a=(Utils::getIcpInfo($this->options->beianinfo));  ?>
   <span style="background: #595c5b;display: inline-block;padding-right: 5px;"><?php echo $a[0]?></span><span style="background: #4d80c1;display: inline-block;padding: 0 10px 0 5px;border-top-right-radius: 5%;border-bottom-right-radius: 5%;"><?php echo $a[1]?></span></a>
  <?php endif; ?>
  <?php if($this->options->mbeianinfo): ?>
        <a  href="https://icp.gov.moe/?keyword=<?php $this->options->mbeianinfo(); ?>" target="_blank" style="background: none;    position: relative;
    top: -10px;" >
       <img style="width:32px;height:32px;background: #595c5b;position: relative;top: 10px;border-top-left-radius: 5%;border-bottom-left-radius: 5%;" src="https://icp.gov.moe/images/ico64.png"><span style="background: #595c5b;display: inline-block;padding-right: 5px;">萌ICP备</span><span style="background: #4d80c1;display: inline-block;padding:0 10px 0 5px;border-top-right-radius: 5%;border-bottom-right-radius: 5%;"><?php $this->options->mbeianinfo(); ?>号</span>
     </a>
   <?php endif; ?>
      <a style="background-image: url(<?php $this->options->themeUrl('/images/badge.png'); ?>);background-position: -5px -26px;width: 130px;height: 31px;" href="https://www.upyun.com/?utm_source=lianmeng&utm_medium=referral" target="_blank" ></a>
        
     </p>
      <p style="margin-top: -5px;"> <?php Utils::getBuildTime($this->options->start_time); ?><i class="fa fa-heartbeat" style="color:red"></i></p>
	</footer>
<!-- end #footer -->


<?php if($this->allow('comment')&&($this->is('post')||$this->is('page')) ): ?>
<script src="<?php $this->options->themeUrl('/assets/owo/owo_custom.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/hljs/highlight.pack.js'); ?>"></script>
<script>
var owo = new OwO({
    logo: 'OωO表情',
    container: document.getElementsByClassName('OwO')[0],
    target: document.getElementsByClassName('input-area')[0],
    api: '<?php $this->options->themeUrl('/assets/owo/OwO_2.json'); ?>',
    position: 'down',
    width: '400px',
    maxHeight: '250px'
});
hljs.initHighlightingOnLoad();
</script>
<?php endif; ?>  

<script src="https://cdn.staticfile.org/fancybox/3.5.2/jquery.fancybox.min.js"></script>
<!--<script src="<?php $this->options->themeUrl('/assets/smothscroll/smothscroll.js'); ?>"></script>
-->
<?php echo $this->options->before_footer; ?>
</body>
</html>
