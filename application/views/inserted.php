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
</div>

</body>
</html>