<?php
	require_once('score_api.php');

	$userID = filter_input(INPUT_COOKIE, 'userID', FILTER_SANITIZE_NUMBER_INT);
	
	if(empty($userID)){
		die('Invalid Action!');
	}

	$scores = get_score($userID);
	jsonOutput($scores);