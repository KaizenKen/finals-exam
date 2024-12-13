CREATE TABLE users(
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(255),
  user_password VARCHAR(255),
  first_name VARCHAR(255),
  last_name VARCHAR(255),
  user_role VARCHAR(255),
	date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE job_posts(
  post_id INT AUTO_INCREMENT PRIMARY KEY,
  post_title VARCHAR(255),
  post_description VARCHAR(255),
  posted_by INT,
  date_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE job_applications(
  app_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  job_post_id INT,
  app_desc VARCHAR(255),
  date_applied TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  app_status VARCHAR(255)
);

INSERT INTO users(user_name, user_password, first_name, last_name, user_role)
VALUES('rain', '123', 'Rainiel Drei', 'Lendio', 'HR');

INSERT INTO users(user_name, user_password, first_name, last_name, user_role)
VALUES('kirk', '123', 'Kirk Mojeiv', 'Teves', 'Applicant');

INSERT INTO users(user_name, user_password, first_name, last_name, user_role)
VALUES('john', '123', 'John', 'Doe', 'Applicant');
