<?php
    //set a connection variable
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_trip";

    //create a database connection
    $conn = new mysqli($server , $username , $password, $dbname);

    //check for connection status
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $insert = false;

    //isset-checks whether a variable is set and is not NULL
    if(isset($_POST['name'])){
        //collect post variables
        //$_POST is a PHP super global variable which is used to collect form data after submitting an HTML form with method="post"
        $name  = $_POST['name'];
        $phoneno = $_POST['phoneno'];
        $fphoneno = $_POST['fphoneno'];
        $email = $_POST['email'];
        $class = $_POST['class'];
        $address = $_POST['address'];
        $curr_date = date('Y-m-d H:i:s');


        $sql = "INSERT INTO  tb_trip (name, mobile_no, fmobile_no, email, class, home_address,status,date_created,date_updated) 
        VALUES ('".$name."','".$phoneno."','".$fphoneno."','".$email."','". $class."', '".$address."', 'active', '".$curr_date."', '".$curr_date."' );";
     
        //execute the querry
        if($conn->query($sql) == true){
            //flag for successfully inserted
            $insert = true ;
            echo "successfully inserted";
        } 
        else{
            echo "ERROR : $sql <br> $conn->error";
        }  
    }
    //close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to travel form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Welcome to banasthali manali trip form</h1>
        <p>Enter your details and submit this form to confirm your participation in the trip. </p>

        <form action="index.php" method="post">
            <p><input type="text" name="name" id="name" required placeholder="NAME"></p>
            <p><input type="number" name="phoneno" id="phoneno" required placeholder="MOBILE NUMBER"></p>
            <p><input type="number" name="fphoneno" id="fphoneno" required placeholder="FATHER'S MOBILE NUMBER"></p>
            <p><input type="email" name="email" id="email" required placeholder="EMAIL"></p>
            <p><input type="text" name="class" id="class" required placeholder="CLASS"></p>
            <p><textarea name="address" id="address" cols="15" rows="5" required placeholder="HOME ADDRESS"></textarea></p>
            <p><input class="btn" type="submit" value="SUBMIT"></p>
        </form>
        <br>
        <div class="list">
            <h4>List of students going for trip:<a  href="list.php">List of students</a> </h4>
        </div>
    </div>
    
    
</body>
</html>