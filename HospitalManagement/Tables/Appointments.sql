CREATE TABLE Appointments (
    AppointmentID INT PRIMARY KEY IDENTITY(1,1),
    PatientID INT NOT NULL,
    DoctorID INT NOT NULL,
	AppointmentDate DATETIME NOT NULL CHECK (AppointmentDate >= GETDATE()),
	Status NVARCHAR(50) NOT NULL CHECK (Status IN ('Chờ', 'Đã khám', 'Huỷ')),
	CONSTRAINT FK_Appointments_Patients FOREIGN KEY (PatientID) REFERENCES Patients(PatientID),
	CONSTRAINT FK_Appointments_Doctors FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID)
);