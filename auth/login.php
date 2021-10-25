<?php 
require_once '../core/config.php';

if(isset($_SESSION['userid'])){
	header("Location: ../index.php");
	exit;
}

if(isset($_POST['userlogin'])){
	$result = processLogin();
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>LGMSMS</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/icons/fontawesome/styles.min.css">

    <script type="text/javascript" src="../lib/js/jquery.min.js"></script>
    <script type="text/javascript" src="../lib/js/tether.min.js"></script>
    <script type="text/javascript" src="../lib/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="assets/js/app.min.js"></script>
</head>

<body>
	<form method='POST' action=''>
		<div class="page-container" style='margin-top:50px'>
			<!-- PAGE CONTENT -->
			<div class="content h-100">
				<div class="row h-100">
					<div class="col-lg-12">
						<div class="login card auth-box mx-auto my-auto">
							<div class="card-block text-center">
								<div class="user-icon">
									<i class="fa fa-user-circle"></i>
								</div>
								<h4 class="text-light">LGMSMS</h4>

								<div class="user-details">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">
													<i class="fa fa-user-o"></i>
												</span>
											<input type="text" name="userlogin" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">
													<i class="fa fa-key"></i>
												</span>
											<input type="password" name="userpassword" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
										</div>
									</div>
								</div>

								<button type="submit" name='submit' class="btn btn-primary btn-lg btn-block">LOGIN</button>

								<div class="user-links">
										<div style="margin-bottom: 10px;">
											<center>
												<span style="font-size:10px;">
													&copy;Copyright LIBRON GMSMS <?php echo date("Y")?>. All Rights Reserved.</br>
													Powered by AwtsCodeIgniter.
												</span>
											</center>
										</div>
										<div>
											<span style="text-align:center;font-size:12px;">
											<?php
											  if(isset($_SESSION['error'])){
												$message = $_SESSION['error'];
												if(!empty($message)){
												  echo '<div id="warning" class="animated shake" style="color:#c62828; margin-top: 3px; margin-bottom: 3px;" class="isa_error">
													 <i class="fa fa-times-circle"></i>
													 '.$message.'
												  </div>';
												}
											  }
											?>
											</span>
										</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /PAGE CONTENT -->
		</div>
	</form>
</body>

</html>