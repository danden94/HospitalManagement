CREATE PROCEDURE GetPatientAppointments
    @PatientID INT
AS
BEGIN
    SELECT 
        A.AppointmentID,
        D.FullName AS DoctorName,
        A.AppointmentDate,
        A.Status
    FROM Appointments A
    JOIN Doctors D ON A.DoctorID = D.DoctorID
    WHERE A.PatientID = @PatientID;
END;
GO
