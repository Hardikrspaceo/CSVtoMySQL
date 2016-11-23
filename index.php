<?php
	include_once 'connection.php';
	if(isset($_POST['submit'])){
		if($_FILES['csv_data']['name']){
			
			$arrFileName = explode('.',$_FILES['csv_data']['name']);
			if($arrFileName[1] == 'csv'){
				$handle = fopen($_FILES['csv_data']['tmp_name'], "r");
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

					 $item1 = mysqli_real_escape_string($conn,$data[0]);
					$item2 = mysqli_real_escape_string($conn,$data[1]);
					$import="INSERT into tbl_csv(item1,item2) values('$item1','$item2')";
					mysqli_query($conn,$import);
				}
				fclose($handle);
				print "Import done";
			}
		}
	}
?>
<html>
	<head>
		<title> SpaceoBloging :: Upload CSV and Insert into Database Using PHP</title>
	<head>
	<body>
		<form method='POST' enctype='multipart/form-data'>
			Upload CSV: <input type='file' name='csv_data' /> <input type='submit' name='submit' value='Upload CSV' />
		</form>
	</body>
</html>