<?php
session_start();
error_reporting(1);

$db_config_path = '../application/config/database.php';

if (!isset($_SESSION["license_code"])) {
    $_SESSION["error"] = "Invalid purchase code!";
    header("Location: index.php");
    exit();
}

if (isset($_POST["btn_admin"])) {

    $_SESSION["db_host"] = $_POST['db_host'];
    $_SESSION["db_name"] = $_POST['db_name'];
    $_SESSION["db_user"] = $_POST['db_user'];
    $_SESSION["db_password"] = $_POST['db_password'];


    /* Database Credentials */
    defined("DB_HOST") ? null : define("DB_HOST", $_SESSION["db_host"]);
    defined("DB_USER") ? null : define("DB_USER", $_SESSION["db_user"]);
    defined("DB_PASS") ? null : define("DB_PASS", $_SESSION["db_password"]);
    defined("DB_NAME") ? null : define("DB_NAME", $_SESSION["db_name"]);

    /* Connect */
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection->query("SET CHARACTER SET utf8");
    $connection->query("SET NAMES utf8");

    /* check connection */
    if (mysqli_connect_errno()) {
        $error = 0;
    } else {
        
        mysqli_query($connection, "UPDATE settings SET version = '1.4' WHERE id = 1;");

        mysqli_query($connection, "ALTER TABLE `workflows` ADD `lang_id` INT NOT NULL DEFAULT '1' AFTER `id`;");
        mysqli_query($connection, "ALTER TABLE `product_services` ADD `lang_id` INT NOT NULL DEFAULT '1' AFTER `id`;");
        mysqli_query($connection, "ALTER TABLE `educations` ADD `lang_id` INT NOT NULL DEFAULT '1' AFTER `id`;");
        mysqli_query($connection, "ALTER TABLE `experiences` ADD `lang_id` INT NOT NULL DEFAULT '1' AFTER `id`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `minimum_session_price` INT NULL DEFAULT '100' AFTER `time_zone`;");
        mysqli_query($connection, "ALTER TABLE `settings` ADD `sender_mail` VARCHAR(255) NULL AFTER `mail_title`;");
        mysqli_query($connection, "ALTER TABLE `users` ADD `booking_enable` INT NOT NULL DEFAULT '1' AFTER `date_format`;");


        // import database table
        $query = '';
          $sqlScript = file('sql/settings_extra.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }
        

        // import database table
        $query = '';
          $sqlScript = file('sql/mentors_settings_extra.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }



        mysqli_query($connection, "INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Upload your resume', 'upload-your-resume', 'Upload your resume'),
        ('user', 'Maximum size :', 'maximum-size-', 'Maximum size :'),
        ('user', 'Interests', 'interests', 'Interests'),
        ('user', 'Resume', 'resume', 'Resume'),
        ('user', 'Preview resume', 'preview-resume', 'Preview resume'),
        ('user', 'Add new skills', 'add-new-skills', 'Add new skills'),
        ('user', 'Minimum session price', 'minimum-session-price', 'Minimum session price'),
        ('user', 'Minimum price for paid is', 'minimum-price-for-paid-is', 'Minimum price for paid is'),
        ('user', 'Set 0 to disable the minimum price option', 'set-0-to-disable-the-minimum-price-option', ' Set 0 to disable the minimum price option'),
        ('user', 'Sender Mail', 'sender-mail', 'Sender Mail'),
        ('user', 'or more', 'or-more', 'or more'),
        ('user', 'Price must be', 'price-must-be', 'Price must be'),
        ('user', 'Booking Disable', 'booking-disable', 'Booking Disable'),
        ('user', 'Booking Enable', 'booking-enable', 'Booking Enable'),
        ('user', 'The mentor has currently disabled session bookings. Please check back later or contact the mentor for more information.', 'session-booking-disabled-warning', 'The mentor has currently disabled session bookings. Please check back later or contact the mentor for more information.'),
        ('user', 'Total attendance (logged in) on this site divided by the total days since joining', 'total-attendance-info', 'Total attendance (logged in) on this site divided by the total days since joining'),
        ('user', 'Enable Booking', 'enable-booking', 'Enable Booking'),
        ('user', 'Enable this option to allow mentees to book your sessions.', 'enable-booking-title', 'Enable this option to allow mentees to book your sessions.'),
        ('user', 'Show Account Publicly', 'show-account-publicly', 'Show Account Publicly'),
        ('user', 'Enable this option to display your account publicly in the Mentors listing.', 'show-account-publicly-title', 'Enable this option to display your account publicly in the Mentors listing.'),
        ('user', 'Available ASAP', 'available-asap', 'Available ASAP'),
        ('user', 'Similar Mentors', 'similar-mentors', 'Similar Mentors');");

            
      /* close connection */
      mysqli_close($connection);

      $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://" . $_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
      $redir = str_replace('updates/v1.4/', '', $redir);
      header("refresh:5;url=" . $redir);
      $success = 1;
    }



}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mentorship &bull; Update Installer</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/libs/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,500,600,700&display=swap" rel="stylesheet">
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2">

                <div class="row">
                    <div class="col-sm-12 logo-cnt">
                        <p>
                           <img src="assets/img/logo.png" alt="">
                        </p>
                       <h1>Welcome to the update installer</h1>
                   </div>
               </div>

               <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">

                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="100" data-number-of-steps="3" style="width: 100%;"></div>
                            </div>
                            <div class="step" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-arrow-circle-right"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step active" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                        </div>

                        <div class="messages">
                            <?php if (isset($message)) { ?>
                            <div class="alert alert-danger">
                                <strong><?php echo htmlspecialchars($message); ?></strong>
                            </div>
                            <?php } ?>
                            <?php if (isset($success)) { ?>
                            <div class="alert alert-success">
                                <strong>Completing Updates ... <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Please wait 5 second </strong>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="tab-content">
                                        <div class="tab_1">
                                            <h1 class="step-title">Database</h1>
                                            <div class="form-group">
                                                <label for="email">Host</label>
                                                <input type="text" class="form-control form-input" name="db_host" placeholder="Host"
                                                value="<?php echo isset($_SESSION["db_host"]) ? $_SESSION["db_host"] : 'localhost'; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Database Name</label>
                                                <input type="text" class="form-control form-input" name="db_name" placeholder="Database Name" value="<?php echo @$_SESSION["db_name"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Username</label>
                                                <input type="text" class="form-control form-input" name="db_user" placeholder="Username" value="<?php echo @$_SESSION["db_user"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Password</label>
                                                <input type="password" class="form-control form-input" name="db_password" placeholder="Password" value="<?php echo @$_SESSION["db_password"]; ?>">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <a href="index.php" class="btn btn-success btn-custom pull-left">Prev</a>
                                        <button type="submit" name="btn_admin" class="btn btn-success btn-custom pull-right">Finish</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>


    </div>


</div>

<?php

unset($_SESSION["error"]);
unset($_SESSION["success"]);

?>

</body>
</html>

