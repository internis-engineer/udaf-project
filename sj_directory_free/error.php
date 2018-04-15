<?php
/**
 * @package        Joomla.Site
 * @copyright    Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//get copyright
$app = JFactory::getApplication();
$date        = JFactory::getDate();
$template = $app->getTemplate(true);
$params = $template->params;
$cur_year    = $date->format('Y');
$ytcopyright = $params->get('ytcopyright' );
$ytcopyright = str_replace('{year}', $cur_year, $ytcopyright);


//get language and direction
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
?>

<html  lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    <link rel="stylesheet" href="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/css/error.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/asset/bootstrap/css/bootstrap.min.css" type="text/css" />	
</head>
<body>
	<div id ="yt_wrapper" class="page-404">
		<div id="content">
			<div class="container">
				<div class="main">
					<div class="main-left item">
						<h3 class="text-404"> <?php echo JText::_('TEXT_404_JUSTICE'); ?></h3>
					</div>
					<div class="main-right item">
						<div class="main-content">
							<h3><?php echo JText::_('TEXT_ERROR_JUSTICE'); ?></h3>
							<P class="mes-content"><?php echo $this->error->getMessage(); ?></p>
							<a class="button" href="<?php echo $this->baseurl; ?>/index.php">
								<?php echo JText::_('TEXT_BACK_HOME'); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>

</body>
</html>
