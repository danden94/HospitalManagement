<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $gender = $_POST['gender'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];

    $sql = "INSERT INTO Patients (FullName, Gender, DateOfBirth, PhoneNumber, Address)
            VALUES (?, ?, ?, ?, ?)";
    $params = array($fullName, $gender, $dateOfBirth, $phoneNumber, $address);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "New patient added successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Patient</title>
</head>
<body>
    <h1>Add New Patient</h1>
    <form method="post">
        Full Name: <input type="text" name="fullName" required><br>
        Gender: <input type="text" name="gender" required><br>
        Date of Birth: <input type="date" name="dateOfBirth" required><br>
        Phone Number: <input type="text" name="phoneNumber" required><br>
        Address: <input type="text" name="address" required><br>
        <input type="submit" value="Add Patient">
    </form>
    <br>
    <a href="indexx.php">Back to Home</a>
</body>
</html>