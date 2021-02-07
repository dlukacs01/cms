<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php include "admin/functions.php"; ?>

    <!-- Navigation -->


<?php include "includes/navigation.php"; ?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->

            <div class="col-md-8">

                <?php


                if(isset($_GET['category'])) {

                    $post_category_id = $_GET['category'];



                    // if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {

                    //     $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
                    // } else {

                    //     $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published'";
                    // }

                    if(is_admin($_SESSION['username'])) {

                        // PREPARED STATEMENT with the ? placeholder
                        $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ?");

                    } else {

                        $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ?");

                        $published = 'published'; // it HAS TO BE a variable, string cannot directly go there
                    }
                   
                    if(isset($stmt1)) {

                        // i stands for integer. We use this, because the cat id is an integer
                        mysqli_stmt_bind_param($stmt1, "i", $post_category_id);
                        mysqli_stmt_execute($stmt1); //executing
                        mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content); // fetching data

                        $stmt = $stmt1;


                    } else {

                        // i stands for integer. We use this, because the cat id is an integer
                        // s stands for string. We use this, because the post status is a string
                        mysqli_stmt_bind_param($stmt2, "is", $post_category_id, $published);
                        mysqli_stmt_execute($stmt2); //executing
                        mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content); // fetching data

                        $stmt = $stmt2;

                    }

                    // $select_all_posts_query = mysqli_query($connection, $query);

                    // if(mysqli_num_rows($select_all_posts_query) < 1) {

                    //     echo "<h1 class='text-center'>No posts available</h1>";

                    // } else {

                    if(mysqli_stmt_num_rows($stmt) === 0) {

                        echo "<h1 class='text-center'>No Categories available</h1>";

                    }


                    while (mysqli_stmt_fetch($stmt)) :

                        // $post_id = $row['post_id'];
                        // $post_title = $row['post_title'];
                        // $post_author = $row['post_author'];
                        // $post_date = $row['post_date'];
                        // $post_image = $row['post_image'];
                        // $post_content = substr($row['post_content'],0,100); // truncating the text

                    ?>

                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                    <?php endwhile;

                    mysqli_stmt_close($stmt);


                } else { // if no category is set, redirect back to index

                    header("Location: index.php");

                }

                ?>


            </div>


            <!-- Blog Sidebar Widgets Column -->


            <?php include "includes/sidebar.php"; ?>



        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>
