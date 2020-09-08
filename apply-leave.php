<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['apply'])) {
        $empid = $_SESSION['eid'];
        $leavetype = $_POST['leavetype'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $reason = $_POST['reason'];
        $status = 0;
        $isread = 0;
        $sql = "INSERT INTO leaves(LeaveType,EndDate,StartDate,Reason,Status,IsRead,empid) VALUES(:leavetype,:enddate,:startdate,:reason,:status,:isread,:empid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':leavetype', $leavetype, PDO::PARAM_STR);
        $query->bindParam(':startdate', $startdate, PDO::PARAM_STR);
        $query->bindParam(':enddate', $enddate, PDO::PARAM_STR);
        $query->bindParam(':reason', $reason, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':isread', $isread, PDO::PARAM_STR);
        $query->bindParam(':empid', $empid, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Leave applied successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>

            <!-- Title -->
            <title>Apply Leave</title>

            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
            <meta charset="UTF-8">
            <meta name="reason" content="Responsive Admin Dashboard Template" />
            <meta name="keywords" content="admin,dashboard" />
            <meta name="author" content="Steelcoders" />

            <!-- Styles -->
            <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
            <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
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
            <main class="mn-inner" >


                <div class="card">
                    <div class="card-content">
                        <form id="example-form" method="post" name="addemp">
                            <div>
                                <d style="color: #4682B4; font-size: 35px"><strong>Apply for Leave</strong></d>
                                <section>
                                    <div class="wizard-content">


                                        <div class="row">
                                            <?php if ($error) { ?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) {
                                                ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>


                                            <div class="input-field col-md-4">
                                                <br>
                                                <select  name="leavetype" autocomplete="off">
                                                    <option value="">Select leave type</option>
                                                    <?php
                                                    $sql = "SELECT  LeaveType from leavetype";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result) {
                                                            ?>                                            
                                                            <option value="<?php echo htmlentities($result->LeaveType); ?>"><?php echo htmlentities($result->LeaveType); ?></option>
                                                        <?php }
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="input-field col-md-4">
                                                <label for="startdate">Start  Date</label>
                                                <br>
                                                <input placeholder="" id="mask1" name="startdate" type="datetime-local"  required>
                                            </div>
                                            <div class="input-field col-md-4">
                                                <label for="enddate">End Date</label>
                                                <br>
                                                <input placeholder="" id="mask1" name="enddate"  type="datetime-local" required>
                                            </div>
                                            <div class="input-field col m12 s12">
                                                <label for="birthdate">Reason</label>    

                                                <textarea id="textarea1" name="reason" class="materialize-textarea" length="500" required></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" name="apply" id="apply" class="btn" style="background: #4682B4; color: white; width: 90px">Apply</button>                                             

                                    </div>

                                </section>


                                </section>
                            </div>
                        </form>
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
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
        <script src="assets/js/pages/form-input-mask.js"></script>
        <script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    </body>
    </html>
<?php } ?> 