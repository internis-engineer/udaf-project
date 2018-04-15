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
?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="advertisements k2ItemsBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">


	<div class="prefix-head">            
        <?php if ($params->get('itemPreText', '')!=''){ ?>
        <div class="pre-text"><?php echo $params->get('itemPreText'); ?></div>
        <?php } ?>
        <div class="sub-hr"><i class="fa fa-globe"></i></div>
    </div>

	<?php if(count($items)): ?>
  <ul>
    <?php foreach ($items as $key=>$item):	?>
    <li class="<?php echo ($key%2) ? "odd" : "even"; if(count($items)==$key+1) echo ' lastItem'; ?>">

      <!-- Plugins: BeforeDisplay -->
      <?php echo $item->event->BeforeDisplay; ?>

      <!-- K2 Plugins: K2BeforeDisplay -->
      <?php echo $item->event->K2BeforeDisplay; ?>

      <!-- Plugins: AfterDisplayTitle -->
      <?php echo $item->event->AfterDisplayTitle; ?>

      <!-- K2 Plugins: K2AfterDisplayTitle -->
      <?php echo $item->event->K2AfterDisplayTitle; ?>

      <!-- Plugins: BeforeDisplayContent -->
      <?php echo $item->event->BeforeDisplayContent; ?>

      <!-- K2 Plugins: K2BeforeDisplayContent -->
      <?php echo $item->event->K2BeforeDisplayContent; ?>

		<?php if($params->get('itemImage') && isset($item->image)): ?>
		<a class="moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
			<img src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>" />
		</a>
		<?php endif; ?>

		<div class="main-item">
			<?php if($params->get('itemTitle')): ?>
				<a class="moduleItemTitle" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
			<?php endif; ?>
			
			<span class="moduleItemDateCreated"><?php echo JHTML::_('date', $item->created , 'M d, Y'); ?></span>

			<div class="catItemRatingBlock">
				<span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>
				<div class="itemRatingForm">
					<ul class="itemRatingList">
						<li class="itemCurrentRating" id="itemCurrentRating<?php echo $item->id; ?>" style="width:<?php //echo $item->votingPercentage; ?>%;"></li>
						<li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a></li>
						<li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a></li>
						<li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a></li>
						<li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a></li>
						<li><a href="#" data-id="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a></li>
					</ul>
					<div id="itemRatingLog<?php echo $item->id; ?>" class="itemRatingLog"><?php //echo $item->numOfvotes; ?></div>
					<div class="clr"></div>
				</div>
				<div class="clr"></div>
			</div>
			
		</div>
   
      <!-- Plugins: AfterDisplayContent -->
      <?php echo $item->event->AfterDisplayContent; ?>

      <!-- K2 Plugins: K2AfterDisplayContent -->
      <?php echo $item->event->K2AfterDisplayContent; ?>

      <?php if($params->get('itemTags') && count($item->tags)>0): ?>
      <div class="moduleItemTags">
      	<b><?php echo JText::_('K2_TAGS'); ?>:</b>
        <?php foreach ($item->tags as $tag): ?>
        <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>




      <!-- Plugins: AfterDisplay -->
      <?php echo $item->event->AfterDisplay; ?>

      <!-- K2 Plugins: K2AfterDisplay -->
      <?php echo $item->event->K2AfterDisplay; ?>

      <div class="clr"></div>
    </li>
    <?php endforeach; ?>
    <li class="clearList"></li>
  </ul>
  <?php endif; ?>

	<?php if($params->get('itemCustomLink')): ?>
	<a class="moduleCustomLink" href="<?php echo $params->get('itemCustomLinkURL'); ?>" title="<?php echo K2HelperUtilities::cleanHtml($itemCustomLinkTitle); ?>"><?php echo $itemCustomLinkTitle; ?></a>
	<?php endif; ?>

	<?php if($params->get('feed')): ?>
	<div class="k2FeedIcon">
		<a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&format=feed&moduleID='.$module->id); ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<i class="k2icon-feed"></i>
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

</div>
