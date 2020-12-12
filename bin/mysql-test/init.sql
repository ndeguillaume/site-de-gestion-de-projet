CREATE DATABASE CDP_TEST;
USE CDP_TEST;

CREATE TABLE project (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title CHAR(255) NOT NULL,
    last_modified DATETIME(1) NOT NULL
);

CREATE TABLE sprint (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT,
    title CHAR(255) NOT NULL,
    begin_date DATETIME(1),
    end_date DATETIME(1),
    PRIMARY KEY (project_id, id),
    CHECK (begin_date < end_date)
) ENGINE=MyISAM;

CREATE TABLE issue (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT,
    sprint_id INT(6) UNSIGNED,
    title CHAR(255) NOT NULL,
    order_in_sprint INT(6) NOT NULL,
    description VARCHAR(1000),
    priority ENUM("lowest", "low", "medium", "high", "highest"),
    cost INT(6) UNSIGNED,
    FOREIGN KEY (sprint_id) REFERENCES sprint(id),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;


CREATE TABLE task ( 
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT,
    title CHAR(255) NOT NULL,
    description VARCHAR(1000),
    dod VARCHAR(1000),
    duration INT(6) UNSIGNED, 
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;
 
CREATE TABLE task_issues_dependency (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT,
    fk_task_id INT(6) UNSIGNED NOT NULL,
    fk_issue_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (fk_task_id) REFERENCES task(id),
    FOREIGN KEY (fk_issue_id) REFERENCES issue(id),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

CREATE TABLE task_todo ( 
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    fk_task_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (fk_task_id) REFERENCES task(id),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM; 

CREATE TABLE task_inprogress ( 
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    fk_task_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (fk_task_id) REFERENCES task(id),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM; 

CREATE TABLE task_done ( 
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    fk_task_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (fk_task_id) REFERENCES task(id),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM; 

CREATE TABLE task_dependency ( 
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    child_task_id INT(6) UNSIGNED NOT NULL,
    parent_task_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (child_task_id) REFERENCES task(id),
    FOREIGN KEY (parent_task_id) REFERENCES task(id),
    constraint not_equal check(child_task_id <> parent_task_id),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

CREATE TABLE test_scenario ( 
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    title CHAR(255) NOT NULL,
    description VARCHAR(1000),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

CREATE TABLE test (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    title CHAR(255) NOT NULL,
    fk_task_id INT(6) UNSIGNED,
    fk_issue_id INT(6) UNSIGNED, 
    fk_test_scenario_id INT(6) UNSIGNED NOT NULL,
    last_test_res ENUM("true", "false"),
    FOREIGN KEY (fk_test_scenario_id) REFERENCES test_scenario(id),
    FOREIGN KEY (fk_task_id) REFERENCES task(id),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

CREATE TABLE test_history (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    date DATETIME(1) NOT NULL,
    fk_test_id INT(6) UNSIGNED NOT NULL,
    res ENUM("true", "false"),
    FOREIGN KEY (fk_test_id) REFERENCES test(id),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

CREATE TABLE user_documentation (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    path CHAR(255) NOT NULL,
    date DATETIME(1) NOT NULL,
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

CREATE TABLE install_documentation (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    path CHAR(255) NOT NULL,
    date DATETIME(1) NOT NULL,
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;