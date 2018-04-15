<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
// includes placehold
$yt_temp = JFactory::getApplication()->getTemplate();
include (JPATH_BASE . '/templates/'.$yt_temp.'/includes/placehold.php');

?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="latest-news-post <?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">

	<div class="prefix-head">            
       <?php if($params->get('itemPreText')): ?>
        <div class="pre-text"><?php echo $params->get('itemPreText'); ?></div>
        <?php endif; ?>
        <div class="sub-hr"><i class="fa fa-globe"></i></div>
    </div>

	<?php if(count($items)): ?>
  <ul class="list-post">
    <?php foreach ($items as $key=>$item):	
		if($key == 0) :
	?>
	
	
	 <li class="<?php if(count($items)==$key+1) echo ' lastItem'; ?>">

      <!-- Plugins: BeforeDisplay -->
      <?php echo $item->event->BeforeDisplay; ?>

      <!-- K2 Plugins: K2BeforeDisplay -->
      <?php echo $item->event->K2BeforeDisplay; ?>

      <?php if($params->get('itemAuthorAvatar')): ?>
	<a class="k2Avatar moduleItemAuthorAvatar" rel="author" href="<?php echo $item->authorLink; ?>">
		<img src="<?php echo $item->authorAvatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" style="width:<?php echo $avatarWidth; ?>px;height:auto;" />
	</a>
      <?php endif; ?>

      <!-- Plugins: AfterDisplayTitle -->
      <?php echo $item->event->AfterDisplayTitle; ?>

      <!-- K2 Plugins: K2AfterDisplayTitle -->
      <?php echo $item->event->K2AfterDisplayTitle; ?>

      <!-- Plugins: BeforeDisplayContent -->
      <?php echo $item->event->BeforeDisplayContent; ?>

      <!-- K2 Plugins: K2BeforeDisplayContent -->
      <?php echo $item->event->K2BeforeDisplayContent; ?>

    
      <div class="moduleItemIntrotext">
			<?php if($params->get('itemImage')): ?>
			<a class="img moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
				  <?php 	
				 $srcimage = '';
				 if(isset($item->image)){
					$srcimage =$item->image;  
					$imagesrcmain = YTTemplateUtils::resize($srcimage, '570', '390', 'fill');
				 }
				
				 //Create placeholder items images
				 if (!empty( $srcimage)) {								
					$thumb_img = '<img src="'.$imagesrcmain.'" alt="'.$item->title.'" />'; 
				 } else if ($is_placehold) {					
					$thumb_img = yt_placehold($placehold_size['k2user'],$item->title,$item->title); 
				 }	
				 echo $thumb_img;
				 ?>
			</a>
		  
			<?php endif; ?>
			<div class="main">
			
			<?php if($params->get('itemTitle')): ?>
			<h3 class="moduleItemTitle">
				<a  href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
			</h3>
			<?php endif; ?>

		  	<?php if($params->get('itemAuthor')): ?>
			    <div class="moduleItemAuthor">
			    	<?php echo JText::_('K2_CUSTOM_BY_NAME_AUTHOR'); ?>

					<?php if(isset($item->authorLink)): ?>
					<a rel="author" title="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" href="<?php echo $item->authorLink; ?>"><?php echo $item->author; ?></a>
					<?php else: ?>
					<?php echo $item->author; ?>
					<?php endif; ?>
					
					<?php if($params->get('userDescription')): ?>
					<?php echo $item->authorDescription; ?>
					<?php endif; ?>					
				</div>
			<?php endif; ?>

			<?php if($params->get('itemCategory')): ?>
				<div class="moduleItemCate">
					<i class="fa fa-folder-open-o"></i>		
					<a class="moduleItemCategory" style="color: <?php echo $color;?>" href="<?php echo $item->categoryLink; ?>"><?php echo $item->categoryname; ?></a>
				</div>		
			<?php endif; ?>

			<?php if($params->get('itemDateCreated')): ?>
			<span class="moduleItemDateCreated"><?php echo JHTML::_('date', $item->created, JText::_('d M Y')); ?></span>
			<?php endif; ?>
			<?php if($params->get('itemIntroText')): ?>
			<div class="introtext">
				<?php echo $item->introtext; ?>
			</div>
			<?php endif; ?>
		</div><!-- end main-->
      </div>
      <div class="clr"></div>
		
		 <?php
	  if($params->get('itemExtraFields') && count($item->extra_fields)): ?>
      <div class="moduleItemExtraFields">
	      <b><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></b>
	      <ul>
	        <?php foreach ($item->extra_fields as $extraField): ?>
					<?php if($extraField->value != ''): ?>
					<li class="type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
						<?php if($extraField->type == 'header'): ?>
						<h4 class="moduleItemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
						<?php else: ?>
						<span class="moduleItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
						<span class="moduleItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
						<?php endif; ?>
						<div class="clr"></div>
					</li>
					<?php endif; ?>
	        <?php endforeach; ?>
	      </ul>
      </div>
      <?php endif; ?>

      <div class="clr"></div>

      <!-- Plugins: AfterDisplayContent -->
      <?php echo $item->event->AfterDisplayContent; ?>

      <!-- K2 Plugins: K2AfterDisplayContent -->
      <?php echo $item->event->K2AfterDisplayContent; ?>


      <!-- Plugins: AfterDisplay -->
      <?php echo $item->event->AfterDisplay; ?>

      <!-- K2 Plugins: K2AfterDisplay -->
      <?php echo $item->event->K2AfterDisplay; ?>
    </li>
	
	<?php else :?>
    <li class="<?php if(count($items)==$key+1) echo ' lastItem'; ?>">

      <!-- Plugins: BeforeDisplay -->
      <?php echo $item->event->BeforeDisplay; ?>

      <!-- K2 Plugins: K2BeforeDisplay -->
      <?php echo $item->event->K2BeforeDisplay; ?>

      <?php if($params->get('itemAuthorAvatar')): ?>
	<a class="k2Avatar moduleItemAuthorAvatar" rel="author" href="<?php echo $item->authorLink; ?>">
		<img src="<?php echo $item->authorAvatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" style="width:<?php echo $avatarWidth; ?>px;height:auto;" />
	</a>
      <?php endif; ?>

      <!-- Plugins: AfterDisplayTitle -->
      <?php echo $item->event->AfterDisplayTitle; ?>

      <!-- K2 Plugins: K2AfterDisplayTitle -->
      <?php echo $item->event->K2AfterDisplayTitle; ?>

      <!-- Plugins: BeforeDisplayContent -->
      <?php echo $item->event->BeforeDisplayContent; ?>

      <!-- K2 Plugins: K2BeforeDisplayContent -->
      <?php echo $item->event->K2BeforeDisplayContent; ?>

    
      <div class="moduleItemIntrotext">
			<?php if($params->get('itemImage')): ?>
			<a class="img moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
				  <?php 	
				  $srcimage = '';
				 if(isset($item->image)){
					$srcimage =$item->image;  
					$imagesrcmain = YTTemplateUtils::resize($srcimage, '270', '180', 'fill');
				 }				 
				
				 //Create placeholder items images
				 if (!empty( $srcimage)) {								
					$thumb_img = '<img src="'.$imagesrcmain.'" alt="'.$item->title.'" />'; 
				 } else if ($is_placehold) {					
					$thumb_img = yt_placehold($placehold_size['k2user'],$item->title,$item->title); 
				 }	
				 echo $thumb_img;
				 ?>
			</a>
		  
			<?php endif; ?>
			<div class="main">
			
			<?php if($params->get('itemTitle')): ?>
			<h3 class="moduleItemTitle">
				<a  href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
			</h3>
			<?php endif; ?>

		  	<?php if($params->get('itemAuthor')): ?>
			    <div class="moduleItemAuthor">
			    	<?php echo JText::_('K2_CUSTOM_BY_NAME_AUTHOR'); ?>

					<?php if(isset($item->authorLink)): ?>
					<a rel="author" title="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" href="<?php echo $item->authorLink; ?>"><?php echo $item->author; ?></a>
					<?php else: ?>
					<?php echo $item->author; ?>
					<?php endif; ?>
					
					<?php if($params->get('userDescription')): ?>
					<?php echo $item->authorDescription; ?>
					<?php endif; ?>					
				</div>
			<?php endif; ?>

			<?php if($params->get('itemCategory')): ?>
				<div class="moduleItemCate">
					<i class="fa fa-folder-open-o"></i>		
					<a class="moduleItemCategory" style="color: <?php echo $color;?>" href="<?php echo $item->categoryLink; ?>"><?php echo $item->categoryname; ?></a>
				</div>		
			<?php endif; ?>

			<?php if($params->get('itemDateCreated')): ?>
			<span class="moduleItemDateCreated"><?php echo JHTML::_('date', $item->created, JText::_('d M Y')); ?></span>
			<?php endif; ?>
			<?php if($params->get('itemIntroText')): ?>
			<div class="introtext">
				<?php echo $item->introtext; ?>
			</div>
			<?php endif; ?>
		</div><!-- end main-->
      </div>
      <div class="clr"></div>
		
		 <?php
	  if($params->get('itemExtraFields') && count($item->extra_fields)): ?>
      <div class="moduleItemExtraFields">
	      <b><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></b>
	      <ul>
	        <?php foreach ($item->extra_fields as $extraField): ?>
					<?php if($extraField->value != ''): ?>
					<li class="type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
						<?php if($extraField->type == 'header'): ?>
						<h4 class="moduleItemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
						<?php else: ?>
						<span class="moduleItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
						<span class="moduleItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
						<?php endif; ?>
						<div class="clr"></div>
					</li>
					<?php endif; ?>
	        <?php endforeach; ?>
	      </ul>
      </div>
      <?php endif; ?>

      <div class="clr"></div>

      <!-- Plugins: AfterDisplayContent -->
      <?php echo $item->event->AfterDisplayContent; ?>

      <!-- K2 Plugins: K2AfterDisplayContent -->
      <?php echo $item->event->K2AfterDisplayContent; ?>


      <!-- Plugins: AfterDisplay -->
      <?php echo $item->event->AfterDisplay; ?>

      <!-- K2 Plugins: K2AfterDisplay -->
      <?php echo $item->event->K2AfterDisplay; ?>
    </li>
	<?php endif; ?>
	
    <?php endforeach; ?>
    <li class="clearList"></li>
  </ul>
  <?php endif; ?>

	

</div>
