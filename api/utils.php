<?php
	function jsonOutput($data){
		$encoded = array();
		foreach($data as $row){
			foreach ($row as $key => $value) {
				$row[$key] = urlencode($value);
			}
			$encoded[] = $row;
		}
		$json = urldecode(json_encode($encoded, JSON_NUMERIC_CHECK));
		header('Content-Type: application/json; charset=utf-8');
		echo($json);
	}

	function fetch_assoc_all($result){
		$data = array();
		while($item = $result->fetch_assoc()){
			$data[] = $item;
		}
		return $data;
	}