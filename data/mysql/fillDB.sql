USE CDP;

INSERT INTO project (title, last_modified) VALUES("projet 1", NOW());
INSERT INTO project (title, last_modified) VALUES("projet 2", NOW());

INSERT INTO sprint (project_id, title)
VALUES("1","sprint 1");
INSERT INTO sprint (project_id, title) VALUES("1","sprint 2");
INSERT INTO sprint (project_id, title, begin_date, end_date) 
VALUES("1","sprint 3", ADDDATE(NOW(), INTERVAL -10 DAY), ADDDATE(NOW(), INTERVAL -1 DAY));

INSERT INTO issue (project_id, title) VALUES("1","issue 1");

INSERT INTO issue (project_id, sprint_id, title, description, priority, cost) 
VALUES("1", "1", "issue 2", "[EN COURS] decription de l'issue 2", "low", 1);
INSERT INTO issue (project_id, sprint_id, title, description, priority, cost) 
VALUES("1", "1", "issue 3", "[EN COURS] decription de l'issue 3", "medium", 2);
INSERT INTO issue (project_id, sprint_id, title, description, priority, cost) 
VALUES("1", "1", "issue 4", "[EN COURS] decription de l'issue 4", "high", 3);

INSERT INTO issue (project_id, sprint_id, title, description, priority, cost) 
VALUES("1", "2", "issue 5", "[EN ATTENTE] decription de l'issue 5", "low", 1);

INSERT INTO issue (project_id, sprint_id, title, description, priority, cost) 
VALUES("1", "3", "issue 6", "[TERMINEE] decription de l'issue 6", "low", 1);
INSERT INTO issue (project_id, sprint_id, title, description, priority, cost) 
VALUES("1", "3", "issue 7", "[TERMINEE] decription de l'issue 7", "medium", 1);
INSERT INTO issue (project_id, sprint_id, title, description, priority, cost) 
VALUES("1", "3", "issue 8", "[TERMINEE] decription de l'issue 8", "high", 1);

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