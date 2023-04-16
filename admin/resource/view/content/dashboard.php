<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/DashboardController.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$dashboard = new DashboardController;
$eloquent = new Eloquent;


## ===*=== [F]ETCH SUMMARY DATA ===*=== ##

#== TOTAL SALE STATUS
$saleResult = $dashboard->sumResult('orders', 'grand_total');
$totalSale = ceil($saleResult[0]['SUM(grand_total)']);	


#== THIS MONTH SALE STATUS
$monthResult = $dashboard->sumByDate('orders', 'grand_total', 'order_date');
$monthSale = ceil($monthResult[0]['SUM(grand_total)']);


#== NEWLY ADDED PRODUCT STATUS
$newResult = $dashboard->dateData('products', 'created_at');
$newProduct = count($newResult);	


#== TOTAL TAX STATUS
$taxResult = $dashboard->sumResult('orders', 'tax');
$totalTax = ceil($taxResult[0]['SUM(tax)']);	


#== NEW ORDER STATUS
$orderResult = $dashboard->getData('orders', 'order_item_status', 'Pending');
$totalOrder = count($orderResult);


#== PRODUCT STATUS
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "products";
$productResult = $eloquent->selectData($columnName, $tableName);
$totalProduct = count($productResult);	


#== SUBSCRIBER STATUS
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "newsletters";
$subscriberResult = $eloquent->selectData($columnName, $tableName);
$totalSubscriber = count($subscriberResult);	


#== CUSTOMER STATUS
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "customers";
$customerResult = $eloquent->selectData($columnName, $tableName);
$totalCustomer = count($customerResult);

## ===*=== [F]ETCH SUMMARY DATA ===*=== ##
?>

<!--=*= DASHBOARD SECTION START =*=-->
<div class="wrapper">	
	<div class="row states-info" style="text-transform: uppercase;">
		<div class="col-md-3">
			<div class="panel red-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-usd"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Total Sale </span>
							<h4 class="counter"> <?= $totalSale ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel blue-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-tags"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Sales This Month </span>
							<h4 class="counter"> <?= $monthSale ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel green-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-gavel"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> New Order </span>
							<h4 class="counter"> <?= $totalOrder ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel yellow-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-file-text"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Total Tax </span>
							<h4 class="counter"> <?= $totalTax ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<div class="row states-info" style="text-transform: uppercase;">
		<div class="col-md-3">
			<div class="panel green-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-dot-circle-o"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> New Products Added </span>
							<h4 class="counter"> <?= $newProduct ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel yellow-bg">
				
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-anchor"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Total Products </span>
							<h4 class="counter"> <?= $totalProduct ?></h4>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel red-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-chain"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Newsletter Subscriber </span>
							<h4 class="counter"> <?= $totalSubscriber ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel blue-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-user"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Register Customer </span>
							<h4 class="counter"> <?= $totalCustomer ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-body">
							<div class="profile-pic text-center">
								<img alt="" src="<?php echo $GLOBALS['ADMINS_DIRECTORY'] . $_SESSION['SMC_login_admin_image']; ?>">
							</div>
							<div class="text-center" style="padding-bottom: 10px;">
								<h3> <?php echo $_SESSION['SMC_login_admin_name']; ?> </h3>
								<h5 class="designation">WEB DEVELOPER </h5>
							</div>
							<a class="btn p-follow-btn pull-left" href="#"> <i class="fa fa-check"></i> Following</a>
							<ul class="p-social-link pull-right">
								<li class="active">
									<a href="#">
										<i class="fa fa-github"></i>
									</a>
								</li>
								<li class="active">
									<a href="#">
										<i class="fa fa-stack-overflow"></i>
									</a>
								</li>
								<li class="active">
									<a href="#">
										<i class="fa fa-linkedin"></i>
									</a>
								</li>										
								<li class="active">
									<a href="#">
										<i class="fa fa-facebook"></i>
									</a>
								</li>									
								<li class="active">
									<a href="#">
										<i class="fa fa-twitter"></i>
									</a>
								</li>									
							</ul>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
	</div>
</div>
<!--=*= DASHBOARD SECTION END =*=-->
