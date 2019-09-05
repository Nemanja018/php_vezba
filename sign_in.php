<?php

   // session_start();
   session_start();

   require_once 'connection.php';
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = $conn->real_escape_string($_POST["username"]);
        $pass = $conn->real_escape_string($_POST["password"]);

        $sql = "
            SELECT * FROM users WHERE username = '$username'
        ";

        $result = $conn->query($sql);
        if(!$result)
        {
            echo "Error.";
        }
        else
        {
            if($result->num_rows == 0)
            {
                echo "There isn't user with this username.";
            }
            else
            {
                $row = $result->fetch_assoc();

                if($row["password"] != $pass)
                {
                    echo "Bad password.";
                }
                else
                {
                    $_SESSION["id"] = $row["id"];
                    
                        header('Location: dashbord.php');

                    
                }
            }
        }
    }

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <form action="sign_in.php" method="POST">
            <div class="row">
                <div class="col-3">
                    <label for="">Username</label>
                </div>
                <div class="col-9">
                    <input type="text" name="username">
                </div>
                <div class="row">
                <div class="col-3">
                    <label for="">Password</label>
                </div>
                <div class="col-9">
                    <input type="password" name="password">
                </div>
            
            </div>
            <div class="row">
                <input type="submit" name="submit" value=Submit>
            </div>
        </form>

    </body>
</html>