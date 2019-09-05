<?php 
    session_start();
    $id = $_SESSION["id"];
    require_once 'connection.php';

    $usernameCheck = "*";
    $emailCheck = "*";
    $passCheck = "*";

    $sql = "SELECT *
    FROM users WHERE id = $id";

    $result = $conn->query($sql);

    //var_dump($result);
    if($result->num_rows == 0)
    {
        $emailValue = "";
        $userValue = "";
        $passValue = "";
    }
    else
    {
        $row = $result->fetch_assoc();
        $emailValue = $row["email"];
        $userValue = $row["username"];
        $passValue = $row["password"];
    }

    if(!empty($_POST))
    {
        $email = $conn->real_escape_string($_POST["email"]);
        $username = $conn->real_escape_string($_POST["username"]);
        $password = $conn->real_escape_string($_POST["password"]);

        if(empty($email))
        {
            $emailCheck = "Please, enter your email.";
        }
        else
        {
            if(empty($username))
            {
                $usernameCheck = "Please, enter your username."; 
            }
            else
            {
                if(empty($password))
                {
                    $passCheck = "Please, enter your password.";
                }
                else
                {
                    if($password == $_POST["retPassword"])
                    {
                        if($result->num_rows == 0)
                        {
                            $sql = "
                            INSERT INTO users (username, email, password)
                            VALUES ('$username', '$email', '$password') ";
                        }
                        else
                        {

                            echo "korisnik vec postoji.";                            //var_dump($sql);
                        }
                      
                        $conn->query($sql);
                        header("Refresh: 0; search.php");
    
                    }
                    else
                    {
                        echo "Error";
                    }
                }
            }
        }
    }

?>


<html>
    <head>

    </head>
    <body>
        <h2>Registration</h2>
        <form action="sign_up.php" method="POST">
            <div class="row">
                <div class="col-3">
                    <label for="">Email</label>
                </div>
        
                <div class="col-9">
                    <input type="email" name="email" value="<?php echo $emailValue; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="">Username</label>
                </div>
                <div class="col-9">
                    <input type="text" name="username" value="<?php echo $userValue; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="">Password</label>
                </div>
                <div class="col-9">
                    <input type="password" name="password" value="<?php echo $passValue; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="">Retype password</label>
                </div>
                <div class="col-9">
                    <input type="password" name="retPassword">
                </div>
            </div>
            <div class="row">
                <input type="submit" name="register" value="Register">
            </div>
            </div>
        </form>
    </body>
</html>