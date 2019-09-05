<?php 
    require_once 'connection.php';
    session_start();
$a = $_SESSION['id'];

    $defSql = "SELECT * FROM users WHERE id=$a";
    $defresult = $conn->query($defSql);
    $defrow = $defresult->fetch_assoc();
    $imeee = $defrow['username'];
 
    $im = "";
     
    if(isset($_POST["search"]))
    {
        $im = $_POST["search"];

    }
    

    $sql = "SELECT * FROM users WHERE email LIKE '%$im%' OR username LIKE '%$im%'";
    $result = $conn->query($sql);
 
        if(!$result)
        {
            echo "greska";
        }

    $row = $result->fetch_assoc();
    
    
        $ime =  $row['username'];


?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <ul>

            <li><a href="logout.php">Log out</a></li>
            <li><h3><?php echo "Hello, $imeee";?></h3></li>

        </ul>
        <form action="dashbord.php" method="POST">
            <div class="row">
                    <div class="col-3">
                        <label for="">Search</label>
                    </div>
                    <div class="col-9">
                        <input type="search" name="search">
            </div>
            <div class="row">
                <input type="submit" name="submit" value=Submit>
            </div>
            <div class="row">
                <?php 
                    echo $row["username"] . "<br>";
                    echo $row["email"] . "<br>"; 
                ?>
            </div>

        </form>
    </body>
</html>