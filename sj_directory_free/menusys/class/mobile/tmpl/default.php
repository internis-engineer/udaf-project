<?php
/** 
 * YouTech menu template file.
 * 
 * @author The YouTech JSC
 * @package menusys
 * @filesource default.php
 * @license Copyright (c) 2011 The YouTech JSC. All Rights Reserved.
 * @tutorial http://www.smartaddons.com
 */
global $yt;
$typelayout = $yt->getParam('layouttype');

?>

<?php
if ($this->isRoot()){
	if($typelayout=='res'){ ?>
		<div id="resmenu" class="slideout-menu hidden-lg">
			<ul class="nav resmenu">
			<?php
			if($this->haveChild()){
				$idx = 0;
				foreach($this->getChild() as $child){
					++$idx;
					$child->getContent('collapse');
				}
			}
			?>
			</ul>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				"use strict";
				var $slideout = $('#resmenu');	
				$slideout.mmenu({
					extensions 	: [ "theme-black", "", "effect-panels-slide-100", "effect-listitems-slide", "effect-menu-slide", "" ],
					counters		: false,
					dividers		: {
						add				: true,
						addTo			: "[id*='contacts-']",
						fixed			: true
					},
					searchfield		: {
						resultsPanel	: true
					},
					sectionIndexer	: {
						add				: true,
						addTo			: "[id*='contacts-']"
					},
					navbar			: {
						title			: "Main Menu"
					},
					navbars		: [{
						content: ["searchfield"]
					}, true]
					}, {
				}).on( 'click',
					'a[href^="#/"]',
					function() {
						alert( "Thank you for clicking, but that's a demo link." );
						return false;
					}
				);

			});
			
			
			
				
		</script>
	<?php
	}
}
?>
