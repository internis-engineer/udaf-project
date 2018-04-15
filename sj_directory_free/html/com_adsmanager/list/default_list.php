<?php
/**
 * @package		AdsManager
 * @copyright	Copyright (C) 2010-2014 Juloa.com. All rights reserved.
 * @license		GNU/GPL
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );
?>
<div class="container-fluid">	
<table class="adsmanager_table table table-striped">
	
<?php
// $contentsizer = sizeof($this->contents);
	// $nbitemincat = ($contentsizer == 1) ? JText::_('ADSMANAGER_AD_IN') : JText::_('ADSMANAGER_ADS_IN');
	
  // echo "<h3><strong>" .$contentsizer. "</strong> ".$nbitemincat."</h3>";

foreach($this->contents as $content) 
{
	$linkTarget = TRoute::_( "index.php?option=com_adsmanager&view=details&id=".$content->id."&catid=".$content->catid);
	
	if (function_exists('getContentClass')) 
        $classcontent = getContentClass($content,"list");
    else
        $classcontent = "";
    ?>   
    <tr class="adsmanager_table_description <?php echo $classcontent;?> trcategory_<?php echo $content->catid?>"> 
        <td>
			<div id="ad-container">
            <?php
			$quartier = "";
			if(!empty($content->ad_quartier) || !empty($content->ad_district))
				$quartier = (!empty($content->ad_quartier) || !empty($content->ad_district)) ? $content->ad_quartier : $content->ad_district;
			else
				$quartier = false;
			
			if($content->parentid == 2 || $content->parentid == 22 || $content->parentid == 24 || $content->parentid == 26 || $content->parentid == 27){
				$quartier = (($quartier) AND ($content->parentid == 2)) ? $content->ad_quartier : $content->ad_district;
				//Immobilier à louer ou à vendre
				echo '<div id="header_immo">
					<h4><a class="align-right" href="'.$linkTarget.'">'.$content->ad_headline.'</a></h4>
					<p>'.(($content->parentid == 26 || $content->parentid == 27) ? "" : $content->ad_city.$quartier).'</p>
					</div>';
			}else if ($content->parentid == 18 || $content->parentid == 19){
				?>
				<div class="hearder-ad">
					<h4 class="no-margin-top">
						<?php echo '<a href="'.$linkTarget.'">'.$content->ad_headline.'</a>'; ?>
					</h4>
					<p class="location"><?php echo $content->ad_city; ?> <br/> <?php echo $quartier; ?></p>
				</div>
				<?php
			}else if($content->parentid == 98 || $content->parentid == 20
				|| $content->parentid == 10 || $content->parentid == 88 || $content->parentid == 17 
				|| $content->parentid == 23 || $content->parentid == 18){
					
					$titre = ($content->parentid AND $content->parentid != 17 ) ? $content->ad_typevoiture.' | '.$content->ad_marque.' '.$content->ad_modele.' '.$content->ad_annee : $content->ad_headline;
					
				echo '<div id="header_autos">
					<h4><a class="align-right" href="'.$linkTarget.'">'.$titre.'</a></h4><p>'.$content->ad_city.$quartier.'</p>
					</div>';
			}
			
			if($content->parentid == 21 || $content->parentid == 25){
				echo "";
			}else{
				if (isset($content->images[0])) {
					echo "<a href='".$linkTarget."' class='intro-pic'><img class='fad-image' name='ad-image".$content->id."' src='".JURI_IMAGES_FOLDER."/".$content->images[0]->thumbnail."' alt=\"".htmlspecialchars($content->ad_headline)."\" /></a>";
				} else if ($this->conf->nb_images > 0) {
						echo "<a href='".$linkTarget."' class='intro-pic'><img class='fad-image' src='".ADSMANAGER_NOPIC_IMG."' alt='nopic' /></a>";
				}
			}
            
			if($content->parentid == 21 || $content->parentid == 25){
				?>
				<div class="descjob">
				<?php
			}else if($content->parentid == 1 || $content->parentid == 20){
				?>
				<div class="descautos">
				<?php
			}else if($content->parentid == 88){
				?>
				<div class="rentcar">
				<?php
			}else{
				?>
				<div class="desc">
				<?php
			}	
			
					//Cat 21 and 25 are jobs and 'emploi' categories.. more fields value are not displayed for these cats
					$jobPosition = addslashes(JText::_('ADSMANAGER_JOB_POSITION'));
					$typeContract = addslashes(JText::_('ADSMANAGER_JOB_CONTRACT'));
					$jobCity    = addslashes(JText::_('ADSMANAGER_JOB_CITY'));
					$deadline    = JText::_('ADSMANAGER_JOB_DEADLINE');
					
						if($content->parentid == 21 || $content->parentid == 25){
							
							$content->ad_text = strip_tags(str_replace ('<br />'," ",$content->ad_text));
							$af_text_short = JString::substr($content->ad_text, 0, 100);
							if (strlen($content->ad_text)>100) {
								$af_text_short .= "[...]";
							}
							
							$tableHtml = '<div class="content_job">';
							if ($content->parentid == 21){
								?>
									<div class="hearder-ad">
										<h4 class="no-margin-top">
											<?php echo '<a href="'.$linkTarget.'">'.$content->ad_headline.'</a>'; ?>
										</h4>
										<p class="location"><?php echo $content->ad_city; ?> <br/> <?php echo $quartier; ?></p>
									</div>
								
								<?php
								if(isset($content->images[0])) {
									$tableHtml .= "<a href='".$linkTarget."' class='intro-pic'><img class='fad-image' name='ad-image".$content->id."' src='".JURI_IMAGES_FOLDER."/".$content->images[0]->thumbnail."' alt=\"".htmlspecialchars($content->ad_jobposition)."\" /></a>";
								} else if ($this->conf->nb_images > 0) {
									$tableHtml .= "<a href='".$linkTarget."' class='intro-pic'><img class='fad-image' src='".ADSMANAGER_NOPIC_IMG."' alt='nopic' /></a>";
								}
								
								$ad_applicationsdeadline = ($content->ad_applicationsdeadline == "") ? '' : $deadline.' :<br/> '.$content->ad_applicationsdeadline;
								
								$tableHtml .= '<div class="job_position">
										<p class="job_desc">'.$af_text_short.'</p>
										<p>'.$typeContract.' : <br/>  '.$content->cat.'</p>
										<p>'.$ad_applicationsdeadline.'</p></div>
										';
										
							}else{
								?>
									<div class="hearder-ad">
										<h4 class="no-margin-top">
											<?php echo '<a href="'.$linkTarget.'">'.$content->ad_headline.'</a>'; ?>
										</h4>
										<p class="location"><?php echo $content->ad_city; ?> <br/> <?php echo $quartier; ?></p>
									</div>
								<?php
								if(isset($content->images[0])) {
										$tableHtml .= "<a href='".$linkTarget."' class='intro-pic'><img class='fad-image' name='ad-image".$content->id."' src='".JURI_IMAGES_FOLDER."/".$content->images[0]->thumbnail."' alt=\"".htmlspecialchars($content->ad_postefontion)."\" /></a>";
								} else if ($this->conf->nb_images > 0) {
										$tableHtml .= "<a href='".$linkTarget."' class='intro-pic'><img class='fad-image' src='".ADSMANAGER_NOPIC_IMG."' alt='nopic' /></a>";
								}
								$ad_deadline = ($content->ad_deadline == "") ? '' : $deadline.' :<br/> '.$content->ad_deadline;
		
								$tableHtml .= '<div class="job_position">
										<p class="job_desc">'.$af_text_short.'</p>
										<p>'.$typeContract.' :<br/> '.$content->cat.'</p>
										<p>'.$ad_deadline.'</p></div>';
							}
								
							$tableHtml .= '</div>';
							echo $tableHtml;
							
						}else if($content->parentid == 98 || $content->parentid == 20 || $content->parentid == 88){
							$content->ad_text = strip_tags(str_replace ('<br />'," ",$content->ad_text));
							$af_text_short = JString::substr($content->ad_text, 0, 100);
							if (strlen($content->ad_text)>100) {
								$af_text_short .= "[...]";
							}
							
							$price_auto = number_format($content->ad_price, 0, ' ', ' '). "".JText::_('ADSMANAGER_CURRENCY_UNIT');
							
							// echo JPATH_BASE;
							
							$tableHtml = '<div class="content_autos">';
							
							if ($content->parentid == 88){
								$tableHtml .= '
									<div class="align-left rentcar">
										<p class="doors">'.$content->ad_nbdoors.' '.JText::_('ADSMANAGER_DOORS').'</p>
										<p class="places">'.$content->ad_places.' '.JText::_('ADSMANAGER_JOB_NBPLACES').'</p>
										<p class="transmssion">'.JText::_('ADSMANAGER_VEHICLE_TRANSMISSION').' : '.$content->ad_transmission.'</p>
									</div>';
									
									foreach($this->columns as $col) {
										echo '<div class="tdcenter column_'.$col->id.' hidden-phone">';
											if (isset($this->fColumns[$col->id]))
												foreach($this->fColumns[$col->id] as $field)
												{	
													$c = $this->field->showFieldValue($content,$field); 
													if (($c !== "")&&($c !== null)) {
														$title = $this->field->showFieldTitle(@$content->catid,$field);
														echo "<span class='f".$field->name."'>";
														if ($title != "")
															echo "<b>".htmlspecialchars($title)."</b>: ";
														echo "$c<br/>";
														echo "</span>";
													}
												}
											echo "</div>";
										
									}
							}
							if ($content->parentid == 98){
								
								$tableHtml .= '
									<p class="fad_price">'.$price_auto.'</p>
									<div class="wrap">
										<div class="align-left">
											<p class="marque">'.$content->ad_marque.'</p>
											<p class="modele">'.$content->ad_modele.'</p>
											<p class="annee">'.JText::_('ADSMANAGER_VEHICLE_YEAR').' : '.$content->ad_annee.'</p>
										</div>
										<div class="align-left">
											<p class="typevoiture">'.$content->ad_typevoiture.'</p>
											<p class="carburant">'.$content->ad_carburant.'</p>
											<p class="kilom">'.$content->ad_kilom.' Km</p>
										</div>
										<div class="align-left">
											<p class="doors">'.JText::_('ADSMANAGER_DOORS').' : '.$content->ad_nbdoors.'</p>
											<p class="transmssion">'.JText::_('ADSMANAGER_VEHICLE_TRANSMISSION').' : '.$content->ad_transmission.'</p>
										</div>
										<span class="clr"></span>
									</div>
									';
								
							}
							
							$tableHtml .= '
							</div>';
							echo $tableHtml;
						}else{
							$class_style = ''; 
							
							
							
							echo '<div class="more_fields ">';
									if($content->parentid == 2 || $content->parentid == 22){
										
										$rooms = ($content->parentid == 2) ? $content->ad_nbpieces : $content->ad_rooms;
										$area = ($content->parentid == 2) ? $content->ad_superficie : $content->ad_area;
										
										$class_style = 'class = "immo_text"';
										echo (isset($rooms) && !empty($rooms)) ? "<span class='f".$field->name."'>" .JText::_('ADSMANAGER_FORM_NBR_ROOMS').": ".$rooms. "</span>" : "";
										echo (isset($area) && !empty($area)) ? "<span class='immo_area'>" .JText::_('ADSMANAGER_FORM_SIZER').": ".intval($area).JText::_('ADSMANAGER_FORM_UNIT'). "</span>" : "";
										$ad_price = (intval($content->ad_price) < 0) ? -1 * intval($content->ad_price) : intval($content->ad_price);
										
										if($content->parentid == 2){
											$ad_prixloyer = (intval($content->ad_prixloyer) < 0) ? -1 * intval($content->ad_prixloyer) : intval($content->ad_prixloyer); 
											echo ($content->catid == 40) ? "<span class='f".$field->name." immo_price'>" .number_format($ad_prixloyer, 0, ' ', ' '). "".JText::_('ADSMANAGER_FORM_MENSUAL')."</span>" : "<span class='f".$field->name." immo_price'>" .number_format($ad_price, 0, ' ', ' '). "".JText::_('ADSMANAGER_CURRENCY_UNIT')."</span>";
										}else{
											$ad_rentprice = (intval($content->ad_rentprice) < 0) ? -1 * intval($content->ad_rentprice) : intval($content->ad_rentprice); 
											echo ($content->catid == 29) ? "<span class='f".$field->name." immo_price'>" .number_format($ad_rentprice, 0, ' ', ' '). "".JText::_('ADSMANAGER_FORM_MENSUAL')."</span>" : "<span class='f".$field->name." immo_price'>" .number_format($ad_price, 0, ' ', ' '). "".JText::_('ADSMANAGER_CURRENCY_UNIT')."</span>";
										}
									}else if ($content->parentid == 18 || $content->parentid == 19){
										echo "";
									}else{
										foreach($this->columns as $col) {
											
												echo '<div class="tdcenter column_'.$col->id.' hidden-phone">';
												if (isset($this->fColumns[$col->id]))
													foreach($this->fColumns[$col->id] as $field)
													{	
														$c = $this->field->showFieldValue($content,$field); 
														if (($c !== "")&&($c !== null)) {
															$title = $this->field->showFieldTitle(@$content->catid,$field);
															echo "<span class='f".$field->name."'>";
															if ($title != "")
																echo "<b>".htmlspecialchars($title)."</b>: ";
															echo "$c<br/>";
															echo "</span>";
														}
													}
												echo "</div>";
											
										}
									}
							echo "
							<div class='clr'></div>
							</div>";
							
							$content->ad_text = strip_tags(str_replace ('<br />'," ",$content->ad_text));
							$af_text = JString::substr($content->ad_text, 0, 100);
							if (strlen($content->ad_text)>100) {
								$af_text .= "[...]";
							}
							
							echo "<p ".$class_style." >" .$af_text. "</p>";
						}
						
						if($content->parentid != 2 || $content->parentid != 22){
							$parentcat = ($content->parent == "Fr" || $content->parent == "En") ? '': $content->parent.' | ';
							
							echo '<p><span class="adsmanager-cat align-left">'.$parentcat.$content->cat.'</span>';
							echo "<a class=\"align-right\" href='".$linkTarget."' class='immo_btn'>" .JText::_('ADSMANAGER_FORM_AD_INFORMATION'). "</a></p>";
						}
					
            ?>
            </div>
            </div>
        </td>
        
        <?php if(!isset($this->conf->display_column_date) || $this->conf->display_column_date == 1): ?>
        <td class="tdcenter column_date hidden-phone">
            <?php 
            $iconflag = false;
            if (($this->conf->show_new == true)&&($this->isNewcontent($content->date_created,$this->conf->nbdays_new))) {
                    echo "<div class='text-center'><img alt='new' src='".getImagePath('new.gif')."' /> ";
                $iconflag = true;
            }
            if (($this->conf->show_hot == true)&&($content->views >= $this->conf->nbhits)) {
                if ($iconflag == false)
                        echo "<div class='text-center'>";
                echo "<img alt='hot' src='".getImagePath('hot.gif')."' />";
                $iconflag = true;
            }
            if ($iconflag == true)
                echo "</div>";
            if(!isset($this->conf->display_column_date_date) || $this->conf->display_column_date_date == 1){
                echo $this->reorderDate($content->date_created);
            }
            ?>
            <br />
            <?php
            if ($content->userid != 0 && (!isset($this->conf->display_column_date_user) || $this->conf->display_column_date_user == 1))
            {
               echo JText::_('ADSMANAGER_FROM')." "; 

               $target = TLink::getUserAdsLink($content->userid);

               if ($this->conf->display_fullname == 1)
                    echo "<a href='".$target."'>".$content->fullname."</a><br/>";
               else
                    echo "<a href='".$target."'>".$content->user."</a><br/>";
            }
            ?>
            <?php 
            if(!isset($this->conf->display_column_date_view) || $this->conf->display_column_date_view == 1){
                echo sprintf(JText::_('ADSMANAGER_VIEWS'),$content->views);
            }
            ?>
            <?php if(isset($this->conf->favorite_enabled) && $this->conf->favorite_enabled == 1 && ($this->conf->favorite_display == 'all' || $this->conf->favorite_display == 'list')): ?>
                <br/>
                <?php
                    $favoriteClass = '';
                    $favoriteLabel = addslashes(JText::_('ADSMANAGER_CONTENT_FAVORITE'));
                    if(array_search($content->id, $this->favorites) !== false){
                        $favoriteClass = ' like_active';
                        $favoriteLabel = addslashes(JText::_('ADSMANAGER_CONTENT_FAVORITE_DELETEMSG'));
                    }
                ?>
                    <button id="like_<?php echo $content->id; ?>" class="btn favorite_ads like_ad<?php echo $favoriteClass; ?>"><?php echo $favoriteLabel; ?></button>
            <?php endif; ?>
        </td>
        <?php endif; ?>
    </tr>
<?php	
}
?>
    </table>
</div>