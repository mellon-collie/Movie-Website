<?php
    session_start();
    $servername = "localhost";   
    $userName = "root";
    $password = "terminator";
    $dbname = "FilmNoirDB";
    $conn = new mysqli($servername,$userName,$password,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed".$conn->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $username = $_POST['user'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        //echo "Hello";
        if(strlen($firstname) == 0 || strlen($lastname) == 0 || strlen($username) == 0 || strlen($email) == 0 || strlen($password) == 0)
        {
            $message = "* Filling all fields is compulsory";
            //echo $message;
        }
        else
        {
            $open_table_sql = "SELECT * FROM FilmNoirUserInfo";
           
            $user_info = $conn->query($open_table_sql);
            if($user_info->num_rows>0)
            {
             
                while($row = $user_info->fetch_assoc())
                {
                    if(strcmp($row["user"],$username) === 0 || strcmp($row["email"],$email) === 0)
                    {
                        $message = "*This username or emailID already exists. Please try another one!";
                        //echo $message;
                        $found = 1;
                        break;
                    }
                }
            }
                
            if($found == 0)
            {
                $insert_into_UserInfo_table_sql = "INSERT INTO FilmNoirUserInfo (username, firstname, lastname, email, password)
                    VALUES ('$username', '$firstname', '$lastname', '$email', '$password')";
                if($conn->query($insert_into_UserInfo_table_sql) === TRUE)
                {
                    $_SESSION["firstname"] = $firstname;
                    $_SESSION["lastname"] = $lastname; 
                    $_SESSION["emailID"] = $email;
                    $_SESSION["username"] = $username;
                    $_SESSION["password"] = $password; 
                }
                else 
                {
                    $message = "Error! Please try again ".$conn->error; 
                }
                    
                    $insert_into_UserLikedWatched_table_sql = "INSERT INTO usergenreinfo (username,actionliked,actionwatched,adventureliked,adventurewatched,animationliked,animationwatched,thrillerliked,
thrillerwatched,comedyliked,comedywatched,romanceliked,romancewatched,sciencefictionliked,sciencefictionwatched,neonoirliked,neonoirwatched,
horrorliked,horrorwatched) VALUES ('$username',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)";
                    $insert_into_UserWatched_table_sql ="INSERT INTO usergenrewatched (username,actionwatched,adventurewatched,animationwatched,
thrillerwatched,comedywatched,romancewatched,sciencefictionwatched,neonoirwatched,horrorwatched) VALUES ('$username','','','','','','','','','')";
                if($conn->query($insert_into_UserLikedWatched_table_sql) === TRUE)
                {
                    echo "reaching here".$conn->error;
                    if($conn->query($insert_into_UserWatched_table_sql) === TRUE)
                    {
                        header("Location:selection-page.html");
                        exit();
                    }
                    
                }
                else
                {
                    $message = "Error entering into User Genre Info table".$conn->error;
                }
                
            } 
                
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Signup Page</title>
        <link rel="stylesheet" href="../CSS/logup.css">
    </head>
    <body>
        <div class='login' style="height:400px;">
            <div class='login_title'>
                <span>Join the Dark Side</span>
            </div>
            <form method = "post" action = "">
            <div class='login_fields'>
                <div class='login_fields__user'>
                    <div class='icon'>
                        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/user_icon_copy.png'>
                    </div>
                    <input placeholder='First Name' type='text' name = "fname"></input>
                    <input placeholder='Last Name' type='text' name = "lname"></input>
                    <input placeholder='Email ID' type='text' name = "email"></input>
                    <input placeholder='Username' type='text' name = "user"></input>
                </div>
                <div class='login_fields__password'>
                    <div class='icon'>
                        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/lock_icon_copy.png'>
                    </div>
                    <input placeholder='Password' type='password' name = "password"></input>
                </div>
                <div class='login_fields__submit'>
                    <input type='submit' value='Signup'>
                </div>
            </div>
            </form>
                   </div>
    </body>
     <?php echo $message; ?>

</html>
