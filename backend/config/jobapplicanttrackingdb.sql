USE JOBAPPLICANTTRACKINGDB;

-- CREATE TABLE JOBADVERTISER(
--     Email varchar(50) PRIMARY KEY,
--     FullName varchar(50),
--     Role varchar(20),
--     Password varchar(20),
--     ContactNo varchar(11)
-- );

-- CREATE TABLE CANDIDATE(
--     Email varchar(50) PRIMARY KEY,
--     FullName varchar(50),
--     Role varchar(20),
--     Password varchar(20),
--     ContactNo varchar(11)
-- );

-- CREATE TABLE JOBS(
--     JobId INT AUTO_INCREMENT PRIMARY KEY,
--     JobTitle varchar(100) not null,
--     dateposted DATETIME NOT NULL,
--     company varchar(50) not null,
--     salary int not null,
--     position varchar(50) not null,
--     postedBy varchar(50),
--     FOREIGN KEY (postedBy) REFERENCES JOBADVERTISER(Email)
-- );

-- CREATE TABLE APPLY(
--     applyId int AUTO_INCREMENT PRIMARY KEY,
--     JobId INT,
--     CandidateEmail varchar(50),
--     Status varchar(20) not null default 'pending',
--     applicationDate DATETIME not null,
--     CvLink varchar(100) not null,
--     FOREIGN KEY (JobId) REFERENCES JOBS(JobId),
--     FOREIGN KEY (CandidateEmail) REFERENCES CANDIDATE(Email)
-- );



-- INSERT INTO JOBADVERTISER (Email, FullName, Role, Password, ContactNo)
-- VALUES
--     ('jobadvertiser1@example.com', 'Job Advertiser 1', 'JobAdvertiser', 'password1', '1234567890'),
--     ('jobadvertiser2@example.com', 'Job Advertiser 2', 'JobAdvertiser', 'password2', '9876543210');

-- INSERT INTO CANDIDATE (Email, FullName, Role, Password, ContactNo)
-- VALUES
--     ('candidate1@example.com', 'Candidate 1', 'Candidate', 'password1', '1234567890'),
--     ('candidate2@example.com', 'Candidate 2', 'Candidate', 'password2', '9876543210');

-- INSERT INTO JOBS (JobTitle, dateposted, company, salary, position, postedBy)
-- VALUES
--     ('Software Engineer', '2023-01-01 12:00:00', 'ABC Tech', 80000, 'Senior Developer', 'jobadvertiser1@example.com'),
--     ('Marketing Specialist', '2023-01-02 10:30:00', 'XYZ Corp', 60000, 'Marketing Manager', 'jobadvertiser2@example.com');

-- INSERT INTO APPLY (JobId, CandidateEmail, Status, applicationDate, CvLink)
-- VALUES
--     (1, 'candidate1@example.com', 'pending', '2023-01-01 15:30:00', 'cv_link_candidate1'),
--     (2, 'candidate2@example.com', 'approved', '2023-01-02 11:45:00', 'cv_link_candidate2');


SELECT * FROM JOBADVERTISER;

SELECT * FROM CANDIDATE;

SELECT * FROM JOBS;

SELECT * FROM APPLY;

