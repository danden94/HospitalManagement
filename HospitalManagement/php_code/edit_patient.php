<?php
header('Content-Type: text/html; charset=UTF-8');
include 'connect.php';

$patientID = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $gender = $_POST['gender'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];

    // Kiểm tra và chuyển đổi định dạng ngày tháng
    $dateOfBirth = DateTime::createFromFormat('Y-m-d', $dateOfBirth);
    if ($dateOfBirth === false) {
        die("Invalid date format. Please use YYYY-MM-DD.");
    }
    $dateOfBirth = $dateOfBirth->format('Y-m-d');

    // Chuẩn bị truy vấn SQL
    $sql = "UPDATE Patients 
            SET FullName = ?, Gender = ?, DateOfBirth = ?, PhoneNumber = ?, Address = ?
            WHERE PatientID = ?";
    $params = array($fullName, $gender, $dateOfBirth, $phoneNumber, $address, $patientID);

    // Thực thi truy vấn
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Patient updated successfully!";
    }
}

// Lấy thông tin bệnh nhân hiện tại
if ($patientID) {
    $sql = "SELECT * FROM Patients WHERE PatientID = ?";
    $params = array($patientID);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $patient = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    // Chuyển đổi định dạng ngày tháng
    if ($patient && isset($patient['DateOfBirth'])) {
        $patient['DateOfBirth'] = $patient['DateOfBirth']->format('Y-m-d');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Patient</title>
</head>
<body>
    <h1>Edit Patient</h1>
    <?php if ($patient): ?>
        <form method="post">
            Full Name: <input type="text" name="fullName" value="<?php echo $patient['FullName']; ?>" required><br>
            Gender: <input type="text" name="gender" value="<?php echo $patient['Gender']; ?>" required><br>
            Date of Birth: <input type="date" name="dateOfBirth" value="<?php echo $patient['DateOfBirth']; ?>" required><br>
            Phone Number: <input type="text" name="phoneNumber" value="<?php echo $patient['PhoneNumber']; ?>" required><br>
            Address: <input type="text" name="address" value="<?php echo $patient['Address']; ?>" required><br>
            <input type="submit" value="Update Patient">
        </form>
    <?php else: ?>
        <p>Patient not found.</p>
    <?php endif; ?>
    <br>
    <a href="indexx.php">Back to Home</a>
</body>
</html>