<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Display images</title>

	<style type="text/css">
		* {
			padding: 5px;
		}
        table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		form {
			margin-top: 20px;
		}
	</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div id="container">

	<table width="600" cellspacing="5" cellpadding="5">
		<thead>
			<tr style="background:#CCC">
				<th>Email</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>UPDATE</th>
			</tr>
		</thead>
		<tbody id="tbody2">
		</tbody>
	</table>




	<form method="post" id="upload_form" enctype="multipart/form-data">  
		<input type="file" name="image_file" id="image_file" />  
		<br />  
		<br />  
		<input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />  
	</form>  
	<br />  
	<br />  
	<div id="uploaded_image">  
	</div>  


</div>

</body>
<script>
	//fetch data from db
	$.ajax({
		url:"<?php echo base_url(); ?>home/fetched",
		type: "POST",
		cache: false,
		success:function(data)
		{
			$('#tbody2').html(data);
		}
	});

	//image upload
	$(document).ready(function(){  
      $('#upload_form').on('submit', function(e){  
           e.preventDefault();  
           if($('#image_file').val() == '')  
           {  
                alert("Please Select the File");  
           }  
           else  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>home/upload_toGaller",     
                     method:"POST",  
                     data:new FormData(this),  
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     success:function(data)  
                     {  
                          $('#uploaded_image').html(data);  
                     }  
                });  
           }  
		});  
	});  

</script>
</html>