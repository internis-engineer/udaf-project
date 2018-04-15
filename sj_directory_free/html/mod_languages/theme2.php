<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_languages
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('stylesheet', 'mod_languages/template.css', array(), true);
?>
<div class="mod-languages <?php echo $moduleclass_sfx ?>">

<?php if ($params->get('dropdown', 1)) : ?>

        <a class="dropdown-toggle"  >
			<div class="pretext">
				<span><?php echo $headerText; ?></span>
				<i class="fa fa-angle-down"></i>
			</div>
            <?php foreach ($list as $language) : ?>
                <?php if ( $language->active):?>
                    <?php if ($params->get('dropdownimage', 1)):?>
                        <?php echo JHtml::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, array('title' => $language->title_native), true);?>
                        <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef);?>
                    <?php else : ?>
                        <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef);?>
                    <?php endif; ?>
                <?php endif;?>
            <?php endforeach;?>
        </a>
        <ul class="dropdown-menu " >
        <?php foreach ($list as $language) : ?>
            <?php if ($params->get('show_active', 0) || !$language->active):?>
                <li class="<?php echo $language->active ? 'lang-active' : '';?>" >
                    <a href="<?php echo $language->link;?>">
                        <?php if ($params->get('dropdownimage', 1)):?>
                            <?php echo JHtml::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, array('title' => $language->title_native), true);?>
                            <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef);?>
                        <?php else : ?>
                            <i class="fa fa-globe "></i> 
                            <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef);?>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif;?>
        <?php endforeach;?>
        </ul>

<?php else : ?>
    <ul class="<?php echo $params->get('inline', 1) ? 'lang-inline' : 'lang-block';?>">
    <?php foreach ($list as $language) : ?>
        <?php if ($params->get('show_active', 0) || !$language->active):?>
            <li class="<?php echo $language->active ? 'lang-active' : '';?>" dir="<?php echo JLanguage::getInstance($language->lang_code)->isRTL() ? 'rtl' : 'ltr' ?>">
            <a href="<?php echo $language->link;?>">
            <?php if ($params->get('dropdownimage', 1)):?>
                <?php echo JHtml::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, array('title' => $language->title_native), true);?>
            <?php else : ?>
                <i class="fa fa-globe "></i> 
                <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef);?>
            <?php endif; ?>
            </a>
            </li>
        <?php endif;?>
    <?php endforeach;?>
    </ul>
<?php endif; ?>

<?php if ($footerText) : ?>
    <div class="posttext"><span><?php echo $footerText; ?></span></div>
<?php endif; ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    var ua = navigator.userAgent,
    _device = (ua.match(/iPad/i)||ua.match(/iPhone/i)||ua.match(/iPod/i)) ? "smartphone" : "desktop";

    if(_device == "desktop") {
        $(".mod-languages").bind('hover', function() {
            $(this).children(".dropdown-toggle").addClass(function(){
                if($(this).hasClass("open")){
                    $(this).removeClass("open");
                    return "";
                }
                return "open";
            });
            $(this).children(".dropdown-menu").slideToggle();
        });
    }else{
        $('.mod-languages .dropdown-toggle').bind('touchstart', function(){
            $('.mod-languages .dropdown-menu').toggle();
        });
    }
});
</script>
