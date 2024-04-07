<?php
//establishes a connection to a MySQL database named "kyoot_db" using the mysqli_connect() function. 
//It executes a SELECT query on the 'data' table and retrieves all the records.
// If a 'new_post' parameter is set in the request, it inserts a new record into the 'data' table.
// If an 'id' parameter is set in the request, it retrieves a specific record from the 'data' table using a SELECT query.

// backend
// connects to a MySQL database named "kyoot_db" using the mysqli_connect() function
$conn = mysqli_connect("localhost", "root", "", "kyoot_db");

// only visible if connection is not established
if (!$conn) {
    echo "<h3>Connection not established </h3>";
}

// holds the SQL query
$sql = "SELECT * FROM blogs";
// holds the result of the query execution.
$query = mysqli_query($conn, $sql);

$data = array();


// REQUEST contains the values of both $_GET and $_POST
// if (isset($_REQUEST["new_post"])) {
//     $title = $_REQUEST["title"];
//     $content = $_REQUEST["content"];
//     $imagePicture = $_REQUEST["imagePicture"];
//     $linkURL = $_REQUEST["linkURL"];
//     // $time_stamp = $_REQUEST["time_stamp"];

//     $sql = "INSERT INTO blogs(title, content, imagePicture, linkURL ) VALUES ('$title', '$content', '$imagePicture', '$linkURL')";
//     mysqli_query($conn, $sql);

//     //header("Location: ../homepage.php?info=added");
//     exit();
// }
// ... Your existing code ...

if (isset($_REQUEST["new_post"])) {
    $title = $_REQUEST["title"];
    $content = $_REQUEST["content"];
    $linkURL = $_REQUEST["linkURL"];
    // File upload handling
    $imagePicture = "";

    if (isset($_FILES['imagePicture']) && $_FILES['imagePicture']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['imagePicture']['name']);
        // Check if the 'uploads' directory exists, if not, create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }



        move_uploaded_file($_FILES['imagePicture']['tmp_name'], $target_file);
        $imagePicture = $target_file;
    }
    // Ensure 'imagePicture' is not null
    $imagePicture = $imagePicture ?: ""; // if $imagePicture is null, set it to an empty string

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO blogs(title, content, imagePicture, linkURL) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $imagePicture, $linkURL);
    //$stmt->execute();

    if ($stmt->execute()) {
        echo "File uploaded and record inserted successfully.";
        header("Location: ../myProfile.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Redirect or handle success as needed
// header("Location: ../homepage.php?info=added");
    exit();
}

// Check if the 'id' parameter is set in the request
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Execute a SELECT query
    $sql = "SELECT * FROM blogs WHERE id = $id";
    $query = mysqli_query($conn, $sql);
}



?>