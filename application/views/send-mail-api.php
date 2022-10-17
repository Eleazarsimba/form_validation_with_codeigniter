<?php 
	$curl = curl_init();
	$request = '{ "email":"eleazarsimba5@gmail.com" }';
	curl_setopt($curl, CURLOPT_URL, 'https://send-email-for-ofisho-app.herokuapp.com/');
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, ['content-type: application/json']);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);// If there is no SSL Certificate

	$result = curl_exec($curl);
	$err = curl_error($curl);
	if($err) {
		echo 'Curl Error: ' . $err;
	} else {
		echo 'Message send';
		return $result;
	}
    curl_close($curl);
 ?>