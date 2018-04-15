<?php
/*
 * ------------------------------------------------------------------------
 * Copyright (C) 2009 - 2013 The YouTech JSC. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: The YouTech JSC
 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
 * ------------------------------------------------------------------------
*/
// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );
global $is_placehold;
global $placehold_size;

// Array param for cookie
$placehold_size = array (
    'listing' => '870x400/cccccc/cccccc',
    'article' => '580x580/cccccc/cccccc',
    'related_items'=>'555x390/cccccc/cccccc',
    'slideshow' => '1150x450/cccccc/cccccc',
    'latest_news' => '270x270/cccccc/cccccc',
    'popular' => '70x70/cccccc/cccccc',
    'featured_posts' => '230x180/cccccc/cccccc',
    'hot_stories' => '270x250/cccccc/cccccc',
    'video_box' => '270x150/cccccc/cccccc',
    'style1' => '70x70/cccccc/cccccc',
    'style2' => '130x80/cccccc/cccccc',
    'style3' => '170x120/cccccc/cccccc',
    'style4' => '270x180/cccccc/cccccc',
    'style5' => '270x180/cccccc/cccccc',
    'style6' => '70x70/cccccc/cccccc',
    'hightlight' => '428x300/cccccc/cccccc',
    'style_mega' => '270x130/cccccc/cccccc',
    'k2user' => '83x83/cccccc/cccccc',
    'k2cat' => '570x300/cccccc/cccccc',
    'k2cat2' => '170x120/cccccc/cccccc',
    'k2itemimgb' => '870x420/cccccc/cccccc',
    'img_ourblog' => '370x280/cccccc/cccccc',
	'k2_item' => '580x580/cccccc/cccccc',
	

);

$is_placehold = 1;

if (!function_exists ('yt_placehold') ) {
    function yt_placehold ($size = '100x100',$icon='0xe942', $alt = '', $title = '' ) {
        return '<img src="http://placehold.it/'.$size.'" alt = "'. $alt .'" title = "'. $title .'"/>';
    }
    function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]);
      }
      return $text;
    }
}
?>
