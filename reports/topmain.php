<?php

?>

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
<?php
if ($logo == "none") {
    echo "  <a class='navbar-brand' href='#'>PHP Timeclock</a>\n";
} else {
    echo "<a class='navbar-brand href='#'><img style='max-width:100px; margin-top: -7px;' border=0 src='$logo'></a>\n";
}
?>
    </div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
     
<?php
if (isset($_SESSION['valid_user'])) {
    $logged_in_user = $_SESSION['valid_user'];
    echo "<li class='active'><a href='../index.php'>logged in as: $logged_in_user</a></li>\n";
} else if (isset($_SESSION['time_admin_valid_user'])) {
    $logged_in_user = $_SESSION['time_admin_valid_user'];
    echo "<li class='active'><a href='../index.php'>logged in as: $logged_in_user</a></li>\n";
} else if (isset($_SESSION['valid_reports_user'])) {
    $logged_in_user = $_SESSION['valid_reports_user'];
    echo "<li class='active'><a href='../index.php'>logged in as: $logged_in_user</a></li>\n";
}
?>

<?php

    echo "<li><a href='$date_link'>";

// display today's date in top right of each page. This will link to $date_link you setup in config.inc.php. //

$todaydate = date('F j, Y');
echo "$todaydate</a></li>\n";
?>


 
     
<li><a href="../index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
<li><a href="../login.php"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Administration</a></li>
<?php
if ($use_reports_password == "yes") {
    echo "<li><a href='../login_reports.php'><span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> Reports</a></li>\n";
} elseif ($use_reports_password == "no") {
    echo "<li><a href='../reports/index.php'><span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> Reports</a></li>\n";
}
?>
<li><a href="../punchclock/menu.php"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Punchclock</a></li>
<?php
if ((isset($_SESSION['valid_user'])) || (isset($_SESSION['valid_reports_user'])) || (isset($_SESSION['time_admin_valid_user']))) {
    echo "  <li><a href='../logout.php'><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout</a></li>\n";
}
?>
      </ul>
<!-- /.navbar-top-links -->



<?php
// display a 'reset cookie' message if $use_client_tz = "yes" //

if ($date_link == "none") {

    if ($use_client_tz == "yes") {
        echo "<li>If the times below appear to be an hour off, click <a href='../resetcookie.php'>here</a> to reset.</li>\n";
    }

} else {

    if ($use_client_tz == "yes") {
        echo "<li>If the times below appear to be an hour off, click <a href='../resetcookie.php'>here</a> to reset.</li>\n";
    }

}

?>

