<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NOA HOTEL</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->

    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">

        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"><?php echo $_SESSION["user"]; ?> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="home.php"><i class="fa fa-dashboard"></i> Status</a>
                    </li>
                    <li>
                        <a href="messages.php"><i class="fa fa-desktop"></i> News Letters</a>
                    </li>
                    <li>
                        <a href="roombook.php"><i class="fa fa-bar-chart-o"></i>Room Booking</a>
                    </li>
                    <li>
                        <a class="active-menu" href="payment.php"><i class="fa fa-qrcode"></i> Payment</a>
                    </li>
                    <li>
                        <a href="profit.php"><i class="fa fa-qrcode"></i> Profit</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>



            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Payment Details<small> </small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->


                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Room Type</th>
                                                <th>Bed Type</th>
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                                <th>No of Room</th>
                                                <th>Meal Type</th>
                                                <th>Room Rent</th>
                                                <th>Bed Rent</th>
                                                <th>Meals</th>
                                                <th>Gr. Total</th>
                                                <th>Print</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('db.php');
                                            $sql = "SELECT * FROM payment";
                                            $re = mysqli_query($con, $sql);
                                            while ($row = mysqli_fetch_array($re)) {
                                                $id = $row['id'];
                                                $status = $row['payment_status']; // Assuming this column exists
                                                $button = ($status == 'pending')
                                                    ? "<form method='POST' style='display:inline;'>
                                    <input type='hidden' name='payment_id' value='$id'>
                                    <button type='submit' name='confirm_payment' class='btn btn-success'>Confirm Payment</button>
                               </form>"
                                                    : "<span class='btn btn-info'>Confirmed</span>";

                                                $class = ($id % 2 == 1) ? 'gradeC' : 'gradeU';

                                                echo "<tr class='$class'>
                                <td>" . $row['title'] . " " . $row['fname'] . " " . $row['lname'] . "</td>
                                <td>" . $row['phone'] . "</td>
                                <td>" . $row['troom'] . "</td>
                                <td>" . $row['tbed'] . "</td>
                                <td>" . $row['cin'] . "</td>
                                <td>" . $row['cout'] . "</td>
                                <td>" . $row['nroom'] . "</td>
                                <td>" . $row['meal'] . "</td>
                                <td>" . $row['ttot'] . "</td>
                                <td>" . $row['mepr'] . "</td>
                                <td>" . $row['btot'] . "</td>
                                <td>" . $row['fintot'] . "</td>
                                <td><a href='print.php?pid=$id'><button class='btn btn-primary'><i class='fa fa-print'></i> Print</button></a></td>
                                <td>" . ucfirst($status) . "</td>
                                <td>$button</td>
                              </tr>";
                                            }

                                            // Handle payment confirmation
                                            if (isset($_POST['confirm_payment'])) {
                                                $paymentId = $_POST['payment_id'];
                                                $updateQuery = "UPDATE `payment` SET `payment_status` = 'confirmed' WHERE `id` = ?";
                                                $stmt = $con->prepare($updateQuery);
                                                $stmt->bind_param("i", $paymentId);
                                                if ($stmt->execute()) {
                                                    echo "<script>alert('Payment ID $paymentId has been confirmed.'); window.location.href = 'payment.php';</script>";
                                                } else {
                                                    echo "<script>alert('Error confirming payment: " . $con->error . "');</script>";
                                                }
                                                $stmt->close();
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!--End Advanced Tables -->
                    </div>
                </div>
                <!-- /. ROW  -->

            </div>

        </div>


    </div>
    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>