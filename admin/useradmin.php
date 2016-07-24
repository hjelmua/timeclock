<?php

session_start();

include '../config.inc.php';
include 'header.php';
include 'topmain.php';
include 'leftadmin.php';
echo "<title>$title - User Summary</title>\n";

$self = $_SERVER['PHP_SELF'];
$request = $_SERVER['REQUEST_METHOD'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (!isset($_SESSION['valid_user'])) {

    echo "  <div id='page-wrapper'>\n";
    echo "<div class='row'><div class='col-lg-12'><div class='table-responsive'> \n";
    echo "<table class='table'>\n";
    echo "  <tr class=right_main_text><td height=10 align=center valign=top scope=row class=title_underline>PHP Timeclock Administration</td></tr>\n";
    echo "  <tr class=right_main_text>\n";
    echo "    <td align=center valign=top scope=row>\n";
    echo "      <table>\n";
    echo "        <tr class=right_main_text><td align=center>You are not presently logged in, or do not have permission to view this page.</td></tr>\n";
    echo "        <tr class=right_main_text><td align=center>Click <a class=admin_headings href='../login.php'><u>here</u></a> to login.</td></tr>\n";
    echo "      </table><br /></td></tr></table>\n";
    echo "          </div></div></div>\n";
    echo "          </div> \n";
    echo "          <!-- /.page-wrapper -->  \n";
    exit;
}
?>
<div id="page-wrapper">
	<div class="row">
	<div class="col-lg-12">
	<h1 class="page-header"">User Summary</h1>
	</div>
	<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
<?php
echo "<div class='row'><div class='col-lg-12'> \n";


$user_count = mysql_query("select empfullname from " . $db_prefix . "employees
                           order by empfullname");
@$user_count_rows = mysql_num_rows($user_count);

$admin_count = mysql_query("select empfullname from " . $db_prefix . "employees where admin = '1'");
@$admin_count_rows = mysql_num_rows($admin_count);

$time_admin_count = mysql_query("select empfullname from " . $db_prefix . "employees where time_admin = '1'");
@$time_admin_count_rows = mysql_num_rows($time_admin_count);

$reports_count = mysql_query("select empfullname from " . $db_prefix . "employees where reports = '1'");
@$reports_count_rows = mysql_num_rows($reports_count);


echo "            <table class='table'>\n";
echo "              <tr><th class=table_heading_no_color nowrap width=100% halign=left>User Summary</th></tr>\n";
echo "              <tr><td height=40 class=table_rows nowrap halign=left><img src='../images/icons/user_green.png' />&nbsp;&nbsp;Total 
                      Users: $user_count_rows&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='../images/icons/user_orange.png' />&nbsp;&nbsp;
                      Sys Admin Users: $admin_count_rows&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='../images/icons/user_red.png' />&nbsp;&nbsp;
                      Time Admin Users: $time_admin_count_rows&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='../images/icons/user_suit.png' />&nbsp;
                      &nbsp;Reports Users: $reports_count_rows</td></tr>\n";
echo "            </table>\n";
echo "            <table class='table'>\n";
echo "              <tr>\n";
echo "                <th class=table_heading nowrap width=3% align=left>&nbsp;</th>\n";
echo "                <th class=table_heading nowrap width=13% align=left>Username</th>\n";
echo "                <th class=table_heading nowrap width=18% align=left>Display Name</th>\n";
//echo "                <th class=table_heading nowrap width=23% align=left>Email Address</th>\n";
echo "                <th class=table_heading nowrap width=10% align=left>Office</th>\n";
echo "                <th class=table_heading nowrap width=10% align=left>Group</th>\n";
echo "                <th class=table_heading width=3% align=center>Disabled</th>\n";
echo "                <th class=table_heading width=3% align=center>Sys Admin</th>\n";
echo "                <th class=table_heading width=3% align=center>Time Admin</th>\n";
echo "                <th class=table_heading nowrap width=3% align=center>Reports</th>\n";
echo "                <th class=table_heading nowrap width=3% align=center>Edit</th>\n";
echo "                <th class=table_heading width=3% align=center>Chg Pwd</th>\n";
echo "                <th class=table_heading nowrap width=3% align=center>Delete</th>\n";
echo "              </tr>\n";

$row_count = 0;

$query = "select empfullname, displayname, email, groups, office, admin, reports, time_admin, disabled from " . $db_prefix . "employees
          order by empfullname";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {

$empfullname = stripslashes("" . $row['empfullname'] . "");
$displayname = stripslashes("" . $row['displayname'] . "");

$row_count++;
$row_color = ($row_count % 2) ? $color2 : $color1;

echo "              <tr class=table_border bgcolor='$row_color'><td nowrap class=table_rows width=3%>&nbsp;$row_count</td>\n";
echo "                <td class=table_rows nowrap width=13%>&nbsp;<a title=\"Edit User: $empfullname\" class=footer_links 
                    href=\"useredit.php?username=$empfullname&officename=" . $row["office"] . "\">$empfullname</a></td>\n";
echo "                <td class=table_rows nowrap width=18%>&nbsp;$displayname</td>\n";
//echo "                <td class=table_rows nowrap width=23%>&nbsp;".$row["email"]."</td>\n";
echo "
<td class=table_rows nowrap width=10%>&nbsp;".$row['office']."</td>\n";
echo "
<td class=table_rows nowrap width=10%>&nbsp;".$row['groups']."</td>\n";

if ("".$row["disabled"]."" == 1) {
echo "
<td class=table_rows width=3% align=center><img src='../images/icons/cross.png'/></td>\n";
} else {
$disabled = "";
echo "
<td class=table_rows width=3% align=center>".$disabled."</td>\n";
}
if ("".$row["admin"]."" == 1) {
echo "
<td class=table_rows width=3% align=center><img src='../images/icons/accept.png'/></td>\n";
} else {
$admin = "";
echo "
<td class=table_rows width=3% align=center>".$admin."</td>\n";
}
if ("".$row["time_admin"]."" == 1) {
echo "
<td class=table_rows width=3% align=center><img src='../images/icons/accept.png'/></td>\n";
} else {
$time_admin = "";
echo "
<td class=table_rows width=3% align=center>".$time_admin."</td>\n";
}
if ("".$row["reports"]."" == 1) {
echo "
<td class=table_rows width=3% align=center><img src='../images/icons/accept.png'/></td>\n";
} else {
$reports = "";
echo "
<td class=table_rows width=3% align=center>".$reports."</td>\n";
}

if ((strpos($user_agent, "MSIE 6")) || (strpos($user_agent, "MSIE 5")) || (strpos($user_agent, "MSIE 4")) || (strpos($user_agent, "MSIE 3"))) {

echo "
<td class=table_rows width=3% align=center><a style='color:#27408b;text-decoration:underline;'
                                              title=\"Edit User: $empfullname\"
    href=\"useredit.php?username=$empfullname&officename=".$row["office"]."\">Edit</a></td>\n";
echo "
<td class=table_rows width=3% align=center><a style='color:#27408b;text-decoration:underline;'
                                              title=\"Change Password: $empfullname\"
    href=\"chngpasswd.php?username=$empfullname&officename=".$row["office"]."\">Chg Pwd</a></td>\n";
echo "
<td class=table_rows width=3% align=center><a style='color:#27408b;text-decoration:underline;'
                                              title=\"Delete User: $empfullname\"
    href=\"userdelete.php?username=$empfullname&officename=".$row["office"]."\">Delete</a></td></tr>\n";

} else {

echo "
<td class=table_rows width=3% align=center><a title=\"Edit User: $empfullname\"
    href=\"useredit.php?username=$empfullname&officename=".$row["office"]."\">
    <img border=0 src='../images/icons/application_edit.png'/></a></td>\n";
echo "
<td class=table_rows width=3% align=center><a title=\"Change Password: $empfullname\"
    href=\"chngpasswd.php?username=$empfullname&officename=".$row["office"]."\"><img border=0
                                                                                     src='../images/icons/lock_edit.png'/></a>
</td>\n";
echo "
<td class=table_rows width=3% align=center><a title=\"Delete User: $empfullname\"
    href=\"userdelete.php?username=$empfullname&officename=".$row["office"]."\">
    <img border=0 src='../images/icons/delete.png'/></a></td></tr>\n";
}
}
echo "          </table>\n";
echo "          </div></div>\n";
echo "          </div> \n";
echo "          <!-- /.page-wrapper -->  \n";
echo "          <p> </p> \n";
include '../footer.php';
exit;
?>
