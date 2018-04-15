<?php
/*
 * ------------------------------------------------------------------------
 * Copyright (C) 2009 - 2013 The YouTech JSC. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: The YouTech JSC
 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
 * ------------------------------------------------------------------------
*/

defined('_JEXEC') or die;
/*
 * Module chrome that allows for ytmod corners by wrapping in nested div tags
 */
 
 
function modChrome_ytmod($module, &$params, &$attribs){ ?>
    <?php
	$badge = preg_match ('/badge/', $params->get('moduleclass_sfx')) ? "<span class=\"badge\"></span>\n" : "";
	$scrollreveal = $params->get('header_class');
	
	$icons  = '';
	if(strpos($params->get('moduleclass_sfx'), 'fa-')===false){
       $modclass_sfx = $params->get('moduleclass_sfx');
    }else{
        $modclass_sfx = explode("fa-", $params->get('moduleclass_sfx'));
		$arr = explode(' ',trim($modclass_sfx[1]));
		
		$fontName = $arr[0]; /* Get Font Awesome Names*/
		$modclass_sfx2 = str_replace('fa-'.$fontName, '', $params->get('moduleclass_sfx'));
	
        $icons = "<i class='fa fa-".$fontName."'></i>";
        $modclass_sfx = "style-icon ".$modclass_sfx2;
    }
	
	$full= strpos($modclass_sfx, 'full-container' );
	?>
	
	<div class="module <?php echo $modclass_sfx ?> " <?php echo ($scrollreveal !='')?  'data-anijs="'. $scrollreveal.'"' : '' ; ?>>
		 <?php if ($full) : ?>
		 <div class="container">
		 <?php endif; ?>
			<?php if ((bool) $module->showtitle) : ?>
			   <?php
				  $title_before=strstr( $module->title, '|' );
				  if ($title_before){
					 $title_after=str_replace( '|','', $title_before );
					 $title_trim= trim($title_after);
					 $number=str_replace( $title_before,'', $module->title );
					 $number1=substr ( $number , 0,1 );
					 $number2=substr ( $number , 1, 1 );
					 $space_firt=strpos($title_trim, ' ');
					 $title_firt=substr ( $title_trim , 0, $space_firt);
					 $title_normal = str_replace( $title_firt,'', $title_trim );
				  }else{
					 $title_trim= trim($module->title);
					 $space_firt=strpos($title_trim, ' ');
					 $title_firt=substr ( $title_trim , 0, $space_firt);
					 $title_normal = str_replace( $title_firt,'', $title_trim );
				  }
				  
				  
			   ?>
				<h3 class="modtitle">
				<?php echo $icons; ?>
				  <?php if($title_before != ""){?>
				  <span class="title">
					 <span class="number">
						<span class="number1"><?php echo $number1; ?></span>
						<span class="number2"><?php echo $number2 ;?></span>
					 </span>
					 <span class="title-color"><?php echo $title_firt;?></span>
					 <span class="title-normal"><?php echo $title_normal;?></span>
				  </span>
				  <?php } else{ ?>
				  <span class="title">
					 <span class="title-color"><?php echo $title_firt;?></span>
					 <span class="title-normal"><?php echo $title_normal;?></span>
				  </span>
				  <?php } ?>
				<?php echo $badge; ?>
				</h3>
			<?php endif; ?>
		   <div class="modcontent clearfix">
			   <?php echo $module->content; ?>
		   </div>
		 <?php if ($full) : ?>
		 </div>
		 <?php endif; ?>
	</div>
    <?php
}
 ?>
    
<?php
function modChrome_special($module, &$params, &$attribs){ ?>
    <?php
	$badge = preg_match ('/badge/', $params->get('moduleclass_sfx')) ? "<span class=\"badge\"></span>\n" : "";
	$icons = preg_match ('/fa/', $params->get('moduleclass_sfx'))?"<span class=\"fa\">&nbsp;</span>\n":"";
    if(strpos($params->get('moduleclass_sfx'), '@')===false){
        $moduleclass_sfx = $params->get('moduleclass_sfx');
        $ico_sfx = 'fa fa-pushpin';
    }else{
        $moduleclass_sfx = explode("@", $params->get('moduleclass_sfx'));
        $ico_sfx = 'fa fa-'.trim($moduleclass_sfx[1]);
        $moduleclass_sfx = trim($moduleclass_sfx[0]);
    }
    
	?>
	
	<div class="module <?php echo $moduleclass_sfx ?>">
		<span class="btn-special" title="<?php echo $module->title;?>"><span class="<?php echo $ico_sfx ?>"></span><?php echo (isset($attribs['title']) && ($attribs['title']==1))?$module->title:''; ?></span>
		<div class="box-special">
			<?php if ((bool) $module->showtitle) : ?>
				<h3 ><?php //echo $icons; ?><?php echo $module->title; ?><?php echo $badge; ?></h3>
			<?php endif; ?>
			<div class="clearfix">
			<?php echo $module->content; ?>
			</div>
		</div>
	</div>
    <?php
}

?>


