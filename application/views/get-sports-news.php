<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create an account</title>

	<style type="text/css">
        @media screen and (min-width: 800px) {
            #container {
                margin: 5px 150px 0px 150px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
        }
        @media screen and (max-width: 800px) {
            #container {
                margin: 2px 20px 0px 20px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        * {
            box-sizing: border-box
        }

        
	</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>" />
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  

</head>
<body>

<div id="container">
<h2>World sports news</h2>


<table id="user_data" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Author</th>
            <th>Title</th>
            <th>Source</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody id="tabledb">
    
    </tbody>
</table>
</div>

</body>
<script>
    fetch("http://api.mediastack.com/v1/news?access_key=8137b743c25881df6500548cf5d2622d&categories=sports&languages=en")
    .then((data) => {
        //convert to json
        return data.json();
    })
    .then((objectData) => {
        // console.log(objectData.data[0].title);
        let tableData = "";
        objectData.data.map((values) => {
            tableData += `<tr>
                <td>${values.author}</td>
                <td>${values.title}</td>
                <td>${values.source}</td>
                <td>${values.category}</td>
            </tr>`;
            console.log(tableData)
        });
        document.getElementById("tabledb").innerHTML = tableData
    })
    .catch((err) => {
        console.log(err)
    })
</script>
</html>