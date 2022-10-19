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
            box-sizing: border-box;
        }

        /* styling datatable search field */
        div.dataTables_filter > label > input {
            margin-right: 20px
        }
                    
	</style>

    <script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src = "https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src = "https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <link rel = "stylesheet" href = "https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>" />

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
            <th>Image</th>
        </tr>
    </thead>
    <tbody id="tabledb">
    
    </tbody>
</table>
</div>

</body>
<script>
    $(document).ready(function () {
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
                    <td><img src=${values.image} alt="No image" height=100 width=100></img></td>
                </tr>`;
                console.log(tableData)
            });
            document.getElementById("tabledb").innerHTML = tableData
            $(document).ready(function () {
                $('#user_data').dataTable().css('padding', '2px');
            });
        })
        .catch((err) => {
            console.log(err)
        })
    });

    // $(document).ready(function () {
    //     $('#user_data').dataTable();
    // });
</script>
</html>