<?php

/**
 * @package		SVW
 * @author 		Pascal Link - http://www.pl07.de
 * @license		GNU GPL
 */
 // no direct access
defined('_JEXEC') or die;
?>
<section id="slideShow" class="page-item">
<header style="display:none">
    <h2>Slideshow</h2>
</header>

<div class="slideMenu">
	<? // SLIDE ITEMS /*?>
	<?php $item_count = 1; ?>
	<?php if(sizeof($list) > 1) : ?>
	<?php foreach ($list as $item) : ?>
    	<?php 
    	   $images = json_decode($item->images); 
    	   $img_url = $images->image_intro;
    	   if(strlen($img_url) == 0){
        	   $img_url = "images/bg/default_teaser.png";
    	   }
    	?>
		<div id="slideItemSelect_<?php echo $item_count; ?>" class="slideItemSelect select_pos<?php echo $item_count; ?>" style="background-image: url('<?php echo $img_url; ?>');" onclick="clickSlide(<?php echo $item_count; ?>)">&nbsp;</div>
		<?php $item_count++;?>
	<?php endforeach; ?>
	<?php endif; ?>
</div>

<div class="slideWindow">
<div id="slider">
<?php if ($grouped) : ?>
	<?php foreach ($list as $group_name => $group) : ?>
   <div class="slideItemGroupList">
		<h<?php echo $item_heading; ?>><?php echo $group_name; ?></h<?php echo $item_heading; ?>>
		<div class="slideItemGroup">
   			<?php foreach ($group as $item) : ?>
   			  <div class="slideItem">
					<h<?php echo $item_heading+1; ?>>
					   	<?php if ($params->get('link_titles') == 1) : ?>
						<a class="mod-articles-category-title <?php echo $item->active; ?>" 
						      href="<?php echo  JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_id)); ?>">
						<?php echo $item->title; ?>
				        <?php if ($item->displayHits) :?>
							<span class="mod-articles-category-hits">
				            (<?php echo $item->displayHits; ?>)  </span>
				        <?php endif; ?></a>
				        <?php else :?>
				        <?php echo $item->title; ?>
				        	<?php if ($item->displayHits) :?>
							<span class="mod-articles-category-hits">
				            (<?php echo $item->displayHits; ?>)  </span>
				        <?php endif; ?></a>
				            <?php endif; ?>
			        </h<?php echo $item_heading+1; ?>>


				<?php if ($params->get('show_author')) :?>
					<span class="mod-articles-category-writtenby">
					<?php echo $item->displayAuthorName; ?>
					</span>
				<?php endif;?>

				<?php if ($item->displayCategoryTitle) :?>
					<span class="mod-articles-category-category">
					(<?php echo $item->displayCategoryTitle; ?>)
					</span>
				<?php endif; ?>
				<?php if ($item->displayDate) : ?>
					<span class="mod-articles-category-date"><?php echo $item->displayDate; ?></span>
				<?php endif; ?>
				<?php if ($params->get('show_introtext')) :?>
			<p class="mod-articles-category-introtext">
			<?php echo $item->displayIntrotext; ?>
			</p>
		<?php endif; ?>
		<?php echo $params->get('show_readmore'); ?>
		<?php if ($params->get('show_readmore')) :?>
			<p class="mod-articles-category-readmore">
				<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
				<?php if ($item->params->get('access-view')== FALSE) :
						echo JText::_('MOD_SLIDESHOW_REGISTER_TO_READ_MORE');
					elseif ($readmore = $item->alternative_readmore) :
						echo $readmore;
						echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit'));
						if ($params->get('show_readmore_title', 0) != 0) :
							echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
						endif;
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('MOD_SLIDESHOW_READ_MORE_TITLE');
					else :

						echo JText::_('MOD_SLIDESHOW_READ_MORE');
						echo JHtml::_('string.truncate', ($item->title), $params->get('readmore_limit'));
					endif; ?>
	        </a>
			</p>
			<?php endif; ?>
			</div><? // slideItem ?> 
			<?php endforeach; ?>
        </div><? // slideItemGroup ?>
	</div><? // slideItemGroupList ?>
	<?php endforeach; ?>
<?php else : ?>
    <?php $item_count = 1; ?>
	<?php foreach ($list as $listItem) : ?>
	<?php 
	   $images = json_decode($listItem->images); 
	   $img_url = htmlspecialchars($images->image_intro);
	   if(strlen($img_url) == 0)
	       $img_url = '/images/bg/default_teaser.png';
	?>
		<div id="slideItem_<?php echo $item_count;?>" class="slideItem" style="background-image: url('<?php echo $img_url; ?>');" category="<?php echo $listItem->catid;?>"> 
            <style type="text/css">
        	#slideItem_<?php echo $item_count;?>, .slideWindow .select_pos<?php echo $item_count;?> {
            	filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $img_url; ?>', sizingMethod='scale');
                -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $img_url; ?>', sizingMethod='scale')";    
            }
        	</style>
    		<?php $item_count++ ?>
    		
            <?php if($listItem->catid != 128) : ?>
            <div class="teaserText">
            
        		<?php if ($listItem->displayCategoryTitle) :?>
        			<span class="mod-articles-category-category">
        			<?php echo $listItem->displayCategoryTitle; ?>
        			</span>
        		<?php endif; ?>
                
        	   	<h<?php echo $item_heading; ?>>
        	   	<?php if ($params->get('link_titles') == 1) : ?>
        		<a class="mod-articles-category-title <?php echo $listItem->active; ?>" 
        		  href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($listItem->slug, $listItem->catid)); ?>">
        		<?php echo $listItem->title; ?>
                <?php if ($listItem->displayHits) :?>
        			<span class="mod-articles-category-hits">
                    (<?php echo $listItem->displayHits; ?>)  </span>
                <?php endif; ?></a>
                <?php else :?>
                <?php echo $listItem->title; ?>
                	<?php if ($listItem->displayHits) :?>
        			<span class="mod-articles-category-hits">
                    (<?php echo $listItem->displayHits; ?>)  </span>
                <?php endif; ?></a>
                    <?php endif; ?>
                </h<?php echo $item_heading; ?>>
                
               	<?php if ($params->get('show_author')) :?>
               		<span class="mod-articles-category-writtenby">
        			<?php echo $listItem->displayAuthorName; ?>
        			</span>
        		<?php endif;?>
        		<?php if ($listItem->displayDate) : ?>
        			<span class="mod-articles-category-date"><?php echo $listItem->displayDate; ?></span>
        		<?php endif; ?>

        		<?php if ($params->get('show_introtext')) :
        		?>
        			<a class="mod-articles-category-title <?php echo $listItem->active; ?>" 
        			 href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($listItem->slug, $listItem->catid)); ?>">
            			<p class="mod-articles-category-introtext">
                			<?php echo $listItem->displayIntrotext; ?>
            			</p>
        			</a>
        		<?php endif; ?>
        
        		<?php if ($params->get('show_readmore')) :?>
        			<p class="mod-articles-category-readmore">
        				<a class="mod-articles-category-title <?php echo $listItem->active; ?>" href="<?php echo $listItem->link; ?>">
        		        <?php if ($listItem->params->get('access-view')== FALSE) :
        						echo JText::_('MOD_SLIDESHOW_REGISTER_TO_READ_MORE');
        					elseif ($readmore = $listItem->alternative_readmore) :
        						echo $readmore;
        						echo JHtml::_('string.truncate', $listItem->title, $params->get('readmore_limit'));
        					elseif ($params->get('show_readmore_title', 0) == 0) :
        						echo JText::sprintf('MOD_SLIDESHOW_READ_MORE_TITLE');
        					else :
        						echo JText::_('MOD_SLIDESHOW_READ_MORE');
        						echo JHtml::_('string.truncate', $listItem->title, $params->get('readmore_limit'));
        					endif; ?>
        	        </a>
        			</p>
        		<?php endif; ?>
            </div>
        	<?php endif; ?>
		</div><? // slideItem ?>
	<?php endforeach; ?>
<?php endif; ?>
</div><? // SLIDE CONTAINER ?>
</div><? // SLIDE WINDOW /*?>
<script type="text/javascript">slideShow();</script>
</section>