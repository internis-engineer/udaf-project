<?php

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
?>
<div class="tlm_menu">
<span class="btn"><?php echo JText::_('View More'); ?></span>
<ul class="menu <?php echo $class_sfx;?>">
<?php
foreach ($list as $i => &$item) :
    $class = 'item-'.$i;
    if ($item->id == $active_id) {
        $class .= ' current';
    }

    if (in_array($item->id, $path)) {
        $class .= ' active';
    }
    elseif ($item->type == 'alias') {
        $aliasToId = $item->params->get('aliasoptions');
        if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
            $class .= ' active';
        }
        elseif (in_array($aliasToId, $path)) {
            $class .= ' alias-parent-active';
        }
    }

    if ($item->deeper) {
        $class .= ' deeper';
    }

    if ($item->parent) {
        $class .= ' parent';
    }

    if (!empty($class)) {
        $class = ' class="'.trim($class) .'"';
    }

    echo '<li'.$class.'>';

    // Render the menu item.
    switch ($item->type) :
        case 'separator separatorex':
        case 'url':
        case 'component':
            require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
            break;

        default:
            require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
            break;
    endswitch;

    // The next item is deeper.
    if ($item->deeper) {
        echo '<ul class="yt-list">';
    }
    // The next item is shallower.
    elseif ($item->shallower) {
        echo '</li>';
        echo str_repeat('</ul></li>', $item->level_diff);
    }
    // The next item is on the same level.
    else {
        echo '</li>';
    }
endforeach;
?></ul>
</div>
