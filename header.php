<?php

include 'functions.php';

ob_start();
echo "<!DOCTYPE html>\n";

// grab the connecting ip address. //

$connecting_ip = get_ipaddress();

if (empty($connecting_ip)) {
    return false;
}

// determine if connecting ip address is allowed to connect to PHP Timeclock //

if ($restrict_ips == "yes") {
    for ($x = 0; $x < count($allowed_networks); $x++) {
        $is_allowed = ip_range($allowed_networks[$x], $connecting_ip);
        if (!empty($is_allowed)) {
            $allowed = true;
        }
    }
    if (!isset($allowed)) {
        echo "You are not authorized to view this page.";
        exit;
    }
}

// connect to db anc check for correct db version //

@ $db = mysql_pconnect($db_hostname, $db_username, $db_password);
if (!$db) {
    echo "Error: Could not connect to the database. Please try again later.";
    exit;
}
mysql_select_db($db_name);

$table = "dbversion";
$result = mysql_query("SHOW TABLES LIKE '" . $db_prefix . $table . "'");
@$rows = mysql_num_rows($result);

if ($rows == "1") {
    $dbexists = "1";
} else {
    $dbexists = "0";
}

$db_version_result = mysql_query("select * from " . $db_prefix . "dbversion");
while (@$row = mysql_fetch_array($db_version_result)) {
    @$my_dbversion = "" . $row["dbversion"] . "";
}

// include css and timezone offset//

if (($use_client_tz == "yes") && ($use_server_tz == "yes")) {
    echo 'Please reconfigure your config.inc.php file, you cannot have both $use_client_tz AND $use_server_tz set to \'yes\'';
    exit;
}

echo "<head>\n";
if ($use_client_tz == "yes") {
    if (!isset($_COOKIE['tzoffset'])) {
        include 'tzoffset.php';
        echo "<meta http-equiv='refresh' content='0;URL=timeclock.php'>\n";
    }
}
?>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap Core CSS -->
    <link href="./css/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<?php
// set refresh rate for each page //  

if ($refresh == "none") {
    echo "</head>\n";
} else {
    echo "<meta http-equiv='refresh' content=\"$refresh;URL=timeclock.php\">\n";
    echo "<script language=\"javascript\" src=\"scripts/pnguin_timeclock.js\"></script>\n";
    echo "</head>\n";
}

setTimeZone();

?>
<body>
<div id="wrapper">
