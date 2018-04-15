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

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2TagCloudBlock">
	<strong class="title-tag"><?php echo JText::_('K2_TITLE_TAG'); ?></strong>
	<?php 
		$count_tag = count($tags);
		foreach ($tags as $tag):
			if(!empty($tag->tag)): 
				$count_tag	= $count_tag - 1;
				if( $count_tag > 0 ) {
					$k = ",";
				} else {
					$k = "";
				}
	?>
	<span class="items-tag">
		<a class="item-tag" href="<?php echo $tag->link; ?>" title="<?php echo $tag->count.' '.JText::_('K2_ITEMS_TAGGED_WITH').' '.K2HelperUtilities::cleanHtml($tag->tag); ?>">
			<span class="name-tag"> <?php echo $tag->tag . $k . ''; ?></span>
		</a>
	</span>
	<?php endif; ?>
	<?php endforeach; ?>
	<div class="clr"></div>
</div>
