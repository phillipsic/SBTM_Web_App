CREATE TABLE logins (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, role_id BIGINT NOT NULL, islocked VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX role_id_idx (role_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE project_category (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, startdate DATE, enddate DATE, completetag VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE role (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sessions (id BIGINT AUTO_INCREMENT, sessionname VARCHAR(255) NOT NULL, charter VARCHAR(255) NOT NULL, areas TEXT NOT NULL, testnotes VARCHAR(255), ready VARCHAR(255) NOT NULL, tester VARCHAR(255), status_id BIGINT NOT NULL, project_id BIGINT NOT NULL, strategy_id BIGINT NOT NULL, todochange_at DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX project_id_idx (project_id), INDEX status_id_idx (status_id), INDEX strategy_id_idx (strategy_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE status (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE strategy (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE logins ADD CONSTRAINT logins_role_id_role_id FOREIGN KEY (role_id) REFERENCES role(id);
ALTER TABLE sessions ADD CONSTRAINT sessions_strategy_id_strategy_id FOREIGN KEY (strategy_id) REFERENCES strategy(id);
ALTER TABLE sessions ADD CONSTRAINT sessions_status_id_status_id FOREIGN KEY (status_id) REFERENCES status(id);
ALTER TABLE sessions ADD CONSTRAINT sessions_project_id_project_category_id FOREIGN KEY (project_id) REFERENCES project_category(id);

CREATE TABLE issues (id BIGINT AUTO_INCREMENT, description VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL,  tester VARCHAR(255), project_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX project_id_idx (project_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE datafiles (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE datafile_issue_link (datafile_id BIGINT NOT NULL, issue_id BIGINT NOT NULL,  PRIMARY KEY(datafile_id,issue_id));
CREATE TABLE session_issue_link (session_id BIGINT NOT NULL, issue_id BIGINT NOT NULL,  PRIMARY KEY(session_id,issue_id));
ALTER TABLE issues ADD CONSTRAINT issues_project_id_project_category_id FOREIGN KEY (project_id) REFERENCES project_category(id);