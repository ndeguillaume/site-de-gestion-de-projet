CREATE DATABASE CDP;
USE CDP;

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

INSERT INTO project (title, last_modified) VALUES("projet 1", NOW());
INSERT INTO project (title, last_modified) VALUES("projet 2", NOW());

INSERT INTO sprint (project_id, title)
VALUES("1","sprint 1");
INSERT INTO sprint (project_id, title) VALUES("1","sprint 2");

INSERT INTO issue (project_id, order_in_sprint, title) VALUES("1", 1, "issue 1");

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) 
VALUES("1", "1", 1, "issue 2", "[EN COURS] description de l'issue 2", "low", 1);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) 
VALUES("1", "1", 2, "issue 3", "[EN COURS] description de l'issue 3", "medium", 2);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) 
VALUES("1", "1", 3, "issue 4", "[EN COURS] description de l'issue 4", "high", 3);

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) 
VALUES("1", "2", 1, "issue 5", "[EN ATTENTE] description de l'issue 5", "low", 1);

INSERT INTO task (project_id, title, description, dod, duration) 
VALUES("1", "task 1", "description de la tache 1", "dod de la tache 1", 1);
INSERT INTO task (project_id, title, description, dod, duration) 
VALUES("1", "task 2", "description de la tache 2", "dod de la tache 2", 1);
INSERT INTO task (project_id, title, description, dod, duration) 
VALUES("1", "task 3", "description de la tache 3", "dod de la tache 3", 1);

INSERT INTO task (project_id, title, description, dod, duration) 
VALUES("1", "task 4", "description de la tache 4", "dod de la tache 4", 1);
INSERT INTO task (project_id, title, description, dod, duration) 
VALUES("1", "task 5", "description de la tache 5", "dod de la tache 5", 1);

INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
VALUES(1, 1, 2);
INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
VALUES(1, 2, 2);

INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
VALUES(1, 2, 3);

INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
VALUES(1, 3, 4);
INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
VALUES(1, 3, 5);

INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
VALUES(1, 4, 5);
INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
VALUES(1, 5, 5);

INSERT INTO task_dependency (project_id, child_task_id, parent_task_id)
VALUES(1, 3, 1);
INSERT INTO task_dependency (project_id, child_task_id, parent_task_id)
VALUES(1, 3, 2);

