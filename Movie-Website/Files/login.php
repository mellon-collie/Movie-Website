<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "terminator";
    $dbname = "FilmNoirDB";
    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed".$conn->error);
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $emailid = $_POST['user'];
        if(strlen($emailid) == 0)
        {
            $message = "*Email ID field cannot be left empty!";
        }
        $password = $_POST['password'];
        if(strlen($password) == 0)
        {
            $message = "*Password field cannot be left empty!";
        } 
        if(strlen($emailid) == 0 && strlen($password) == 0)
        {
            $message = "*Email ID field and Password field cannot be left empty!";
        }     
        if(strlen($emailid)>0 && strlen($password)>0)
        {
            $sql = "SELECT * FROM FilmNoirUserInfo";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc())
                {
                    if(strcmp($row["username"],$emailid) === 0 && strcmp($row["password"],$password) === 0)
                    {
                        $firstname = $row["firstname"];
                        $lastname = $row["lastname"];
                        $user = $row["username"];
                        $found = 1;
                        break;
                    }
                }
                if($found == 0)
                {
                    $message = "Invalid user";
                }
                else if($found == 1)
                {
                     $_SESSION["firstname"] = $firstname;
                     $_SESSION["lastname"] = $lastname; 
                     $_SESSION["emailID"] = $emailid;
                     $_SESSION["password"] = $password; 
                     $_SESSION["username"] = $user;
                     header("Location:transition.html");
                     exit();                     
                }
            }
           
        }
    } 
?>  
<!DOCTYPE html>
<html>
    <head>
      	<title>Login Page</title>
    	<link rel="stylesheet" href="../CSS/logup.css">
    </head>
    <body>
    	<div class='login'>
    		<div class='login_title'>
    			<span>Login to your account</span>
    	  	</div>
    	  	<div class='login_fields'>
    			<div class='login_fields__user'>
    				<form action="" method="POST">
    		  			<div class='icon'>
    		    			<img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/user_icon_copy.png'>
    		  			</div>
    			  		<input placeholder='Username' type='text' name = "user"></input>
    					</div>
    					<div class='login_fields__password'>
    			  		<div class='icon'>
    						<img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/lock_icon_copy.png'>
    			  		</div>
    			  		<input placeholder='Password' type='password' name = "password"></input>
    					</div>
    					<div class='login_fields__submit'>
    		  				<input type='submit' value='Log In'>
    					</div>
    				</form>
    	    </div>
    	</div>
    </body>
</html>
