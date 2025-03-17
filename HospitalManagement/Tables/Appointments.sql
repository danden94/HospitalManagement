USE HospitalManagement;
GO

CREATE TABLE Appointments (
    AppointmentID INT PRIMARY KEY IDENTITY(1,1),
    PatientID INT FOREIGN KEY REFERENCES Patients(PatientID),
    DoctorID INT FOREIGN KEY REFERENCES Doctors(DoctorID),
	AppointmentDate DATETIME NOT NULL,
	Status NVARCHAR(50) NOT NULL
);
GO