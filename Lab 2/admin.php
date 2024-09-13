<?php
    session_name('ctr9664-lab-2');
    session_start();
?>

<html>
    <head>
        <title>Admin Page</title>
    </head>

    <body>
        <h2>Welcome to the page!</h2>

        <?php
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
                $date = $_COOKIE['loggedIn'];
                echo "<p>You logged in on $date</p>";

                unset($_SESSION['loggedIn']);
                session_unset(); // Step 1: Unset entire session.
                
                // Step 2: Invalidate/destroy session cookie.
                if (isset($_COOKIE[session_name()])) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(),'', 1, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
                }

                if (isset($_COOKIE['loggedIn'])) {
                    setcookie('loggedIn','', 1, "/~ctr9664/", "solace.ist.rit.edu", true, true);
                }

                session_destroy(); // Step 3: Destroy the session.
            } else {
                header('Location: login.php?error=loginRequired');
                die();
            }
        ?>
    </body>
</html>