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
    $catId = $_GET['CatId'];

    // Get data from table
    $sql = "SELECT CEILING(COUNT(*) / 12) as 'TOTAL PAGE' FROM `product` WHERE CatId = '$catId';";
    $result = mysqli_query($conn, $sql);

    // Convert data to JSON format
    if ($result) {
        // Fetch result as an associative array
        $row = mysqli_fetch_assoc($result);
        
        // Get the total product page count
        $totalPageCount = $row['TOTAL PAGE'];
        
        // Print the total product page count
        echo json_encode($totalPageCount);
    } else {
        // Print an error message if query execution fails
        echo mysqli_error($conn);
    }

    $conn->close();
?>