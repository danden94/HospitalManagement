CREATE TRIGGER UpdateAppointmentStatus
ON Appointments
AFTER INSERT, UPDATE
AS
BEGIN
    UPDATE Appointments
    SET Status = 'Đã khám'
    WHERE AppointmentDate < GETDATE() AND Status = 'Chờ';
END;
GO
