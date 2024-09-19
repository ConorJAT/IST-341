<html>
    <head>
        <title>Feelings Form</title>
    </head>

    <body>
        <form method="POST" name="feelings-form">
            First Name: <input type="text" name="first-name"/><br/>
            Last Name: <input type="text" name="last-name"/><br/>
            Date: <input type="text" name="date"/><br/>
            Comments: <textarea type="text" name="comments"></textarea><br/><br/>
            Mood:
                <input type="radio" id="happy" name="current-mood" value="Happy"/>
                <label for="happy">Happy</label>
                <input type="radio" id="upset" name="current-mood" value="Upset"/>
                <label for="upset">Upset</label>
                <input type="radio" id="indifferent" name="current-mood" value="Indifferent"/>
                <label for="indifferent">Indifferent</label><br/><br/>
            <input type="reset" value="Reset Form"/>
            <input type="submit" name="submit" value="Submit Form"/>
        </form>

        <?php
            $firstName;
            $lastName;
            $date;
            $comments;
            $mood;

            if (isset($_POST["submit"])) { 
                // Name Validation and Cleansing
                if ($_POST["first-name"] == "" || $_POST["last-name"] == "") { 
                    echo "<hr/><p>Sorry, I didn't quite catch your name...</p>";
                } else {
                    $firstName = trim(strip_tags($_POST["first-name"]));
                    $lastName = trim(strip_tags($_POST["last-name"]));

                    if (isset($_POST["current-mood"])) { 
                        $mood = $_POST["current-mood"];
                    }   else {
                        $mood = "";
                    }
                    switch ($mood) {
                        case "Happy":
                            echo "<hr/><p>Welcome, $firstName $lastName! Glad to hear you're doing well!</p>";
                            break;
                        
                        case "Upset":
                            echo "<hr/><p>Welcome, $firstName $lastName. Take as much time and space as you need.</p>";
                            break;

                        case "Indifferent":
                            echo "<hr/><p>Welcome, $firstName $lastName. Hope you have a good day today!</p>";
                            break;

                        default:
                            echo "<hr/><p>Welcome, $firstName $lastName!</p>";
                            break;
                    }
                }

                // Date Validation and Cleansing
                if ($_POST["date"] == "" || $_POST["date"] == "") { 
                    echo "<p>Sorry, cannot retrieve date information...</p>";
                } else {
                    $date = trim(strip_tags($_POST["date"]));
                    echo "<p>Today is $date.</p>";
                }

                // Comments Validation and Cleansing
                if ($_POST["comments"] == "") { 
                    echo "<p>Today's Comments: None.</p>";
                } else {
                    $comments = trim(strip_tags($_POST["comments"]));
                    echo "Today's Comments: $comments</p>";
                }
            }
        ?>
    </body>
</html>