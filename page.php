<?php
/**
 * post.php
 * 
 * 新建页面
 * 
 * @author OTK
 */
 if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php  $this->need('nav.php'); ?>
<section>
 <!-- <div class="col-mb-12 col-8"  role="main" style="padding-left:20px;background: rgba(0,0,0,0.60);">-->
<div class="col-mb-12 col-8"  role="main" style="padding-left:20px;">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title" itemprop="name headline" style="margin-top: 0;text-align: center;"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody" >
<?php echo Utils::parseAll($this->content,true); ?>
        </div>
    </article>
    <?php $this->need('comments.php'); ?>

</div>
</section>
<!-- end #main-->
<?php $this->need('footer.php'); ?>

