<?php
	require_once('api/database.php');

	$json = json_decode(trim(file_get_contents('php://input')), true);
	//print_r($json);
	if($json){
		$errorStatus = 0;
		$conn->begin_transaction();
		$stmt = $conn->prepare('INSERT INTO `answers`(`userID`, `examID`, `questionID`, `answer`) VALUES (?, ?, ?, ?)');

		foreach ($json['answers'] as $key => $value) {
			$stmt->bind_param('iiss', $json['userID'], $json['examID'], $value['question'], $value['answer']);
			$stmt->execute();
			if($stmt->error){
				//print_r($stmt->error);
				$errorStatus = 1;
			}
		}

		$stmt = $conn->prepare('SELECT `answers`.`questionID`, `questions`.`point` FROM `answers` 
				JOIN `questions` ON `answers`.`userID` = ? AND `answers`.`examID` = ? AND `answers`.`answer` = `questions`.`answer`');

		$stmt->bind_param('ii', $json['userID'], $json['examID']);
		
		$stmt->execute();
		if($stmt->error){
			$errorStatus = 1;
		}
		$result = $stmt->get_result();
		
		//calc the score
		$score = 0;
		while($row = $result->fetch_assoc()){
			$score += $row['point'];
		}

		$stmt = $conn->prepare('INSERT INTO `scores`(`userID`, `examID`, `score`) VALUES (?, ?, ?)');

		$stmt->bind_param('iii', $json['userID'], $json['examID'], $score);
		$stmt->execute();
		if($stmt->error){
			$errorStatus = 1;
		}

		if ($errorStatus == 0){
			$conn->commit();
			echo 'Success';
		} else{
			$conn->rollback();
			echo 'Failed';
		}
	} else{
		die('Invalid JSON Data');
	}