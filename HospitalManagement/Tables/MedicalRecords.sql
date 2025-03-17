CREATE TABLE MedicalRecords (
    RecordID INT IDENTITY(1,1) PRIMARY KEY,
    PatientID INT NOT NULL,
    DoctorID INT NOT NULL,
    Diagnosis NVARCHAR(500) NOT NULL,
    TreatmentPlan NVARCHAR(500) NULL,
    DateCreated DATETIME DEFAULT GETDATE(),
    CONSTRAINT FK_MedicalRecords_Patients FOREIGN KEY (PatientID) REFERENCES Patients(PatientID),
    CONSTRAINT FK_MedicalRecords_Doctors FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID)
);
