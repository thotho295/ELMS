<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>

            <!-- Title -->
            <title>Leave history</title>

            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
            <meta charset="UTF-8">
            <meta name="description" content="Responsive Admin Dashboard Template" />
            <meta name="keywords" content="admin,dashboard" />
            <meta name="author" content="Steelcoders" />

            <!-- Styles -->
            <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
            <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
            <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">


            <!-- Theme Styles -->
            <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
            <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>

            <!-- CSS only -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

            <!-- JS, Popper.js, and jQuery -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
            <style>
                .errorWrap {
                    padding: 10px;
                    margin: 0 0 20px 0;
                    background: #fff;
                    border-left: 4px solid #dd3d36;
                    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                }
                .succWrap{
                    padding: 10px;
                    margin: 0 0 20px 0;
                    background: #fff;
                    border-left: 4px solid #5cb85c;
                    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                }
            </style>
        </head>
        <body>
            <?php include('includes/header.php'); ?>

            <?php include('includes/sidebar.php'); ?>
            <div class="mn-content fixed-sidebar" style="background: #C1FFC1">
            <main class="mn-inner">

                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="font-size: 20px; color: #4682B4">Leave History</span>

                        <?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                        <table id="example" class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="120">Leave Type</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Reason</th>
                                    <th width="120">Posting Date</th>
                                    <th width="200">Admin Remak</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $eid = $_SESSION['eid'];
                                $sql = "SELECT LeaveType,EndDate,StartDate,Reason,PostingDate,AdminRemarkDate,AdminRemark,Status from leaves where empid=:eid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        ?>  
                                        <tr>
                                            <td> <?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->LeaveType); ?></td>
                                            <td><?php echo htmlentities($result->StartDate); ?></td>
                                            <td><?php echo htmlentities($result->EndDate); ?></td>
                                            <td><?php echo htmlentities($result->Reason); ?></td>
                                            <td><?php echo htmlentities($result->PostingDate); ?></td>
                                            <td><?php
                                                if ($result->AdminRemark == "") {
                                                    echo htmlentities('waiting for approval');
                                                } else {

                                                    echo htmlentities(($result->AdminRemark) . " " . "at" . " " . $result->AdminRemarkDate);
                                                }
                                                ?></td>
                                            <td><?php
                                                $stats = $result->Status;
                                                if ($stats == 1) {
                                                    ?>
                                                    <span style="color: green">Approved</span>
                                                <?php } if ($stats == 2) { ?>
                                                    <span style="color: red">Not Approved</span>
                                                <?php } if ($stats == 0) { ?>
                                                    <span style="color: blue">waiting for approval</span>
                                                <?php } ?>

                                            </td>

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

            </div>
        </main>

    </div>
    <div class="left-sidebar-hover"></div>

    <!-- Javascripts -->
    <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/alpha.min.js"></script>
    <script src="assets/js/pages/table-data.js"></script>

    </body>
    </html>
<?php } ?>