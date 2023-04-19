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
    $pageString = $_GET['page'];
    $pageInt = intval($pageString);
    $page = ($pageInt - 1) * 12;
    $table_name = 'product';

    // Get data from table
    if(isset($_GET['isAscending'])) {
        $isAscending = $_GET['isAscending']; // Assuming $_GET['isAscending'] contains a string representation of a number
        $isAscendingNumber = intval($isAscending);
        if($isAscendingNumber == 0) {
            // Giảm dần
            $sql = "SELECT * FROM $table_name ORDER BY `product`.`Price` DESC LIMIT 12 OFFSET $page";
        } else {
            // Tăng dần
            $sql = "SELECT * FROM $table_name ORDER BY `product`.`Price` ASC LIMIT 12 OFFSET $page";
        }
    } else if (isset($_GET['priceMin']) || isset($_GET['priceMax'])) {
        if(!isset($_GET['priceMax'])) {
            // Nếu chỉ có min
            $priceMinString = $_GET['priceMin'];
            $priceMin = intval($priceMinString);
            $sql = "SELECT * FROM $table_name WHERE price > $priceMin LIMIT 12 OFFSET $page";
        } else if (!isset($_GET['priceMin'])) {
            // Nếu chỉ có max
            $priceMaxString = $_GET['priceMax'];
            $priceMax = intval($priceMaxString);
            $sql = "SELECT * FROM $table_name WHERE price < $priceMax LIMIT 12 OFFSET $page";
        } else {
            // Nếu có cả min và max
            $priceMinString = $_GET['priceMin'];
            $priceMin = intval($priceMinString);
            $priceMaxString = $_GET['priceMax'];
            $priceMax = intval($priceMaxString);
            $sql = "SELECT * FROM $table_name WHERE price BETWEEN $priceMin AND $priceMax LIMIT 12 OFFSET $page";
        }
    } else {
        $sql = "SELECT * FROM $table_name LIMIT 12 OFFSET $page";
    }
    $result = $conn->query($sql);

    // Convert data to JSON format
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                if (is_string($value)) {
                    $row[$key] = rtrim($value);
                }
            }
            $data[] = $row;
        }
    }
    echo json_encode($data);

    $conn->close();
?>
