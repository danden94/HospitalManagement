USE HospitalManagement;
GO

CREATE TABLE Doctors (
    DoctorID INT PRIMARY KEY IDENTITY(1,1),
    FullName NVARCHAR(100) NOT NULL,
    Specialty NVARCHAR(100) NOT NULL
);
GO