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

if(!function_exists('otherDiffDate')) {
	function otherDiffDate($end='2015-03-19 10:30:00'){
		$intervalo = date_diff(date_create(), date_create($end));
		if(!empty($intervalo)){
			$_date_time = array(); $i = 0;
			foreach($intervalo as $inter){ $i++;
				if($i <= 5){
					$_date_time[] = $inter;
				}
			}
			$str = '';
			if(!empty($_date_time)){
				$_labels = array('year','month','day','hour','minute', 'second');
				 for($i = 0; $i <= count($_date_time) ; $i++){
					 if($_date_time[$i] > 0){
						if($_date_time[$i] <= 1){
							$str .= $_date_time[$i].' '.$_labels[$i].' ago'; 
						}else{
							$str .= $_date_time[$i].' '.$_labels[$i].'s ago';  
						}
						 break;
					 }
				 }
			}
			return $str;
		
		}
	}
}

?>

<?php if(JRequest::getInt('print')==1): ?>
<!-- Print button at the top of the print page only -->
<a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print();return false;">
	<span><?php echo JText::_('K2_PRINT_THIS_PAGE'); ?></span>
</a>
<?php endif; ?>

<!-- Start K2 Item Layout -->
<span id="startOfPageId<?php echo JRequest::getInt('id'); ?>"></span>

<div id="k2Container" class="itemView <?php echo ($this->item->featured) ? ' itemIsFeatured' : ''; ?><?php if($this->item->params->get('pageclass_sfx')) echo ' '.$this->item->params->get('pageclass_sfx'); ?>">
	<div class="content-box">
		<!-- Plugins: BeforeDisplay -->
		<?php echo $this->item->event->BeforeDisplay; ?>

		<!-- K2 Plugins: K2BeforeDisplay -->
		<?php echo $this->item->event->K2BeforeDisplay; ?>
	    
	    <?php if($this->item->params->get('itemImage') ): ?>
	    <!-- Item Image -->
	    <div class="itemImageBlock">
	        <span class="itemImage">
	            <a data-k2-modal="image" href="<?php echo $this->item->imageXLarge; ?>" title="<?php echo JText::_('K2_CLICK_TO_PREVIEW_IMAGE'); ?>">
	                <?php 
						//Create placeholder items images
					
						$src = $this->item->image;
						if (!empty( $src)) {								
							$thumb_img = '<img src="'.$src.'" alt="'.$this->item->title.'" />';
						} else if ($is_placehold) {					
							$thumb_img = yt_placehold($placehold_size['k2_item'],$this->item->title,$this->item->title);
						}	
						echo $thumb_img;
					?>
	            </a>
	        </span>

	        <?php if($this->item->params->get('itemImageMainCaption') && !empty($this->item->image_caption)): ?>
	        <!-- Image caption -->
	        <span class="itemImageCaption"><?php echo $this->item->image_caption; ?></span>
	        <?php endif; ?>

	        <?php if($this->item->params->get('itemImageMainCredits') && !empty($this->item->image_credits)): ?>
	        <!-- Image credits -->
	        <span class="itemImageCredits"><?php echo $this->item->image_credits; ?></span>
	        <?php endif; ?>

	        <div class="clr"></div>
	    </div>
	    <?php endif; ?>
	    <div class="main-item">
			<div class="itemHeader">

				<?php if($this->item->params->get('itemTitle')): ?>
				<!-- Item title -->
				<h2 class="itemTitle">
					<?php if(isset($this->item->editLink)): ?>
					<!-- Item edit link -->
					<span class="itemEditLink">
						<a data-k2-modal="edit" href="<?php echo $this->item->editLink; ?>"><?php echo JText::_('K2_EDIT_ITEM'); ?></a>
					</span>
					<?php endif; ?>
			
					<?php echo $this->item->title; ?>
			
					<?php if($this->item->params->get('itemFeaturedNotice') && $this->item->featured): ?>
					<!-- Featured flag -->
					<span>
						<sup>
							<?php echo JText::_('K2_FEATURED'); ?>
						</sup>
					</span>
					<?php endif; ?>
				</h2>
				<?php endif; ?>
			</div>
			<!-- Plugins: AfterDisplayTitle -->
			<?php echo $this->item->event->AfterDisplayTitle; ?>
		
			<!-- K2 Plugins: K2AfterDisplayTitle -->
			<?php echo $this->item->event->K2AfterDisplayTitle; ?>
		
			<?php if(
				$this->item->params->get('itemCategory') ||
				$this->item->params->get('itemAuthor') ||
				$this->item->params->get('itemDateCreated') ||
				$this->item->params->get('itemFontResizer') ||
				$this->item->params->get('itemPrintButton') ||
				$this->item->params->get('itemEmailButton') ||
				$this->item->params->get('itemRating') ||
				($this->item->params->get('itemVideoAnchor') && !empty($this->item->video)) ||
				($this->item->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)) ||
				($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && $this->item->params->get('comments'))
			): ?>
			<div class="itemToolbar">
				<ul class="list-toolbar">
					<?php if($this->item->params->get('itemAuthor')): ?>
					<!-- Item Author -->
					<li class="itemAuthor">
						<?php if(empty($this->item->created_by_alias)): ?>
						<?php echo JText::_('K2_CUSTOM_BY_NAME_AUTHOR'); ?>
						<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
						<?php else: ?>
						<?php echo $this->item->author->name; ?>
						<?php endif; ?>
					</li>
					<?php endif; ?>

					<?php if($this->item->params->get('itemCategory')): ?>
					<!-- Item category -->
					<li>
						<i class="fa fa-folder-open-o"></i>
						<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
					</li>
					<?php endif; ?>

					<?php if($this->item->params->get('itemDateCreated')): ?>
					<!-- Date created -->
					<li class="itemDateCreated">
						<i class="fa fa-clock-o"></i>
						<?php echo JHTML::_('date', $this->item->created , JText::_('d M Y')); ?>
					</li>
					<?php endif; ?>
					<?php if($this->item->params->get('itemFontResizer')): ?>
					<!-- Font Resizer -->
					<li>
						<span class="itemTextResizerTitle"><?php echo JText::_('K2_FONT_SIZE'); ?></span>
						<a href="#" id="fontDecrease">
							<span><?php echo JText::_('K2_DECREASE_FONT_SIZE'); ?></span>
						</a>
						<a href="#" id="fontIncrease">
							<span><?php echo JText::_('K2_INCREASE_FONT_SIZE'); ?></span>
						</a>
					</li>
					<?php endif; ?>
		
					<?php if($this->item->params->get('itemPrintButton') && !JRequest::getInt('print')): ?>
					<!-- Print Button -->
					<li>
						<a class="itemPrintLink" rel="nofollow" href="<?php echo $this->item->printLink; ?>" onclick="window.open(this.href,'printWindow','width=900,height=600,location=no,menubar=no,resizable=yes,scrollbars=yes'); return false;">
							<span><?php echo JText::_('K2_PRINT'); ?></span>
						</a>
					</li>
					<?php endif; ?>
		
					<?php if($this->item->params->get('itemEmailButton') && !JRequest::getInt('print')): ?>
					<!-- Email Button -->
					<li>
						<a class="itemEmailLink" rel="nofollow" href="<?php echo $this->item->emailLink; ?>" onclick="window.open(this.href,'emailWindow','width=400,height=350,location=no,menubar=no,resizable=no,scrollbars=no'); return false;">
							<span><?php echo JText::_('K2_EMAIL'); ?></span>
						</a>
					</li>
					<?php endif; ?>
					
		
					<?php if($this->item->params->get('itemVideoAnchor') && !empty($this->item->video)): ?>
					<!-- Anchor link to item video below - if it exists -->
					<li>
						<a class="itemVideoLink k2Anchor" href="<?php echo $this->item->link; ?>#itemVideoAnchor"><?php echo JText::_('K2_MEDIA'); ?></a>
					</li>
					<?php endif; ?>
		
					<?php if($this->item->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)): ?>
					<!-- Anchor link to item image gallery below - if it exists -->
					<li>
						<a class="itemImageGalleryLink k2Anchor" href="<?php echo $this->item->link; ?>#itemImageGalleryAnchor"><?php echo JText::_('K2_IMAGE_GALLERY'); ?></a>
					</li>
					<?php endif; ?>
		
					<?php if($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && ( ($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1')) ): ?>
					<!-- Anchor link to comments below - if enabled -->
					<li class="icomments">
						<?php if(!empty($this->item->event->K2CommentsCounter)): ?>
						<!-- K2 Plugins: K2CommentsCounter -->
						<?php echo $this->item->event->K2CommentsCounter; ?>
						<?php else: ?>
						<?php if($this->item->numOfComments > 0): ?>
						<i class="fa fa-comments-o"></i>
						<a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
							<span><?php echo $this->item->numOfComments; ?></span> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
						</a>
						<?php else: ?>
						<i class="fa fa-comments-o"></i>
						<a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor"><?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?></a>
						<?php endif; ?>
						<?php endif; ?>
					</li>
					<?php endif; ?>

					<?php if($this->item->params->get('itemRating')): ?>
					<!-- Item Rating -->
					<li>
						<div class="itemRatingBlock">
							<span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>
							<div class="itemRatingForm">
								<ul class="itemRatingList">
									<li class="itemCurrentRating" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li>
									<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a></li>
									<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a></li>
									<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a></li>
									<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a></li>
									<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a></li>
								</ul>
								<div id="itemRatingLog<?php echo $this->item->id; ?>" class="itemRatingLog"><?php echo $this->item->numOfvotes; ?></div>
								<div class="clr"></div>
							</div>
							<div class="clr"></div>
						</div>
					</li>
					<?php endif; ?>
				</ul>
			</div>
			<?php endif; ?>
			
			<div class="clr"></div>

			<div class="itemBody">
		
				<!-- Plugins: BeforeDisplayContent -->
				<?php echo $this->item->event->BeforeDisplayContent; ?>
		
				<!-- K2 Plugins: K2BeforeDisplayContent -->
				<?php echo $this->item->event->K2BeforeDisplayContent; ?>
		
				<?php if(!empty($this->item->fulltext)): ?>
		
				<?php if($this->item->params->get('itemIntroText')): ?>
				<!-- Item introtext -->
				<div class="itemIntroText">
					<?php echo $this->item->introtext; ?>
				</div>
				<?php endif; ?>
		
				<?php if($this->item->params->get('itemFullText')): ?>
				<!-- Item fulltext -->
				<div class="itemFullText">
					<?php echo $this->item->fulltext; ?>
				</div>
				<?php endif; ?>
		
				<?php else: ?>
		
				<!-- Item text -->
				<div class="itemFullText">
					<?php echo $this->item->introtext; ?>
				</div>
		
				<?php endif; ?>
		
				<div class="clr"></div>
		
				<?php if($this->item->params->get('itemExtraFields') && count($this->item->extra_fields)): ?>
				<!-- Item extra fields -->
				<div class="itemExtraFields">
					<h3><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h3>
					<ul>
						<?php foreach ($this->item->extra_fields as $key=>$extraField): ?>
						<?php if($extraField->value != ''): ?>
						<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
							<?php if($extraField->type == 'header'): ?>
							<h4 class="itemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
							<?php else: ?>
							<span class="itemExtraFieldsLabel"><?php echo $extraField->name; ?>:</span>
							<span class="itemExtraFieldsValue"><?php echo $extraField->value; ?></span>
							<?php endif; ?>
						</li>
						<?php endif; ?>
						<?php endforeach; ?>
					</ul>
					<div class="clr"></div>
				</div>
				<?php endif; ?>
		
				<?php if($this->item->params->get('itemHits') || ($this->item->params->get('itemDateModified') && intval($this->item->modified)!=0)): ?>
				<div class="itemContentFooter">
		
					<?php if($this->item->params->get('itemHits')): ?>
					<!-- Item Hits -->
					<span class="itemHits">
						<?php echo JText::_('K2_READ'); ?> <b><?php echo $this->item->hits; ?></b> <?php echo JText::_('K2_TIMES'); ?>
					</span>
					<?php endif; ?>
		
					<?php if($this->item->params->get('itemDateModified') && intval($this->item->modified)!=0): ?>
					<!-- Item date modified -->
					<span class="itemDateModified">
						<?php echo JText::_('K2_LAST_MODIFIED_ON'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?>
					</span>
					<?php endif; ?>
		
					<div class="clr"></div>
				</div>
				<?php endif; ?>	
				<!-- Plugins: AfterDisplayContent -->
				<?php echo $this->item->event->AfterDisplayContent; ?>
		
				<!-- K2 Plugins: K2AfterDisplayContent -->
				<?php echo $this->item->event->K2AfterDisplayContent; ?>
		
				<div class="clr"></div>	
			</div>
		</div>	
		<?php if(		
			$this->item->params->get('itemTags') ||
			$this->item->params->get('itemAttachments') ||
			$this->item->params->get('itemSocialButton')
		): ?>
		<div class="itemLinks">
			<?php if($this->item->params->get('itemAttachments') && count($this->item->attachments)): ?>
			<!-- Item attachments -->
			<div class="itemAttachmentsBlock">
				<span><?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS'); ?></span>
				<ul class="itemAttachments">
					<?php foreach ($this->item->attachments as $attachment): ?>
					<li>
						<a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>"><?php echo $attachment->title; ?></a>
						<?php if($this->item->params->get('itemAttachmentsCounter')): ?>
						<span>(<?php echo $attachment->hits; ?> <?php echo ($attachment->hits==1) ? JText::_('K2_DOWNLOAD') : JText::_('K2_DOWNLOADS'); ?>)</span>
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<div class="clr"></div>	    
		    <div class="itemLinksEx">
		        <?php if($this->item->params->get('itemTags') && count($this->item->tags)): ?>
				<!-- Item tags -->
				<div class="itemTagsBlock">
					<span><?php echo JText::_('K2_TAGGED_NAME'); ?></span>
					<ul class="itemTags">
						<?php  
							$count_item = count($this->item->tags);
							foreach ($this->item->tags as $tag):					
								$count_item= $count_item - 1;
								if($count_item>0){
									$k= ',';
								}else{
									$k= '';
								}
						?>
						<li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name . $k . " "; ?></a></li>
						<?php endforeach; ?>
					</ul>
					<div class="clr"></div>
				</div>
				<?php endif; ?>

		        <?php if($this->item->params->get('itemSocialButton') && !is_null($this->item->params->get('socialButtonCode', NULL))): ?>
				<!-- Item Social Button -->
				<div class="itemSocialBlock">
					<div class="post_social">
						<a href="javascript:void(0)" class="icons-social social-fb" onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u=<?php echo JURI::current();?>&amp;url=<?php echo JURI::current();?>')" title="Facebook Share"><i class="fa fa-facebook" aria-hidden="true"></i> <?php echo JTEXT::_('NAME_SOCIAL_FACEBOOK');?></a>
						<a href="javascript:void(0)" class="icons-social social-gp" onclick="javascript:genericSocialShare('https://plus.google.com/share?url=<?php echo JURI::current();?>')" title="Google Plus Share"><i class="fa fa-google-plus" aria-hidden="true"></i> <?php echo JTEXT::_('NAME_SOCIAL_GOOGLE'); ?></a>
						<a href="javascript:void(0)" class="icons-social social-tw" onclick="javascript:genericSocialShare('http://twitter.com/share?text=<?php echo $this->item->title?>&amp;url=<?php echo JURI::current();?>')" title="Twitter Share"><i class="fa fa-twitter" aria-hidden="true"></i> <?php echo JTEXT::_('NAME_SOCIAL_TWITTER');?></a>
						<a href="javascript:void(0)" class="icons-social social-lk" onclick="javascript:genericSocialShare('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo JURI::current();?>')" title="LinkedIn Share"><i class="fa fa-linkedin" aria-hidden="true"></i> <?php echo JTEXT::_('NAME_SOCIAL_LINKEDIN');?></a>
						<a href="javascript:void(0)" class="icons-social social-pt" onclick="javascript:genericSocialShare('http://pinterest.com/pin/create/button/?url=<?php echo JURI::current();?>')" title="Pinterest Share"><i class="fa fa-pinterest-p" aria-hidden="true"></i>  <?php echo JTEXT::_('NAME_SOCIAL_PINTEREST');?></a>
					</div>
					<script type="text/javascript">
					function genericSocialShare(url){
						window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
						return true;
					}
					</script>
				</div>
				<?php endif; ?>
		    </div>
	    </div>    
		<?php endif; ?>
		<div class="clr"></div>
		<?php if($this->item->params->get('itemAuthorBlock') && empty($this->item->created_by_alias)): ?>
		<!-- Author Block -->
		<div class="itemAuthorBlock">
			<?php if($this->item->params->get('itemAuthorImage') && !empty($this->item->author->avatar)): ?>
			<img class="itemAuthorAvatar" src="<?php echo $this->item->author->avatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($this->item->author->name); ?>" />
			<?php endif; ?>

			<div class="itemAuthorDetails">

				<h3 class="itemAuthorName">
					<span><?php echo JTEXT::_('TAG_NAME_AUTHOR_POST'); ?> </span>
					<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
				</h3>

				<?php if($this->item->params->get('itemAuthorDescription') && !empty($this->item->author->profile->description)): ?>
				<?php echo $this->item->author->profile->description; ?>
				<?php endif; ?>

				<?php if($this->item->params->get('itemAuthorURL') && !empty($this->item->author->profile->url)): ?>
				<span class="itemAuthorUrl"><i class="k2icon-globe"></i> <a rel="me" href="<?php echo $this->item->author->profile->url; ?>" target="_blank"><?php echo str_replace('http://','',$this->item->author->profile->url); ?></a></span>
				<?php endif; ?>
				
				<?php if($this->item->params->get('itemAuthorURL') && !empty($this->item->author->profile->url) && $this->item->params->get('itemAuthorEmail')): ?>
				<span class="k2HorizontalSep">|</span>
				<?php endif; ?>
				
				<?php if($this->item->params->get('itemAuthorEmail')): ?>
				<span class="itemAuthorEmail"><?php echo JHTML::_('Email.cloak', $this->item->author->email); ?></span>
				<?php endif; ?>

				<div class="clr"></div>

				<!-- K2 Plugins: K2UserDisplay -->
				<?php echo $this->item->event->K2UserDisplay; ?>

				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
		<?php endif; ?>
	</div>

	<?php if($this->item->params->get('itemAuthorLatest') && empty($this->item->created_by_alias) && isset($this->authorLatestItems)): ?>
	<!-- Latest items from author -->
	<div class="itemAuthorLatest">
		<h3><?php echo JText::_('K2_LATEST_FROM'); ?> <?php echo $this->item->author->name; ?></h3>
		<ul>
			<?php foreach($this->authorLatestItems as $key=>$item): ?>
			<li class="<?php echo ($key%2) ? "odd" : "even"; ?>">
				<a href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<div class="clr"></div>

	<?php if($this->item->params->get('itemVideo') && !empty($this->item->video)): ?>
	<!-- Item video -->
	<a name="itemVideoAnchor" id="itemVideoAnchor"></a>
	<div class="itemVideoBlock">
		<h3><?php echo JText::_('K2_MEDIA'); ?></h3>

		<?php if($this->item->videoType=='embedded'): ?>
		<div class="itemVideoEmbedded">
			<?php echo $this->item->video; ?>
		</div>
		<?php else: ?>
		<span class="itemVideo"><?php echo $this->item->video; ?></span>
		<?php endif; ?>

		<?php if($this->item->params->get('itemVideoCaption') && !empty($this->item->video_caption)): ?>
		<span class="itemVideoCaption"><?php echo $this->item->video_caption; ?></span>
		<?php endif; ?>

		<?php if($this->item->params->get('itemVideoCredits') && !empty($this->item->video_credits)): ?>
		<span class="itemVideoCredits"><?php echo $this->item->video_credits; ?></span>
		<?php endif; ?>

		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if($this->item->params->get('itemImageGallery') && !empty($this->item->gallery)): ?>
	<!-- Item image gallery -->
	<a name="itemImageGalleryAnchor" id="itemImageGalleryAnchor"></a>
	<div class="itemImageGallery">
		<h3><?php echo JText::_('K2_IMAGE_GALLERY'); ?></h3>
		<?php echo $this->item->gallery; ?>
	</div>
	<?php endif; ?>

	<?php if($this->item->params->get('itemNavigation') && !JRequest::getCmd('print') && (isset($this->item->nextLink) || isset($this->item->previousLink))): ?>
	<!-- Item navigation -->
	<div class="itemNavigation">
		<span class="itemNavigationTitle"><?php echo JText::_('K2_MORE_IN_THIS_CATEGORY'); ?></span>

		<?php if(isset($this->item->previousLink)): ?>
		<a class="itemPrevious" href="<?php echo $this->item->previousLink; ?>">&laquo; <?php echo $this->item->previousTitle; ?></a>
		<?php endif; ?>

		<?php if(isset($this->item->nextLink)): ?>
		<a class="itemNext" href="<?php echo $this->item->nextLink; ?>"><?php echo $this->item->nextTitle; ?> &raquo;</a>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<!-- Plugins: AfterDisplay -->
	<?php echo $this->item->event->AfterDisplay; ?>

	<!-- K2 Plugins: K2AfterDisplay -->
	<?php echo $this->item->event->K2AfterDisplay; ?>
		
	<?php if($this->item->params->get('itemRelated') && isset($this->relatedItems)): ?>
	<div class="content-box global_Related">		
		<!-- Related items by tag -->
		<div class="itemRelated module global-title-module">
			<h3 class="modtitle"> <span class="title"><?php echo JText::_("K2_RELATED_ITEMS_BY_TAG"); ?></span></h3>
			<div id="owl-carousel-detail" >
				<?php foreach($this->relatedItems as $key=>$item): ?>
				<div class="item-post itemContainer">
					<div class="catItemView listing">
						<?php if($this->item->params->get('itemRelatedImageSize')): ?>
							<div class="catItemImageBlock">
							<?php if($this->item->params->get('itemRelatedImageSize')): ?>
								<?php 
									//Create placeholder items images								
									$src_related = $item->image;
									if (!empty( $src_related)) { 								
										$thumb_img = '<img src="'.$src_related.'" alt="'.$item->title.'" />';
									} else if ($is_placehold) {					
										$thumb_img = yt_placehold($placehold_size['k2_item'],$this->item->title,$this->item->title);
									}	
									echo $thumb_img;
								?>							
							<?php endif; ?>
							</div>
						<?php endif; ?>						
						<div class="main-item">
							<div class="catItemHeader">
								<?php if($this->item->params->get('itemRelatedTitle', 1)): ?>
									<h3 class="catItemTitle"> <a class="itemRelTitle" href="<?php echo $item->link ?>"><?php echo $item->title; ?></a></h3>
								<?php endif; ?>
							</div>

							<?php $fieldclass = $item->extra_fields; ?>
                            <?php if( (isset($fieldclass[1]) && ($fieldclass[1]->value !=''))): ?>
                                <div class="local">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $fieldclass[1]->value; ?>                             
                                </div>                                        
                            <?php endif; ?>

							<div class="catItemRatingBlock">
								<span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>
								<div class="itemRatingForm">
									<ul class="itemRatingList">
										<li class="itemCurrentRating" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li>
										<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a></li>
										<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a></li>
										<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a></li>
										<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a></li>
										<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a></li>
									</ul>
									<div id="itemRatingLog<?php echo $this->item->id; ?>" class="itemRatingLog"><?php echo $this->item->numOfvotes; ?></div>
									<div class="clr"></div>
								</div>
								<div class="clr"></div>
							</div>

							
							<?php if($this->item->params->get('itemRelatedIntrotext')): ?>
								<div class="catItemBody">
									<div class="catItemIntroText"><?php echo $item->introtext; ?></div>
								</div>							
							<?php endif; ?>								
							<?php if($this->item->params->get('itemRelatedCategory')): ?>
								<div class="itemRelCat">
								<?php
									$catr_title = $item->category->name;
									$newr_title = JString::strpos($catr_title, '|');
									$newcatr_title = ($newr_title !== false) ? '<i class="fa fa-stop" style="color:'.JString::substr($catr_title, $newr_title + 1).'"></i><a href="' . $item->category->link . '" title="'.JString::substr($catr_title, 0, $newr_title).'" style="color:'.JString::substr($catr_title, $newr_title + 1).'">' . JString::substr($catr_title, 0, $newr_title) . '</a>': '<i class="fa fa-stop"></i><a href="' . $item->category->link . '" title="'.$item->category->name.'">' . $item->category->name . '</a>';
									echo $newcatr_title;
								?>							
								</div> 
							<?php endif; ?>						
							
							<?php if($item->params->get('itemHits')): ?>
								<div class="itemRelatedInfo">
									<!-- Item Hits -->
									<div class="itemHits">
										<i class="fa fa-bar-chart"></i>
										<?php echo JText::_('K2_READ'); ?> <b><?php echo $item->hits; ?></b> <?php echo JText::_('K2_TIMES'); ?>
									</div>
								</div>						
							<?php endif; ?>
		
						<?php if($this->item->params->get('itemRelatedAuthor')): ?>
						<div class="itemRelAuthor"><?php echo JText::_("K2_BY"); ?> <a rel="author" href="<?php echo $item->author->link; ?>"><?php echo $item->author->name; ?></a></div>
						<?php endif; ?>	
		
						<?php if($this->item->params->get('itemRelatedFulltext')): ?>
						<div class="itemRelFulltext"><?php echo $item->fulltext; ?></div>
						<?php endif; ?>
		
						<?php if($this->item->params->get('itemRelatedMedia')): ?>
						<?php if($item->videoType=='embedded'): ?>
						<div class="itemRelMediaEmbedded"><?php echo $item->video; ?></div>
						<?php else: ?>
						<div class="itemRelMedia"><?php echo $item->video; ?></div>
						<?php endif; ?>
						<?php endif; ?>
		
						<?php if($this->item->params->get('itemRelatedImageGallery')): ?>
						<div class="itemRelImageGallery"><?php echo $item->gallery; ?></div>
						<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="clr"></div>
		</div>
	</div>
	<?php endif; ?>

	<div class="clr"></div>
		<?php if(
		$this->item->params->get('itemComments') &&
		($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2')) && empty($this->item->event->K2CommentsBlock)
	): ?>
	<div class="content-box k2_Comments">
		<!-- Item comments -->
		<div class="itemComments">
			<?php if($this->item->params->get('commentsFormPosition')=='above' && $this->item->params->get('itemComments') && !JRequest::getInt('print') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
			<!-- Item comments form -->
			<div class="itemCommentsForm">
				<?php echo $this->loadTemplate('comments_form'); ?>
			</div>
			<?php endif; ?>

			<?php if($this->item->numOfComments>0 && $this->item->params->get('itemComments') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2'))): ?>
			<!-- Item user comments -->
			<div class="global-title-module">
				<h3 class="itemCommentsTitle modtitle">
					<span class="title"><?php echo JText::_('K2_COMMENTS') ?></span>
				</h3>
			</div>
				
			<ul class="itemCommentsList">
	            <?php foreach ($this->item->comments as $key=>$comment): ?>
	            <li class="<?php echo ($key%2) ? "odd" : "even"; echo (!$this->item->created_by_alias && $comment->userID==$this->item->created_by) ? " authorResponse" : ""; echo($comment->published) ? '':' unpublishedComment'; ?>">
	                <div class="c-avatar">
		                <?php if($comment->userImage): ?>
		                	<img src="<?php echo $comment->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($comment->userName); ?>" width="<?php echo $this->item->params->get('commenterImgWidth'); ?>" />
		                <?php endif; ?>
	                </div>                
	                <div class="c-content">
		                <span class="commentAuthorName">
		                    <?php if(!empty($comment->userLink)): ?>
		                    <a href="<?php echo JFilterOutput::cleanText($comment->userLink); ?>" title="<?php echo JFilterOutput::cleanText($comment->userName); ?>" target="_blank" rel="nofollow"><?php echo $comment->userName; ?></a>
		                    <?php else: ?>
		                    <?php echo $comment->userName; ?>
		                    <?php endif; ?>
		                </span>
		                
		                <span class="comment_Date"><?php $_date = JHTML::_('date',$comment->commentDate, 'Y-m-d H:m:s'); echo otherDiffDate($_date); ?></span>
		           
		                <p><?php echo $comment->commentText; ?></p>

		                <?php if(
		                    $this->inlineCommentsModeration ||
		                    ($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest)))
		                ): ?>
		                <span class="commentToolbar">
		                    <?php if($this->inlineCommentsModeration): ?>
		                    <?php if(!$comment->published): ?>
		                    <a class="commentApproveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=publish&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_APPROVE')?></a>
		                    <?php endif; ?>

		                    <a class="commentRemoveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=remove&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_REMOVE')?></a>
		                    <?php endif; ?>

		                    <?php if($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest))): ?>
		                    <a data-k2-modal="iframe" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=report&commentID='.$comment->id)?>"><?php echo JText::_('K2_REPLY')?></a>
		                    <?php endif; ?>

		                    <?php if($comment->reportUserLink): ?>
		                    <a class="k2ReportUserButton" href="<?php echo $comment->reportUserLink; ?>"><?php echo JText::_('K2_FLAG_AS_SPAMMER'); ?></a>
		                    <?php endif; ?>
		                </span>
		                <?php endif; ?>
	                </div>
	                <div class="clr"></div>
	            </li>
	            <?php endforeach; ?>
	        </ul>
			<!-- Comments Pagination -->
			<div class="itemCommentsPagination">
				<?php echo $this->pagination->getPagesLinks(); ?>
				<div class="clr"></div>
			</div>
			<?php endif; ?>
			<?php if(
				$this->item->params->get('commentsFormPosition')=='below' &&
				$this->item->params->get('itemComments') &&
				!JRequest::getInt('print') &&
				($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))
			): ?>
			<!-- Item comments form -->
			<div class="itemCommentsForm">
				<?php echo $this->loadTemplate('comments_form'); ?>
			</div>
			<?php endif; ?>
			<?php $user = JFactory::getUser(); if($this->item->params->get('comments') == '2' && $user->guest): ?>
			<div class="itemCommentsLoginFirst"><?php echo JText::_('K2_LOGIN_TO_POST_COMMENTS'); ?></div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
</div>
<!-- End K2 Item Layout -->
