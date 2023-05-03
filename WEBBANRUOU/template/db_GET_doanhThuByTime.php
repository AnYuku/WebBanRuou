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
    $stmt = $conn->prepare("SELECT SUM(Total) AS SumTotal FROM $table_name WHERE TimePayment >= ? AND TimePayment <= ?");
    $stmt->bind_param("ss", $TimePaymentStart, $TimePaymentEnd);
    // Execute statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch sum value from result set
    $row = $result->fetch_assoc();
    $sumTotal = $row['SumTotal'];

    // Generate JSON output
    echo json_encode(['SumTotal' => $sumTotal]);

    $stmt->close();
    $conn->close();
?>