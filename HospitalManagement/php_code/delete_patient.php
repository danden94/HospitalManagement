<?php
header('Content-Type: text/html; charset=UTF-8');
include 'connect.php';

$patientID = isset($_GET['id']) ? $_GET['id'] : null;

if ($patientID) {
    // Chuẩn bị truy vấn SQL
    $sql = "DELETE FROM Patients WHERE PatientID = ?";
    $params = array($patientID);

    // Thực thi truy vấn
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Patient deleted successfully!";
    }
} else {
    echo "Invalid patient ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Patient</title>
</head>
<body>
    <br>
    <a href="indexx.php">Back to Home</a>
</body>
</html>