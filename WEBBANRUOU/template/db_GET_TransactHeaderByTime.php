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

    $table_name = 'transactheader';
    $TimePaymentStart  = $_GET['Start'];
    $TimePaymentEnd  = $_GET['End'];

    // Prepare statement
    $stmt = $conn->prepare("SELECT * FROM $table_name WHERE TimePayment BETWEEN '$TimePaymentStart' AND '$TimePaymentEnd';");

    // Execute statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Convert result to array
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Generate JSON output
    echo json_encode($rows);

    $stmt->close();
    $conn->close();
?>