<aside id="slide-out" class="side-nav gray fixed" >
    <div class="side-nav-wrapper" style="background: #BCEE68">
        <div class="center">
            <div class="sidebar-profile">
                <div class="sidebar-profile-image">
                    <img src="assets/images/tải xuống.JPG" class="circle" alt="">
                </div>
                <div class="sidebar-profile-info">
                    <?php
                    $eid = $_SESSION['eid'];
                    $sql = "SELECT FullName, EmpId from  employees where id=:eid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                            ?>  
                            <p><?php echo htmlentities($result->FullName); ?></p>
                            <span><?php echo htmlentities($result->EmpId) ?></span>
    <?php }
} ?>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion"  >                  
            <li class="no-padding"><a class="waves-effect waves-grey "  href="myprofile.php"><i class="material-icons" >person</i>Your profile</a></li>
            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" ><i class="material-icons" >apps</i>Leaves<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="apply-leave.php"><i class="material-icons">create</i>Apply Leave</a></li>
                        <li><a href="leavehistory.php"><i class="material-icons" >history</i>Leave History</a></li>
                    </ul>
                </div>
            </li>
            <li class="no-padding"><a class="waves-effect waves-grey" href="emp-changepassword.php"><i class="material-icons" >vpn_key</i>Change Password</a></li>


            <li class="no-padding">
                <a class="waves-effect waves-grey" href="logout.php" ><i class="material-icons">exit_to_app</i>Sign Out</a>
            </li>  
        </ul>

    </div>
</aside>
