<?php

require_once 'post.php';
require_once 'read_data.php';

$file_name = './__';

if(file_exists($file_name)){
	echo 'not loop.';
	exit;
}

touch($file_name);

while(file_exists($file_name)){
	foreach($tbl as $k => $v){
		for(;;){
			if(
				('00' == date('s')
			|| '30' == date('s')
			)
			&&
				('00' == date('i')
			|| '05' == date('i')
			|| '10' == date('i')
			|| '15' == date('i')
			|| '20' == date('i')
			|| '25' == date('i')
			|| '30' == date('i')
			|| '35' == date('i')
			|| '40' == date('i')
			|| '45' == date('i')
			|| '50' == date('i')
			|| '55' == date('i')
			)){
				post($v . ' ' . $k);
				sleep(1);

				$cmd = 'curl http://' . $_SERVER['SERVER_NAME'] . '/';
				system($cmd);

				break;
			}
		}
	}

	require_once 'read_data.php';
}
