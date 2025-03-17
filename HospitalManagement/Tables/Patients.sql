CREATE TABLE Patients (
    PatientID INT PRIMARY KEY IDENTITY(1,1),
    FullName NVARCHAR(100) NOT NULL,
    Gender NVARCHAR(10) NOT NULL CHECK (Gender IN ('Nam', 'Nữ', 'Khác')),
    DateOfBirth DATE NOT NULL,
    PhoneNumber NVARCHAR(15) UNIQUE NULL,
    Address NVARCHAR(200) NULL
);