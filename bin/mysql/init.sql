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
    description VARCHAR(8000),
    priority ENUM("lowest", "low", "medium", "high", "highest"),
    cost INT(6) UNSIGNED,
    FOREIGN KEY (sprint_id) REFERENCES sprint(id),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;


CREATE TABLE task ( 
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT,
    title CHAR(255) NOT NULL,
    description VARCHAR(8000),
    dod VARCHAR(8000),
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
    description VARCHAR(8000),
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
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

CREATE TABLE install_documentation (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    path CHAR(255) NOT NULL,
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

CREATE TABLE install_documentation_history (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    path CHAR(255) NOT NULL,
    date DATETIME(1) NOT NULL,
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

CREATE TABLE user_documentation_history (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    path CHAR(255) NOT NULL,
    date DATETIME(1) NOT NULL,
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

CREATE TABLE release_archive (
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT,
    major INT(6) UNSIGNED NOT NULL,
    minor INT(6) UNSIGNED NOT NULL,
    patch INT(6) UNSIGNED NOT NULL,
    path_release CHAR(255),
    date_release DATETIME(1),
    fk_user_documentation_id INT(6) UNSIGNED NOT NULL,
    fk_install_documentation_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (fk_install_documentation_id) REFERENCES install_documentation_history(id),
    FOREIGN KEY (fk_user_documentation_id) REFERENCES user_documentation_history(id),
    PRIMARY KEY (project_id, id)
 ) ENGINE=MyISAM;

CREATE TABLE release_finished_issues ( 
    project_id INT(6) UNSIGNED NOT NULL,
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    release_id INT(6) UNSIGNED NOT NULL,
    finished_issue_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (release_id) REFERENCES release_archive(id),
    FOREIGN KEY (finished_issue_id) REFERENCES issue(id),
    PRIMARY KEY (project_id, id)
) ENGINE=MyISAM;

INSERT INTO project (title, last_modified) VALUES("projet 1", NOW());

INSERT INTO sprint (project_id, title, begin_date, end_date)
VALUES("1","Sprint 1","2020-11-02 08:00:00.0", "2020-11-13 18:00:00.0");
INSERT INTO sprint (project_id, title, begin_date, end_date)
VALUES("1","Sprint 2","2020-11-16 08:00:00.0", "2020-11-29 18:00:00.0");

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 1, "Barre de navigation","En tant qu’utilisateur, je souhaite avoir accès à une barre de navigation où il y aura les boutons :
pour accéder au backlog
pour accéder à la gestion des gherkins
pour accéder à la liste des tâches
pour accéder à la page des tests
pour accéder à la page des releases
pour accéder à la page des documentations
pour accéder au trello des tâches
pour accéder au sprint actif
ainsi qu'un bouton avec liste déroulante pour accéder à la page regroupant tous les projets, pour créer un nouveau projet et qui affiche les projets récents sur lesquels on peut cliquer", "medium", 1);

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 2, "Accéder la page Backlog", "En tant qu’utilisateur, je souhaite avoir accès à une page “backlog” regroupant toutes les issues décrites par leur identifiant, titre, difficulté, état et coût. Les issues sont soit dans la catégorie backlog soit dans une des catégories sprint. A côté de chaque catégorie il y a écrit le nombre d’issues associées", "high", 3);

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 3, "Ajouter une issue", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “+” présent sous chaque catégorie sur la page “backlog” afin d’ajouter une issue en renseignant son titre. Son identifiant est affecté automatiquement.", "highest", 1);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 4, "Supprimer une issue", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “x” présent à gauche de chaque issue sur la page “backlog” afin de supprimer l’issue. Une fenêtre de validation apparaît alors me demandant de valider mon choix ou d’annuler.", "highest", 1);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 5, "Modifier une issue", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur une issue du backlog ce qui ouvre une fenêtre pré-remplie avec les données de l’issue afin de pouvoir modifier cette issue en renseignant jusqu’à:
un titre dans boîte de texte
une US dans une boîte de texte
une difficulté dans une boîte de texte n’acceptant que les nombres positifs
une priorité à choisir entre la plus haute, haute, moyenne, faible, la plus faible.
Dès qu’un champs est modifié, sa valeur est sauvegardée.", "highest", 5);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 6, "Drag and drop issue", "En tant qu’utilisateur, je souhaite pouvoir effectuer un drag and drop sur la page “backlog” d’une issue dans une catégorie afin de l’affecter à un sprint particulier ou de la remettre dans le backlog. Si je souhaite déplacer une issue depuis ou vers un sprint actif, une fenêtre de confirmation s’affiche. Si j’appuie sur le bouton “Confirmer”, l’issue est déplacée.", "highest", 3);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 7, "Créer un sprint", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “créer un sprint” à côté de la catégorie backlog sur la page “backlog” qui crée une catégorie sprint numérotée automatiquement.", "highest", 1);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 8, "Lancer un sprint", "En tant qu’utilisateur, je souhaite pouvoir lancer le prochain sprint en cliquant sur un bouton qui m’ouvrira une fenêtre permettant de donner la date de début (date et heure) modifiable initialisée à la date actuelle ainsi que la date de fin du sprint. Ce bouton est présent en face du prochain sprint (sprint 1 si aucun n’a été lancé) mais il n’est pas possible de cliquer dessus si un sprint est en cours.", "highest", 2);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 9, "Supprimer un sprint", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “modifier” présent à droite du sprint actif sur la page “backlog” afin de modifier le sprint. Une fenêtre apparaît permettant de modifier la date de début (date et heure) et la date de fin du sprint. Je peux alors valider la modification ou l’annuler.", "lowest", 2);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 11, "Accéder à la page liste des tâches", "En tant qu’utilisateur, je souhaite avoir accès à une page “liste des tâches” regroupant toutes les tâches décrites par leur identifiant, durée, dépendances et US correspondante. Les tâches sont placées soit dans la catégorie “En attente” soit dans une des catégories sprint en fonction de la position de leur US correspondante.", "highest", 3);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 12, "Accéder à une page kanban", "En tant qu’utilisateur, je souhaite avoir accès à une page “trello” qui affiche 3 catégories “à faire”, “en cours” et “terminée” dans lesquelles sont écrites les tâches qui correspondent aux issues du sprint actif. S’il n’y a pas de sprint actif la page affiche un trello vide.", "highest", 3);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 13, "Ajouter une tâche", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “+” présent en haut de la page des tâches afin d’ajouter une tâche en renseignant son titre et en sélectionnant l’User Story qui lui correspond grâce à une liste déroulante. Son identifiant est affecté automatiquement.", "highest", 1);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 14, "Supprimer une tâche", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “x” présent à gauche de chaque tâche sur la page de la liste des tâches afin de supprimer la tâche. Une fenêtre de validation apparaît alors me demandant de valider mon choix ou d’annuler.", "highest", 1);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 1, 15, "Drag and drop tâche active", "En tant qu’utilisateur, je souhaite pouvoir effectuer un drag and drop sur la page “trello” entre les 3 catégories “à faire”, “en cours” et “terminée” afin de modifier l’avancement de la tâche:
si une issue a au moins une tâches qui dépend d’elle dans la catégorie “en cours”, cette issue sera dans cette catégorie sur la page du sprint actif
si une issue toutes les tâches qui dépendent d’elle dans la catégorie “terminée”, cette issue sera dans cette catégorie sur la page du sprint actif
si une issue a toutes les tâches qui dépendent d’elle dans la catégorie “à faire”, cette issue sera dans cette catégorie sur la page du sprint actif", "highest", 5);

-- INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) 
-- VALUES("1", "2", 1, "issue 5", "[EN ATTENTE] description de l'issue 5", "low", 1);

-- INSERT INTO task (project_id, title, description, dod, duration) 
-- VALUES("1", "task 1", "description de la tache 1", "dod de la tache 1", 1);
-- INSERT INTO task (project_id, title, description, dod, duration) 
-- VALUES("1", "task 2", "description de la tache 2", "dod de la tache 2", 1);
-- INSERT INTO task (project_id, title, description, dod, duration) 
-- VALUES("1", "task 3", "description de la tache 3", "dod de la tache 3", 1);

-- INSERT INTO task (project_id, title, description, dod, duration) 
-- VALUES("1", "task 4", "description de la tache 4", "dod de la tache 4", 1);
-- INSERT INTO task (project_id, title, description, dod, duration) 
-- VALUES("1", "task 5", "description de la tache 5", "dod de la tache 5", 1);

-- INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
-- VALUES(1, 1, 2);
-- INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
-- VALUES(1, 2, 2);

-- INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
-- VALUES(1, 2, 3);

-- INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
-- VALUES(1, 3, 4);
-- INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
-- VALUES(1, 3, 5);

-- INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
-- VALUES(1, 4, 5);
-- INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
-- VALUES(1, 5, 5);

-- INSERT INTO task_dependency (project_id, child_task_id, parent_task_id)
-- VALUES(1, 3, 1);
-- INSERT INTO task_dependency (project_id, child_task_id, parent_task_id)
-- VALUES(1, 3, 2);



INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 2, 1, "Terminer un sprint", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “terminer” sur la page “backlog” afin de pouvoir terminer le sprint actif avant que la date de fin ne soit atteinte. Les issues qui sont dans la catégorie “terminées” apparaissent alors barrées sur la page “backlog” et ne sont plus déplaçables et celles qui sont en “cours” ou “à faire” sont réaffectées à la catégorie “backlog”", "highest", 1);

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 2, 2, "Modifier une tâche", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur une tâche de la liste des tâches, ce qui ouvre une fenêtre pré-remplie avec les données de la tâche afin de pouvoir modifier cette tâche qui comporte les champs suivant:
un titre dans boîte de texte
une tâche dans une boîte de texte
une Definition of Done dans une boîte de texte
une durée en heure/homme dans une boîte de texte n’acceptant que les nombres positifs de 1 à 8
une ou plusieurs tâches dont elle dépend dans une liste déroulante des id des tâches (peut être vide). Les tâches sélectionnées auront une marque à côté de leur id dans la liste pour signaler qu’elles le sont. Les id des tâches sélectionnées seront affichés en ligne à droite de la liste déroulante. Cliquer sur une tâches marquée dans la liste ou sur une croix d’une tâche affichée à droite supprimera la dépendance
la ou les User Stories qui lui correspondent dans une liste déroulante des id des issues (ne peut pas être vide). L’ajout ou la suppression de dépendance se fera comme pour les tâches. Cependant, il devra y avoir au moins une User Story de selectionnée pour valider la modification.", "highest", 5);

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 2, 3, "Accéder à la page Scénario", "En tant qu’utilisateur, je souhaite pouvoir avoir accès à une page “liste des tests” qui contient tous les tests de mon projet. Pour chaque test, il y a d’affiché l’identifiant, le titre, le dernier lancement, le résultat et un bouton “API”. En haut de la page je vois le taux de réussite de tous les tests de la liste", "highest", 3);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 2, 4, "Ajouter un scénario de test", "En tant qu’utilisateur, je souhaite pouvoir, depuis la page “scénarios de tests”, appuyer sur un bouton “+” qui ouvre un formulaire contenant un champs texte “scénario”. Lorsque je valide le scénario, ce dernier est ajouté à la liste de scénario.", "highest", 1);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 2, 5, "Modifier un scénario de test", "En tant qu’utilisateur, je souhaite pouvoir, depuis la page “scénarios de tests”, appuyer sur un scénario qui ouvre une fenêtre pré-remplie à droite de l'écran formulaire avec un champs texte pré-rempli avec le scénario correspondant, et qui est modifiable.", "low", 2);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 2, 6, "Accéder à la page Tests", "En tant qu’utilisateur, je souhaite pouvoir avoir accès à une page “liste des tests” qui contient tous les tests de mon projet. Pour chaque test, il y a d’affiché l’identifiant, le titre, le dernier lancement, le résultat et un bouton “API”. En haut de la page je vois le taux de réussite de tous les tests de la liste", "highest", 3);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 2, 7, "Copier une requête pour modifier le résultat d'un test", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “api”, depuis la page la page des tests, afin de récupérer des lignes de code me permettant d'appeler une api qui modifie le résultat d'un test.", "highest", 3);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 2, 8, "Supprimer un test", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “x” présent à gauche de chaque test sur la page “liste des tests” afin de supprimer le test. Une fenêtre de validation apparaît alors me demandant de valider mon choix ou d’annuler.", "high", 2);
INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", 2, 10, "Supprimer un scénario", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “x” présent à gauche de chaque scenario sur la page “liste des scenarios” afin de supprimer le scenario. Une fenêtre de validation apparaît alors me demandant de valider mon choix ou d’annuler. Je ne peux pas supprimer un scenario qui a un test associé.", "high", 3);

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", NULL, 1, "Accéder à la page Sprint actif", "En tant qu’utilisateur, je souhaite avoir accès à une page “sprint actif” qui affiche 3 catégories “à faire”, “en cours” et “terminée” dans lesquelles il y écrit, pour chaque issue du sprint actif, son titre, sa difficulté, sa priorité et son identifiant. S’il n’y a pas de sprint actif, la page l’affiche.”", "highest", 3);

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", NULL, 2, "Cliquer sur une issue de la page Sprint actif", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur une issue de la page “sprint actif” afin d’afficher toutes ses informations dans une fenêtre qui apparaît.", "low", 2);

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", NULL, 3, "Cliquer sur une tâche de la page Kanban","En tant qu’utilisateur, je souhaite pouvoir cliquer sur une tâche de la page “trello” afin d’afficher toutes ses informations dans une fenêtre qui apparaît.", "low", 2);

INSERT INTO issue (project_id, sprint_id, order_in_sprint, title, description, priority, cost) VALUES("1", NULL, 5, "Modifier un sprint", "En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “x” présent à droite de chaque sprint sur la page “backlog” afin de supprimer le sprint. Une fenêtre de validation apparaît alors me demandant de valider mon choix ou d’annuler. Si je valide, les issues qui étaient associées au sprint seront réaffectées à la catégorie backlog.", "medium", 1);

INSERT INTO test_scenario(project_id, title, description) VALUES ("1", "Ajouter une issue", "description");
INSERT INTO test_scenario(project_id, title, description) VALUES ("1", "Lire une issue", "description");
INSERT INTO test_scenario(project_id, title, description) VALUES ("1", "Supprimer une issue", "description");
INSERT INTO test_scenario(project_id, title, description) VALUES ("1", "Modifier une issue", "description");

INSERT INTO test(project_id, title, fk_test_scenario_id, fk_issue_id) VALUES ("1", "Ajouter une issue", 1, 1);
INSERT INTO test(project_id, title, fk_test_scenario_id, fk_issue_id) VALUES ("1", "Lire une issue", 2, 2);
INSERT INTO test(project_id, title, fk_test_scenario_id, fk_issue_id) VALUES ("1", "Supprimer une issue", 3, 3);
INSERT INTO test(project_id, title, fk_test_scenario_id, fk_issue_id) VALUES ("1", "Modifier une issue", 4, 4);