<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
    $eid = $_SESSION['emplogin'];
    if (isset($_POST['update'])) {

        $fullname = $_POST['fullName'];

        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $mobileno = $_POST['mobileno'];
        $sql = "update employees set FullName=:fullname,Gender=:gender,Dob=:dob,Address=:address,Phonenumber=:mobileno where EmailId=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);

        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Employee record updated Successfully";
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>

            <!-- Title -->
            <title>Profile</title>

            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
            <meta charset="UTF-8">
            <meta name="description" content="Responsive Admin Dashboard Template" />
            <meta name="keywords" content="admin,dashboard" />
            <meta name="author" content="Steelcoders" />

            <!-- Styles -->
            <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
            <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
            <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
            <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
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
                <div class="row">

                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
                                        <h3 style="color: #4682B4"><strong>Edit profile</strong></h3>
                                        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) {
                                            ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
                                                            <?php
                                                            $eid = $_SESSION['emplogin'];
                                                            $sql = "SELECT * from  employees where EmailId=:eid";
                                                            $query = $dbh->prepare($sql);
                                                            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt = 1;
                                                            if ($query->rowCount() > 0) {
                                                                foreach ($results as $result) {
                                                                    ?> 
                                                                    <div class="input-field col  s12">
                                                                        <label for="empcode">Employee Code</label>
                                                                        <input  name="empcode" id="empcode" value="<?php echo htmlentities($result->EmpId); ?>" type="text" autocomplete="off" readonly required>
                                                                        <span id="empid-availability" style="font-size:12px;"></span> 
                                                                    </div>


                                                                    <div class="input-field col s12">
                                                                        <label for="fullName">Full name</label>
                                                                        <input id="fullName" name="fullName" value="<?php echo htmlentities($result->FullName); ?>"  type="text" required>
                                                                    </div>


                                                                    <div class="input-field col s12">
                                                                        <label for="email">Email</label>
                                                                        <input  name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId); ?>" readonly autocomplete="off" required>
                                                                        <span id="emailid-availability" style="font-size:12px;"></span> 
                                                                    </div>

                                                                    <div class="input-field col s12">
                                                                        <label for="phone">Mobile number</label>
                                                                        <input id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber); ?>" maxlength="10" autocomplete="off" required>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="col m6">
                                                                <div class="row">

                                                                    <div class="row">
                                                                        <div class="input-field col m6 s12">
                                                                            <select  name="gender" autocomplete="off">
                                                                                <option value="<?php echo htmlentities($result->Gender); ?>"><?php echo htmlentities($result->Gender); ?></option>                                          
                                                                                <option value="Male">Male</option>
                                                                                <option value="Female">Female</option>
                                                                                <option value="Other">Other</option>
                                                                            </select>
                                                                        </div>
                                                                        <label for="birthdate">Date of Birth</label>
                                                                        <div class="input-field col m6 s12">

                                                                            <input id="birthdate" name="dob"  class="datepicker" value="<?php echo htmlentities($result->Dob); ?>" >
                                                                        </div>


                                                                        <div class="input-field col s12">
                                                                            <label for="address">Address</label>
                                                                            <input id="address" name="address" type="text"  value="<?php echo htmlentities($result->Address); ?>" autocomplete="off" required>
                                                                        </div>
                                                                    <?php }
                                                                }
                                                                ?>

                                                                <div class="input-field col s12">
                                                                    <button type="submit" name="update"  id="update" class="btn" style="background: #4682B4">UPDATE</button>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </section>


                                        </section>
                                    </div>
                                </form>
                            </div>
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
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>

    </body>
    </html>
<?php } ?> 