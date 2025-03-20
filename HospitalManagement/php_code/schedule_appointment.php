<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientID = $_POST['patientID'];
    $doctorID = $_POST['doctorID'];
    $appointmentDate = $_POST['appointmentDate'];
    $status = "Scheduled";

    // Kiểm tra và chuyển đổi định dạng ngày tháng
    $appointmentDate = DateTime::createFromFormat('Y-m-d\TH:i', $appointmentDate);
    if ($appointmentDate === false) {
        die("Invalid date format. Please use YYYY-MM-DDTHH:MI.");
    }
    $appointmentDate = $appointmentDate->format('Y-m-d H:i:s'); // Định dạng đúng cho SQL Server

    $sql = "INSERT INTO Appointments (PatientID, DoctorID, AppointmentDate, Status)
            VALUES (?, ?, ?, ?)";
    $params = array($patientID, $doctorID, $appointmentDate, $status);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Appointment scheduled successfully!";
    }
}

// Lấy danh sách bệnh nhân và bác sĩ
$patients = sqlsrv_query($conn, "SELECT * FROM Patients");
$doctors = sqlsrv_query($conn, "SELECT * FROM Doctors");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Appointment</title>
</head>
<body>
    <h1>Schedule Appointment</h1>
    <form method="post">
        Patient: 
        <select name="patientID" required>
            <?php while ($patient = sqlsrv_fetch_array($patients, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?php echo $patient['PatientID']; ?>">
                    <?php echo $patient['FullName']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        Doctor: 
        <select name="doctorID" required>
            <?php while ($doctor = sqlsrv_fetch_array($doctors, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?php echo $doctor['DoctorID']; ?>">
                    <?php echo $doctor['FullName']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        Appointment Date: <input type="datetime-local" name="appointmentDate" required><br>
        <input type="submit" value="Schedule Appointment">
    </form>
    <br>
    <a href="indexx.php">Back to Home</a>
</body>
</html>