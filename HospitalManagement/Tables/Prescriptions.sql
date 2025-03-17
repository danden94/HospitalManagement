CREATE TABLE Prescriptions (
    PrescriptionID INT IDENTITY(1,1) PRIMARY KEY,
    RecordID INT NOT NULL,
    MedicationName NVARCHAR(100) NOT NULL,
    Dosage NVARCHAR(50) NOT NULL,
    Quantity INT NOT NULL CHECK (Quantity > 0),
    Instructions NVARCHAR(500) NULL,
    CONSTRAINT FK_Prescriptions_MedicalRecords FOREIGN KEY (RecordID) REFERENCES MedicalRecords(RecordID)
);
