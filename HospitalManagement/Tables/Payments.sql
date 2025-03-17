CREATE TABLE Payments (
    PaymentID INT IDENTITY(1,1) PRIMARY KEY,
    PatientID INT NOT NULL,
    Amount DECIMAL(10,2) NOT NULL CHECK (Amount > 0),
    PaymentDate DATETIME DEFAULT GETDATE(),
    PaymentMethod NVARCHAR(50) NOT NULL CHECK (PaymentMethod IN ('Tiền mặt', 'Thẻ tín dụng', 'Chuyển khoản')),
    CONSTRAINT FK_Payments_Patients FOREIGN KEY (PatientID) REFERENCES Patients(PatientID)
);
