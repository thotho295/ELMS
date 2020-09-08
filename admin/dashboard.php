<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>

            <!-- Title -->
            <title>Dashboard</title>

            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
            <meta charset="UTF-8">
            <meta name="description" content="Responsive Admin Dashboard Template" />
            <meta name="keywords" content="admin,dashboard" />
            <meta name="author" content="Steelcoders" />

            <!-- Styles -->
            <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
            <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
            <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
            <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">


            <!-- Theme Styles -->
            <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
            <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>

            <!-- CSS only -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

            <!-- JS, Popper.js, and jQuery -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

            <style>
                span{
                    color: black;
                }
            </style>   
        </head>
        <body>
            <?php include('includes/header.php'); ?>
            <?php include('includes/sidebar.php'); ?>
            <div class="mn-content fixed-sidebar" style="background: #C1FFC1">
            <main class="mn-inner" >
                <div class="row">
                    <div class="col-md-4" >
                        <div class="card stats-card" style="background: #00CED1;">
                            <div class="card-content" >
                                <span class="card-title" style="color:black; font-size: 15px">Totle Regd Employee</span>
                                <span class="stats-counter" >
                                    <?php
                                    $sql = "SELECT id from employees";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $empcount = $query->rowCount();
                                    ?>

                                    <span class="counter"><?php echo htmlentities($empcount); ?></span>
                                </span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="card stats-card" style="background: #4682B4;">
                            <div class="card-content">
                                <span class="card-title" style="color: black;font-size: 15px">Listed leave </span>
                                <?php
                                $sql = "SELECT id from leaves";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $dptcount = $query->rowCount();
                                ?>                            
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($dptcount); ?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="card stats-card" style="background: #C9D74F">
                            <div class="card-content">
                                <span class="card-title" style="color: black; font-size: 15px">Listed leave Type</span>
                                <?php
                                $sql = "SELECT id from  leavetype";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $leavtypcount = $query->rowCount();
                                ?>   
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($leavtypcount); ?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
                </div>

                <div class="card invoices-card">
                    <div class="card-content" >
                        <span class="card-title" style="color: #458B00;font-size: 20px">Latest Leave Applications</span>
                        <table id="example" class="table table-striped table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th width="220">Employe Name</th>
                                    <th width="150">Leave Type</th>

                                    <th width="200">Posting Date</th>                 
                                    <th>Status</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT leaves.id as lid,employees.FullName,employees.EmpId,employees.id,leaves.LeaveType,leaves.PostingDate,leaves.Status from leaves join employees on leaves.empid=employees.id order by lid desc limit 6";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        ?>  

                                        <tr>
                                            <td> <b><?php echo htmlentities($cnt); ?></b></td>
                                            <td><a style="color: #0033FF" href="editemployee.php?empid=<?php echo htmlentities($result->id); ?>" target="_blank"><?php echo htmlentities($result->FullName); ?>(<?php echo htmlentities($result->EmpId); ?>)</a></td>
                                            <td><?php echo htmlentities($result->LeaveType); ?></td>
                                            <td><?php echo htmlentities($result->PostingDate); ?></td>
                                            <td><?php
                                                $stats = $result->Status;
                                                if ($stats == 1) {
                                                    ?>
                                                    <span style="color: #32CD32"><strong>Approved</strong></span>
                                                <?php } if ($stats == 2) { ?>
                                                    <span style="color: red">Not Approved</span>
                                                <?php } if ($stats == 0) { ?>
                                                    <span style="color: blue">waiting for approval</span>
                                                <?php } ?>
                                            </td>


                                            <td><a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid); ?>" class="btn" style="background: #0066CC; color: white"  > View Details</a></td>
                                        </tr>
                                        <?php
                                        $cnt++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

        </div>



        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="../assets/plugins/chart.js/chart.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/dashboard.js"></script>

    </body>
    </html>
<?php } ?>