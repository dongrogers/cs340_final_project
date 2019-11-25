<?php
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(-1);
	include 'connectdb.php';	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
	if(!$conn){
		die("Unable to connect to database " . mysql_error());
	}
	
	if (isset($_SESSION['AccountId'])) {
		$ID = $_SESSION['AccountId'];
	}

	if(isset($_SESSION["menu_item"])){
		$total_quantity = 0;
		$total_price = 0;
	}

	$today = date("Y-m-d");
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Menu</title>
        <link rel="stylesheet" href="index.css">
		<script type='text/javascript' src="jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
		<script src="javascript/menu.js"></script>
    </head>


    <body class='bg-light'>
		<?php include 'header.php' ?>
		<div class='container-fluid'>
			<div class='row'>
				<!-- CART INFORMATION -->
				<div class='col-6'>
	            	<!-- Header --> 
					<div class='d-flex justify-content-between p-3 my-3 text-dark-50 bg-white rounded shadow'>
        		        <h4> Cart </h4>
					</div>
				
					<!-- Cart Modal -->
					<table class='table'>
					<?php if(isset($_SESSION['menu_item'])) :?>
						<thead>
							<tr>
								<th>Name</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody>
						<?php
							if(isset($_SESSION["menu_item"])){
								foreach ($_SESSION["menu_item"] as $item){
									$item_price = $item["quantity"]*$item["Price"];
								?>
									<tr>
										<td><?php echo $item["Name"]; ?></td>
										<td><?php echo $item["quantity"]; ?></td>
										<td><?php echo "$ ".$item["Price"]; ?></td>
										<td>
											<a href='menu.php?action=remove&code=<?= $item['ProductId'] ?>'>
												<button class='btn btn-danger fas fa-trash text-center' type='submit' value='<?= $item['ProductId'] ?>'></button>
											</a>
										</td>
									</tr>
								<?php
									$total_quantity += $item["quantity"];
									$total_price += ($item["Price"]*$item["quantity"]);
								}
							}
							?>
							<tr class='table-success'>
								<td class='font-weight-bold'>Total</td>
								<td class='font-weight-bold'><?= $total_quantity?></td>
								<td class='font-weight-bold'><?= "$".$total_price ?></td>
								<td>
									<a class='text-center' type='submit' href='menu.php?action=empty'>
									<button class='btn btn-danger text-center' type='submit' href='menu.php?action=empty'>Clear Cart</button>
								</td>
							</tr>
						</tbody>
						<?php endif; ?>
					</table>
				</div>
				<!-- ORDER INFORMATION -->
				<div class='col-6'>
					<div class='d-flex justify-content-between p-3 my-3 text-dark-50 bg-white rounded shadow'>
        		        <h4> Checkout Information </h4>
					</div>

					<form>
						<!-- First/Last Name -->
						<div class="row">
						    <div class="col">
							      <input type="text" class="form-control" placeholder="First name">
							</div>
							<div class="col">
								<input type="text" class="form-control" placeholder="Last name">
							</div>
						</div>
						<!-- Address Ciy State Zip -->
						<div class="row mt-2">
						    <div class="col">
							      <input type="text" class="form-control" placeholder="Address">
							</div>
						    <div class="col">
							      <input type="text" class="form-control" placeholder="City">
							</div>
						    <div class="col">
							      <input type="text" class="form-control" placeholder="State">
							</div>
						    <div class="col">
							      <input type="text" class="form-control" placeholder="Zipcode">
							</div>
						</div>
						<!-- Submit -->
						<div class='row mt-4'>
							<div class='col-5'></div>
							<div class='col'>
								<button class='btn btn-lg btn-success' type='submit'>Place Order</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
        <!-- End Container --> 
    </body>
</html>
