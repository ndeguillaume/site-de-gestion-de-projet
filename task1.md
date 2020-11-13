# Tâches du 1 : 02/11/20 -> 13/11/20

<table>
    <thead>
        <tr>
            <th colspan="7">TODO</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Description</td>
            <th>Definition of Done</th>
            <th>Durée</th>
            <th>Dépendances</th>
            <th>User Story Correspondante(s)</th>
            <th>Developpeur</th>
        </tr>
    </thead>
   <tbody>
      <!-- ======================================= -->
      <!-- ================ TÂCHES =============== -->
      <!-- ======================================= -->
      <!-- ======================================= -->
      <!-- ================ SPRINT =============== -->
      <!-- ======================================= -->     
   <tr>
         <td>25</td>
         <td>
        Création du fichier <code>SprintActif.php</code> qui crée un <code>new Sprints s</code> et qui récupère dans une variable res <code>activeSprint</code> le résultat de <code>s->getActiveSprint()</code>
     
   * Si <code>res == null</code> alors on affiche au centre de l'écran qu'il n'y a pas de sprint actif.  
     * Sinon 
       * On crée tableau de 3 colonnes: TODO, IN PROGRESS et DONE
       * On crée une <code>new Issues($db) issues</code>. 
       * On crée une <code>new Issue($db) issue</code>. 
       * On crée une <code>new Tasks($db) tasks</code>
       * On crée un <code>new Sprints($db) sprints</code>
       * On récupère dans <code>$activeSprint</code> le retour de <code>sprints->getActiveSprint()</code>
       * On récupère dans <code>$issuesList</code> le retour de <code>issues->getIssuesBySprint($activeSprint[0])</code>
       
       * On récupère dans tasks_in_progress le retour de <code>tasks->getTasksInProgress()</code>
       * Pour chaque task dans tasks_in_progress:
          * On crée une <code>new Task($db) t</code>
          * On récupère dans <code>$task_issues</code> le résultat de <code>t->getRelatedIssues(task[0])</code>
          * Pour chaque ligne dans <code>task_issues $i</code>, si <code>$i</code> est toujours dans <code>issueList</code>, on affiche dans une div dans la colonne "IN PROGRESS" l'identifiant et le titre de l'issue
          * On supprime l'issue <code>$i</code> de <code>issuesList</code>

       * On récupère dans tasks_todo le retour de <code>tasks->getTasksToDo()</code>
       * Pour chaque task dans tasks_todo:
          * On crée une <code>new Task($db) t</code>
          * On récupère dans <code>$task_issues</code> le résultat de <code>t->getRelatedIssues(task[0])</code>
          * Pour chaque ligne dans task_issues <code>$i</code>, si <code>$i</code> est toujours dans <code>issueList</code>, on affiche dans une div dans la colonne "TODO" l'identifiant et le titre de l'issue
          * On supprime l'issue <code>$i</code> de <code>issuesList</code>

       * Pour chaque issue <code>$i</code> restante dans issueList, on affiche dans une div dans la colonne "DONE" l'identifiant et le titre de l'issue
         </td>
         <td>
         
         * Insérer des issues dans la table (de la base de données) issue, des tâches dans la table task et un sprint dans la table sprint.
         * Associer des tâches à différentes issues grâce à la table task_issues_dependency.
         * Mettre chaque tâche dans une des tables task_todo, task_inprogress ou task_done. 
         * Passer le sprint créé précédemment en sprint actif
         * Vérifier que les issues sont bien dans la bonne colonne
      </td>
   <td>2h</td>
   <td>1, 2, 3, 6, 7, 17, 29, 30</td>
   <td>16, 17</td>
   <td></td>
      </tr>
      <!-- ======================================= -->
      <!-- ================ TASKS ================ -->
      <!-- ======================================= -->
      <tr>
      <td>37</td>
      <td>
      Création du fichier <code>KanbanTaskInformation.js</code> qui ajoute un listener sur le clic sur les tâches. Le script fait une requête de méthode GET vers la page <code>GetTask.php</code> dans laquelle il y a l'identifiant de la tâche. La page retourne retourne un JSON. On récupère dans ce dernier le code de réponse de la requête. Si le code est 200 (OK), on affiche les valeurs de <code>title, description, dod, duration, fk_issue_id, fk_parent_id</code> (peut être <code>null</code> ) dans une div au centre de l'écran. L'utilisateur peut appuyer sur une croix en haut à droite de la fenêtre pour fermer celle-ci. Si le code est 405 ou 404 on affiche un <code>toast</code> avec le message d'erreur.
      <td>Cliquer sur une tâche affiche bien une fenêtre contenant tous les champs décrits. Appuyer sur la croix les enlève. On constate qu'une requête <code>GET</code> est bien émise.</td>
      <td>2h</td>
      <td>1, 2, 3, 39</td>
      <td>24</td>
      <td></td>
      </tr>
   <tbody>
</table>
<table>
<thead>
        <tr>
            <th colspan="7">IN PROGRESS</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Description</td>
            <th>Definition of Done</th>
            <th>Durée</th>
            <th>Dépendances</th>
            <th>User Story Correspondante(s)</th>
            <th>Developpeur</th>
        </tr>
    </thead>
    <tbody>
<td>39</td>
<td>
Dockeriser l'application</td>
<td>Effectuer un <code>docker-compose up</code> et que l'application fonctionne en local</td>
<td>6h</td>
<td>Toutes</td>
<td>Toutes</td>
<td>Fabien</code>
   </tr>
      <tr>
         <td>26</td>
         <td>
         Création du fichier <code>EndSprint.js</code> qui ajoute un listener sur le bouton des div <code>end-sprint</code>. Lorsqu'un utilisateur clique sur ce dernier, on fait apparaître une division au centre de l'écran qui contient un message de validation et deux boutons : l'un pour valider la fin du sprint actif et l'autre pour annuler. Si l'utilisateur clique sur "valider", on envoie une requête de méthode DELETE à <code>EndSprint.php</code>. S'il clique sur annuler, on cache la fenêtre. La page retourne un fichier JSON. On récupère dans ce dernier le code de réponse de la requête. Si le code est 200 (OK), on recharge la page. Si le code est 405 ou 404 on affiche un <code>toast</code> avec le message d'erreur.
         </td>
         <td>Cliquer sur <code>end-sprint</code> fait bien apparaître deux boutons dans une division. Cliquer sur celui de validation envoie une requête <code>DELETE</code> vers la page <code>EndSprint.php</code> et cliquer sur celui d'annulation fait disparaître la division et les boutons. Le code de retour est bien 200.</td>
         <td>2h</td>
         <td>1, 27</td>
         <td>15</td>
         <td>Fabien</td>
      </tr>      
      <tr>
         <td>27</td>
         <td>
         Création du fichier <code>EndSprint.php</code> qui vérifie que la méthode utilisée est bien DELETE. Si c'est le cas, on crée une <code>new Tasks</code> t. Puis qui réalise les actions suivantes :

   * récupère les tâches à faire grâce à la méthode <code>t->getTasksToDo()</code> dans une variable <code>$tasks_todo</code> et les tâches en cours avec la méthode <code>t->getTasksInProgress()</code> dans une variable <code>$tasks_inprogress</code>. 
   * pour chaque tâches à faire et en cours récupère les issues qui leur correspondent en itérant sur <code>$tasks_todo</code> et <code>$tasks_inprogress</code> (en créant une <code>new Task task</code> au préalable) en faisant <code>task->getRelatedIssues($tasks_todo[$index][0])</code> que l'on récupère dans une variable <code>$related_issue_id</code>. 
   * met les issues récupérées dans le backlog puisqu'elles ne sont pas terminées, en créant une <code>new Issue issue</code> et appelant la méthode <code>issue->removeFromSprint($related_issue_id)</code>. 
   * appelle la méthode <code>t->endSprint()</code> qui permet de supprimer les tâches qui ont été terminées et de nettoyer les tables <code>task_todo, task_inprogress et task_done</code>. 
   * si les tâches ont bien été supprimées, renvoie un code de succès 200. Si ce n'est pas le cas <code>echo</code> un message d'erreur et on envoie un code 405 (method not allowed).
         <td>La requête reçue est de type <code> DELETE</code> et on y trouve une variable <code>$id</code>. Le code de retour est bien 200. On constate en regardant le backlog que les taches non terminées du sprint sont bien réaffectées dans le backlog.</td>
         <td>2h</td>
         <td>1, 2, 3, 7, 29, 30</td>
         <td>15</td>
         <td>Fabien</td>
      </tr>
         <tr>
         <td>28</td>
         <td>
         Création du fichier <code>TaskList.php</code> qui:

       * Crée un <code>new Sprints($db) sprints</code>
       * On affecte à <code>t</code> le résultat de <code>sprints.getActiveSprint()</code>
       * Pour chaque task dans t 
         * on met le titre et l'identifiant de task dans la div <code>active-sprint</code>
         * Crée une <code>new Tasks($db) tasks</code>
         * On affecte à <code>t</code> les tâches qui sont 'en attente' (qui ne sont pas liées au sprint actif)</code>
         * pour chaque tasks dans t 
            * On affiche une croix <code>delete-task</code> l'id et le titre de la tâche 
      * Ajoute un bouton <code>add-task</code> intitulé "ajouter une tâche"
            Le fichier inclut les fichiers <code>TaskInformation.php</code>,<code>OnTaskClicked.js</code>, <code>CreateTask.js</code>, <code>DeleteTask.js</code>
         </td>
         <td>La page contient toutes les tâches qui sont dans le sprint actif ou dans la catégorie "en attente". A gauche de chaque tâche il y a une croix. En haut de la page, il y a un bouton intitulé "Ajouter une tâche".</td>
         <td>3h</td>
         <td>1, 2, 3, 17, 29, 30</td>
         <td>18</td>
         <td>Nicolas</td>
      </tr>
      <tr>
         <td>38</td>
         <td>
            Création du fichier <code>style.css</code>. 
         </td>
         <td>Observer que les pages respectent bien la charte graphique du site</td>
         <td>2h</td>
         <td>Toutes</td>
         <td>Toutes</td>
         <td>Fabien, Nicolas</td>
      </tr>
      <tr>
         <td>40</td>
         <td>
         Création du fichier <code>OnTaskClicked.js</code> qui ajoute un listener sur le clic de chaque division directement fille (<code>taskX</code>) de <code>task</code>. Lorsqu'un utilisateur clique sur une division <code>taskX</code> le script effectue une requête de méthode GET vers la page php <code>GetTask.php</code> dans laquelle il y a le numéro de la tâche qui retourne un JSON. On récupère dans ce dernier les champs correspondants au title, description, dod, duration et les issues dont dépendent cette tâche. On modifie les valeurs des champs correspondants dans la div <code>task-information</code> et on la rend visible. On ajoute un listener le bouton "modifier" une requête PUT à l'adresse <code>UpdateIssue.php</code> dans laquelle il y a le contenu des inputs dans la div <code>task-information</code>.
         </td>
         <td>Cliquer sur une issue enlève la classe <code>hidden</code> de la div <code>task-information</code>. On observe aussi l'envoi d'une requête <code>PUT</code> à l'adresse <code>UpdateTask.php</code>.</td>
         <td>3h</td>
         <td>1, 2, 3, 39 </td>
         <td>22</td>
         <td>Fabien, Nicolas</td>
      </tr>
   </tbody>
</table>
<table>
      <thead>
        <tr>
            <th colspan="8">DONE</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Description</td>
            <th>Definition of Done</th>
            <th>Durée</th>
            <th>Dépendances</th>
            <th>User Story Correspondante(s)</th>
            <th>Developpeur</th>
            <th>Testeur</th>
        </tr>
      </thead>
   <tbody>
   <tr>
      <td>1</td>
      <td>
      Installer la pile logicielle LAMP avec les lignes de commande:
            
   * <code>sudo apt install apache2 php libapache2-mod-php mysql-server php-mysql</code>
            
   * installer les modules plus courant: <code>sudo apt install php-curl php-gd php-intl php-json php-mbstring php-xml php-zip</code>
      </td>
      <td>Lorsque l'on ouvre la page sur <a href="http://127.0.0.1/">127.0.0.1</a> on lit le message "it works!" ou la page par défaut de apache selon la version installée. On peut effectuer des requêtes SQL dans le terminal avec la commande <code>mysql</code> et on peut lancer la commande <code>php -S localhost:8080 -t .</code> et accéder aux fichiers dans le dossier à l'adresse <a href="localhost:8080">localhost:8080</a></td>
      <td>15m</td>
      <td>Aucune</td>
      <td>Toutes</td>
      <td>Fabien, Nicolas</td>
      <td></td>
   </tr>
   <tr>
      <td>2</td>
      <td>
         Créer un fichier <code>createDB.sql</code> qui crée les tables suivantes:

   * project               (id[Primary Key], name, last_modified)
   * issue                 ((id, project_id)[PK] title, description, priority, cost, fk_sprint_id)
   * sprint                ((id, project_id)[PK], title, begin_date, end_date)
   * task                  ((id, project_id)[PK], title, description, dod, duration)
   * task_issues_dependency ((id, project_id)[PK], fk_task_id, fk_issue_id)
   * task_dependency       ((id, project_id)[PK], fk_child_id, fk_parent_id)
   * task_todo             ((id, project_id)[PK], fk_task_id)
   * task_inprogress       ((id, project_id)[PK], fk_task_id)
   * task_done             ((id, project_id)[PK], fk_task_id)
   * test                  ((id, project_id)[PK], title, last_execution, last_result, is_functionnal, fk_issue_id, fk_test_scenario_id, video_path)
   * test_scenario         ((id, project_id)[PK], content)
   * test_history          ((id, project_id)[PK], fk_test_id, date, result, comment)
   * release               ((id, project_id)[PK], semver_id , archive_path, creation_date)
   * release_issue         ((id, project_id)[PK], fk_release_id, fk_issue_id)
   * documentation         ((id, project_id)[PK], path, fk_release_id)
   * user_documentation    ((id, project_id)[PK], fk_documentation_id)
   * install_documentation ((id, project_id)[PK], fk_documentation_id)
   Tous les id sont en <code>auto_increment</code>.
         </td>
         <td>Executer le script de création de base de données et ne pas avoir de message d'erreur. Eventuellement faire des requêtes sur les tables de la base. </td>
         <td>2h</td>
         <td>1</td>
         <td>Toutes</td>
         <td>Nicolas</td>
      <td></td>
   </tr>   
   <tr>
      <td>3</td>
      <td> Création d'un fichier <code>Connection.php</code> qui permet de se connecter à la base de donnée SQL et qui sera inclus par chaque autre fichier php qui aura besoin d'utiliser la base de données. Il faudra se connecter grâce à la commande 
<pre>try { 
    $bdd = new PDO('mysql:host='.$servername.';dbname='.'dbname'.';charset=utf8', $login, $password);
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
</pre>
   </td>
      <td>Ne pas avoir de message d'erreur à l'utilisation du fichier.</td>
      <td>1h</td>
      <td>1, 2</td>
      <td>Toutes</td>
      <td>Nicolas</td>
      <td></td>
   </tr>
   <tr>
      <td>4</td>
      <td>
            Création du fichier <code>Navbar.php</code> qui va créer une barre de navigation contenant les boutons: 
            
* Backlog pour accèder au backlog
* Scénarios pour accèder à la page de création des gherkins pour les tests
* Tâches pour accèder à la liste des tâches
* Tests pour accèder à la page des tests
* Releases pour accèder à la liste des releases
* Documentation pour accèder à la page des documentations
* Kanban pour accèder à la page de kanban des tâches
* Sprint actif pour accèder à la page des issues du sprint actif
ainsi que les boutons à liste déroulante: 
* Projets pour accéder à la page des projets
      </td>
      <td>Ouvrir la page et observer qu'il y a bien tous les boutons qui redirigent aux bonnes pages.</td>
      <td>30min</td>
      <td>1</td>
      <td>5</td>
      <td>Nicolas</td>
      <td></td>
   </tr>
   <tr>
      <td>6</td>
      <td> Création du fichier <code>Issues.php</code> où on déclare la classe <code>Issues</code> et qui contient un constructeur qui prend la connexion à la base de donnée avec <code>$db</code> en paramètre et qui l'affecte à l'attribut de classe <code>$db</code>. Ce fichier contient aussi les méthodes:  

   * <code>getIssuesBySprint($sprint_id)</code> renvoie le résultat de la requête <code>SELECT id, title, description, difficulty, cost, fk_sprint_id FROM issue WHERE project_id = $_SESSION["project_id"] AND sprint_id = $sprint_id</code>.
   * <code>removeIssuesFromSprint($sprint_id)</code> qui effectue la requête <code>UPDATE issue SET sprint_id = NULL WHERE sprint_id = $sprint_id AND project_id = $_SESSION["project_id"]</code> et qui renvoie <code>true</code> si elle s'est bien effectuée.
      <td>Instancier une <code>new Issues($db)</code>. 
         
      * Lancer <code>getIssuesBySprint($sprint_id)</code> après avoir ajouté un sprint dans la BD et avoir mis à jour l'attribut sprint_id de plusieurs issues puis observer que la fonction a retourné <code>true</code> et que l'attribut issues de la classe est rempli.
      * Lancer <code>getIssuesBySprint($sprint_id)</code> sans avoir ajouté de sprint dans la BD puis observer que la fonction a retourné <code>false</code> et que l'attribut issues de la classe est null.
      * Lancer <code>removeIssuesFromSprint($sprint_id)</code> sans qu'il n'y ait de sprint dans la BD et vérifier que l'on retourne un message d'erreur.
      * Lancer <code>removeIssuesFromSprint($sprint_id)</code> après avoir rajouté un sprint dans la BD et vérifier qu'il est bien supprimé.
         </td>
         <td>1h</td>
         <td>1, 2, 3</td>
         <td>6, 7, 8, 9, 10, 16, 17, 18, 19</td>
         <td>Nicolas</td>
         <td></td>
      </tr>
      <tr>
         <td>7</td>
         <td>
         Création du fichier <code>Issue.php</code> où on déclare la classe Issue qui a les attributs suivants :
         <pre>
      private $db
      public  $id
      public  $title
      public  $description
      public  $cost
      public  $priority
      public  $sprint_id</pre>
         Les méthodes suivantes : 
            
     * Un constructeur qui prend la connexion à la base de donnée avec 
   <code>$db</code> en paramètre et qui l'affecte à l'attribut de classe <code>$db</code>.
     * <code>read($id)</code> : qui met à jour les attributs de l’instance grâce au  résultat de la requête <code>SELECT * FROM issue WHERE ID = $id AND project_id =    $_SESSION["project_id"]</code> et qui renvoie <code>true</code> si elle s'est bien    effectuée
     * <code>create($sprint_id, $title)</code> : qui effectue la requête <code>INSERT INTO issue (project_id, sprint_id, title) VALUES($_SESSION["project_id"], $sprint_id, $title)</code> et qui renvoie <code>true</code> si elle s'est bien effectuée.
     * <code>delete($id)</code> : qui effectue la requête <code>DELETE FROM issue WHERE id =   $id AND project_id = $_SESSION["project_id"]</code> et qui renvoie <code>true</code> si elle s'est bien effectuée.
      * <code>update($id, $title, $description, $cost, $priority, $sprint_id)</code> : qui effectue la requête <code>UPDATE issue SET title = $title, description = $description, cost = $cost, priority = $priority, sprint_id = $sprint_id  WHERE id = $id AND project_id =  $_SESSION["project_id"]</code> et qui renvoie <code>true</code> si elle s'est bien effectuée. 
     * <code>removeFromSprint($id)</code> : qui effectue la   requête <code>UPDATE issue SET sprint_id = NULL WHERE id = $id AND project_id = $_SESSION["project_id"]</code> et qui renvoie <code>true</code> si elle s'est bien effectuée.
     * <code>getRelatedTasks($id)</code> : renvoie le résultat de la requête <code>SELECT fk_task_id FROM task_issues_dependency WHERE fk_issue_id = $id AND project_id = $SESSON["project_id"]</code>
     * <code>updateSprint(updateSprint($project_id, $sprint_id, $id)</code> qui effectue la requête <code>UPDATE issue SET sprint_id = $sprint_id  WHERE id = $id AND project_id =  $project_id</code> et qui renvoie <code>true</code> si elle s'est bien effectuée. 
         </td>
         <td>Instancier une <code>new Issue($db)</code>. 
         
         * Lancer <code>create($sprint_id, $title)</code> et observer que la fonction a retourné <code>true</code>
         * Lancer <code>read($id)</code> et observer que la fonction a retourné <code>true</code> et que les attributs de classe sont remplis 
         * Lancer <code>update($id, $title, $description, $cost, $priority)</code> et observer que la fonction a retourné <code>true</code>
         * Lancer <code>delete($id)</code> et observer que la fonction a retourné <code>true</code>
         * Lancer <code>removeFromSprint($id)</code> et observer que la fonction a retourné <code>true</code>
         * Lancer <code>getRelatedTasks($id)</code> et observer que la fonction a retourné <code>true</code>
         </td>
         <td>1h</td>
         <td>1, 2, 3</td>
         <td>6, 7, 8, 9, 10, 16, 17, 18, 19</td>
         <td>Nicolas</td>
        <td></td>
      </tr>
      <tr>
         <td>17</td>
         <td>
      Création du fichier <code>Sprints.php</code> qui contient un constructeur qui prend la connexion à la base de donnée avec <code>$db</code> en paramètre et qui l'affecte à l'attribut de classe <code>$db</code>. Ce fichier contient aussi la les méthodes:

      * <code>getSprints()</code> : renvoie le résultat de la requête <code>SELECT id, title, begin_date, end_date FROM sprint WHERE project_id = $_SESSION["project_id"]</code>.
      * <code>getActiveSprint()</code> : renvoie le résultat de la requête <code>SELECT * FROM sprint where begin_date > $current_date AND end_date &#60; $current_date</code> où <code>$current_date</code> est la date du jour
      <td>Instancier un <code>Sprints($db)</code>. Lancer <code>getSprints()</code> et observer et que la fonction a renvoyé <code>null</code> ou puis insérer des sprints dans la BD dans le projet actuel et vérifier que cette fois la fonction renvoie bien un tableau a double entrée contenant tous les sprints  que l'on vient de créer. Lancer <code>getActiveSprint()</code> et observer que la fonction a retourné soit <code>null</code> soit un tableau contenant le sprint actif du <code>$project_id</code> dans la BD.
    </td>
         <td>1h</td>
         <td>1, 2, 3</td>
         <td>5, 6, 10, 11, 12, 13, 14, 15, 16, 19</td>
         <td>Nicolas</td>
         <td></td>
      </tr>
      <tr>
         <td>18</td>
         <td>
         Création du fichier <code>Sprint.php</code> où on déclare la classe Sprint qui a les attributs suivants :
<pre>
private $db
public  $id
public  $title
public  $begin_date
public  $end_date
</pre>

   Les méthodes suivantes :  
   * Un constructeur qui prend la connexion à la base de donnée <code>$db</code> en paramètre et qui l'affecte à l'attribut de classe <code>$db</code>.
   * <code>read($id)</code> : qui met à jour les attributs de l'instance grâce le résultat de la requête <code> SELECT * FROM sprint WHERE ID = $id AND project_id = $_SESSION["project_id"]</code> et qui retourne <code>true</code> si la requête s'est bien effectuée. 
   * <code>create($title)</code> : qui effectue la requête <code>INSERT INTO sprint (project_id, title) VALUES($_SESSION["project_id"], $title)</code> et qui renvoie <code>true</code> si elle s'est bien effectuée.
   * <code>delete($id)</code> : qui effectue la requête <code>DELETE FROM sprint WHERE id = $id AND project_id = $_SESSION["project_id"]</code> et qui renvoie <code>true</code> si elle s'est bien effectuée.
   * <code>update($id, $title, $begin_date, $end_date)</code> : qui effectue la requête <code>UPDATE sprint SET title = $title, begin_date = $begin_date, end_date = $end_date WHERE id = $id AND project_id = $_SESSION["project_id"]</code> et qui renvoie <code>true</code> si elle s'est bien effectuée.
   * <code>getLastSprintName()</code>: qui effectue la requête <code>SELECT * FROM sprint ORDER BY ID DESC LIMIT 1 WHERE project_id = $_SESSION["project_id"]</code> et qui renvoie le résultat de cette requête.
   * <code>isFinishedSprint($sprint_id)</code> : renvoie <code>true</code> si le résultat de la requête suivante n'est pas <code>null</code> : <code>SELECT * FROM sprint WHERE id = $sprint_id AND end_date > NOW() AND project_id = $_SESSION["project_id"]</code>
   * <code>startSprint($id, $begin_date, $end_date)</code> : renvoie <code>true</code> si le résultat de la requête suivante n'est pas <code>null</code> : <code>UPDATE sprint SET begin_date=$begin_date, end_date=$end_date WHERE id=$id AND project_id = $_SESSION["project_id"]</code>
         </td>
         <td>Instancier un <code>new Sprint($db)</code>. 
         
      * Lancer <code>create($title)</code> et observer que la fonction a retourné <code>true</code>
      * Lancer <code>read($id)</code> et observer que la fonction a retourné <code>true</code> et que les attributs de classe sont remplis 
      * Lancer <code>update($id, $title, $begin_date, $end_date)</code> et observer que la fonction a retourné <code>true</code>
      * Lancer <code>delete($id)</code> et observer que la fonction a retourné <code>true</code>
      * Lancer <code>getLastSprintName()</code> et observer que la fonction a retourné un tableau s'il y a un dernier sprint ou <code>null</code> sinon.
      * Lancer <code>isFinishedSprint($sprint_id)</code> et observer que la fonction a retourné <code>true</code> ou <code>false</code>
      * Lancer <code>startSprint($id, $begin_date, $end_date)</code> et observer que la fonction a retourné <code>true</code> ou <code>false</code>
         </td>
         <td>1h</td>
         <td>1, 2, 3</td>
         <td>5, 6, 10, 11, 12, 13, 14, 15, 16, 19</td>
         <td>Pierre</td>
         <td></td>
      </tr>
      <tr>
         <td>19</td>
         <td>
         Création du fichier <code>CreateSprint.js</code> qui ajoute un listener sur le clic de la div <code>add-sprint</code>. Lorsqu'un utilisateur clique sur ce dernier, le script fait une requête de méthode POST vers la page <code>CreateSprint.php</code>. La page retourne retourne un JSON. On récupère dans ce dernier le code de réponse de la requête. Si le code est 200 (OK), on ajoute le sprint qui a pour le titre ce qui a été renvoyé avant la div <code>backlog</code>.
         </td>
         <td>Cliquer sur <code>add-sprint</code> crée une requête POST vers la page <code>CreateSprint.php</code>. Le code de réponse est 200.</td>
         <td>2h</td>
         <td>1, 2, 3, 20</td>
         <td>11</td>
         <td>Pierre</td>
      </tr>
      <tr>
         <td>20</td>
         <td>
        Création du fichier <code>CreateSprint.php</code> qui vérifie si la méthode utilisée est bien POST. Si c'est le cas, on crée un <code>new Sprint s</code>. Puis, on utilise <code>s->getLastSprintName()</code> pour récupérer le nom du dernier sprint créé. Ensuite, si le titre du dernier sprint créé finit par un nombre, on l'incrémente de 1, sinon on met 2 à la fin de ce dernier. Enfin, on ajoute le nouveau sprint dans la base avec le titre que l'on vient de créer avec la méthode <code>s->create($id, $title)</code> avant d'<code>echo</code> le résultat en JSON.
         </td>
         <td>La requête reçue est de type PUT. On effectue la requête <code>s->create($id, $title)</code> et on observe que le résultat de cette méthode est <code>true</code>.</td>
         <td>2h</td>
         <td>1, 2, 3</td>
         <td>11</td>
         <td>Pierre</td>
      </tr>
      <tr>
         <td>23</td>
         <td>
        Création du fichier <code>StartSprint.js</code> qui ajoute un listener sur le clic du bouton <code>sprintStart</code>. Lorsqu'un utilisateur clique sur ce dernier, on fait apparaître une division au centre de l'écran qui contient deux <code>input type="datetime-local"</code>: un pour sélectionner la date et l'heure de début et un pour sélectionner la date et l'heure de fin. En bas de la division il y a un bouton <code>Sauvegarder</code>. Lorsque l'on clique sur ce dernier cela ferme la fenêtre et envoie une requête de méthode PUT à <code>StartSprint.php</code>. Il y a aussi un bouton "Annuler" qui ferme la fenêtre.      
         <td>Cliquer sur <code>sprintStart</code> fait apparaître deux <code>input type="datetime-local"</code> ainsi qu'un bouton <code>Sauvegarder</code>. Cliquer sur celui-ci envoie une requête <code>PUT</code> vers la page <code>StartSprint.php</code> avec <code>$begin_date</code> et <code>$end_date</code> dans la requête (récupéré avec les 2 inputs ci-dessus). Le code de retour est bien 200.</td>
         <td>2h</td>
         <td>1, 5, 24</td>
         <td>12</td>
      <td>Pierre, Fabien</td>
      </tr>
      <tr>
      <tr>
      <td>24</td>
        <td>Création du fichier <code>StartSprint.php</code> qui vérifie si la méthode utilisée est bien PUT. Si c'est le cas, on crée un <code>new Sprint s</code>. On lance le sprint en appellant <code>s->startSprint($id, $begin_date, $end_date)</code> (avec $id récupéré dans la requête).
        Ensuite :
        
      * On crée une <code>new Issues($db) issues</code>  
      * On crée une <code>new Issue($db) issue</code>
      * On crée une <code>new Tasks($db) tasks</code>
      * On récupère dans <code>$issuesList</code> le retour de <code>issues->getIssuesBySprint($id)</code> (avec <code>$id</code> récupéré dans la requête).
       * Pour chaque issue <code>$i</code> dans <code>issuesList</code> :
           * On récupère dans une variable tasklist le retour de <code>issue->getRelatedTasks($i[0])</code>
           * Pour chaque task <code>$t</code> dans <code>taskList</code> :
             * On crée une <code>new Task($db) task</code>  
             * On appelle <code>task->setTaskTodo($t[0])</code></td>
         <td>
         La requête reçue est de type <code>PUT</code> et on y trouve une variable <code>$id</code>. Le code de retour est bien 200. On constate en regardant la page du sprint actif que les issues correspondantes au sprint actif sont bien présentes et dans la colonne TODO, et que dans le Kanban, les tâches correspondantes aux issues sont toutes présentes et dans la colonne TODO.
         </td>
         <td>2h</td>
         <td>1, 2, 3, 6, 7, 29, 30</td>
         <td>12</td>
         <td>Pierre, Fabien</td>
      </tr>
      <tr>
         <td>29</td>
         <td>
        Création du fichier <code>Tasks.php</code> où on déclare la classe Tasks qui a un attribut taks qui est un tableau à double entrée. qui contient un constructeur qui prend la connexion à la base de donnée avec <code>$db</code> en paramètre et qui l'affecte à l'attribut de classe <code>$db</code>. Ce fichier contient aussi la les méthodes:

      * <code>getTasks()</code> : renvoie le résultat de la requête <code>SELECT * FROM task WHERE project_id = $_SESSION["project_id"]</code>.
      * <code>getTasksToDo()</code> : renvoie le résultat de la requête <code>SELECT * FROM task t INNER JOIN task_todo t_td ON t.id = t_td.fk_task_id AND t.project_id = t_td.project_id WHERE t.project_id=.$_SESSION["project_id"]</code> 
      * <code>getTasksInProgress()</code> : renvoie le résultat de la requête <code>SELECT * FROM task t INNER JOIN task_inprogress t_ip ON t.id = t_ip.fk_task_id AND t.project_id = t_ip.project_id WHERE t.project_id=.$_SESSION["project_id"]</code> 
      * <code>getTasksDone()</code> : renvoie le résultat de la requête <code>SELECT * FROM task t INNER JOIN task_done t_d ON t.id = t_d.fk_task_id AND t.project_id = t_d.project_id WHERE t.project_id=.$_SESSION["project_id"]</code> 

      * <code>endSprint()</code> : effectue les requêtes
         * <code>DELETE t_d FROM `task_dependency` AS t_d INNER JOIN `task_done` AS t ON t_d.fk_parent_id = t.fk_task_id AND t_d.project_id = t.project_id WHERE project_id=.$_SESSION["project_id"]</code> qui supprime les dépendances dont la tâche mère est terminée.
         * <code>DELETE FROM `task_todo` WHERE project_id=.$_SESSION["project_id"]</code> qui vide la table task_todo.
         * <code>DELETE FROM `task_inprogress` WHERE project_id=.$_SESSION["project_id"]</code> qui vide la table task_inprogress.
         * <code>DELETE t, t_done FROM `task_done` AS t_done INNER JOIN `task` AS t ON t_done.fk_task_id = t.id AND t.project_id = t_done.project_id WHERE t.project_id=.$_SESSION["project_id"]</code> qui supprime les tâches qui ont été terminées, vide la table task_done et renvoie <code>true</code> si elle s'est bien effectuée.
        <td>Instancier une <code>new Tasks($db)</code>. 
         
         * Lancer <code>getTasks()</code> après avoir ajouté des tâches dans la BD puis observer que la fonction a retourné toutes les tâches rajoutées.
         * Lancer <code>getTasksToDo()</code> après avoir rajouté des tâches dans task_todo et vérifier que la fonction a renvoyé les tâches rajoutées. 
         * Lancer <code>getTasksInProgress()</code> après avoir rajouté des tâches dans task_inprogress et vérifier que la fonction a renvoyé les tâches rajoutées.  
         * Lancer <code>getTasksDone()</code> après avoir rajouté des tâches dans task_done et vérifier que la fonction a renvoyé les tâches rajoutées
         * Lancer <code>endSprint()</code> après avoir rajouté des tâches dans task_todo, task_inprogress et task_done et vérifier que la fonction renvoie <code>true</code> et que les trois tables task_todo, task_inprogress et task_done sont vide. De plus, vérifier que les tâches qui étaient dans la table task_done ont bien été supprimées de la table task mais pas celles qui étaient dans une des tables task_todo et task_inprogress.
         </td>
         <td>1h</td>
         <td>1, 2, 3</td>
         <td>18, 19, 20, 21, 22, 23, 24</td>
         <td>Fabien</td>
         <td></td>
      </tr>
      <tr>
         <td>30</td>
         <td>
         Création du fichier <code>Task.php</code> où on déclare la classe Task qui a les attributs suivants :
<pre>private $db
public  $id
public  $title
public  $description
public  $dod
public  $duration
</pre>
Les méthodes suivantes : 
            Un constructeur qui prend la connexion à la base de donnée avec 
            <code>$db</code> en paramètre et qui l'affecte à l'attribut de classe <code>$db</code>.
            
   * <code>read($id)</code> : qui met à jour les attributs de l’instance grâce au résultat de la requête <code>SELECT * FROM task WHERE id = $id AND project_id = $_SESSION["project_id"]</code> et qui renvoie <code>true</code> si elle s'est bien effectuée
   * <code>create($title)</code> : qui effectue la requête <code>INSERT INTO task (project_id, title) VALUES($_SESSION["project_id"], $title)</code> et qui renvoie <code>true</code> si elle s'est bien effectuée.
   * <code>delete($id)</code> : qui effectue la requête <code>DELETE FROM task WHERE id = $id AND project_id = $_SESSION["project_id"]</code> et qui renvoie <code>true</code> si elle s'est bien effectuée.
   * <code>update($id, $title, $description, $dod, $duration)</code> : qui effectue la requête <code>UPDATE task SET title = $title, description = $description, dod = $dod, duration = $duration,  WHERE id = $id AND project_id = $_SESSION["project_id"]</code> et qui renvoie <code>true</code> si elle s'est bien effectuée. 
   * <code>getRelatedIssues($id)</code> : renvoie le résultat de la requête <code>SELECT fk_issue_id FROM task_issues_dependency WHERE fk_task_id = $id AND project_id = $SESSON["project_id"]</code>
   * <code>setTaskToDo($id)</code> : effectue les requêtes <code>INSERT INTO task_todo (fk_task_id, project_id) VALUES ($id, $_SESSION["project_id"])</code>, <code>DELETE FROM task_inprogress WHERE id = $id AND project_id = $SESSON["project_id"]</code> et <code>DELETE FROM task_done WHERE id = $id AND project_id = $SESSON["project_id"]</code>
   * <code>setTaskInProgress($id)</code> : effectue les requêtes <code>INSERT INTO task_inprogress (fk_task_id, project_id) VALUES ($id, $_SESSION["project_id"])</code>, <code>DELETE FROM task_todo WHERE id = $id AND project_id = $SESSON["project_id"]</code> et <code>DELETE FROM task_done WHERE id = $id AND project_id = $SESSON["project_id"]</code>
   * <code>setTaskDone($id)</code> : effectue les requêtes <code>INSERT INTO task_done (fk_task_id, project_id) VALUES ($id, $_SESSION["project_id"])</code>, <code>DELETE FROM task_todo WHERE id = $id AND project_id = $SESSON["project_id"]</code> et <code>DELETE FROM task_inprogress WHERE id = $id AND project_id = $SESSON["project_id"]</code>
         </td>
         <td>Instancier une <code>new Task($db)</code>.

      * Lancer <code>create($title, $description, $dod, $duration)</code> et observer que la fonction a retourné <code>true</code>
      * Lancer <code>read($id)</code> et observer que la fonction a retourné <code>true</code> et que les attributs de classe sont remplis 
      * Lancer <code>update($id, $title, $description, $dod, $duration)</code> et observer que la fonction a retourné <code>true</code>
      * Lancer <code>delete($id)</code>  et observer que la fonction a retourné <code>true</code>
         
      * Lancer <code>getRelatedIssues($id)</code> après avoir inséré des issues dans la table issue, avoir créé des tâches dans la table task et d'avoir inséré des couples ($id, issue_id) et vérifier que la fonction retourne les bonnes valeurs.
      * Lancer <code>getRelatedIssues($id)</code> après avoir inséré des issues dans la table issue, avoir créé des tâches dans la table task et d'avoir inséré des couples (task_id, issue_id) avec tâche_id différent de $id et vérifier que la fonction retourne null.
      
      * Lancer <code>setTaskToDo($id)</code> avec un $id valide et vérifier que la tâche avec l'id $id est bien présente dans les tables task et task_todo mais pas dans les tables task_inprogress et task_done, puis que la fonction retourne <code>true</code>. 
      * Lancer <code>setTaskToDo($id)</code> avec un $id invalide et vérifier que la fonction retourne <code>false</code>. 
      * Lancer <code>setTaskInProgress($id)</code> avec un $id valide et vérifier que la tâche avec l'id $id est bien présente dans les tables task et task_inprogress mais pas dans les tables task_todo et task_done puis que la fonction retourne <code>true</code>. 
      * Lancer <code>setTaskInProgress($id)</code> avec un $id invalide et vérifier que la fonction retourne <code>false</code>. 
      * Lancer <code>setTaskDone($id)</code> avec un $id valide et vérifier que la tâche avec l'id $id est bien présente dans les tables task et task_done mais pas dans les tables task_todo et task_inprogress puis que la fonction retourne <code>true</code>. 
      * Lancer <code>setTaskDone($id)</code> avec un $id invalide et vérifier que la fonction retourne <code>false</code>. 
      * Mettre une tâche dans task_todo puis appeler les différentes fonctions setTaskTodo($db), setTaskInProgress($db) et setTaskDone($db) les unes après les autres et vérifier que les mises à jour des tables correspondantes se faire correctement.
         </td>
         <td>1h</td>
         <td>1, 2, 3</td>
         <td>15, 16, 18, 19, 20, 21, 22, 23, 24</td>
         <td>Fabien</td>
         <td></td>
      </tr>
         <tr>
         <td>8</td>
         <td>
         Création du fichier <code>CreateIssue.js</code> qui ajoute un listener sur le clic de la div <code>add-issue</code>. Lorsqu'un utilisateur clique sur ce dernier, on ajoute un <code>input type="text"</code> au dessus dans lequel l'utilisateur devra rentrer le titre de la nouvelle issue et appuyer sur entrée pour confirmer. Le script fait une requête de méthode POST vers la page <code>CreateIssue.php</code> en le titre de l'issue ainsi que le sprint correspondant. Pour annuler, l'utilisateur devra cliquer n'importe où sur l'écran à part sur la div <code>add-issue</code>. La page retourne retourne un JSON. On récupère dans ce dernier le code de réponse de la requête. Si le code est 200 (OK), on ajoute l'issue avant la div <code>add-issue</code> sur laquelle l'utilisateur a cliqué.
         </td>
         <td>Cliquer sur <code>add-issue</code> faire apparaître un <code>input</code> au dessus. Cliquer sur entrée envoie bien une requête <code>POST</code> vers la page <code>CreateIssue.php</code> est bien envoyée. Le code de retour de la requête est 200</td>
         <td>1h</td>
         <td>5, 9</td>
         <td>7</td>
         <td>Nicolas, Fabien</td>
         <td></td>
      </tr>
      <tr>
         <td>9</td>
         <td>
        Création du fichier <code>CreateIssue.php</code> qui vérifie si la méthode utilisée est bien <code>POST</code>. Si c'est le cas, on crée une <code>new Issue i</code>. On crée dans la base de données l'issue qui a le titre <code>$title</code> et qui est dans le sprint <code>$sprint_id</code> dans la requête avec <code>i->create($title)</code>.
         </td>
         <td>La requête reçue est de type POST. On effectue la requête <code>i->create($title)</code> et on observe que le résultat de cette méthode est <code>true</code></td>
         <td>1h</td>
         <td>1, 2, 3, 7</td>
         <td>7</td>
         <td>Nicolas, Fabien</td>
         <td></td>
      </tr>
       <tr>
         <td>12</td>
         <td>
        Création du fichier <code>DeleteIssue.js</code> qui ajoute un listener sur le clic des div <code>delete-issue</code>. Lorsqu'un utilisateur clique sur ce dernier,  on fait apparaître une division au centre de l'écran qui contient un message de validation et deux boutons : l'un pour valider la suppression et l'autre pour annuler. Si l'utilisateur clique sur "valider", on envoie une requête de méthode <code>DELETE</code> à <code>DeleteIssue.php</code> dans laquelle il y a l'id de l'issue correspondante. S'il clique sur annuler, on cache la fenêtre. On recharche la page.
         </td>
         <td> Cliquer sur <code>delete-issue</code> fait apparaître un message de validation contenant un bouton de validation et un d'annulation. Cliquer sur le bouton de validation envoie une requête <code>DELETE</code> vers la page <code>DeleteIssue.php</code>. Le code de retour est bien 200.</td>
         <td>1h</td>
         <td>5, 13</td>
         <td>8</td>
         <td>Fabien</td>
         <td></td>
      </tr>
      <tr>
         <td>13</td>
         <td>
         Création du fichier <code>DeleteIssue.php</code> qui vérifie si la méthode utilisée est bien DELETE. Si c'est le cas, on crée une <code>new Issue i</code>. On supprime de la base de données l'issue qui a l'id <code>$id</code> (récupéré dans la requête) avec <code>i->delete($id)</code>. Si l'issue a bien été supprimée, on <code>echo</code> le résultat de la suppression en JSON.
         </td>
         <td>La requête reçue est de type DELETE. On effectue la requête <code>i->delete($id)</code> et on observe que le résultat de cette méthode est <code>true</code>.</td>
         <td>1h</td>
         <td>1, 2, 3, 7</td>
         <td>8</td>
         <td>Fabien</td>
         <td></td>
      </tr>
         <tr>
         <td>11</td>
         <td>
         Création du fichier <code>UpdateIssue.php</code> qui vérifie si la méthode utilisée est bien PUT. Si c'est le cas, on crée une <code>new Issue</code> i. On modifie l'issue qui a l'id $id avec les variables $sprint_id (variables récupérées dans la query) grâce à <code>i->updateSprint($id, $sprint_id, $_SESSION["project_id"])</code>. On <code>echo</code> le résultat de la modification en JSON.
         </td>
         <td>La requête reçue est de type PUT. On effectue la requête <code>i->updateSprint($id, $sprint_id, $_SESSION["project_id"])</code> et on observe que le résultat de cette méthode est <code>true</code>.</td>
         <td>2h</td>
         <td>1, 2, 3, 7</td>
         <td>5, 9</td>
         <td>Nicolas</td>
         <td></td>
      </tr>
         <tr>
         <td>14</td>
         <td> Création du fichier <code>IssuesDragAndDrop.js</code> qui initialise tous les élements <code>draggable</code>. Ajoute l'évènement lorsqu'un élément <code>draggable</code> est déposé dans un sprint ou dans le backlog. Lorsque l'utilisateur effectue cette action, on envoie une requête de méthode <code>PUT</code> à <code>UpdateIssue.php</code> dans laquelle il y a le numéro de l'issue correspondante. Voir la <a href="https://jqueryui.com/draggable/#default">documentation</a>. 
         </td>
         <td>Effectuer un drag and drop d'une issue d'une catégorie dans une autre et observer que ça la déplace dans l'autre catégorie. La requête <code>PUT</code> peut être obversée avec les outils de développement des navigateurs.</td>
         <td>1h</td>
         <td>5, 11</td>
         <td>10</td>
         <td>Nicolas</td>
         <td></td>
      </tr>
      <tr>
         <td>21</td>
         <td>
        Création du fichier <code>DeleteSprint.js</code> qui ajoute un listener sur le bouton des div <code>delete-sprint</code>. Lorsqu'un utilisateur clique sur ce dernier,  on fait apparaître une division au centre de l'écran qui contient un message de validation et deux boutons : l'un pour valider la suppression et l'autre pour annuler. Si l'utilisateur clique sur "valider", on envoie une requête de méthode DELETE à <code>DeleteSprint.php</code> dans laquelle il y a le numéro du sprint correspondant. S'il clique sur annuler, on cache la fenêtre.  La page retourne retourne un JSON. On récupère dans ce dernier le code de réponse de la requête. Si le code est 200 (OK), on recharge la page.
         </td>
         <td>Cliquer sur <code>delete-sprint</code> fait apparaître un message de validation contenant un bouton de validation et un d'annulation. Cliquer sur le bouton de validation envoie une requête <code>DELETE </code>vers la page <code>DeleteSprint.php</code>. Le code de retour est bien 200.</td>
         <td>1h</td>
         <td>5, 6, 18</td>
         <td>13</td>
         <td>Fabien</td>
         <td></td>
      </tr>
      <tr>
         <td>22</td>
         <td>
         Création du fichier <code>DeleteSprint.php</code> qui vérifie si la méthode utilisée est bien DELETE. Si c'est le cas, on crée un <code>new Sprint s</code> et une <code>new Issues i</code>. On remet les issues du sprints à supprimer dans le backlog en appellant <code>i->removeIssuesFromSprint($id)</code> (avec <code>$id</code> récupéré dans la requête), enfin on supprime de la base de données le sprint qui a l'id <code>$id</code> avec <code>s->delete($id)</code>. Si le sprint a bien été supprimé, on <code>echo</code> le résultat de la suppression en JSON.
         <td>La requête reçue est de type DELETE. On effectue la requête <code>i->delete($id)</code> et on observe que le résultat de cette méthode est <code>true</code>.</td>
         <td>1h</td>
         <td>5, 6, 18</td>
         <td>13</td>
         <td>Fabien</td>
         <td></td>
      </tr>
<tr>
         <td>10</td>
         <td>
         Création du fichier <code>GetIssue.php</code> qui vérifie si la méthode utilisée est bien GET. Si c'est le cas, on crée une <code>new Issue</code> i. On récupère les informations correspondante à l'issue qui a l'id <code>$id</code> (récupéré dans la requête) avec <code>i->read($id)</code>. On <code>echo</code> le résultat en JSON.
         </td>
         <td>La requête reçue est de type GET. On effectue la requête <code>i->read($title)</code> et on observe que le résultat de cette méthode est <code>true</code> et que les attributs de la classe sont remplis.</td>
         <td>1h</td>
         <td>1, 2, 3, 7</td>
         <td>5, 9</td>
         <td>Nicolas</td>
         <td></td>
      </tr>
      <tr>
         <td>15</td>
         <td>
         Création du fichier <code>OnIssueClicked.js</code> qui ajoute un listener sur le clic de chaque division directement fille (<code>issueX</code>) de <code>issues</code>. Lorsqu'un utilisateur clique sur une division <code>issueX</code> le script effectue une requête de méthode GET vers la page php <code>GetIssue.php</code> dans laquelle il y a le numéro de l'issue qui retourne un JSON. On récupère dans ce dernier les champs correspondants au title, description, difficulty, priority. On modifie les valeurs des champs correspondants dans la div <code>issue-information</code> et on la rend visible. On ajoute un listener le bouton "modifier" une requête PUT à l'adresse <code>UpdateIssue.php</code> dans laquelle il y a le contenu des inputs dans la div <code>issue-information</code>.
         </td>
         <td>Cliquer sur une issue enlève la classe <code>hidden</code> de la div <code>issue-information</code>. On observe aussi l'envoi d'une requête <code>PUT</code> à l'adresse <code>UpdateIssue.php</code>.</td>
         <td>2h</td>
         <td>5, 10</td>
         <td>5, 9</td>
         <td>Nicolas</td>
         <td></td>
      </tr>
      <tr>
         <td>16</td>
         <td>
      Création du fichier <code>IssueInformation.php</code> qui crée une div <code>issue-information hidden</code> qui contient :

   * un <code>input type="text"</code> vide (title)
   * un <code>input type="text"</code> vide (description)
   * un <code>input type="number"</code> vide (coût) qui n'accepte pas les nombres  négatifs 
   * un <code>select</code> (priorité)
         </td>
         <td>Ouvrir la page et constater que les différents <code>input</code> et le <code>dropdown menu</code> sont présents.</td>
         <td>1h</td>
         <td>1</td>
         <td>5, 9</td>
         <td>Nicolas</td>
         <td></td>
      </tr>
      <tr>
         <td>32</td>
         <td>
         Création du fichier <code>UpdateTask.php</code> qui vérifie si la méthode utilisée est bien <code>PUT</code>. Si c'est le cas, on crée une <code>new Task</code> t.

      * Si <code>$state == "TODO"</code> on fait <code>t->setTaskTodo($id)</code>
      * Sinon si <code>$state == "IN PROGRESS"</code> on fait <code>t->setTaskInProgress($id)</code>
      * Sinon si <code>$state == "DONE"</code> on fait <code>t->setTaskDone($id)</code>
      * Si l'issue a bien été modifiée, on <code>echo</code> le résultat de la modification en JSON.
         </td>
         <td>La requête reçue est de type PUT. 
         
         * Si le $state == "TODO"
            * On récupère la liste des tâches qui sont à faire avec <code>newTasks().getTasksTodo()</code> : la tâche qui a comme identifiant <code>$id</code> n'est pas dedans
            * On modifie la valeur de la table avec <code>t->setTaskTodo($id)</code>
            * On récupère la liste des tâches qui sont à faire avec <code>newTasks().getTasksTodo()</code> : la tâche qui a comme identifiant <code>$id</code> est désormais dedans
         * On fait de même si <code>$state == "IN PROGRESS"</code> et <code>$state == "DONE"</code>
          On effectue la requête <code>i->update($id, $title, $description, $cost, $priority)</code> et on observe que le résultat de cette méthode est <code>true</code>.</td>
         <td>1h</td>
         <td>1, 2, 3, 30</td>
         <td>18, 22</td>
         <td>Fabien</td>
         <td></td>
      </tr>
       <tr>
         <td>35</td>
         <td>
         Création du fichier <code>Kanban.php</code> qui crée un <code>new Sprints s</code> et qui récupère dans une variable <code>activeSprint</code> le résultat de <code>s->getActiveSprint()</code>
         
      * on crée tableau de 3 colonnes: TODO, IN PROGRESS et DONE qui sont toutes <code>sortable</code>
   
      * Si <code>res != null</code> alors : 
         * On crée une <code>new Tasks tasks</code>
         * On récupère dans <code>tasksTodo</code> le résultat de <code>tasks->getTasksTodo()</code>
         * On récupère dans <code>tasksInProgress</code> le résultat de <code>tasks->getInProgress()</code>
         * On récupère dans <code>tasksDone</code> le résultat de <code>tasks->getTasksDone() </code>
         * Pour chacune des tasksTodo, tasksInProgress et tasksDone, on ajoute dans la colonne correspondante leur contenu dans des div <code>taskX</code> et <code>draggableX</code> (où X est l'identifiant de la tâche) en écrivant l'identifiant et le titre de la tâche 
         * On inclut le fichier <code>TasksDragAndDrop.js</code>
         * On inclut le fichier <code>KanbanTaskInformation.js</code>
         </td>
         <td> 
         * Insérer des tâches dans la table (de la base de données) task 
         * Mettre chaque tâche dans une des tables task_todo, task_inprogress ou task_done. 
         * Vérifier que les tâches sont bien dans la bonne colonne
         </td>
         <td>2h</td>
         <td>1, 2, 3, 17</td>
         <td>23, 24</td>
         <td>Fabien</td>
         <td></td>
      </tr>
      <tr>
         <td>36</td>
         <td>
         Création du fichier <code>TasksDragAndDrop.js</code> qui initialise tous les élements draggable. Ajoute l'évènement lorsqu'un élément <code>draggable</code> est déposé dans une colonne. Lorsque l'utilisateur effectue cette action, on envoie une requête de méthode PUT à <code>UpdateTask.php</code> dans laquelle il y a l'id qui est le numéro de l'issue correspondante et state l'intitulé correspondante à la colonne. Voir la <a href="https://jqueryui.com/draggable/#default">documentation</a>. 
         <td>Effectuer un drag and drop d'une tâche d'une colonne à une autre et observer que ça la déplace dans l'autre catégorie. Observer qu'une requête de type <code>PUT</code> est bien émise, contenant une variable <code>$id</code></td>
         <td>1h</td>
         <td>32, 35</td>
         <td></td>
         <td>Fabien</td>
         <td>23, 24</td>
      </tr>
<tr>
      <td>31</td>
      <td>
        Création du fichier <code>CreateTask.js</code> qui ajoute un listener sur le clic du button <code>add-task</code>. Lorsqu'un utilisateur clique sur ce dernier, on ouvre une fenêtre dans laquelle l'utilisateur devra rentrer le titre, la description, la dod, la durée dans les boîtes de texte. Il y a une liste déroulante avec une barre de recherche <code>dependancy</code> dans laquelle il y a tous les identifiants des tâches. En cliquant sur un identifiant cela affichera en dessous un <code>span</code> dans lequel il y a écrit l'identifiant. Passer la souris sur un <code>span</code> affiche une croix en haut à droite, cliquer dessus supprime le <code>span</code>. On met en place le même système pour les issues (la liste déroulante affiche tous les identifiants des issues). Il y a un bouton "Valider" et "Annuler". Cliquer sur "Annuler" ferme la fenêtre. Cliquer sur "Valider" envoie une requête POST vers la page <code>CreateTask.php</code> en envoyant dans la requête le titre, la description, la dod, la durée, les tâches dont dépend la tâche et les issues dont dépend la tâche. Une erreur est affichée si l'utilisateur clique sans avoir renseigné de titre et au moins une issue dépendante. La page est rechargée lorsque la requête renvoie le code 200 (OK), si elle renvoie un code correspondant à une erreur, cette dernière est affichée et la fenêtre est fermée.Utiliser l’éditeur swagger pour décrire la specification de votre API de gestion de carnet d’adresse et publier la doccumentation ad-hoc. Nous n’utiliserons pas les générateurs de code existant.
      </td>
         <td>Cliquer sur <code>add-issue</code> ouvre une fenêtre contenant les champs ainsi que la liste déroulante décrits. Cliquer sur les croix des différents éléments retire bien l'élément de la page. On observe qu'une requête <code>POST</code> est bien générée, et que la page se recharge lorsque l'on clique sur le bouton "Valider". </td>
      <td>1h</td>
      <td>29, 41</td>
      <td>20</td>
      <td>Nicolas</td>
      <td></td>
      </tr>
      <tr>
      <td>33</td>
      <td>
        Création du fichier <code>DeleteTask.js</code> qui ajoute un listener sur le clic des div <code>delete-task</code>. Lorsqu'un utilisateur clique sur ce dernier,  on fait apparaître une division au centre de l'écran qui contient un message de validation et deux boutons : l'un pour valider la suppression et l'autre pour annuler. Si l'utilisateur clique sur "valider", on envoie une requête de méthode <code>DELETE</code> à <code>DeleteTask.php</code> dans laquelle il y a l'id de la tâche correspondante. S'il clique sur annuler, on cache la fenêtre.
         </td>
         <td> Cliquer sur <code>delete-task</code> fait apparaître un message de validation contenant un bouton de validation et un d'annulation. Cliquer sur le bouton de validation envoie une requête <code>DELETE</code> vers la page <code>DeleteTask.php</code>. Le code de retour bien 200 si la requête a bien été exécutée.</td>
      <td>1h</td>
      <td>29, 34 </td>
      <td>21</td>
      <td>Nicolas</td>
      <td></td>
      </tr>
      <tr>
      <td>34</td>
      <td>
           Création du fichier <code>DeleteTask.php</code> qui vérifie si la méthode utilisée est bien DELETE. Si c'est le cas, on crée une <code>new Task t</code>. On supprime de la base de données la tâche qui a l'id <code>$id</code> (récupéré dans la requête) avec <code>t->delete($id)</code>. Le code de retour est 200 si la requête a bien été exécutée.
      </td>
      <td>La requête reçue est de type <code> DELETE</code> et on y trouve une variable <code>$id</code>. Le code de retour est bien 200. On constate en regardant la liste des tâches que la taches à supprimer a bien disparu.</td>
      <td>1h</td>
      <td>1, 2, 3, 30</td>
      <td>21</td>
      <td>Nicolas</td>
      <td></td>
      </tr>
   <tr>
      <td>5</td>
      <td>
      Création du fichier <code>Backlog.php</code> qui:

   * Crée un <code>new Sprints($db)</code> s;
   * Récupère dans un objet o tous les sprints avec <code>s->getSprints()</code>  
   * Pour chaque <code>row</code> r de o : 
      * Ouvre une div <code>sprintX</code> et <code>sortable</code> (où X est le numéro du sprint)
      * Crée une <code>new Issues($db) i</code>
      * Récupère dans un objet p les issues du sprint avec <code>i->getIssuesBySprint(r[0])</code>.
      * Affiche le nombre d'issues
      * Affiche la date et début et de fin du sprint si elles existent
      * Si ce sprint est le prochain sprint (Sprint 1 si aucun sprint n'a jamais été lancé) et que <code>s->getActiveSprint()</code> renvoie NULL, on affiche un bouton <code>sprintStart</code> intitulé "Lancer le sprint" 
      * Si <code>r[0] = s->getActiveSprint()</code> alors on affiche un bouton "terminer le sprint".
      * Affiche un bouton <code>deleteSprint</code> intitulé "Supprimer le sprint"
      * Pour chaque row de p : 
         * Si le résultat de <code>s->isFinished(r[0])</code> est <code>false</code> alors
            * Afficher une croix <code>delete-issue</code> dans une div et l'id, le titre, la difficulté, l'état et le coût de chacune des issues dans une autre div adjacente 
         * Sinon
            * Affiche dans une div <code>issueX</code> (X étant l'id de l'issue) l'id, le titre, la difficulté, l'état et le coût de chacune des issues; la div est barrée
      * Si le sprint est terminé (<code>r->end_date < current_date</code>) alors on ajoute à chacune de des issues la classe <code>crossed</code> et on <code>sortable</code> de la div <code>sprintX</code>     
      * Sinon on affiche "+ Ajouter une issue" dans une div <code>add-issue</code>
      * Ferme la div <code>sprintX</code>
   * Crée une <code>new Issues($db) i</code>
   *   Récupère dans un objet p les issues du backlog avec <code>i->getBacklogIssues()</code>
   * Ouvre une div <code>backlog sortable</code>
   * Affiche "+ Ajouter un sprint" dans une div <code>add-sprint</code>
   * Pour chaque row de p : 
      * Afficher le titre de chacune des issues dans une div
      * Affiche "+ Ajouter une issue" dans une div <code>add-issue</code>
   * Fermer la div <code>backlog</code>  
            Le fichier inclut le fichier <code>IssueInformation.php</code>, <code>StartSprint.js</code>, <code>OnIssueClicked.js</code>, <code>CreateIssue.js</code>, <code>DeleteIssue.js</code> et <code>IssuesDragAndDrop.js</code>
         </td>
         <td>La page contient toutes les issues qui sont dans leur sprint ou dans le backlog. A gauche de chaque issue il y a une croix. A droite du nom de chque sprint il y a un bouton "Supprimer le sprint". A droite du nom du premier sprint de la page il y a un bouton "Lancer le sprint". Tout en bas de chaque catégorie il y a un bouton intitulé "Ajouter une issue".</td>
         <td>3h</td>
         <td>1, 2, 3, 6, 17</td>
         <td>5</td>
         <td>Nicolas, Fabien</td>
         <td></td>
      </tr>
<tr>
         <td>39</td>
         <td>
         Création du fichier <code>GetTask.php</code> qui vérifie si la méthode utilisée est bien GET. Si c'est le cas, on crée une <code>new Task</code> t. On récupère les informations correspondante à la tâche qui a l'id <code>$id</code> (récupéré dans la requête) avec <code>t->read($id)</code>. On <code>echo</code> le résultat en JSON.
         </td>
         <td>La requête reçue est de type GET. On effectue la requête <code>t->read($title)</code> et on observe que le résultat de cette méthode est <code>true</code> et que les attributs de la classe sont remplis.</td>
         <td>1h</td>
         <td>1, 2, 3 30</td>
         <td>18, 24</td>
         <td>Nicolas</td>
         <td></td>
      </tr>
<tr>
         <td>41</td>
         <td>
         Création du fichier <code>CreateTask.php</code> qui vérifie si la méthode utilisée est bien <code>POST</code>. Si c'est le cas, on crée une <code>new Task i</code>. On crée dans la base de données la tâche qui a le titre <code>$title</code> dans la requête avec <code>t->create($title)</code>.
         </td>
         <td>La requête reçue est de type POST. On effectue la requête <code>t->create($title)</code> et on observe que le résultat de cette méthode est <code>true</code></td>
         <td>1h</td>
         <td>1, 2, 3 30</td>
         <td>20</td>
         <td>Nicolas</td>
         <td></td>
      </tr>
   </tbody>
</table>
