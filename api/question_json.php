<?php
	require_once('question_api.php');

	$examID = filter_input(INPUT_COOKIE, 'examID', FILTER_SANITIZE_NUMBER_INT);
	
	if(empty($examID)){
		die('Invalid Action!');
	}

	$questions = get_question($examID);
	jsonOutput($questions);