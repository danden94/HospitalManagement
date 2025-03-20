<?php
include 'connect.php';

//lấy danh sách bệnh nhân
$sql = "SELECT * FROM Patients";
$stmtPatients = sqlsrv_query($conn, $sql);

if ($stmtPatients === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Lấy danh sách bác sĩ
$sqlDoctors = "SELECT * FROM Doctors";
$stmtDoctors = sqlsrv_query($conn, $sqlDoctors);

if ($stmtDoctors === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Lấy danh sách lịch hẹn
$sqlAppointments = "SELECT Appointments.AppointmentID, Patients.FullName AS PatientName, 
                           Doctors.FullName AS DoctorName, Appointments.AppointmentDate, 
                           Appointments.Status
                    FROM Appointments
                    INNER JOIN Patients ON Appointments.PatientID = Patients.PatientID
                    INNER JOIN Doctors ON Appointments.DoctorID = Doctors.DoctorID";
$stmtAppointments = sqlsrv_query($conn, $sqlAppointments);

if ($stmtAppointments === false) {
    die(print_r(sqlsrv_errors(), true));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Management System</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Hospital Management System</h1>

    <!-- Bảng Patients -->
    <h2>Patients</h2>
    <table>
        <tr>
            <th>Patient ID</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = sqlsrv_fetch_array($stmtPatients, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['PatientID']; ?></td>
                <td><?php echo $row['FullName']; ?></td>
                <td><?php echo $row['Gender']; ?></td>
                <td><?php echo $row['DateOfBirth']->format('Y-m-d'); ?></td>
                <td><?php echo $row['PhoneNumber']; ?></td>
                <td><?php echo $row['Address']; ?></td>
                <td>
                    <a href="edit_patient.php?id=<?php echo $row['PatientID']; ?>">Edit</a> |
                    <a href="delete_patient.php?id=<?php echo $row['PatientID']; ?>" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Bảng Doctors -->
    <h2>Doctors</h2>
    <table>
        <tr>
            <th>Doctor ID</th>
            <th>Full Name</th>
            <th>Specialty</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = sqlsrv_fetch_array($stmtDoctors, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['DoctorID']; ?></td>
                <td><?php echo $row['FullName']; ?></td>
                <td><?php echo $row['Specialty']; ?></td>
                <td>
                    <a href="delete_doctor.php?id=<?php echo $row['DoctorID']; ?>" onclick="return confirm('Are you sure you want to delete this doctor?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Bảng Appointments -->
    <h2>Appointments</h2>
    <table>
        <tr>
            <th>Appointment ID</th>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Appointment Date</th>
            <th>Status</th>
        </tr>
        <?php while ($row = sqlsrv_fetch_array($stmtAppointments, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['AppointmentID']; ?></td>
                <td><?php echo $row['PatientName']; ?></td>
                <td><?php echo $row['DoctorName']; ?></td>
                <td><?php echo $row['AppointmentDate']->format('Y-m-d H:i:s'); ?></td>
                <td><?php echo $row['Status']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="add_patient.php">Add New Patient</a> |
    <a href="add_doctor.php">Add New Doctor</a> |
    <a href="schedule_appointment.php">Schedule Appointment</a>
</body>
</html>