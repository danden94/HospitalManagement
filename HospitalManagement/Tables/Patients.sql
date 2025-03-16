USE HospitalManagement;
GO

CREATE TABLE Patients (
    PatientID INT PRIMARY KEY IDENTITY(1,1),
    FullName NVARCHAR(100) NOT NULL,
    Gender NVARCHAR(10) NOT NULL,
    DateOfBirth DATE NOT NULL,
    PhoneNumber NVARCHAR(15),
    Address NVARCHAR(200)
);
GO