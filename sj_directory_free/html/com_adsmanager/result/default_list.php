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
    <tr>
      <th><?php echo JText::_('ADSMANAGER_CONTENT'); ?>
      <?php /*<a href="<?php echo TRoute::_("index.php?option=com_adsmanager&view=result&order=5&orderdir=ASC");?>"><img src="<?php echo $this->baseurl ?>administrator/images/sort_asc.png" alt="+" /></a>
      <a href="<?php echo TRoute::_("index.php?option=com_adsmanager&view=result&order=5&orderdir=DESC");?>"><img src="<?php echo $this->baseurl ?>administrator/images/sort_desc.png" alt="-" /></a>
      */?></th>
      <?php 
          foreach($this->columns as $col)
          {
            echo "<th class='hidden-phone'>".JText::_($col->name);
            /*$order = @$this->fColumns[$col->id][0]->fieldid;
            ?>
            <a href="<?php echo TRoute::_("index.php?option=com_adsmanager&view=result&order=$order&orderdir=ASC");?>"><img src="<?php echo $this->baseurl ?>administrator/images/sort_asc.png" alt="+" /></a>
            <a href="<?php echo TRoute::_("index.php?option=com_adsmanager&view=result&order=$order&orderdir=DESC");?>"><img src="<?php echo $this->baseurl ?>administrator/images/sort_desc.png" alt="-" /></a>
            */?>
            <?php echo "</th>";
          }
      ?>

      <?php if(!isset($this->conf->display_column_date) || $this->conf->display_column_date == 1): ?>
      <th class="hidden-xs" width="15%"><?php echo JText::_('ADSMANAGER_DATE'); ?>
      <?php endif; ?>
      <?php /*<a href="<?php echo TRoute::_("index.php?option=com_adsmanager&view=result&order=orderdir=ASC");?>"><img src="<?php echo $this->baseurl ?>administrator/images/sort_asc.png" alt="+" /></a>
      <a href="<?php echo TRoute::_("index.php?option=com_adsmanager&view=result&order=orderdir=DESC");?>"><img src="<?php echo $this->baseurl ?>administrator/images/sort_desc.png" alt="-" /></a>
      */?>
      </th>
    </tr>
<?php
	
	$nbresult = sizeof($this->contents);
		$resfound = ($nbresult > 1) ? JText::_('ADSMANAGER_RESULTSFOUND') : JText::_('ADSMANAGER_RESULTFOUND');
		
	echo "<h2 class='searchtitle'>".$this->catparent." : ".$nbresult." ".$resfound."</h2>";

foreach($this->contents as $content) 
{
    $linkTarget = TRoute::_( "index.php?option=com_adsmanager&view=details&id=".$content->id."&catid=".$content->catid);
    if (function_exists('getContentClass')) 
        $classcontent = getContentClass($content,"list");
    else
        $classcontent = "";
    ?>   
    <tr class="adsmanager_table_description <?php echo $classcontent;?>"> 
        <td class="column_desc">
             <?php
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
			}else{
				?>
				<div class="desc">
				<?php
			}	
			
			//Cat 21 and 25 are jobs and 'emploi' categories.. more fields value are not displayed for these cats
			$typeContract = addslashes(JText::_('ADSMANAGER_JOB_CONTRACT'));
			$jobCity    = addslashes(JText::_('ADSMANAGER_JOB_CITY'));
			$deadline    = addslashes(JText::_('ADSMANAGER_JOB_DEADLINE'));
			
			if($content->parentid == 21 || $content->parentid == 25){
							$content->ad_text = strip_tags(str_replace ('<br />'," ",$content->ad_text));
							$af_text_short = JString::substr($content->ad_text, 0, 100);
							if (strlen($content->ad_text)>100) {
								$af_text_short .= "[...]";
							}
							
							$tableHtml = '<div class="content_job">';
							if ($content->parentid == 21){
								$tableHtml .= '<div class="job_position">
									<p>'.$af_text_short.'</p></div><div class="job_logo">';
									
									?>
									<h4 class="no-margin-top">
									<?php echo '<a href="'.$linkTarget.'">'.$content->ad_headline.'</a>'; ?>
									<?php if(!isset($this->conf->display_category_list_label) || $this->conf->display_category_list_label == 1): ?>
										<span class="adsmanager-cat">
										<?php 
											echo "(".$content->parent." / ".$content->cat.")";
										?>
										</span>
									<?php endif; ?>
								</h4>
								
								<?php
									if(isset($content->images[0])) {
											$tableHtml .= "<p><a href='".$linkTarget."' class='intro-pic'><img class='fad-image' name='ad-image".$content->id."' src='".JURI_IMAGES_FOLDER."/".$content->images[0]->thumbnail."' alt=\"".htmlspecialchars($content->ad_jobposition)."\" /></a>";
									} else if ($this->conf->nb_images > 0) {
											$tableHtml .= "<p><a href='".$linkTarget."' class='intro-pic'><img class='fad-image' src='".ADSMANAGER_NOPIC_IMG."' alt='nopic' /></a>";
									}
									
									$tableHtml .= '</p></div>
										<div class="job_city"><p>'.$jobCity.' : <br/> '.$content->ad_city.'</p></div>
										<div class="job_contract"><p>'.$typeContract.' : <br/>  '.$content->cat.'</p></div>
										<div class="job_deadline"><p>'.$deadline.' :<br/> '.$content->ad_applicationsdeadline.'</p></div>';
									
									
							}else{
								$tableHtml .= '<div class="job_position">
									<p>'.$af_text_short.'</p></div><div class="job_logo">';
								?>
									<h4 class="no-margin-top">
									<?php echo '<a href="'.$linkTarget.'">'.$content->ad_headline.'</a>'; ?>
									<?php if(!isset($this->conf->display_category_list_label) || $this->conf->display_category_list_label == 1): ?>
										<span class="adsmanager-cat">
										<?php 
											echo "(".$content->parent." / ".$content->cat.")";
										?>
										</span>
									<?php endif; ?>
								</h4>
								
								<?php
									if(isset($content->images[0])) {
											$tableHtml .= "<p><a href='".$linkTarget."' class='intro-pic'><img class='fad-image' name='ad-image".$content->id."' src='".JURI_IMAGES_FOLDER."/".$content->images[0]->thumbnail."' alt=\"".htmlspecialchars($content->ad_postefontion)."\" /></a>";
									} else if ($this->conf->nb_images > 0) {
											$tableHtml .= "<p><a href='".$linkTarget."' class='intro-pic'><img class='fad-image' src='".ADSMANAGER_NOPIC_IMG."' alt='nopic' /></a>";
									}
									
									
									$tableHtml .= '</p></div>
										<div class="job_city"><p>'.$jobCity.' :<br/> '.$content->ad_city.'</p></div>
										<div class="job_contract"><p>'.$typeContract.' :<br/> '.$content->cat.'</p></div>
										<div class="job_deadline"><p>'.$deadline.' :<br/> '.$content->ad_deadline.'</p></div>';
							}
							
							$tableHtml .= '</div>';
							echo $tableHtml;
							
						}else{
							?>
								<div>
									<h4 class="no-margin-top">
										<?php echo '<a href="'.$linkTarget.'">'.$content->ad_headline.'</a>'; ?>
										<span class="adsmanager-cat"><?php echo "(".$content->parent." / ".$content->cat.")"; ?></span>
									</h4>
								<?php 
									$content->ad_text = strip_tags(str_replace ('<br />'," ",$content->ad_text));
									$af_text = JString::substr($content->ad_text, 0, 100);
									if (strlen($content->ad_text)>100) {
										$af_text .= "[...]";
									}
									echo $af_text;
								?>
								</div>
								<?php
						}
            	?>
        </td>
        <?php 
            foreach($this->columns as $col) {
                echo '<td class="tdcenter column_'.$col->id.' hidden-phone">';
                if (isset($this->fColumns[$col->id]))
                    foreach($this->fColumns[$col->id] as $field)
                    {
                        $c = $this->field->showFieldValue($content,$field); 
                        if (($c !== "")&&($c !== null)) {
                            $title = $this->field->showFieldTitle(@$content->catid,$field);
                            if ($title != "")
                                echo "<b>".htmlspecialchars($title)."</b>: ";
                                echo "$c<br/>";
                        }
                    }
                echo "</td>";
            }
        ?>
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
            echo $this->reorderDate($content->date_created); 
            ?>
            <br />
            <?php
            if ($content->userid != 0)
            {
               echo JText::_('ADSMANAGER_FROM')." "; 

               $target = TLink::getUserAdsLink($content->userid);

                if ($this->conf->display_fullname == 1)
                    echo "<a href='".$target."'>".$content->fullname."</a><br/>";
                else
                    echo "<a href='".$target."'>".$content->user."</a><br/>";
            }
            ?>
            <?php echo sprintf(JText::_('ADSMANAGER_VIEWS'),$content->views); ?>
        </td>
        <?php endif; ?>
    </tr>
<?php	
}
?>
    </table>
</div>