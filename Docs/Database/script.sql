CREATE TABLE Users(
   Id_Users INT,
   surname VARCHAR(50) NOT NULL,
   lastname VARCHAR(50) NOT NULL,
   date_of_birth DATE NOT NULL,
   rule VARCHAR(50) NOT NULL,
   users_status LOGICAL NOT NULL,
   password VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL,
   phone_number VARCHAR(10) NOT NULL,
   PRIMARY KEY(Id_Users)
);

CREATE TABLE Account(
   Id_Account INT,
   balance DECIMAL(10,2) NOT NULL,
   iban VARCHAR(34) NOT NULL,
   account_status LOGICAL NOT NULL,
   Id_Users INT NOT NULL,
   PRIMARY KEY(Id_Account),
   FOREIGN KEY(Id_Users) REFERENCES Users(Id_Users)
);

CREATE TABLE Deposit(
   Id_Deposit INT,
   deposit_amount DECIMAL(10,2) NOT NULL,
   deposit_date DATETIME NOT NULL,
   deposit_status LOGICAL NOT NULL,
   deposit_identity VARCHAR(50) NOT NULL,
   deposit_reason VARCHAR(255) NOT NULL,
   Id_Account INT NOT NULL,
   PRIMARY KEY(Id_Deposit),
   FOREIGN KEY(Id_Account) REFERENCES Account(Id_Account)
);

CREATE TABLE Withdrawal(
   Id_Withdrawal INT,
   withdrawal_amount VARCHAR(50) NOT NULL,
   withdrawl_date DATETIME NOT NULL,
   withdrawl_reason VARCHAR(50) NOT NULL,
   Id_Account INT NOT NULL,
   PRIMARY KEY(Id_Withdrawal),
   FOREIGN KEY(Id_Account) REFERENCES Account(Id_Account)
);

CREATE TABLE Transfert(
   Id_Account_transmitter INT,
   Id_Account_receiver INT,
   transfert_amount DECIMAL(10,2) NOT NULL,
   transfert_date DATETIME NOT NULL,
   transfert_reason VARCHAR(255) NOT NULL,
   PRIMARY KEY(Id_Account_transmitter, Id_Account_receiver),
   FOREIGN KEY(Id_Account_transmitter) REFERENCES Account(Id_Account),
   FOREIGN KEY(Id_Account_receiver) REFERENCES Account(Id_Account)
);
