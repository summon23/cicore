<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
    
</head>
<body>
    <table id="book-table" border="1">
    <thead>
    <tr><td>Book Title</td><td>Book Price</td><td>Book Author</td></tr>
    </thead>
    <tbody>
    </tbody>
    </table>
</body>

<script type="text/javascript">
$(document).ready(function() {
    $('#book-table').DataTable({
        "ajax": {
            url : "<?php echo base_url("user/ajaxrequest/getuser") ?>",
            type : 'GET'
        },
    });
});
</script>
</html>