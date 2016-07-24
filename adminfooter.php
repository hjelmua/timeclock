
<?php

?>
   </div>
    <!-- /#wrapper look in header-->

<!--footer--> 
<div class="navbar navbar-default navbar-static-bottom">
<footer class="footer">

<p class="navbar-text pull-left">Powered by <a class="footer_links" href="http://httpd.apache.org/">Apache</a> &nbsp;&#177 <a class="footer_links" href="http://mysql.org">MySql</a>&nbsp;&#177
<?php
if ($email == "none") {
    echo "<a class='footer_links' href='http://php.net'>&nbsp;PHP</a> &nbsp;&#8226;<a class='footer_links' href='http://timeclock.sourceforge.net'>&nbsp;$app_name&nbsp;$app_version</a>";
} else {
    echo "<a class='footer_links' href='http://php.net'>&nbsp;PHP</a>&nbsp;&#8226;&nbsp;<a class='footer_links' href='mailto:$email'>$email</a> &nbsp;&#8226;<a class='footer_links' href='http://timeclock.sourceforge.net'>&nbsp;$app_name&nbsp;$app_version</a>";
}
?> &nbsp;&#177 <a class="footer_links" href="http://startbootstrap.com/">SB Admin 2 theme</a> &nbsp;&#177 <a class="footer_links" href="http://getbootstrap.com">Bootstrap</a>
</p>
</footer>
</div>

<!-- script footer-->


    <!-- jQuery -->
    <script src="../css/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../css/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../css/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../css/dist/js/sb-admin-2.js"></script>

</body>
</html>
