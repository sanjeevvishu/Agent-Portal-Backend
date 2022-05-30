<?php

/* GET TOTAL AGENTS REGISTER TODAY */

function getTotalCountOfAgentsToday(){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\r\n\"dataform\": \"tpx6a1p7l9\",\r\n\"filters\": [\r\n\t\t\t\t{\r\n\t\t\t\t\t\"field\": \"created_date\",\r\n\t\t\t\t\t\"op\": \"today\",\r\n\t\t\t\t\t\"values\": []\r\n\t\t\t\t}\r\n\t\t],\r\n\"getfieldvalues\": false,\r\n\"use_field_slug\": true\r\n}",
	  CURLOPT_HTTPHEADER => array(
	    "authorization: ApiKey bilalkeskin_94:7e16941c8cb6a8c4630a9890e91900fc09ad7184",
	    "cache-control: no-cache",
	    "content-type: application/json",
	    "postman-token: 7b619f1f-5ab6-48f1-fe76-80973c04d400"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
		$JsonToArrayObj = json_decode($response);
	  	return $JsonToArrayObj->meta->total_count;
	  	//print_r(json_decode($response));
	}
}


/* GET TOTAL TODAYS APPOINTMENTS */

function getTotalCountOfAppontmentsToday(){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\r\n\"dataform\": \"fa7v9e4go6\",\r\n\"filters\": [\r\n\t\t\t\t{\r\n\t\t\t\t\t\"field\": \"created_date\",\r\n\t\t\t\t\t\"op\": \"today\",\r\n\t\t\t\t\t\"values\": []\r\n\t\t\t\t}\r\n\t\t],\r\n\"getfieldvalues\": false,\r\n\"use_field_slug\": true\r\n}",
	  CURLOPT_HTTPHEADER => array(
	    "authorization: ApiKey bilalkeskin_94:7e16941c8cb6a8c4630a9890e91900fc09ad7184",
	    "cache-control: no-cache",
	    "content-type: application/json",
	    "postman-token: 29b5f334-c468-30c3-7667-040cbaec8d21"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  $JsonToArrayObj = json_decode($response);
	  return $JsonToArrayObj->meta->total_count;
	}
}


/* GET TOTAL TODAYS MEETINGS WITH CLIENTS */

function getTotalCountOfMeetingssToday(){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\r\n\"dataform\": \"sm8kikp4yt\",\r\n\"filters\": [\r\n\t\t\t\t{\r\n\t\t\t\t\t\"field\": \"actual_start_date\",\r\n\t\t\t\t\t\"op\": \"today\",\r\n\t\t\t\t\t\"values\": [\"25-01-2022\"]\r\n\t\t\t\t}\r\n\t\t],\r\n\"getfieldvalues\": false,\r\n\"use_field_slug\": true\r\n}",
	  CURLOPT_HTTPHEADER => array(
	    "authorization: ApiKey bilalkeskin_94:7e16941c8cb6a8c4630a9890e91900fc09ad7184",
	    "cache-control: no-cache",
	    "content-type: application/json",
	    "postman-token: b8c27193-2aa4-dd99-f9d1-639a1c8d858c"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {	  
	  $JsonToArrayObj = json_decode($response);
	  return $JsonToArrayObj->meta->total_count;
	}
}


/* GET TOTAL TODAYS Oppotunities */

function getTotalCountOfMeetingssToday(){

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\r\n\"dataform\": \"f1eivythtw\",\r\n\"filters\": [\r\n\t\t\t\t{\r\n\t\t\t\t\t\"field\": \"created_date\",\r\n\t\t\t\t\t\"op\": \"today\",\r\n\t\t\t\t\t\"values\": [\"25-01-2022\"]\r\n\t\t\t\t}\r\n\t\t],\r\n\"getfieldvalues\": false,\r\n\"use_field_slug\": true\r\n}",
	  CURLOPT_HTTPHEADER => array(
	    "authorization: ApiKey bilalkeskin_94:7e16941c8cb6a8c4630a9890e91900fc09ad7184",
	    "cache-control: no-cache",
	    "content-type: application/json",
	    "postman-token: 23887cf8-848f-e340-072b-dc37a392b6e2"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  $JsonToArrayObj = json_decode($response);
	  return $JsonToArrayObj->meta->total_count;		
	}
}


/* GET TOTAL TODAYS SALES */

function getTotalCountOfMeetingssToday(){

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\r\n\"dataform\": \"ededuslire\",\r\n\"filters\": [\r\n\t\t\t\t{\r\n\t\t\t\t\t\"field\": \"created_date\",\r\n\t\t\t\t\t\"op\": \"today\",\r\n\t\t\t\t\t\"values\": [\"25-01-2022\"]\r\n\t\t\t\t}\r\n\t\t],\r\n\"getfieldvalues\": false,\r\n\"use_field_slug\": true\r\n}",
	  CURLOPT_HTTPHEADER => array(
	    "authorization: ApiKey bilalkeskin_94:7e16941c8cb6a8c4630a9890e91900fc09ad7184",
	    "cache-control: no-cache",
	    "content-type: application/json",
	    "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  $JsonToArrayObj = json_decode($response);
	  return $JsonToArrayObj->meta->total_count;		
	}
}

exit;

?>