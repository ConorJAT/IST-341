<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    	<title>Lab 1.3</title>
    </head>

    <body>
        <?php
            echo "<h1>ISTE 341 - Lab 1.3 - Conor Race</h1>";

            $grades = [87, 75, 93, 95];
            $avg = 0;

            unset($grades[1]);

            foreach ($grades as $grade) {
                $avg += $grade;
            }

            $avg /= 3.0;

            echo "<p>The average test score: $avg</p>";
        ?>
    </body>
</html>