<?php
	require_once('database.php');
	require_once('utils.php');

	function get_question($examID){
		global $conn;
		$stmt = $conn->prepare('SELECT `questions`.`questionID`, `subject`, `question`, `type`, `point` FROM exams
				JOIN `questions` ON examID = ? AND `exams`.`questionID` = `questions`.`questionID`');
		$stmt->bind_param('i', $examID);

		$stmt->execute();
		$result = $stmt->get_result();
		$data = fetch_assoc_all($result);

		return $data;
	}
