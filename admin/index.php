<?php include "includes/admin_header.php"; ?>

<?php

$post_count = count_records(get_all_user_posts());
$comment_count = count_records(get_all_post_user_comments());
$category_count = count_records(get_all_user_categories());

$post_published_count = count_records(get_all_user_published_posts());
$post_draft_count = count_records(get_all_user_draft_posts());

$approved_comments_count = count_records(get_all_user_approved_comments());
$unapproved_comments_count = count_records(get_all_user_unapproved_comments());

?>

    <div id="wrapper">



        <!-- Navigation -->


        <?php include "includes/admin_navigation.php"; ?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                        <h1 class="page-header">
                            <small>Role: Admin</small>
                            Welcome to Admin <?php echo strtoupper(get_user_name()); ?>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->


                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                                                    
                                        <!--<div class='huge'><?php // echo $post_count = recordCount('posts'); ?></div>-->

                                        <?php echo "<div class='huge'>".$post_count."</div>"; ?>

                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <!--<div class='huge'><?php //echo $comment_count = recordCount('comments'); ?></div>-->

                                    <?php echo "<div class='huge'>".$comment_count."</div>"; ?>

                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--<div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <div class='huge'><?php //echo $user_count = recordCount('users'); ?></div>

                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>-->
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                            <!--<div class='huge'><?php //echo $category_count = recordCount('categories'); ?></div>-->

                                            <?php echo "<div class='huge'>{$category_count}</div>"; ?>

                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


                <?php

                // $query = "SELECT * FROM posts WHERE post_status = 'published'";
                // $select_all_published_post = mysqli_query($connection, $query);
                // $post_published_count = mysqli_num_rows($select_all_published_post);

                // $post_published_count = checkStatus('posts','post_status','published');



                //$post_draft_count = checkStatus('posts','post_status','draft');

                

                // $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                // $unapproved_comments_query = mysqli_query($connection, $query);
                // $unapproved_comments_count = mysqli_num_rows($unapproved_comments_query);

                //$unapproved_comments_count = checkStatus('comments','comment_status','unapproved');

                // $subscriber_count = checkUserRole('users','user_role','subscriber');

                ?>


                <div class="row">


                    <script type="text/javascript">
                          google.charts.load('current', {'packages':['bar']});
                          google.charts.setOnLoadCallback(drawChart);

                          function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                              ['Date', 'Count'],


                              <?php


                              $element_text = ['All Posts','Active Posts', 'Draft Posts', 'Comments', 'Approved Comments','Pending Comments', 'Categories'];
                              $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $approved_comments_count, $unapproved_comments_count, $category_count];

                              for($i = 0; $i< 7; $i++) {

                                // minta: ['Posts', 1000],
                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

                              }


                              ?>


                              //['Posts', 1000],
                            ]);

                            var options = {
                              chart: {
                                title: '',
                                subtitle: '',
                              }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                          }
                    </script>

                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


                </div>


            </div>
            <!-- /.container-fluid -->

        </div>



        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php"; ?>