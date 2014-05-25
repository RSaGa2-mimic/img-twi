<?php

require_once '.env.php';	//settings $consumerKey, $consumerSecret, $accessToken, $accessTokenSecret
require_once 'src/twitter.class.php';

function post($data, $img_file = null){
	$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

	try {
		$tweet = $twitter->send($data, $img_file);
	} catch (TwitterException $e) {
		echo 'Error: ' . $e->getMessage();
	}
}
