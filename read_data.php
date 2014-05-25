<?php

$rdf_file = 'rss_list.txt';

$rdf_list = array();

if(file_exists($rdf_file)){
	$rdf_list = file($rdf_file);
}

$tmp = array();
$data = '';
$new_rdf_list = array();

foreach($rdf_list as $v){
	$v = trim($v);
	$rdf = simplexml_load_file($v);

	if(false == $rdf){
		continue;
	}

	if(!isset($tmp[$v])){
		$tmp[$v] = 1;
		$new_rdf_list[] = $v;
		$data .= $v . PHP_EOL;
	}
}

if('' != $data){
	unset($tmp);

	file_put_contents($rdf_file, $data);
	unset($data);
}

$tbl = array();

foreach($new_rdf_list as $url){
	$rdf = simplexml_load_file($url);

	foreach($rdf->item as $row){
		$node = $row->children('http://purl.org/rss/1.0/modules/content/');
		preg_match_all('/<img src="(.+?)"/', $node->encoded, $matches);

		if(!isset($matches[1])){
			continue;
		}

		$title = $row->title;

		foreach($matches[1] as $v){
			$tbl[$v] = $title;
		}
	}
}
