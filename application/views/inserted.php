<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Display records</title>

	<style type="text/css">
        table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
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
	<tr style="background:#CCC">
		<th>Email</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>DELETE</th>
	</tr>
	<?php
		if($data->num_rows() > 0){
			foreach($data->result() as $row){
			?>
				<tr>
					<td><?php echo $row->Email; ?></td>
					<td><?php echo $row->First_Name; ?></td>
					<td><?php echo $row->Last_Name; ?></td>
					<td><a href='deletedata?Email=<?php echo $row->Email; ?>'>Delete</a></td>
				</tr>
			<?php
			}
		}else{
		?>
			<tr>
				<td colspan="4">No data found</td>
			</tr>
		<?php
		}
	?>
	</table>







	<p><a href="<?php echo base_url(); ?>home/logout">Logout</a></p>






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

</script>
</html>