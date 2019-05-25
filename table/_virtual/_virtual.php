<?php

if (!$af->jq()) {
	return $router->replace(['demo']);
}


//var_export($router->virtual);

// PULL THE SERVER INFORMATION FROM THE CONNECTION LIST
$server = $db->rowId('databases', 'nickname', $router->virtual[0]);

if (!empty($server['iv'])  &&  !empty($server['raw'])) {
	$server['password'] = $af->decrypt($server);
}

$pudl = pudl::instance($server);

//var_export($server);

/*
$data = $db(
	'pragma table_info(' . $db->_table($router->virtual[1], true) . ')'
)->complete();
*/

?>

<style>
.table {
	width:			100%;
}


.td, .th {
	border:			1px solid rgba(255,255,255,0.3);
	padding:		0.3em 0.5em;
	text-shadow:	0 0 0.2em #000;
	display:		table-cell;
}

.td {
	width:		20px;
	text-overflow:	ellipsis;
	overflow:		hidden;
	padding:0; margin:0;
}

.td input {
	background:none;
	border:none;
	color:#fff;
	width:100%;
	padding: 0.3em 0.5em;
}

.tr:nth-child(even) {
	background:		rgba(0,0,0,0.1);
}

.tr:hover {
	background:		rgba(255,0,255,0.1);
	box-shadow:		0 0 10em rgba(0,0,0,0.5);
}
</style>

<script>
$(function(){
	$('.table').afSpreadsheet({
		row:	'.tr',
		cell:	'.td',
	});
});
</script>

<?php

echo '<div class="table">';

echo '<div class="tr">';
$data	= $pudl->listFields( $router->virtual[1] );

foreach ($data as $field) {
	echo '<span class="th">';
	echo $field['field'];
	echo '</span>';
}

echo '</div>';

$rows = $pudl->selectRows('*', $router->virtual[1], false, false, 200);
foreach ($rows as $row) {
	echo '<div class="tr">';
	foreach ($row as $cell) {
		echo '<span class="td">';
		echo '<input type="text" ';
		echo 'value="' . htmlspecialchars($cell) . '"';
		echo '/>';
		echo '</span>';
	}
	echo '</div>';
}

echo '</div>';

/*
echo '<pre>';
var_export($data);
echo '</pre>';
*/
/*
$af	->load('_virtual.tpl')
		->field('table',	['name' => $router->virtual[1]])
		->block('column',	$data)
	->render();
*/
