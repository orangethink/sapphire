<?php
/**
 * post.php
 * 
 * 文章页面
 * 
 * @author OTK
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('nav.php'); ?>
<section>

        <!--post-item start-->
        <?php if(!$this->have()):?>
           <?php $this->need('404.php'); ?>
          <!--<div class="post-item" >
            <div class="post-item-body" style="padding-top:0.001em"><h1 style="text-align:center;margin-top:40px;color:var(--text-color)">11111糟糕，是 404 的感觉</h1></div>
            </div>-->
        <?php else:?>
                <?php if($this->fields->type=='1' || !($this->fields->banner && $this->fields->banner!='')): ?>
                    <div class="post-header">
                      <?php if(!($this->fields->type=='1')): ?>
                        <div class="post-title"><?php $this->title();?>
                        <?php if($this->user->hasLogin()): ?>
                            <sup><a target="_blank" href="<?php echo $this->options->adminUrl.'write-post.php?cid='.$this->cid;?>"><i class="fa fa-edit"></i></a></sup>
                        <?php endif;?>
                        </div>
                    <?php endif; ?>
                     <span style="display: inline-block;"><b><?php echo $this->author->screenName; ?></b><?php Utils::exportPostMeta($this,$this->fields->type); ?></span>
                    </div>
                <?php elseif($this->fields->banner && $this->fields->banner!='') :?>
                    <a data-fancybox="gallery" href="<?php echo $this->fields->banner; ?>"><img style="max-width:100%;width:100%" src="<?php echo $this->fields->banner; ?>"/></a>
                <?php endif; ?>
                    <article class="post-body">
                    <?php $diff= round((time()- $this->modified) / 3600 / 24); if($diff>=100): ?>
                    <blockquote>本文最后修改于 <?php echo $diff; ?> 天前，部分内容可能已经过时！</blockquote>
                    <?php endif; ?>
                        <?php if($this->options->show_toc=='hide'||$this->fields->show_toc=='hide'):?>
                      <?php echo Utils::parseAll($this->content); ?>
                    <?php else :?>
   <?php 
                          $parsed=Utils::parseTOC(Utils::parseAll($this->content));
                      echo $parsed['content']; 
                        ?>
                    <?php endif; ?>
					
							

                    </article>
  							
	
					
        <?php endif; ?>
       <div class="post-footer">
                      <?php if(count($this->tags) == 0):$this->category('', true, 'none'); else:$this->category('', true, 'none');$this->tags('', true, '');endif; ?>
                    <span style="font-size:1.2em;">© 著作权归<?php $this->options->title(); ?>所有，转载请注明出处。</span>
                </div>
        <!--post-item end-->
        <div class="post-pager" >
 
           <?php Utils::thePrev($this);?>
    
         <?php if($this->options->reward_img&&$this->options->reward_img!=''):?>
 <a id="reward" href="javascript:;" data-title="如果觉得不错就赞赏一下吧~"><i class="fa fa-gift"></i> 打赏</a>

 <div id="reward_main">
            <div id="reward_content">
              <!--头部-->
              <div id="reward_title">请作者吃个鸡腿！</div>
              <!--打赏图-->
<?php
                     $rw=explode(PHP_EOL,$this->options->reward_img);
echo '<div id="reward_body">';
                        foreach ($rw as $value) {
                            $value=str_replace("\r",'', $value);
                            $temp=explode(',',$value);
echo '<span>';
                            echo '<input type="radio" id="'.$temp[0].'" name="reward">';
                            echo '<label class="reward_title" for="'.$temp[0].'">'.$temp[1].'</label>';

                            echo '<img id="otk_'.$temp[0].'" src="'.$temp[2].'"/>';
echo '</span>';
                        }
  ?>
</div>
            </div>
          </div> 

               <script>
  $("#reward").click(function(){
    $("#reward_main")[0].style['display']="block";
  });   
  // $("#reward_title").click(function(){
  //   $("#reward_main")[0].style['display']="none";
  // });      
   $("#reward_main").click(function(){
     $("#reward_main")[0].style['display']="none";
   });    
  $("#reward_body").click(function(e){
    e.stopPropagation();
	
  });       
	
       
		  </script>
         
         <!--  </a>--><?php endif;?>
           <?php Utils::theNext($this); echo "</div>";?>

        <?php $this->need('comments.php'); ?>

</section>
<?php $this->need('footer.php'); ?>
