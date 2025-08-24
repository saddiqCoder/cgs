<?php
$errors = [];
$message = [];

function hideError($var){
	$var = @strtolower(trim($var)) ;
	return $var;
}

function checkerrors ($error){
	if (isset($error) && !empty($error)){
		echo $error;
	}
}

function checkmessage ($message){
	if (!empty($message)){
		echo $message;
	}
}

function finalchecker($var){
	if ($var === true){
		return true;
	}else{
		return false;
	}
}

function cleanvariable($var, $con){
	$var = strtolower(trim(htmlentities(mysqli_real_escape_string($con, $var))));
	return $var;
}

function covert_str_to_normal($var){
	$var = html_entity_decode($var);
	return $var;
}

function echo_out_updateresult($rows, $row_counter){
    for ($counter1 = 0; $counter1 < $row_counter; $counter1++){
		$updatecontent = '
			<tr>
				<td>'.$rows[$counter1][0].'</td>
				<td>'.$rows[$counter1][1].'</td>
				<td>'.$rows[$counter1][2].'</td>
			</tr>
		';
		echo $updatecontent;
    }
}

function echo_out_loans($rows, $row_counter){
    for ($counter1 = 0; $counter1 < $row_counter; $counter1++){
		switch ($rows[$counter1][3]){
			case 0:
				$rows[$counter1][3] = 'request';
				break;
			case 1:
				$rows[$counter1][3] = 'confrimed';
				break;
			case 2:
				$rows[$counter1][3] = 'released';
				break;
			case 3:
				$rows[$counter1][3] = 'complteted';
				break;
			case 4:
				$rows[$counter1][3] = 'denied';
				break;
			default:
				$rows[$counter1][3] = 'invalid';
		}
		$updatecontent = '
			<tr>
				<td>'.$rows[$counter1][0].'</td>
				<td>'.$rows[$counter1][1].'</td>
				<td>'.$rows[$counter1][2].'</td>
				<td>'.$rows[$counter1][3].'</td>
			</tr>
		';
		echo $updatecontent;
    }
}

?>