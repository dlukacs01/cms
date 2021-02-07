<?php

use PHPMailer\PHPMailer\PHPMailer; // needs to be on top !!!
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>


<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<?php

// Load Composer's autoloader (EZ MAGA A COMPOSER AUTOLOAD RÉSZE, automatikusan betölti a classes mappában lévő classokat)
require './vendor/autoload.php';
// require './classes/Config.php'; ezt már a composer autolad tölti be / megoldja

// testing composer's autoload
// $example = new Example();

// Returns the name of the class of an object
// echo get_class($example)."szia";

    // if its not a GET request OR we dont have the right key
    // ... we dont have the person to be here at all...
    if(!isset($_GET['forgot'])) {

        redirect('index');

    }

    // FORM SUBMIT
    if(ifItIsMethod('post')) {

        if(isset($_POST['email'])) {

            $email = $_POST['email'];

            $length = 50;

            // creating random string
            $token = bin2hex(openssl_random_pseudo_bytes($length));

            if(email_exists($email)) {

                // echo "IT DOES EXISTS";

                // PREPARE
                if($stmt = mysqli_prepare($connection, "UPDATE users SET token = '{$token}' WHERE user_email = ?")) { //...if we are able to connect, we set those values

                    // BIND
                    mysqli_stmt_bind_param($stmt, "s", $email); // s stands for string
                    // EXECUTE
                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_close($stmt);

                    /*
                    *
                    * configure PHPMailer
                    *
                    */

                    $mail = new PHPMailer(true);

                    // Returns the name of the class of an object
                    // echo get_class($mail)."szia";

                    //Server settings
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = Config::SMTP_HOST;                    // Set the SMTP server to send through                    
                    $mail->Username   = Config::SMTP_USER;                     // SMTP username
                    $mail->Password   = Config::SMTP_PASSWORD;                    // SMTP password
                    $mail->Port       = Config::SMTP_PORT;                       // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->CharSet = 'UTF-8'; // setting utf8 encoding (ékezetes betűkhöz kell, Árvíztűrő tükörfúrógép)

                    //Recipients
                    $mail->setFrom('edwin@codingfaculty.com', 'Edwin Diaz');
                    $mail->addAddress($email);     // Add a recipient

                    $mail->Subject = 'This is a test email';
                    $mail->Body    = '<p>Please click to reset your password

                    <a href="http://localhost/cms/reset.php?email='.$email.'&token='.$token.' ">http://localhost/cms/reset.php?email='.$email.'&token='.$token.'</a>

                    </p>';

                    if($mail->send()) {

                        // echo "IT WAS SENT";
                        $emailSent = true;

                    } else {
                        echo "NOT SENT";
                    }


                } else {


                    //echo "WRONG";
                    echo mysqli_error($connection);

                }

            }

        }

    }


?>


<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <?php if(!isset($emailSent)): ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                            <?php else: ?>

                                <h2>Please check your email</h2>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->