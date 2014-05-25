<?php

require_once 'post.php';

if(isset($_POST['rss'])){
	$data = '';
	$rdf_file = 'rss_list.txt';

	$rdf_list = array();

	if(file_exists($rdf_file)){
		$rdf_list = file($rdf_file);
	}

	$tmp = array();

	foreach($rdf_list as $v){
		$v = trim($v);
		$tmp[$v] = 1;
		$data .= $v . PHP_EOL;
	}

	$rss = $_POST['rss'];
	$rdf = simplexml_load_file($rss);

	if(false != $rdf){
		$data .= $rss . PHP_EOL;
	}

	file_put_contents($rdf_file, $data);
}

$file_name = './__';

if(!file_exists($file_name)){
	echo 'init heroku!!';

	`php -f loop.php > /dev/null &`;
}

echo
'<form method="post" action="/">
<p>RSS : <input type="text" name="rss"></p>
<p><input type="submit" value="add"></p>
</form>';
