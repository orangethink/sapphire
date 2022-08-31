<?php
/**
 * 一款简单的蓝宝石模板
 * 欢迎反馈
 * 作者：<a href="https://www.mochengli.cn">OrangeThinK</a>
 * 
 * 
 * @package sapphire
 * @author OrangeThinK
 * @version 0.1
 * @link https://www.mochengli.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('nav.php'); ?>
<style>
main{
background:none;
padding:0}
</style>
<section>
        <!--post-item start-->
        <?php if(!$this->have()):?>
            <div class="post-item">
            <div class="post-item-body" style="padding-top:0.001em"><h1 style="text-align:center;margin-top:40px;color:var(--text-color)">糟糕，是 404 的感觉</h1></div>
            </div>
        <?php else:?>

            <div id="post-list">
            <?php $index=0;  ?>
            <?php while($this->next()): ?>
                <?php $index++;?>
                    <a href="<?php $this->permalink(); ?>"  class="post-item">
                        <h1><?php  $this->title();?></h1>
                        <span><i class="fa fa-calendar"></i> <?php echo Utils::formatDate($this->created,'Y-m-d')?></span>
                        <span><?php $this->getcategory(' ');?></span>
                        <span><i class="fa fa-commenting-o"></i> <?php echo $this->commentsNum; ?></span>
                    </a>

            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        
        <!--post-item end-->
                <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
               
</section>
<?php $this->need('footer.php'); ?>