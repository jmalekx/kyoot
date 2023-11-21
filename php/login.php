<?php

$servername = "localhost"; #name of server which SQL database hosted (on machine)
$root = "root";
$password = "";

$database = "login";

$connect = mysqli_connect($servername, $root, $password, $database); #variable holds connection object returned by function

if(!$connect){
    die("Connection failed" . mysqli_connect_error());
}
else{
    echo "Connection successful";
}

session_start(); #starts new session when logging in

if(isset($_POST['uname']) && isset($_POST['password'])){ #checks if username and psw have been submitted using the http POST method
    function valid($input){ #removal of spaces, slashes and html characters from string so can be used in SQL
        $input = stripslashes($input);
        $input = trim($input);
        $input = htmlspecialchars($input);
        return $input;
	}
    
    #retrieve and validate username and password inputs
    $uname = valid($_POST['uname']);
	$psw = valid($_POST['password']);

    #checks if empty for potential error message display
	if (empty($uname)){
        header("Location: index.php?error=Username is required");
        exit();
	}
    else if(empty($psw)){
        header("Location: index.php?error=Password is required");
	    exit();
	}
    #runs when both username and password values are present
    else{
        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$psw'";
        $result = mysqli_query($connect, $sql);

        #checks if result contains only one row - if username and password correct, redirected
		if(mysqli_num_rows($result) === 1){
			$row = mysqli_fetch_assoc($result);
            if($row['user_name'] === $uname && $row['password'] === $psw){ #session variables set to store
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: addEntry.php");
		        exit();
            }
            else{
				header("Location: index.php?error=Incorrect username and/or password");
		        exit();
			}
		}
        else{
			header("Location: index.php?error=Incorrect username and/or password");
	        exit();
		}
	}
}
else{
	header("Location: index.php"); #redirects back to index when values not set
	exit();
}