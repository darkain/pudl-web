<?php


////////////////////////////////////////////////////////////////////////////////
//INCLUDES
////////////////////////////////////////////////////////////////////////////////
require_once('_altaform/core/afSidebar.inc.php');


$template = [
	'menu_id'		=> 0,
	'menu_parent'	=> NULL,
	'menu_page'		=> 1,
	'menu_sort'		=> 0,
	'menu_text'		=> '',
	'menu_subtext'	=> NULL,
	'menu_url'		=> NULL,
	'menu_target'	=> NULL,
];


$menu = [];

$databases = $db->rows('databases');
foreach ($databases as $server) {
	if (!empty($server['iv'])  &&  !empty($server['raw'])) {
		$server['password'] = $af->decrypt($server);
	}

	$item = $template;
	$item['menu_id']		= count($menu)+1;
	$item['menu_text']		= $server['nickname'];
	$menu[$item['menu_id']]	= $item;

	$pudl = pudl::instance($server);

	$tables = $pudl->tables();
	foreach ($tables as $table) {
		$subitem = $template;
		$subitem['menu_id']			= count($menu)+1;
		$subitem['menu_text']		= $table;
		$subitem['menu_parent']		= $item['menu_id'];
		$subitem['menu_url']		= $afurl(['table', $server['nickname'], $table], true);
		$menu[$subitem['menu_id']]	= $subitem;
	}
}

$sidebar = new afSidebar($menu);
$sidebar->process();
//$text = $sidebar->renderString();

$af->script($afurl->static.'/js/jquery.history.min.js');

$af	->header()
		->load('demo.tpl')
			->field('sidebar', $sidebar)
		->render()
	->footer();

/*
$sidebar = (new afSidebar)
			->base('/admin/new')
			->renderString();
*/

/*
$tables	= [];

$items	= $db->tables();
foreach ($items as $item) {
	$tables[$item] = [
		'name'	=> $item,
	];
}


ksort($tables);


$af->load('_index.tpl');
	$af->block('table', $tables);
$af->render();
*/
