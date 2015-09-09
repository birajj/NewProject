<?php ob_start(); 
require_once("config.php");
?>
<script type="text/javascript">
	function checkFields(objForm){
		
		var field1 = objForm.firstName.value.length;
		var field2 = objForm.lastName.value.length;
		var field3 = objForm.phoneNumber.value.length;
		var field4 = objForm.address.value.length;
		
		if(field1 == 0 || field2 == 0 || field3 == 0 || field4 == 0 ){
			alert("All Fields are Mandatory!!!");
			return false;
		}
	}
</script>

<?
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$fName = $_POST["firstName"];
	$lName = $_POST["lastName"];
	$phone = $_POST["phoneNumber"];
	$address = $_POST["address"];
	$myFile = 'data.csv';
	if (file_exists($myFile)) {
		$file = fopen($myFile,'r');
	
		while (($data = fgetcsv($file)) !== FALSE) {
			if($data[0] == $fName && $data[1] == $lName && $data[2] == $phone && $data[3] == $address) {
				header("Location: welcome.php");
			} else {
				echo "<span style='color:red'>Sorry we don't recognize you</span>";
				echo "<br><br>";
			}
		}
	}else {
		die("<span style='color:red'>Something went wrong.</span>");
	}
	fclose($file);
}
?>
   
<form action="" method="post" name="form1" id="form1">
<table cellpadding="3" cellspacing="0" width="100%" border="0">
	<tr>
      <td colspan="2">Add Personal Details</td>
    </tr>
    <tr>
      <td width="17%">&nbsp;</td>
      <td width="83%">&nbsp;</td>
    </tr>
    <tr>
      <td>First Name</td>
      <td><input type="text" name="firstName" id="firstName" size="35"/></td>
    </tr>
    <tr>
       <td>Last Name</td>
       <td><input type="text" name="lastName" id="lastName" size="35"/></td>
     </tr>
     <tr>
       <td>Phone Number</td>
       <td><input type="text" name="phoneNumber" id="phoneNumber" size="35"/></td>
     </tr>
      <tr>
       <td>Address</td>
       <td><input type="text" name="address" id="address"\ size="35"/></td>
     </tr>
     <tr>
      <td>&nbsp;</td>
      <td>
        <div class="buttons" style="float:left">
        <button type="submit" name="Submit" value="Save" onClick="return checkFields(document.getElementById('form1'));"/><img src="<?=$config["img_path"]?>disk.png">save        </div>
        
        <div class="buttons">
        <button type="button" name="Cancel" value="Cancel" onClick="window.location='<?=$config["site_url"]?>index.php';"/><img src="<?=$config['img_path']?>cancel.png">Cancel        </div>          </td>
    </tr>
</table>
</form>
