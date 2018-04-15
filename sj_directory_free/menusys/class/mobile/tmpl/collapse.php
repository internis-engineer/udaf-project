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
?>
<?php
if ( $this->canAccess() ){
	$haveChild = $this->haveChild(); ?>
    <?php
    $class = '';
    if($this->get('level',1) >= 1){
        $class .= ($class!='' && $this->get('active')>=1)?' open':'';
        $class = ($class!='')?' class="'.$class.'"':'';
    }
    echo '<li'.$class.'>'.$this->getLinkInMobile($this->get('level',1));
    if($haveChild){ ?>
			
			
				<ul class="nav">
			<?php
				$cidx = 0;
				foreach($this->getChild() as $child){
					++$cidx;
					$child->getContent('collapse');
				}
			?>
				</ul>
				
			</li>
        <?php
    }else{ ?>
        </li>
    <?php
    } ?>
<?php
} ?>