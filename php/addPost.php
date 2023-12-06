<?php
//establishes a connection to a MySQL database named "kyoot_db" using the mysqli_connect() function. 
//It executes a SELECT query on the 'data' table and retrieves all the records.
// If a 'new_post' parameter is set in the request, it inserts a new record into the 'data' table.
// If an 'id' parameter is set in the request, it retrieves a specific record from the 'data' table using a SELECT query.

// backend
    // connects to a MySQL database named "kyoot_db" using the mysqli_connect() function
    $conn = mysqli_connect("localhost", "root", "", "kyoot_db");

    // only visible if connection is not established
    if(!$conn) { 
        echo "<h3>Connection not established </h3>";
    }

    // holds the SQL query
    $sql = "SELECT * FROM blogs";
    // holds the result of the query execution.
    $query = mysqli_query($conn, $sql);

    $data = array();
 
   
    // REQUEST contains the values of both $_GET and $_POST
    if(isset($_REQUEST["new_post"])) {
        $title = $_REQUEST["title"];
        $content = $_REQUEST["content"];
        // $time_stamp = $_REQUEST["time_stamp"];

        $sql = "INSERT INTO blogs(title, content ) VALUES ('$title', '$content')";
        mysqli_query($conn, $sql);

        //header("Location: ../homepage.php?info=added");
        exit();
    }

    // checks if the 'id' parameter is set in the request
    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];


        // here we have a query that you pass into $query
        $sql = "SELECT * FROM blogs WHERE id = $id";
        $query = mysqli_query($conn, $sql);
    }
    


    ?>
    


