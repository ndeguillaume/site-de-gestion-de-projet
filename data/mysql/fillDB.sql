USE CDP;

INSERT INTO project (title, last_modified) VALUES("projet 1", NOW());
INSERT INTO project (title, last_modified) VALUES("projet 2", NOW());

INSERT INTO sprint (project_id, title)
VALUES("1","sprint 1");
INSERT INTO sprint (project_id, title) VALUES("1","sprint 2");

INSERT INTO issue (project_id, order_in_sprint, title) VALUES("1", 1, "issue 1");

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