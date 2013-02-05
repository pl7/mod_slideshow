<?php
/**
 * @package		SVW
 * @author 		Pascal Link - http://www.pl07.de
 * @license		GNU GPL
 */

defined('_JEXEC') or die;
// require_once __DIR__ . '/helper.php'; // joomla 3.0
require_once (dirname(__FILE__).DS.'helper.php'); 
$doc =& JFactory::getDocument();
$doc->addScript("/media/mod_slideshow/js/slider.js");
$doc->addStyleSheet("/media/mod_slideshow/css/slider.css");
		
$input = JFactory::getApplication()->input;

		// Prep for Normal or Dynamic Modes
		$mode = $params->get('mode', 'normal');
		$idbase = null;
		
		
		$option = $input->get('option');
		$view = $input->get('view');
		if ($option === 'com_content') {
			switch($view)
			{
				case 'category':
					$idbase = $input->getInt('id');
					break;
				case 'categories':
					$idbase = $input->getInt('id');
					break;
				case 'article':
					if ($params->get('show_on_article_page', 1)) {
						$idbase = $input->getInt('catid');
					}
					break;
			}
		}

$cacheid = md5(serialize(array ($idbase, $module->module)));

$cacheparams = new stdClass;
$cacheparams->cachemode = 'id';
$cacheparams->class = 'modSlideshowHelper';
$cacheparams->method = 'getList';
$cacheparams->methodparams = $params;
$cacheparams->modeparams = $cacheid;

$list = JModuleHelper::moduleCache($module, $params, $cacheparams);


if (!empty($list)) {
	$grouped = false;
	$article_grouping = $params->get('article_grouping', 'none');
	$article_grouping_direction = $params->get('article_grouping_direction', 'ksort');
	$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
	$item_heading = $params->get('item_heading');

	if ($article_grouping !== 'none') {
		$grouped = true;
		switch($article_grouping)
		{
			case 'year':
			case 'month_year':
				$list = modArticlesCategoryHelper::groupByDate($list, $article_grouping, $article_grouping_direction, $params->get('month_year_format', 'F Y'));
				break;
			case 'author':
			case 'category_title':
				$list = modArticlesCategoryHelper::groupBy($list, $article_grouping, $article_grouping_direction);
				break;
			default:
				break;
		}
	}
	//require JModuleHelper::getLayoutPath('mod_articles_category', $params->get('layout', 'default'));
	require JModuleHelper::getLayoutPath('mod_slideshow', 'default');
}