<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Display records</title>

	<style type="text/css">
		/* delete multiple users */
		.remove_Row {
			background-color: #FF0000;
			color:#FFFFFF;
		}
	</style>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

    <div id="container">

	    <h3>Delete Multiple Users</h3><br />

        <span class="text-danger error-infor"><?php echo $this->session->flashdata('error'); ?></span>
        <span class="text-primary error-primary"><?php echo $this->session->flashdata('success'); ?></span>


        <form action="<?php echo base_url(); ?>home/delete_multiple" method="POST">
            <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><button type="submit" name="delete_all" id="delete_all" class="btn btn-danger btn-xm">Delete</button></th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($data->result() as $row)
                {
                    echo '
                    <tr id="dataRows">
                        <td>
                            <input type="checkbox" class="delete_checkbox" name="checkbox_value[]" id="delete_checkbox" value='.$row->Email.'/>
                        </td>
                        <td>'.$row->Email.'</td>
                        <td>'.$row->First_Name.'</td>
                        <td>'.$row->Last_Name.'</td>
                    </tr>
                    ';
                }
                ?>
                </tbody>
                </table>
            </div>
        </form>
    </div>

</body>
<script>
	// change background color of record to delete
	$(document).ready(function(){
 
		$('#delete_checkbox').click(function(){
		if($(this).is(':checked'))
		{
			$("#dataRows").addClass('remove_Row');
		}
		else
		{
			$("#dataRows").removeClass('remove_Row');
		}
        });
	});
</script>
</html>