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

    $table_name = 'product';

    if(!isset($_GET['priceMax'])) {
        // Nếu chỉ có min
        $priceMinString = $_GET['priceMin'];
        $priceMin = intval($priceMinString);
        $sql = "SELECT COUNT(*) as total_results FROM $table_name WHERE price > $priceMin";
    } else if (!isset($_GET['priceMin'])) {
        // Nếu chỉ có max
        $priceMaxString = $_GET['priceMax'];
        $priceMax = intval($priceMaxString);
        $sql = "SELECT COUNT(*) as total_results FROM $table_name WHERE price < $priceMax";
    } else {
        // Nếu có cả min và max
        $priceMinString = $_GET['priceMin'];
        $priceMin = intval($priceMinString);
        $priceMaxString = $_GET['priceMax'];
        $priceMax = intval($priceMaxString);
        $sql = "SELECT COUNT(*) as total_results FROM $table_name WHERE price BETWEEN $priceMin AND $priceMax";
    }
    
    // Get data from table
    $result = $conn->query($sql);

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
