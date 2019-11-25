<?php
	include 'connectdb.php';	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	session_start();	
	if(!$conn){
		die("Unable to connect to database " . mysql_error());
	}
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Employee Information</title>
        <link rel="stylesheet" href="index.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>

    </head>


    <body class='bg-light'>
		<?php include 'header.php' ?>
        <div class='container'>
            <!-- Header --> 
           <div class='d-flex justify-content-between p-3 my-3 text-dark-50 bg-white rounded shadow'>
                <h4> Lucky Dragon Employee Information </h4>
                <button class='btn btn-info'>Filter</button>                      
           </div>

			<!-- Menu Items -->
			
			<!-- SQL Query -->
			<table class='table'>
				<thead class='thead-dark'>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Position Name</th>
						<th>Payrate</th>
					</tr>
			<?php
				$sql = "SELECT *
						FROM Employees E
						LEFT JOIN EmployeeCategories EC ON E.EmpCategoryId = EC.EmpCategoryId
						ORDER BY E.EmpCategoryId ASC";
				$sql_get = $conn->query($sql);
				while($row = $sql_get->fetch_assoc()){
				?>
					<tr>
						<td><?= $row['FirstName']?></td>
						<td><?= $row['LastName']?></td>
						<td><?= $row['EmpCategory']?></td>
						<td><?= "$".$row['Wage']?></td>
					</tr>

				<?php
				}
				$sql_get->close();
			?>
			</table>
        </div>
        <!-- End Container -->
    </body>
</html>
