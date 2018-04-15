<?php
/**
 * @package		AdsManager
 * @copyright	Copyright (C) 2010-2014 Juloa.com. All rights reserved.
 * @license		GNU/GPL
 */
// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

$conf= $this->conf;

$user = JFactory::getUser();

$document	= JFactory::getDocument();
if ($conf->metadata_mode != 'nometadata') {
	$document->setMetaData("description", strip_tags($this->content->metadata_description));
	$document->setMetaData("keywords", strip_tags($this->content->metadata_keywords));
}

$advertiser_ads = JText::_('ADSMANAGER_SHOW_OTHERS'); 
// $userprofilelink = JUri::root()."index.php?option=com_comprofiler&task=userprofile&id=".$this->content->userid;
?>
<div class="juloawrapper">
<?php if ($conf->display_inner_pathway == 1) { ?>
<div class="breadcrumb row-fluid">
<?php 
	$pathway ="";
	$nb = count($this->pathlist);
	for ($i = $nb - 1 ; $i >0;$i--)
	{
		$pathway .= '<a href="'.$this->pathlist[$i]->link.'">'.$this->pathlist[$i]->text.'</a>';
		$pathway .= ' <img src="'.getImagePath('arrow.png').'" alt="arrow" /> ';
	}
	$pathway .= '<a href="'.$this->pathlist[0]->link.'">'.$this->pathlist[0]->text.'</a>';
echo $pathway;

if (function_exists('getContentClass')) 
	$classcontent = getContentClass($this->content,"details");
else
	$classcontent = "";
?>   
</div>
<?php } ?>
<?php echo $this->content->event->onContentBeforeDisplay; ?>
<?php if (@$conf->print==1) {?>
<div class="text-right">
<?php if (JRequest::getInt('print',0) == 1) {
	echo TTools::print_screen();
} else {
	$url = "index.php?option=com_adsmanager&view=details&catid=".$this->content->catid."&id=".$this->content->id;
	echo TTools::print_popup($url); 
}?>
</div>
<?php } ?>
<div class="<?php echo $classcontent;?> adsmanager-details row-fluid">	
		<div class="span12 page-header">
        <?php 
			$class_style = ($this->content->parentid == "21" || $this->content->parentid == "25") ? "jobposition" : "";
		
		// echo JURI::root();
		?>
		
        <h1 class="no-margin-top <?php echo $class_style; ?>">	
			<?php 
			if (isset($this->fDisplay[1]))
			{
				foreach($this->fDisplay[1] as $field)
				{
					$c = $this->field->showFieldValue($this->content,$field); 
					if (($c !== "")&&($c !== null)) {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
                        if($field->name != 'ad_headline')
	                        echo "<span class='f".$field->name."'>";
						// if ($title != "")
							// echo "<b>".htmlspecialchars($title)."</b>: ";
						echo "$c ";
                        if($field->name != 'ad_headline')
                            echo "</span>";
					}
				}
			} ?>
		</h1>
		<div class="span8">
		<?php
			echo $this->content->event->onContentAfterTitle; 
		?>
		</div>
        <div class="span4">
            <?php
                echo '<div class="text-right">';
                if ($this->content->userid != 0 && $this->userid == $this->content->userid)	{
				?>
				<div>
				<?php
					$target = TRoute::_("index.php?option=com_adsmanager&task=write&catid=".$this->content->category."&id=".$this->content->id);
					echo "<a href='".$target."'>".JText::_('ADSMANAGER_CONTENT_EDIT')."</a>";
					echo "&nbsp;";
					$target = TRoute::_("index.php?option=com_adsmanager&task=delete&catid=".$this->content->category."&id=".$this->content->id);
					echo "<a onclick='return confirm(\"".htmlspecialchars(JText::_('ADSMANAGER_CONFIRM_DELETE'),ENT_QUOTES)."\")' href='".$target."'>".JText::_('ADSMANAGER_CONTENT_DELETE')."</a>";
				?>
				</div>
				<?php
				}
	            if(isset($this->conf->favorite_enabled) && $this->conf->favorite_enabled == 1 && ($this->conf->favorite_display == 'all' || $this->conf->favorite_display == 'details')){
                    echo '<div class="row-fluid adsmanager-favorite">
                            <div class="span12">';
	                $favoriteClass = '';
	                $favoriteLabel = JText::_('ADSMANAGER_CONTENT_FAVORITE');
	                if(array_search($this->content->id, $this->favorites) !== false){
	                    $favoriteClass = ' like_active';
	                    $favoriteLabel = JText::_('ADSMANAGER_CONTENT_FAVORITE_DELETEMSG');
	                }
                echo '<button id="like_'.$this->content->id.'" class="btn favorite_ads like_ad'.$favoriteClass.'">'.$favoriteLabel.'</button>';
                    echo '</div></div>';
					}
                if (!empty($this->fDisplay[4])) {
                    echo '<div class="row-fluid">
                            <div class="span12">';
				$strtitle = @JText::_($this->positions[3]->title);
				if ($strtitle != "") echo "<h2 class='section-header'>".@$strtitle."</h2>"; 
				foreach($this->fDisplay[4] as $field)
				{
					$c = $this->field->showFieldValue($this->content,$field); 
					
					if (($c !== "")&&($c !== null)) {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
                        	echo "<span class='f".$field->name."'>";
                        if ($title != "")
							echo "<b>".htmlspecialchars($title)."</b>: ";
						echo "$c<br/>";
                        echo "</span>";
					}
				} 
                    echo '</div></div>';
                }
                echo '</div>';
                ?>
		</div>
	</div>
	
	<?php

		if($this->content->parentid == "21" || $this->content->parentid == "25"){
							
			$deadline = ($this->content->parentid == "25") ? $this->content->ad_deadline : $this->content->ad_applicationsdeadline;
			if($deadline !=""){
				?>
				<div id="date_bar">
					<p class="deadline_on"><?php echo JText::_('ADSMANAGER_JOB_DEADLINE'). " : ".$deadline; ?></p>
				</div>
				<?php
			}
			
			
			if(!empty($this->content->ad_companylabel) || !empty($this->content->ad_societe)){
				$ste = ($this->content->parentid == "25") ? $this->content->ad_societe : $this->content->ad_companylabel;
				
				if(!empty($this->content->ad_siteweb))
					$wwwste = ($this->content->parentid == "25") ? "http://www.".$this->content->ad_siteweb : "http://www.".$this->content->ad_wwwcompany;
				else
					$wwwste="";
				
				?>
				<div id="ste_block">
					<h2><?php echo JText::_('ADSMANAGER_JOB_COMPANY'); ?></h2>
					<div class="adsmanager-images float-left-jobblock">
						<?php
						
							foreach($this->content->images as $img)
							{
								$thumbnail = JURI_IMAGES_FOLDER."/".$img->thumbnail;
								$image = JURI_IMAGES_FOLDER."/".$this->content->images->image;
								echo "<img src='".$thumbnail."' alt=\"".htmlspecialchars($this->content->ad_headline)."\" />";
							}
						?>
					</div>
					<div id="ste">
						<h3><strong><?php echo $ste; ?></strong></h3><p><?php echo $wwwste; ?></p>
						<div>
							<?php 
								if($user->id == $this->content->userid){
									$myads = JText::_('ADSMANAGER_SEE_MY_ADS'); 
										$target = TLink::getUserAdsLink($this->content->userid);
										
										echo "<br/><a href='$target'><b>".$myads."</b></a>";
										
								}else if (($this->content->userid != 0) && ($this->content->userid != $user->id)){
									$target = TLink::getUserAdsLink($this->content->userid);
									
									if ($conf->display_fullname == 1)
										echo "<a href='$target'><b>".$advertiser_ads."</a></b> ".$this->content->fullname;
									else
										echo "<a href='$target'><b>".$advertiser_ads."</a></b> ".$this->content->user;
								}
							?>
						</div>
					</div>
				</div>
				<?php
			}
		
		?>
			<h2><?php echo JText::_('ADSMANAGER_JOB_DETAILS'); ?></h2>
			<div id="job_detail_block"><h3><?php echo JText::_('ADSMANAGER_JOB_POSITION')." : ".$this->content->ad_headline; ?></h3>
		<?php
		}
	?>
	
	<div class="row-fluid">
		<div class="span4 adsmanager-images text-center">
			<?php
				$this->loadScriptImage($this->conf->image_display);
				if (count($this->content->images) == 0)
					$image_found = 0;
				else
					$image_found = 1;
				
				
				if($this->content->parentid == "21" || $this->content->parentid == "25")
					echo "";
				else{
                ?>
                <div class="adsmanager_ads_image">
                <?php 
				foreach($this->content->images as $img)
				{
					$thumbnail = JURI_IMAGES_FOLDER."/".$img->thumbnail;
					$image = JURI_IMAGES_FOLDER."/".$img->image;
					switch($this->conf->image_display)
				    {
				    	case 'popup':
							echo "<a href=\"javascript:popup('$image');\"><img src='".$thumbnail."' alt=\"".htmlspecialchars($this->content->ad_headline)."\" /></a>";
							break;
						case 'lightbox':
						case 'lytebox':
							echo "<a href='".$image."' rel='lytebox[roadtrip".$this->content->id."]'><img src='".$thumbnail."' alt=\"".htmlspecialchars($this->content->ad_headline)."\" /></a>"; 
							break;
						case 'highslide':
							echo "<a id='thumb".$this->content->id."' class='highslide' onclick='return hs.expand (this)' href='".$image."'><img src='".$thumbnail."' alt=\"".htmlspecialchars($this->content->ad_headline)."\" /></a>";
							break;
						case 'default':	
						default:
							echo "<a href='".$image."' target='_blank'><img src='".$thumbnail."' alt=\"".htmlspecialchars($this->content->ad_headline)."\" /></a>";
							break;
					}
				}
                if (($image_found == 0)&&($conf->nb_images >  0))
                {
                    echo '<img src="'.ADSMANAGER_NOPIC_IMG.'" alt="nopic" />'; 
                }?>
                </div>
				<?php } ?>
        </div>
        <div class="span8 adsmanager-infos">
            <div class="row-fluid">
		<div class="span12">
			 <?php if (!empty($this->fDisplay[3])) {
				$strtitle = @JText::_($this->positions[2]->title);
				if ($strtitle != "") echo "<h2 class='section-header'>".@$strtitle."</h2>"; 
				foreach($this->fDisplay[3] as $field) {
					$c = $this->field->showFieldValue($this->content,$field); 
					if (($c !== "")&&($c !== null)) {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
						
						$c = JString::substr($c, 0, 1000);
						if (strlen($c)>1000) {
							$c .= "";
						}
						
                        echo "<span class='f".$field->name."'>";
						if ($title != "")
							echo "<b>".htmlspecialchars($title)."</b>: ";
						echo "$c<br/>";
                        echo "</span>";
					}
				}
			}?>
			
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<?php if (!empty($this->fDisplay[2])) {
				$strtitle = @JText::_($this->positions[1]->title);
				if ($strtitle != "") echo "<h2 class='section-header'>".@$strtitle."</h2>"; 
				foreach($this->fDisplay[2] as $field) {
					$c = $this->field->showFieldValue($this->content,$field); 
					if (($c !== "")&&($c !== null)) {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
						
                        echo "<span class='f".$field->name."'>";
						if ($title != "")
							echo "<b>".htmlspecialchars($title)."</b>: ";
						echo "$c<br/>";
                        echo "</span>";
					}
				}
			}
			?>
			
		</div>
    </div>
	<div class="row-fluid">
		<div class="span12">
			<?php if (!empty($this->fDisplay[6])) {
				$strtitle = @JText::_($this->positions[5]->title);
				if ($strtitle != "") echo "<h2 class='section-header'>".@$strtitle."</h2>";
				
				if($this->content->parentid == "21" || $this->content->parentid == "25"){ 
					echo "<p><b>".JText::_('ADSMANAGER_JOB_CONTRACT')."</b> : ".$this->content->cat."</p>";
				}
				
				foreach($this->fDisplay[6] as $field) {
					$c = $this->field->showFieldValue($this->content,$field); 
					if (($c !== "")&&($c !== null)) {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
                        echo "<span class='f".$field->name."'>";
						if ($title != "")
							echo "<b>".htmlspecialchars($title)."</b>: ";
						echo "$c<br/>";
                        echo "</span>";
					}
				}
			} ?>
		
		</div>
	</div>
	<?php
		$publisher_contact = ($this->content->parentid == "21" || $this->content->parentid == "25") ? '': 'id="contact_publisher"'; 
	?>
	
	<div class="row-fluid" <?php echo $publisher_contact; ?> >
		<div class="span12">
			<?php if (!empty($this->fDisplay[5])) {
				$strtitle = ($this->content->parentid == "21" || $this->content->parentid == "25") ? "" : @JText::_($this->positions[4]->title);
				
				if ($strtitle != "") echo "<h2 class='section-header'>".@$strtitle."</h2>"; 
			
				if ($this->showContact) {
					if($user->id == $this->content->userid){
						$myads = JText::_('ADSMANAGER_SEE_MY_ADS'); 
							$target = TLink::getUserAdsLink($this->content->userid);
							
							echo "<br/><a href='$target'><b>".$myads."</b></a>";
							
					}else if (isset($this->fDisplay[5])){	
						foreach($this->fDisplay[5] as $field)
						{	
							$c = $this->field->showFieldValue($this->content,$field); 
							
							if(($c !== "")&&($c !== null)) {
								$title = $this->field->showFieldTitle(@$this->content->catid,$field);
		                        echo "<span class='f".$field->name."'>";
                                if ($title != "")
									echo "<b>".htmlspecialchars($title)."</b>: <br />";
								echo "$c<br/>";
                                echo "</span>";
							}
						} 
					}
					
					if (($this->content->userid != 0)&&($conf->allow_contact_by_pms == 1)){
						echo TLink::getPMSLink($this->content);
					}
					
				}else if($this->content->parentid == "21" || $this->content->parentid == "25"){
					echo "<p class=\"mandatory text-center\">" .JText::_('ADSMANAGER_CONTACT_CONNECT_TO_APPLY_THIS_JOB')."</p>";
				}else{
					echo JText::_('ADSMANAGER_CONTACT_NO_RIGHT');
				}
			}
            
			if($this->content->parentid == "21" || $this->content->parentid == "25"){
				echo "";
			}else{
				?>
				<div>
					<?php 
					if (($this->content->userid != 0) && ($this->content->userid != $user->id))
					{
						$target = TLink::getUserAdsLink($this->content->userid);
						if(($this->content->name != $this->content->user) || ($this->content->name != $this->content->fullname))
							echo "<a href='$target'><b>".$advertiser_ads."</a></b> ".$this->content->name;
						else if ($conf->display_fullname == 1)
							echo "<a href='$target'><b>".$advertiser_ads."</a></b> ".$this->content->fullname;
						else
							echo "<a href='$target'><b>".$advertiser_ads."</a></b> ".$this->content->user;
					}
					?>
				</div>
				<?php
			}
			?>
			
		</div>
	</div>
        </div>
    </div>
	
	<?php
		if($this->content->parentid == "21" || $this->content->parentid == "25")
			echo "</div>";
		
	?>
</div>
<?php echo $this->content->event->onContentAfterDisplay; ?>
<div class="back_button text-center">
<a href='javascript:history.go(-1)'>
<div class="btn"><?php echo JText::_('ADSMANAGER_BACK_TEXT'); ?></div>
</a>
</div>
<script type="text/JavaScript">
jQ(function() {
	jQ('.favorite_ads').click(function() {
        var favoriteId = this.getAttribute( "id" );
        favoriteId = favoriteId.split('like_');
        var adId = favoriteId[1];
        var id = '#like_'+adId;

        if(jQ(id).hasClass("like_active")) {
            jQ.ajax({ url: <?php echo json_encode(JRoute::_('index.php?option=com_adsmanager&task=deletefavorite&mode=1'))?>,
                data: {adId: adId},
                type: 'post',
                success: function(result) {
                    if(result == 1){
                        jQ(id).removeClass("like_active");
                        jQ(id).html('<span class="glyphicon glyphicon-heart" aria-hidden="true"></span> <?php echo addslashes(JText::_('ADSMANAGER_CONTENT_FAVORITE')); ?>');
                        //alert('<?php echo addslashes(JText::_('ADSMANAGER_CONTENT_FAVORITE_DELETE')); ?>');
                    } else if(result == 2) {
                        <?php if(COMMUNITY_BUILDER): ?>
                        window.location.replace(<?php echo json_encode(JRoute::_('index.php?option=com_comprofiler&task=login'))?>);
                        <?php else: ?>
                        window.location.replace(<?php echo json_encode(JRoute::_('index.php?option=com_users&view=login'))?>);
                        <?php endif; ?>
                    } else if(result == 3) {
                        alert('<?php echo addslashes(JText::_('ADSMANAGER_CONTENT_FAVORITE_NO_AD_SELECTED')); ?>');
                    }
                }
            });
        } else {
            jQ.ajax({ url: <?php echo json_encode(JRoute::_('index.php?option=com_adsmanager&task=favorite'))?>,
                data: {adId: adId},
                type: 'post',
                success: function(result) {
                    if(result == 1){
                        jQ(id).addClass("like_active");
                        jQ(id).html('<span class="glyphicon glyphicon-heart" aria-hidden="true"></span> <?php echo addslashes(JText::_('ADSMANAGER_CONTENT_FAVORITE_DELETEMSG')); ?>');
                       // alert('<?php echo addslashes(JText::_('ADSMANAGER_CONTENT_FAVORITE_SUCCESS')); ?>');
                    } else if(result == 2) {
                        <?php if(COMMUNITY_BUILDER): ?>
                        window.location.replace(<?php echo json_encode(JRoute::_('index.php?option=com_comprofiler&task=login'))?>);
                        <?php else: ?>
                        window.location.replace(<?php echo json_encode(JRoute::_('index.php?option=com_users&view=login'))?>);
                        <?php endif; ?>
                    } else if(result == 3) {
                        alert('<?php echo addslashes(JText::_('ADSMANAGER_CONTENT_FAVORITE_NO_AD_SELECTED')); ?>');
                    } else {
                        alert('<?php echo addslashes(JText::_('ADSMANAGER_CONTENT_FAVORITE_ALREADY_EXIST')); ?>');
                    }
                }
            });
        }
        return false;       
    });
});
</script>
</div>