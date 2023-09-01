<?php
	require_once __DIR__ . '/vendor/autoload.php';
	// configure the Google Client
	$client = new \Google_Client();
	$client->setApplicationName('Google Sheets API');
	$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
	$client->setAccessType('offline');
	// credentials.json is the key file we downloaded while setting up our Google Sheets API
	$path = 'credentials.json';
	$client->setAuthConfig($path);

	// configure the Sheets Service
	$service = new \Google_Service_Sheets($client);

	// the spreadsheet id can be found in the url https://docs.google.com/spreadsheets/d/1mi8r67r_OsNDpMa0aEwpWUKNJ72YJt173xGVH4S973I/edit#gid=0
	$spreadsheetId = '1mi8r67r_OsNDpMa0aEwpWUKNJ72YJt173xGVH4S973I';
	$spreadsheet = $service->spreadsheets->get($spreadsheetId);
	// var_dump($spreadsheet);


	// // get all the rows of a sheet
	// $range = 'students'; // here we use the name of the Sheet to get all the rows
	// $response = $service->spreadsheets_values->get($spreadsheetId, $range);
	// $values = $response->getValues();
	// var_dump($values);


	// append new row
	$name = $_POST['name'];
	$email = $_POST['email'];
	$roll = $_POST['roll'];
	$newRow = [
	    $name,
	    $email,
	    $roll
	];
$rows = [$newRow]; // you can append several rows at once
$valueRange = new \Google_Service_Sheets_ValueRange();
$valueRange->setValues($rows);
$range = 'students'; // the service will detect the last row of this sheet
$options = ['valueInputOption' => 'USER_ENTERED'];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $options);

?>


