CREATE PROCEDURE AddPatient
    @FullName NVARCHAR(100),
    @Gender NVARCHAR(10),
    @DateOfBirth DATE,
    @PhoneNumber NVARCHAR(15),
    @Address NVARCHAR(200)
AS
BEGIN
    INSERT INTO Patients (FullName, Gender, DateOfBirth, PhoneNumber, Address)
    VALUES (@FullName, @Gender, @DateOfBirth, @PhoneNumber, @Address);
END;
GO