<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<title>Update Data</title>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding-left: 8px;
    }

    /* tr:nth-child(even) {
        background-color: #dddddd;
    } */
    input[type=text] {
        width: 100%;
        padding: 5px;
        margin: 5px 0 5px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus {
        background-color: #ddd;
        outline: none;
    }

    #updatebtn {
        background-color: #04AA6D;
        color: #fff;
        padding: 4px;
        margin: 4px 0;
        border: none;
        cursor: pointer;
        width: 130px;
        opacity: 0.9;
    }

    button:hover {
        opacity:1;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
 
<body>
 <?php
  $i=1;
  foreach($data as $row)
  {
  ?>
	<form method="post">
        <table>
            <tr>
                <td>Enter First Name </td>
                <td><input type="text" name="f_name" value="<?php echo $row->First_Name; ?>"/></td>
            </tr>
            <tr>
                <td>Enter Last Email </td>
                <td><input type="text" name="l_name" value="<?php echo $row->Last_Name; ?>"/></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" id="updatebtn" name="update" value="Update_Records"/>
                </td>
            </tr>
        </table>
	</form>
	<?php } ?>
</body>
</html>