<?php
    session_name('ctr9664-lab-2');
    session_start();

    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        header('Location: admin.php');
        die();
    }
?>

<html>
    <head>
        <title>Login Page</title>
    </head>

    <body>
        <?php
            $username = "";
            $password = "";
            $adminError = "";

            if (isset($_GET['username'])) { $username = $_GET['username']; }
            if (isset($_GET['password'])) { $password = $_GET['password']; }
            if (isset($_GET['error'])) { $adminError = $_GET['error']; }

            if (!empty($adminError) && $adminError == 'loginRequired') {
                echo '<h3>Login Required.</h3>';
            } else if  (empty($username) && empty($password)) {
                echo '<h3>Welcome! Please login to continue.</h3>';
            } else if (empty($username) || empty($password)) {
                echo '<h3>Invalid Login! Please try again!</h3>';
            } else {
                $_SESSION['loggedIn'] = true;

                date_default_timezone_set('ET');
                setcookie(
                    'loggedIn',
                    date('F jS, Y, h:i A'),
                    time() + 600,
                    "/~ctr9664/",
                    "solace.ist.rit.edu",
                    true,
                    true
                );
                header('Location: admin.php');
                die();
            }
        ?>
    </body>
</html>