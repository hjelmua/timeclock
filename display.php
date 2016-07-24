<?php

$row_count = 0;
$page_count = 0;

while ($row = mysql_fetch_array($result)) {

    $display_stamp = "" . $row["timestamp"] . "";
    $time = date($timefmt, $display_stamp);
    $date = date($datefmt, $display_stamp);

    if ($row_count == 0) {

        if ($page_count == 0) {

            // display sortable column headings for main page //
            echo "            <!--from display--><div class='row'><div class='col-lg-8'><div class='table-responsive'><table class='table table-striped'>\n";

            echo "              <thead><tr class=hidden-print>\n";
            echo "                <td><a href='$current_page?sortcolumn=empfullname&sortdirection=$sortnewdirection'>Name</a></td>\n";
            echo "                <td><a href='$current_page?sortcolumn=inout&sortdirection=$sortnewdirection'>In/Out</a></td>\n";
            echo "                <td><a href='$current_page?sortcolumn=tstamp&sortdirection=$sortnewdirection'>Time</a></td>\n";
            echo "                <td><a href='$current_page?sortcolumn=tstamp&sortdirection=$sortnewdirection'>Date</a></td>\n";

            if ($display_office_name == "yes") {
                echo "                <td><a href='$current_page?sortcolumn=office&sortdirection=$sortnewdirection'>Office</a></td>\n";
            }

            if ($display_group_name == "yes") {
                echo "                <td><a href='$current_page?sortcolumn=groups&sortdirection=$sortnewdirection'>Group</a></td>\n";
            }

            echo "                <td><a href='$current_page?sortcolumn=notes&sortdirection=$sortnewdirection'><u>Notes</u></a></td>\n";
            echo "              </tr></thead><tbody>\n";

        } else {

            // display report name and page number of printed report above the column headings of each printed page //

            $temp_page_count = $page_count + 1;
        }
        echo"                <!--\n";
        echo "              <tr class=visible-print-block>\n";
        echo "                <td>Name</td>\n";
        echo "                <td nowrap>In/Out</td>\n";
        echo "                <td>Time</td>\n";
        echo "                <td>Date</td>\n";

        if ($display_office_name == "yes") {
            echo "                <td>Office</td>\n";
        }

        if ($display_group_name == "yes") {
            echo "                <td>Group</td>\n";
        }

        echo "                <td>Notes</td>\n";
        echo "              </tr>\n";
        echo"                -->\n";
    }

    // begin alternating row colors //

    $row_color = ($row_count % 2) ? $color1 : $color2;

    // display the query results //

    $display_stamp = $display_stamp + @$tzo;
    $time = date($timefmt, $display_stamp);
    $date = date($datefmt, $display_stamp);

    if ($show_display_name == "yes") {
        echo stripslashes("              <tr><td>" . $row["displayname"] . "</td>\n");
    } elseif ($show_display_name == "no") {
        echo stripslashes("              <tr><td>" . $row["empfullname"] . "</td>\n");
    }

    echo "                <td>" . $row["inout"] . "</td>\n";
    echo "                <td>" . $time . "</td>\n";
    echo "                <td>" . $date . "</td>\n";

    if ($display_office_name == "yes") {
        echo "                <td>" . $row["office"] . "</td>\n";
    }

    if ($display_group_name == "yes") {
        echo "                <td>" . $row["groups"] . "</td>\n";
    }

    echo stripslashes("                <td>" . $row["notes"] . "</td>\n");
    echo "              </tr>\n";

    $row_count++;

    // output 40 rows per printed page //

    if ($row_count == 40) {
        echo "              <tr style=\"page-break-before:always;\"></tr>\n";
        $row_count = 0;
        $page_count++;
    }
echo "   \n";
}

echo "            </tbody></table></div></div><!-- from display 127-->\n";

?>

                    <div class="col-md-3 hidden-print">
                                    <a href="timeclock.php?printer_friendly=true"><button type="button" class="btn btn-info">printer friendly page</button></a>
    	</div></div>
<?php

if (!isset($_GET['printer_friendly'])) {
    echo "          <!-- </td></tr> from display 130-->\n";

}

mysql_free_result($result);
?>
