<?php 
                echo '<div class="row"><div class="col-lg-4 hidden-print col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Weather Conditions
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="glyphicon glyphicon-map-marker fa-fw"></i> City:
                                    <span class="pull-right text-muted small"><em>'. $city .'</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-sun-o fa-fw"></i> Currently:
                                    <span class="pull-right text-muted small"><em>'.$temp.'&#176;</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-umbrella fa-fw"></i> Feels Like:
                                    <span class="pull-right text-muted small"><em>'.$feelslike.'&#176;</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="glyphicon glyphicon-cloud fa-fw"></i> Skies:
                                    <span class="pull-right text-muted small"><em>'.$cloud_cover.'</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-refresh fa-fw"></i> Wind:
                                    <span class="pull-right text-muted small"><em>'.$wind_dir .$wind .$mph.'</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-bolt fa-fw"></i> Humidity:
                                    <span class="pull-right text-muted small"><em>'?>
				    <?php if ($humidity == 'None') {echo "<em>$humidity</em>";} else {echo "<em>$humidity%</em>";}?><?php echo'</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-eye fa-fw"></i> Visibility:
                                    <span class="pull-right text-muted small"><em>'.$visibility.'</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="glyphicon glyphicon-time"></i> Last Updated:
                                    <span class="pull-right text-muted small"><em>'.$time.'</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
</div></div>
<!-- /.col-lg-4 -->'
?>


