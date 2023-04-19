<?php
    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "pubmanager";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchString = $_GET['searchKey'];
    $table_name = 'product';

    // Get data from table
    $sql = "SELECT COUNT(*) as total_results FROM $table_name WHERE ProductName LIKE '%$searchString%'";
    $result = mysqli_query($conn, $sql);

    // Convert data to JSON format
    if ($result) {
        // Fetch result as an associative array
        $totalResults = mysqli_fetch_assoc($result)["total_results"];
        // Get the total product page count
        $numPages = ceil($totalResults / 12);
        
        // Print the total product page count
        echo json_encode($numPages);
    } else {
        // Print an error message if query execution fails
        echo mysqli_error($conn);
    }

    $conn->close();
?>
