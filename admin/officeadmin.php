<?php

session_start();

include '../config.inc.php';
include 'header.php';
include 'topmain.php';
include 'leftadmin.php';
echo "<title>$title - Office Summary</title>\n";

$self = $_SERVER['PHP_SELF'];
$request = $_SERVER['REQUEST_METHOD'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (!isset($_SESSION['valid_user'])) {


    echo "<table width=100% border=0 cellpadding=7 cellspacing=1>\n";
    echo "  <tr class=right_main_text><td height=10 align=center valign=top scope=row class=title_underline>PHP Timeclock Administration</td></tr>\n";
    echo "  <tr class=right_main_text>\n";
    echo "    <td align=center valign=top scope=row>\n";
    echo "      <table width=200 border=0 cellpadding=5 cellspacing=0>\n";
    echo "        <tr class=right_main_text><td align=center>You are not presently logged in, or do not have permission to view this page.</td></tr>\n";
    echo "        <tr class=right_main_text><td align=center>Click <a class=admin_headings href='../login.php'><u>here</u></a> to login.</td></tr>\n";
    echo "      </table><br /></td></tr></table>\n";
    exit;
}
?>
<div id="page-wrapper">
	<div class="row">
	<div class="col-lg-12">
	<h1 class="page-header"">Office Summary</h1>
	</div>
	<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
<?php
echo "<div class='row'><div class='col-lg-12'> \n";


echo "      <table class='table'>\n";
echo "        <tr class=right_main_text>\n";
echo "          <td valign=top>\n";
echo "            <table width=60% align=center height=40 border=0 cellpadding=0 cellspacing=0>\n";
echo "              <tr><th class=table_heading_no_color nowrap width=100% valign=top halign=left>Office Summary</th></tr>\n";
echo "            </table>\n";
echo "            <table class=table_border width=60% align=center border=0 cellpadding=0 cellspacing=0>\n";
echo "              <tr><th class=table_heading nowrap width=7% align=left>&nbsp;</th>\n";
echo "                <th class=table_heading nowrap width=79% align=left>Office Name</th>\n";
echo "                <th class=table_heading nowrap width=4% align=center>Groups</th>\n";
echo "                <th class=table_heading nowrap width=4% align=center>Users</th>\n";
echo "                <th class=table_heading nowrap width=3% align=center>Edit</th>\n";
echo "                <th class=table_heading nowrap width=3% align=center>Delete</th></tr>\n";

$row_count = 0;

$query = "select * from " . $db_prefix . "offices order by officename";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {

    $query2 = "select office from " . $db_prefix . "employees where office = '" . $row['officename'] . "'";
    $result2 = mysql_query($query2);
    @$user_cnt = mysql_num_rows($result2);

    $query3 = "select * from " . $db_prefix . "groups where officeid = '" . $row['officeid'] . "'";
    $result3 = mysql_query($query3);
    @$group_cnt = mysql_num_rows($result3);

    $row_count++;
    $row_color = ($row_count % 2) ? $color2 : $color1;

    echo "              <tr class=table_border bgcolor='$row_color'><td nowrap class=table_rows width=7%>&nbsp;$row_count</td>\n";
    echo "                <td nowrap class=table_rows width=79%>&nbsp;<a class=footer_links title='Edit Office: " . $row["officename"] . "'
                    href=\"officeedit.php?officename=" . $row["officename"] . "\">" . $row["officename"] . "</a></td>\n";
    echo "                <td class=table_rows width=4% align=center>$group_cnt</td>\n";
    echo "                <td class=table_rows width=4% align=center>$user_cnt</td>\n";

    if ((strpos($user_agent, "MSIE 6")) || (strpos($user_agent, "MSIE 5")) || (strpos($user_agent, "MSIE 4")) || (strpos($user_agent, "MSIE 3"))) {

        echo "                <td class=table_rows width=3% align=center><a style='color:#27408b;text-decoration:underline;'
                    href=\"officeedit.php?officename=" . $row["officename"] . "\" title=\"Edit Office: " . $row["officename"] . "\">
                    Edit</a></td>\n";
        echo "                <td class=table_rows width=3% align=center><a style='color:#27408b;text-decoration:underline;'
                    href=\"officedelete.php?officename=" . $row["officename"] . "\" title=\"Delete Office: " . $row["officename"] . "\">
                    Delete</a></td></tr>\n";
    } else {
        echo "                <td class=table_rows width=3% align=center><a href=\"officeedit.php?officename=" . $row["officename"] . "\"
                    title=\"Edit Office: " . $row["officename"] . "\">
                    <img border=0 src='../images/icons/application_edit.png' /></a></td>\n";
        echo "                <td class=table_rows width=3% align=center><a href=\"officedelete.php?officename=" . $row["officename"] . "\"
                    title=\"Delete Office: " . $row["officename"] . "\">
                    <img border=0 src='../images/icons/delete.png' /></a></td></tr>\n";
    }
}
echo "            </table>\n";
echo "            </td></tr></table>\n";
echo "          </div></div>\n";
echo "          </div> \n";
echo "          <!-- /.page-wrapper -->  \n";
echo "          <p> </p> \n";
include '../footer.php';
exit;
?>
