<?php
error_reporting(1);
$uploadedStatus = 0;
ini_set('memory_limit', '-1');
if ( isset($_POST["submit"]) ) {
	if ( isset($_FILES["file"])) {
		if ($_FILES["file"]["error"] > 0) {
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else {
			$time = time();
			$myname = $time.'.xlsx'; 
			$storagename = "upload/$myname";
			move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);

			define ("DB_HOST", "18.130.123.56"); // set database host portal.cubedots.com
			define ("DB_USER", "cuengine_portal"); // set database user
			define ("DB_PASS","porTal@!2022@CU"); // set database password
			define ("DB_NAME","cuengine_portal"); // set database name

			//$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			
			// Check connection
			/*if ($mysqli -> connect_errno) {
				echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
				exit();
			}*/
			//exit;
			/************************ YOUR DATABASE CONNECTION END HERE  ****************************/


			set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
			include 'PHPExcel/IOFactory.php';

			// This is the file path to be uploaded.
			$inputFileName = $storagename; 

			try {
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}


			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
			//echo '<BR> COUNT => '.$arrayCount.'<BR>arrayCount<BR><pre>';
			//print_r($allDataInSheet);
			//exit;
			$me = 0;
			for($i=2;$i<=$arrayCount;$i++){
				//echo '<BR> COUNT => <BR>';print_r($allDataInSheet); echo '<BR>arrayCount<BR><pre>';
				if($allDataInSheet[$i]["N"] != ''){
					
					//get total number of records
					$results = $mysqli->query("SELECT COUNT(*) FROM users WHERE email='".$allDataInSheet[$i]["E"]."'");
					echo '<BR><BR>Total Rows of Email'.$allDataInSheet[$i]["E"].'--->'.$get_total_rows = $results->fetch_row(); //hold total records in variable

					if($get_total_rows == 0 ){
						/*echo '<BR>'.$orgzit_customer_record_id = trim($allDataInSheet[$i]["A"]);
						echo '<BR>'.$orgzit_id = trim($allDataInSheet[$i]["B"]); 
						echo '<BR>'.$fullName = trim($allDataInSheet[$i]["C"]); 
						echo '<BR>'.$phone = trim($allDataInSheet[$i]["D"]); 
						echo '<BR>'.$email = trim($allDataInSheet[$i]["E"]); 
						echo '<BR>'.$company = trim($allDataInSheet[$i]["F"]);*/
						/*$insert_row = $mysqli->query("INSERT INTO users (name, email, orgzit_id, orgzit_customer_record_id, phone, company_name) VALUES($fullname, $email, $orgzit_id, $orgzit_customer_record_id, $phone, $company)");
						if($insert_row){
							print 'Success! ID of last inserted record is : ' .$mysqli->insert_id .'<br />'; 
						}else{
							die('Error : ('. $mysqli->errno .') '. $mysqli->error);
						}*/
					}
				}
				
			}
		
		}
	}
}
?> 
 
 
 
 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Import Excel </title> 
</head>
<body>



<table width="600" style="margin:115px auto; background:#f8f8f8; border:1px solid #eee; padding:10px;">

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

<tr><td colspan="2" style="font:bold 21px arial; text-align:center; border-bottom:1px solid #eee; padding:5px 0 10px 0;">
 </td></tr>

<tr><td colspan="2" style="font:bold 15px arial; text-align:center; padding:0 0 5px 0;">Data Uploading System  </td></tr>

<tr>

<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Select file</td>

<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="file" name="file" id="file" /></td>

</tr>





<tr>

<td style="font:bold 12px tahoma, arial, sans-serif; text-align:right; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Submit</td>

<td width="50%" style=" padding:5px;"><input type="submit" name="submit" /></td>

</tr>

</table>
<body>
</html>