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

<div id="k2ModuleBox<?php echo $module->id; ?>" class="mega_k2 <?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">

	<?php if($params->get('itemPreText')): ?>
	<p class="modulePretext"><?php echo $params->get('itemPreText'); ?></p>
	<?php endif; ?>

	<?php if(count($items)): ?>
  <ul>
    <?php foreach ($items as $key=>$item):	?>
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
				 //Create placeholder items images
				 if(isset($item->image)){
				 $src =$item->image;  }
				 if (!empty( $src)) {								
					 $thumb_img = '<img src="'.$src.'" alt="'.$item->title.'" />'; 
				 } else if ($is_placehold) {					
					 $thumb_img = yt_placehold($placehold_size['k2user'],$item->title,$item->title); 
					//var_dump( $thumb_img);
				 }	
				 echo $thumb_img;
				 ?>
			</a>
		  
			<?php endif; ?>
			<div class="main">
			<?php if($params->get('itemCategory')): ?>
				
			<?php
			$string_color1=strstr($item->categoryname, "|" );
			$string_color2=str_replace("|", "#", $string_color1);
			if ($string_color2 !=""){
				$color= $string_color2;
			}else{
				$color="#999";
			}
			$string_cate=str_replace($string_color1, "", $item->categoryname);
			?>
			<a class="moduleItemCategory" style="color: <?php echo $color;?>" href="<?php echo $item->categoryLink; ?>"><?php echo $string_cate; ?></a>
			<?php endif; ?>
			<?php if($params->get('itemTitle')): ?>
			<h3 class="moduleItemTitle">
				<a  href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
			</h3>
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
    <?php endforeach; ?>
    <li class="clearList"></li>
  </ul>
  <?php endif; ?>

	

</div>
