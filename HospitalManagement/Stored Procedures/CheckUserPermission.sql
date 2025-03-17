CREATE PROCEDURE CheckUserPermission
    @Username NVARCHAR(50),
    @RequiredRole NVARCHAR(50)
AS
BEGIN
    DECLARE @UserRole NVARCHAR(50);

    SELECT @UserRole = R.RoleName
    FROM Users U
    JOIN Roles R ON U.RoleID = R.RoleID
    WHERE U.Username = @Username;

    IF @UserRole = @RequiredRole
        PRINT 'Access granted.';
    ELSE
        PRINT 'Access denied.';
END;
GO
