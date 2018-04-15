<?php
/**
 * @package Sj K2 Accordion
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die;

$uniquied = 'sj_accordion_'.time().rand();
ImageHelper::setDefault($params);
$item_first = (int)$params->get('item_first_display');
if($item_first >= (int)count($list)){
	$item_first = count($list) ;
}
else if($item_first <= 0){
	$item_first = 1;
}else{
	$item_first = $item_first ; 
}

if(!empty($list)){?>

<script type="text/javascript">
//<![CDATA[
	jQuery(document).ready(function($) {
		$(window).load(function(){
			$('#<?php echo $uniquied;?>').imagesLoaded( function(){});
		});
		$('#<?php echo $uniquied;?>').imagesLoaded( function(){
			
			$('#<?php echo $uniquied;?>').sj_accordion({
				items : '.acd-item',
				heading : '.acd-header',
				content : '.acd-content-wrap',
				active_class : 'selected',
				event : '<?php echo $params->get('accmouseenter', 'click');?>',
				delay : 300,
				duration : 500,
				active : '<?php echo $item_first;?>'
			}); 
			
			var height_content = function(){	
			  	$('.acd-item', '#<?php echo $uniquied;?>').each(function(){
			        var inner = $('.acd-content-wrap-inner', $(this).filter('.selected'));
		            if(inner.length){
		                var inner_height = inner.height();
		                inner.parent().css('height',inner_height);
		            }
			   });
			}
			if ( $.browser.msie  && parseInt($.browser.version, 10) <= 8){
			//nood
			}else{
	      		  $(window).resize(function() {
	        		height_content();
	       		 });
			}
		}); 
		
	}); 
//]]>	
</script>
	<?php if($params->get('pretext') != null){?>
	<div class="acd-pretext">
		<?php echo $params->get('pretext'); ?>
	</div>
	<?php }?>
	<div id="<?php echo $uniquied; ?>" class="sj-accordion">
		<div class="acd-items">
			<?php  foreach($list as $item){ ?>
			<div class="acd-item">
				<div class="acd-header">
					<?php echo modSjK2AccordionHelper::truncate($item->title, $params->get('item_title_max_characters',25)); ?>
				</div>
				<div class="acd-content-wrap cf">
					<div class="acd-content-wrap-inner cf">
						<div class="acd-image cf">
							<a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo modSjK2AccordionHelper::parseTarget($params->get('link_target')); ?>>
				    			<?php $img = modSjK2AccordionHelper::getK2Image($item, $params);
		    						echo modSjK2AccordionHelper::imageTag($img);?>
							</a>
						</div>
						<div class="acd-content">
							<h3 class="title-accordion">
								<a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>">
									<?php echo $item->title; ?>
								</a>
							</h3>
						<?php $fieldclass = $item->extra_fields; ?>
						<?php if(isset($fieldclass[1]) && ($fieldclass[1]->value !='')): ?>
							<div class="local">
								<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $fieldclass[1]->value; ?>
							</div>
						<?php endif; ?>

							
							<div class="catItemRatingBlock">
                                <span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>
                                <div class="itemRatingForm">
                                    <ul class="itemRatingList">
                                        <li class="itemCurrentRating" style="width:<?php echo $item->votingPercentage; ?>%;"></li>
                                        <li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a></li>
                                        <li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a></li>
                                        <li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a></li>
                                        <li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a></li>
                                        <li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a></li>
                                    </ul>
                                    <div class="itemRatingLog"><?php echo $item->numOfvotes; ?></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="clr"></div>
                            </div>

							<?php if($params->get('item_description_display') == 1) {?>
							<div class="acd-description">
								<?php echo modSjK2AccordionHelper::truncate($item->displayIntrotext, $params->get('item_description_max_characters',200)); ?>
							</div>
							<?php }?>
							<?php if($params->get('item_readmore_display') == 1) {?>
							<div class="accd-readmore">
								<a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo modSjK2AccordionHelper::parseTarget($params->get('link_target')); ?>>
								<?php echo $params->get('item_readmore_text'); ?>
								</a>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php if($params->get('posttext') != null){?>
	<div clss="acd-posttext">
		<?php echo $params->get('posttext'); ?>
	</div>
	<?php }?>
<?php }else{ echo JText::_('Has no content to show!');}?>

