<?php
session_start();

include 'config.inc.php';
include 'header.php';
include 'topmain.php';
include 'leftplaceholder.php';
echo "<title>$title - Admin Login</title>\n";


$self = $_SERVER['PHP_SELF'];

if (isset($_POST['login_userid']) && (isset($_POST['login_password']))) {
    $login_userid = $_POST['login_userid'];
    $login_password = crypt($_POST['login_password'], 'xy');

    $query = "select empfullname, employee_passwd, admin, time_admin from " . $db_prefix . "employees
              where empfullname = '" . $login_userid . "'";
    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result)) {

        $admin_username = "" . $row['empfullname'] . "";
        $admin_password = "" . $row['employee_passwd'] . "";
        $admin_auth = "" . $row['admin'] . "";
        $time_admin_auth = "" . $row['time_admin'] . "";
    }

    if (($login_userid == @$admin_username) && ($login_password == @$admin_password) && ($admin_auth == "1")) {
        $_SESSION['valid_user'] = $login_userid;
    } elseif (($login_userid == @$admin_username) && ($login_password == @$admin_password) && ($time_admin_auth == "1")) {
        $_SESSION['time_admin_valid_user'] = $login_userid;
    }

}

if (isset($_SESSION['valid_user'])) {
    echo "<script type='text/javascript' language='javascript'> window.location.href = 'admin/index.php';</script>";
    exit;
} elseif (isset($_SESSION['time_admin_valid_user'])) {
    echo "<script type='text/javascript' language='javascript'> window.location.href = 'admin/timeadmin.php';</script>";
    exit;

} else {

}

    // build form
?>
<div id='page-wrapper'>
	 <div class='row'>
		  <div class='col-lg-12'>
 <h1 class='page-header'>PHP Timeclock Admin Login</h1>
 </div>
 <!-- /.col-lg-12 -->
 </div>
 <!-- /.row -->
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
			    <form name="auth" method='post' action=""$self"">

                            <fieldset>
                                <div class="form-group">
					<input class="form-control" type='text' name='login_userid' placeholder="Username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="login_password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
				<input type='submit' class="btn btn-lg btn-success btn-block" onClick='admin.php' value='Log In'>
                            </fieldset>
			    <?php

			        if (isset($login_userid)) {
			            echo "  <p>Could not log you in. Either your username or password is incorrect.\n";
			        }

			        echo "\n";
			        echo "</form>\n";
			        echo "<script language=\"javascript\">document.forms['auth'].login_userid.focus();</script>\n";
			    ?>
                    </div>
                </div>
            </div>
        </div>

</div>
<!-- /#page-wrapper login-->
<?php
include 'footer.php';
?>
