<?php

function checkExist($field, $value, $table, $connect) {
	if(is_string($value)) {
		$sql = "SELECT * FROM $table WHERE $field = '$value' LIMIT 1";
	} else {
		$sql = "SELECT * FROM $table WHERE $field = $value LIMIT 1";
	}
	$check = $connect->query($sql);
	if($check->num_rows > 0) {
		return true;
	}
	return false;
}