<?php
/**
 * @version    2.7.x
 * @package    K2
 * @author     JoomlaWorks http://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2016 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
// includes placehold
$yt_temp = JFactory::getApplication()->getTemplate();
include (JPATH_BASE . '/templates/'.$yt_temp.'/includes/placehold.php');
?>

<!-- Start K2 Generic (search/date) Layout -->
<div id="k2Container" class="itemListView <?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title') || JRequest::getCmd('task')=='search' || JRequest::getCmd('task')=='date'): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if(JRequest::getCmd('task')=='search' && $this->params->get('googleSearch')): ?>
	<!-- Google Search container -->
	<div id="<?php echo $this->params->get('googleSearchContainer'); ?>"></div>
	<?php endif; ?>

	<?php if(count($this->items) && $this->params->get('genericFeedIcon',1)): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if(count($this->items)): ?>

	<div class="itemList itemListSearch">
		<?php foreach($this->items as $item): ?>

		<!-- Start K2 Item Layout -->
		<div class="itemContainer col-lg-6 col-md-6 col-sm-4 col-xs-12">

			<div class="catItemView grid searchItem">
				<div class="catItemImageBlock">
					<a class="img"  href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
						<?php 
							//Create placeholder items images
							$src = $item->imageGeneric;
							if (!empty( $src)) {								
								$thumb_img = '<img src="'.$src.'" alt="'.$item->image_caption.'" />';
							} else if ($is_placehold) {					
								$thumb_img = yt_placehold($placehold_size['listing'],$item->image_caption,$item->image_caption);
							}	
							echo $thumb_img;
						?>
					</a>
				</div>
				<div class="main-item">
					<div class="catItemHeader">
						<!-- Item title -->
						<h3 class="catItemTitle">
							<?php if ($this->params->get('genericItemTitleLinked')): ?>
								<a href="<?php echo $item->link; ?>">
								<?php echo $item->title; ?>
								</a>
							<?php else: ?>
							<?php echo $item->title; ?>
							<?php endif; ?>
						</h3>
						<div class="clr"></div>					

						<?php 
							$fieldclass = $item->extra_fields; 
							
							//var_dump($fieldclass); die();
						?>
						<?php if( (isset($fieldclass[4]) && ($fieldclass[4]->value !='') && isset($fieldclass[1]) && ($fieldclass[1]->value !='') )): ?>
							<div class="local">
								<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $fieldclass[4]->value .', '. $fieldclass[1]->value; ?>
							</div>
						<?php endif; ?>
						<div class="clr"></div>
						<div class="rate-comment">
							<!-- Item Rating -->
							<div class="itemRatingBlock">
								<div class="itemRatingForm">
									<ul class="itemRatingList">
										<li class="itemCurrentRating" id="itemCurrentRating<?php echo $item->id; ?>" style="width:<?php echo $item->votingPercentage; ?>%;"></li>
										<li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a></li>
										<li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a></li>
										<li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a></li>
										<li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a></li>
										<li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a></li>
									</ul>
									<div id="itemRatingLog<?php echo $item->id; ?>" class="itemRatingLog"><?php echo $item->numOfvotes; ?></div>
									<div class="clr"></div>
								</div>
							</div>
							<!-- Anchor link to comments below - if enabled -->
							<div class="icomments">
								<?php if(!empty($item->event->K2CommentsCounter)): ?>
								<!-- K2 Plugins: K2CommentsCounter -->
								<?php echo $item->event->K2CommentsCounter; ?>
								<?php else: ?>
								<?php if($item->numOfComments > 0): ?>
								<i class="fa fa-comment"></i>
								<a class="itemCommentsLink k2Anchor" href="<?php echo $item->link; ?>#itemCommentsAnchor">
									<span><?php echo $item->numOfComments; ?></span> 
								</a>
								<?php else: ?>
								<i class="fa fa-comment"></i>
								<a class="itemCommentsLink k2Anchor" href="<?php echo $item->link; ?>#itemCommentsAnchor">0</a>
								<?php endif; ?>
								<?php endif; ?>
							</div>							
					</div>
					</div>
					<div class="clr"></div>
				</div>
			</div>
		  <div class="clr"></div>
		</div>
		<!-- End K2 Item Layout -->

		<?php endforeach; ?>
	</div>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="clr"></div>
	<div class="k2Pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>

	<?php else: ?>

	<?php if(!$this->params->get('googleSearch')): ?>
	<!-- No results found -->
	<div id="genericItemListNothingFound">
		<p><?php echo JText::_('K2_NO_RESULTS_FOUND'); ?></p>
	</div>
	<?php endif; ?>

	<?php endif; ?>

</div>
<!-- End K2 Generic (search/date) Layout -->
