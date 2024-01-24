USE JOBAPPLICANTTRACKINGDB;

CREATE TABLE JOBADVERTISER(
    Email varchar(50) PRIMARY KEY,
    FullName varchar(50),
    Role varchar(20),
    Password varchar(20),
    ContactNo varchar(11)
);

CREATE TABLE CANDIDATE(
    candidateId INT AUTO_INCREMENT PRIMARY KEY,
    Email varchar(50) unique,
    FullName varchar(50),
    Role varchar(20),
    Password varchar(20),
    ContactNo varchar(11)
);

CREATE TABLE JOBS(
    JobId INT AUTO_INCREMENT PRIMARY KEY,
    JobTitle varchar(100) not null,
    dateposted DATETIME NOT NULL,
    company varchar(50) not null,
    salary int not null,
    position varchar(50) not null,
    postedBy varchar(50),
    jobStatus varchar(20),
    jobDetail varchar(255),
    FOREIGN KEY (postedBy) REFERENCES JOBADVERTISER(Email)
);

CREATE TABLE APPLY(
    applyId int AUTO_INCREMENT PRIMARY KEY,
    JobId INT,
    candidateId int,
    Status varchar(20) not null default 'pending',
    applicationDate DATETIME not null,
    CvLink varchar(100) not null,
    FOREIGN KEY (JobId) REFERENCES JOBS(JobId),
    FOREIGN KEY (candidateId) REFERENCES CANDIDATE(candidateId)
);



