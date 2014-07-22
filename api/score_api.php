<?php
	require_once('database.php');
	require_once('utils.php');

	function get_score($userID){
		global $conn;
		$stmt = $conn->prepare('SELECT `examID`, `score` FROM `scores` WHERE `userID` = ?');
		$stmt->bind_param('i', $userID);

		$stmt->execute();
		$result = $stmt->get_result();
		$data = fetch_assoc_all($result);

		return $data;
	}
