<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$blockPosition = $displayData['params']->get('info_block_position', 0);

?>

    <div class="itemToolbar">
        <ul class="list-toolbar">
            <?php if ($displayData['params']->get('show_author') && !empty($displayData['item']->author )) : ?>
                <li>
                <?php echo JLayoutHelper::render('joomla.content.info_block.author', $displayData); ?>
                </li>
            <?php endif; ?>
			
			
			<?php if ($displayData['params']->get('show_parent_category') && !empty($displayData['item']->parent_slug)) : ?>
				<li>
				<?php echo JLayoutHelper::render('joomla.content.info_block.parent_category', $displayData); ?>
				 </li>
			<?php endif; ?>
            <?php if ($displayData['params']->get('show_category')) : ?>
                <li>
                <i class="fa fa-folder-open-o"></i>
                <?php echo JLayoutHelper::render('joomla.content.info_block.category', $displayData); ?>
                </li>
            <?php endif; ?>
			
            <?php if ($displayData['position'] == 'above' && ($blockPosition == 0 || $blockPosition == 2)
                || $displayData['position'] == 'below' && ($blockPosition == 1)
                ) : ?>
                <?php if ($displayData['params']->get('show_publish_date')) : ?>
                    <li>
					   <i class="fa fa fa-calendar"></i>
                    <?php echo JLayoutHelper::render('joomla.content.info_block.publish_date', $displayData); ?>
                    </li>
                <?php endif; ?>            
            <?php endif; ?>
            
            <?php if ($displayData['position'] == 'above' && ($blockPosition == 0)
                    || $displayData['position'] == 'below' && ($blockPosition == 1 || $blockPosition == 2)
                    ) : ?>
                
                <?php if ($displayData['params']->get('show_create_date')) : ?>
                    <li>
                    <i class="fa fa fa-calendar"></i>
                    <?php echo JLayoutHelper::render('joomla.content.info_block.create_date', $displayData); ?>
                    </li>
                <?php endif; ?>
                
                <?php if ($displayData['params']->get('show_modify_date')) : ?>
                    <li>
                    <i class="fa fa fa-calendar"></i>
                    <?php echo JLayoutHelper::render('joomla.content.info_block.modify_date', $displayData); ?>
                    </li>
                <?php endif; ?>                           
    
                <?php if ($displayData['params']->get('show_hits')) : ?>
                    <li>
					 <i class="fa fa-user" aria-hidden="true"></i>
                    <?php echo JLayoutHelper::render('joomla.content.info_block.hits', $displayData); ?>
                    </li>
                <?php endif; ?>
                
            <?php endif; ?>
        </ul>
    </div>
    <div class="clr"></div>
  
