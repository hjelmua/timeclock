<?php
session_start();

include 'config.inc.php';
include 'header.php';
include 'topmain.php';
include 'leftplaceholder.php';
echo "<title>$title - Reports Login</title>\n";

$self = $_SERVER['PHP_SELF'];

if (isset($_POST['login_userid']) && (isset($_POST['login_password']))) {
    $login_userid = $_POST['login_userid'];
    $login_password = crypt($_POST['login_password'], 'xy');

    $query = "select empfullname, employee_passwd, reports from " . $db_prefix . "employees
              where empfullname = '" . $login_userid . "'";
    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result)) {

        $reports_username = "" . $row['empfullname'] . "";
        $reports_password = "" . $row['employee_passwd'] . "";
        $reports_auth = "" . $row['reports'] . "";
    }

    if (($login_userid == @$reports_username) && ($login_password == @$reports_password) && ($reports_auth == "1")) {
        $_SESSION['valid_reports_user'] = $login_userid;
    }

}

if (isset($_SESSION['valid_reports_user'])) {
    echo "<script type='text/javascript' language='javascript'> window.location.href = 'reports/index.php';</script>";
    exit;

} else {

    // build form

    echo "<div id='page-wrapper'>\n";
    echo "<div class='row'>\n";
    echo "<div class='col-lg-12'>\n";
    echo "<h1 class='page-header'>PHP Timeclock Reports Login</h1>\n";
    echo "</div>\n";
    echo "<!-- /.col-lg-12 -->\n";
    echo "</div>\n";
    echo "<!-- /.row -->\n";
    echo "    <div class='row'>\n";
    echo "        <div class='col-md-4 col-md-offset-4'>\n";
    echo "            <div class='login-panel panel panel-default'>\n";
    echo "                <div class='panel-heading'>\n";
    echo "                    <h3 class='panel-title'>Please Sign In</h3>\n";
    echo "                </div>\n";
    echo "                <div class='panel-body'>\n";
    echo "		    <form name='auth' method='post' action=''$self''>\n";
    echo "                        <fieldset>\n";
    echo "                            <div class='form-group'>\n";
    echo "				<input class='form-control' type='text' name='login_userid' placeholder='Username' autofocus>\n";
    echo "                            </div>\n";
    echo "                            <div class='form-group'>\n";
    echo "                                <input class='form-control' placeholder='Password' name='login_password' type='password' value=''>\n";
    echo "                            </div>\n";
    echo "                            <!-- Change this to a button or input when using this as a form -->\n";
    echo "			<input type='submit' class='btn btn-lg btn-success btn-block' onClick='admin.php' value='Log In'>\n";
    echo "                        </fieldset>\n";

    if (isset($login_userid)) {
        echo "  <p>Could not log you in. Either your username or password is incorrect.</p>\n";
    }
    echo "</form>\n";
    echo "<script language=\"javascript\">document.forms['auth'].login_userid.focus();</script>\n";
}

echo "            </div>\n";
echo "        </div>\n";
echo "    </div>\n";
echo "</div>\n";
    echo "</div>\n";
    echo "<!-- /#page-wrapper login-->\n";
include 'footer.php';
?>
