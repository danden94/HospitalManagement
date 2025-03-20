<?php
header('Content-Type: text/html; charset=UTF-8');
include 'connect.php';

$doctorID = isset($_GET['id']) ? $_GET['id'] : null;

if ($doctorID) {
    // Xóa các lịch hẹn liên quan đến bác sĩ
    $sqlDeleteAppointments = "DELETE FROM Appointments WHERE DoctorID = ?";
    $paramsDeleteAppointments = array($doctorID);
    $stmtDeleteAppointments = sqlsrv_query($conn, $sqlDeleteAppointments, $paramsDeleteAppointments);

    if ($stmtDeleteAppointments === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Xóa các hồ sơ bệnh án liên quan đến bác sĩ
    $sqlDeleteMedicalRecords = "DELETE FROM MedicalRecords WHERE DoctorID = ?";
    $paramsDeleteMedicalRecords = array($doctorID);
    $stmtDeleteMedicalRecords = sqlsrv_query($conn, $sqlDeleteMedicalRecords, $paramsDeleteMedicalRecords);

    if ($stmtDeleteMedicalRecords === false) {
        die(print_r(sqlsrv_errors(), true));
    }
     // Xóa bác sĩ
     $sqlDeleteDoctor = "DELETE FROM Doctors WHERE DoctorID = ?";
     $paramsDeleteDoctor = array($doctorID);
     $stmtDeleteDoctor = sqlsrv_query($conn, $sqlDeleteDoctor, $paramsDeleteDoctor);
 
     if ($stmtDeleteDoctor === false) {
         die(print_r(sqlsrv_errors(), true));
     } else {
         echo "Doctor and related appointments deleted successfully!";
     }
} else {
    echo "Invalid doctor ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Doctor</title>
</head>
<body>
    <br>
    <a href="indexx.php">Back to Home</a>
</body>
</html>