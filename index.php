<?php
include 'core/config.php';
checkLoginStatus();
$page = (isset($_GET['page']) && $_GET['page'] !='') ? $_GET['page'] : '';
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Sales</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

    <!-- PAGE LEVEL STYLESHEETS -->
    <link rel="stylesheet" href="lib/css/jquery.dataTables.min.css">
    <!-- /PAGE LEVEL STYLESHEETS -->
    <!-- PAGE LEVEL STYLESHEETS -->
    <link rel="stylesheet" href="lib/css/classic.css">
    <link rel="stylesheet" href="lib/css/classic.date.css">
    <!-- /PAGE LEVEL STYLESHEETS -->
    <!-- DEFAULT STYLESHEETS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/icons/fontawesome/styles.min.css">
    <!-- /DEFAULT STYLESHEETS -->

    <script type="text/javascript" src="lib/js/jquery.min.js"></script>
    <script type="text/javascript" src="lib/js/tether.min.js"></script>
    <script type="text/javascript" src="lib/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/app.min.js"></script>

    <!-- PAGE LEVEL SCRIPTS -->
    <script type="text/javascript" src="lib/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/pages_datatables.min.js"></script>
    <script type="text/javascript" src="lib/js/picker.js"></script>
    <script type="text/javascript" src="lib/js/picker.date.js"></script>
    <script type="text/javascript" src="assets/js/pickers_date.min.js"></script>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-toggleable-md">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav">
            <span>
                <i class="fa fa-code-fork"></i>
            </span>
        </button>

        <button class="navbar-toggler navbar-toggler-left" type="button" id="toggle-sidebar">
            <span>
               <i class="fa fa-align-justify"></i>
            </span>
        </button>

        <a class="navbar-brand logo" href="#">
            <img src="assets/img/logo1.png">
        </a>
		<?php include 'topbar.php';?>
    </nav>
    <!-- /NAVBAR -->

    <div class="page-container">
        <div class="page-content">
            <!-- inject:SIDEBAR -->
			<?php include 'sidebar.php';?>

            <!-- inject:/SIDEBAR -->

            <!-- PAGE CONTENT -->
			<?php require_once 'routes/routes.php'; ?>
            <!-- /PAGE CONTENT -->
        </div>
    </div>
<script type="text/javascript">
        function checkAll(ele) {
            var checkboxes = document.getElementsByTagName('input');
            if (ele.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = true;
                        }
                    }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    //console.log(i)
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = false;
                    }
                }
            }
        }
</script>
</body>

</html>