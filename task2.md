# Sprint 2 : 16/11/20 -> 29/11/20

<table>
    <thead>
        <tr>
            <th colspan="7">TODO</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Definition of Done</th>
            <th>Durée</th>
            <th>Dépendances</th>
            <th>User Story Correspondante(s)</th>
            <th>Developpeur</th>
        </tr>
    </thead>
   <tbody>
        <tr>
            <td>4</td>
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
            <td></td>
            <td>27</td>
            <td></td>
        </tr>
        
    <tr>
    <td>5</td>
      <td>
      Création du fichier <code>KanbanTaskInformation.js</code> qui ajoute un listener sur le clic sur les tâches. Le script fait une requête de méthode GET vers la page <code>GetTask.php</code> dans laquelle il y a l'identifiant de la tâche. La page retourne retourne un JSON. On récupère dans ce dernier le code de réponse de la requête. Si le code est 200 (OK), on affiche les valeurs de <code>title, description, dod, duration, fk_issue_id, fk_parent_id</code> (peut être <code>null</code> ) dans une div au centre de l'écran. L'utilisateur peut appuyer sur une croix en haut à droite de la fenêtre pour fermer celle-ci. Si le code est 405 ou 404 on affiche un <code>toast</code> avec le message d'erreur.
      <td>Cliquer sur une tâche affiche bien une fenêtre contenant tous les champs décrits. Appuyer sur la croix les enlève. On constate qu'une requête <code>GET</code> est bien émise.</td>
    <td>2h</td>
    <td></td>
    <td>24</td>
    <td></td>
    </tr>
   </tbody>
</table>


<table>
    <thead>
        <tr>
            <th colspan="7">IN PROGRESS</td>
        </tr>
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Definition of Done</th>
            <th>Durée</th>
            <th>Dépendances</th>
            <th>User Story Correspondante(s)</th>
            <th>Developpeur</th>
        </tr>
        <tr>
            <td>6</td>
            <td>Création du fichier <code>TestList.php</code> qui récupère dans la base de données tous les tests et qui pour chacun affiche l'id, le title, le résultat. On calcule le taux de réussites des tests et on l'affiche en haut de la page. Il y a un bouton cahier de tests qui affiche l'historique des résultats de tous les tests du projet</td>
            <td>La page contient tous les tests liés au projet. Il y a en haut de la page le taux de réussite des tests.</td>
            <td>5h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
        </tr>
    </thead>
   <tbody>
   </tbody>
</table>

<table>
    <thead>
        <tr>
            <th colspan="8">DONE</td>
        </tr>
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Definition of Done</th>
            <th>Durée</th>
            <th>Dépendances</th>
            <th>User Story Correspondante(s)</th>
            <th>Developpeur</th>
            <th>Tester</th>
        </tr>
    </thead>
   <tbody>
   <tr>
            <td>7</td>
         <td>
         Création du fichier <code>OnTaskClicked.js</code> qui ajoute un listener sur le clic de chaque division directement fille (<code>taskX</code>) de <code>task</code>. Lorsqu'un utilisateur clique sur une division <code>taskX</code> le script effectue une requête de méthode GET vers la page php <code>GetTask.php</code> dans laquelle il y a le numéro de la tâche qui retourne un JSON. On récupère dans ce dernier les champs correspondants au title, description, dod, duration et les issues dont dépendent cette tâche. On modifie les valeurs des champs correspondants dans la div <code>task-information</code> et on la rend visible. On ajoute un listener le bouton "modifier" une requête PUT à l'adresse <code>UpdateIssue.php</code> dans laquelle il y a le contenu des inputs dans la div <code>task-information</code>.
         </td>
         <td>Cliquer sur une issue enlève la classe <code>hidden</code> de la div <code>task-information</code>. On observe aussi l'envoi d'une requête <code>PUT</code> à l'adresse <code>UpdateTask.php</code>.</td>	
            <td>5h</td>
            <td>Pierre</td>
            <td>22</td>
            <td></td>
        </tr>
        <tr>
            <td>8</td>
         <td>
         Création du fichier <code>GetTask.php</code> qui vérifie si la méthode utilisée est bien <code>GET</code>. Si c'est le cas, on crée une new <code>Task t</code>. On récupère les informations correspondante à la task qui a l'id <code>$id</code> (récupérée dans la requête) avec <code>t->read($id)</code>. On echo le résultat en JSON. 
         </td>
         <td>La requête reçue est de type <code>GET</code>. On effectue la requête <code>t->read($id)</code> et on observe que le résultat de cette méthode est <code>true</code> et que les attributs de la classe sont remplis.</td>	
            <td>30mn</td>
            <td></td>
            <td>22</td>
            <td>Pierre</td>
        </tr>
        <tr>
         <td>9</td>
         <td>
      Création du fichier <code>TaskInformation.php</code> qui crée une div <code>task-information hidden</code> qui contient :

   * un <code>input type="text"</code> vide (title)
   * un <code>input type="text"</code> vide (description)
   * un <code>input type="text"</code> vide (definition of done)
   * un <code>input type="number"</code> vide (duration)
         </td>
         <td>Ouvrir la page et constater que les différents <code>input</code> sont présents.</td>
         <td>1h</td>
         <td>1</td>
         <td>22</td>
         <td>Pierre</td>
         <td></td>
      </tr>
<tr>
            <td>10</td>
            <td>Création du fichier <code>Testscenario.php</code> qui récupère dans la base de données tous les scénarios de test et qui pour chacun affiche l'id et le contenu. En haut de la liste des scénarios il y a un bouton "+ Ajouter un scénario". A droite de la division qui contient chaque scénario, il y a un bouton "valider". Il n'y a pas de boulot "valider" pour un scénario si ce scénario a déjà un test associé. A gauche, il y a une croix.
            </td>
            <td>La page contient tous les scénarios de test liés au projet et les boutons.</td>
            <td>1h</td>
            <td></td>
            <td>26, 27, 28, 29</td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>11</td>
            <td>Création du fichier <code>CreateScenario.js</code> qui ajoute un listener sur le clic du bouton "+ Ajouter un scénario". Lorsque le clic est effectué, on ouvre une fenêtre contenant un formulaire "contenu" et un bouton "Créer le scénario". Cliquer sur ce dernier envoie une requête POST à la page <code>CreateScenario.php</code>.  
            </td>
            <td>Lorsque l'on clique sur le bouton "+ Ajouter un scénario" une fenêtre s'ouvre et si on appuie sur "Créer le scénario" une requête POST est envoyée à la page <code>CreateScenario.php</code></td>
            <td>1h</td>
            <td>10</td>
            <td>27</td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>12</td>
            <td>Création du fichier <code>CreateScenario.php</code> qui ajoute un scénario dans la base de données avec le <code>$content</code> de la requête</td>
            <td>La base de données continent désormais le scénario.</td>
            <td>30m</td>
            <td></td>
            <td>27</td>
            <td>Nicolas</td>
            <td></td>
        </tr>
<tr>
            <td>13</td>
            <td>Création du fichier <code>DeleteScenario.js</code> qui ajoute un listener sur le clic des croix. Lorsque le clic est effectué, on ouvre une fenêtre de validation. Cliquer sur valider envoie une requête DELETE à la page <code>DeleteScenario.php</code>.  
            </td>
            <td>Lorsque l'on clique sur une croix une fenêtre s'ouvre et si on appuie sur "valider" une requête DELETE est envoyée à la page <code>DeleteScenario.php</code></td>
            <td>1h</td>
            <td>10</td>
            <td>27</td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>14</td>
            <td>Création du fichier <code>DeleteScenario.php</code> qui supprime un scénario de la base de données.</td>
            <td>La base de données ne contient plus le scénario supprimé.</td>
            <td>30m</td>
            <td></td>
            <td>27</td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>15</td>
            <td>Création du fichier <code>UpdateTestScenario.php</code> qui met à jour un scénario dans la base de données avec le <code>$content</code> de la requête</td>
            <td>La base de données continent désormais le scénario modifié.</td>
            <td>30m</td>
            <td></td>
            <td>28</td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>16</td>
            <td>Création du fichier <code>OnTestScenarioClicked.js</code> qui ajoute un listener sur le clic de chaque division directement fille (<code>test-scenario-X</code>) de <code>test-scenario</code>. Lorsqu'un utilisateur clique sur une division <code>test-scenario-X</code> le script effectue une requête de méthode GET vers la page php <code>GetTestScenario.php</code> dans laquelle il y a le numéro du scénario qui retourne un JSON. On récupère dans ce dernier les champs correspondants au title, description. On modifie les valeurs des champs correspondants dans la div <code>test-scenario-information</code> et on la rend visible. On ajoute un listener le bouton "modifier" une requête PUT à l'adresse <code>UpdateIssue.php</code> dans laquelle il y a le contenu des inputs dans la div <code>test-scenario-information</code>.
         </td>
         <td>Cliquer sur une issue enlève la classe <code>hidden</code> de la div <code>test-scenario-information</code>. On observe aussi l'envoi d'une requête <code>PUT</code> à l'adresse <code>UpdateTestScenario.php</code>.</td>	
            <td>30m</td>
            <td></td>
            <td>28</td>
            <td>Nicolas</td>
            <td></td>
        </tr>       
        <tr>
            <td>17</td>
         <td>
         Création du fichier <code>GetTestScenario.php</code> qui vérifie si la méthode utilisée est bien <code>GET</code>. Si c'est le cas, on crée un <code>new Scenario s</code>. On récupère les informations correspondante au scenario qui a l'id <code>$id</code> (récupérée dans la requête) avec <code>s->read($id)</code>. On echo le résultat en JSON. 
         </td>
         <td>La requête reçue est de type <code>GET</code>. On effectue la requête <code>s->read($id)</code> et on observe que le résultat de cette méthode est <code>true</code> et que les attributs de la classe sont remplis.</td>	
            <td>30mn</td>
            <td></td>
            <td>22</td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>18</td>
            <td>Création du fichier <code>Scenario.php</code> ou on déclare une classe Scenaio qui prend en paramètre une database <code>$db</code>, et a les attributs correspondant à ceux de la table test_scenario de la BDD. Cette classe dispose des méthodes qui effectuent les requêtes SQL permettant d'ajouter, supprimer et modifier les éléments de la table test_scenario.
            </td>
            <td>On instancie un <code>new Scenario($db)</code>, et en exécutant les différentes méthodes on constate que la base de données est bien modifiée</td>
            <td>1h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>19</td>
            <td>Création du fichier <code>Scenarios.php</code> ou on déclare une classe Scenarios qui prend en paramètre une database <code>$db</code>. Cette classe dispose d'une méthode: <code>getScenarios</code> qui retourne tous les scénarios de test.
            </td>
            <td>On instancie un <code>new Scenarios($db)</code>, et en exécutant <code>getScenario</code> on a une réponse.</td>
            <td>1h</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>20</td>
            <td>Création du fichier <code>OnTestValidateScenario.js</code> qui ajoute un listener sur le click des boutons "valider". Une fenêtre apparaît avec plusieurs champs. Il y a un bouton valider et annuler. Appuyer sur valider envoie une requête POST à la page <code>CreateTest.php</code></td>
            <td>Lorsqu'on clique sun bouton "valider" une fenêtre apparaît dans laquel on peut renseigner des input. Appuyer sur créer le test crée un test qui est visible sur la page Test.php</td>
            <td>2h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
                <tr>
            <td>21</td>
            <td>Création du fichier <code>copyAPIRequest.js</code> qui ajoute un listener sur le bouton "api" qui copie dans le presse papier les lignes de codes pour effectuer un appel à la page UpdateTest.php pour changer le résultat du test sur lequel on appuyé sur le bouton "api" </td>
            <td>Lorsqu'on clique sur le bouton "api" des lignes de code sont bien copiés dans le presse papier. Utiliser ses lignes mettent à jour un test spécifique.</td>
            <td>2h</td>
            <td>6</td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>22</td>
            <td>Création du fichier <code>UpdateTest.php</code> qui met à jour un test dans la base de données avec le <code>$content</code> de la requête</td>
            <td>La base de données continent désormais le test modifié.</td>
            <td>30m</td>
            <td>1</td>
            <td>28</td>
            <td>Nicolas</td>
            <td></td>
        </tr>
                <tr>
            <td>1</td>
            <td>Création du fichier <code>Test.php</code> ou on déclare une classe Test qui prend en paramètre une database <code>$db</code>, et a les attributs correspondant à ceux de la table Test de la BDD. Cette classe dispose des méthodes qui effectuent les requêtes SQL permettant d'ajouter, supprimer et modifier les éléments de la table Test.
            </td>
            <td>On instancie un <code>new Test($db)</code>, et en exécutant les différentes méthodes on constate que la base de données est bien modifiée</td>
            <td>1h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
<tr>
            <td>2</td>
            <td>Création du fichier <code>DeleteTest.js</code> qui ajoute un listener sur le clic des croix. Lorsque le clic est effectué, on ouvre une fenêtre de validation. Cliquer sur valider envoie une requête DELETE à la page <code>DeleteTest.php</code>.  
            </td>
            <td>Lorsque l'on clique sur une croix une fenêtre s'ouvre et si on appuie sur "valider" une requête DELETE est envoyée à la page <code>DeleteTest.php</code></td>
            <td>1h</td>
            <td>10</td>
            <td>27</td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Création du fichier <code>DeleteTest.php</code> qui supprime un test de la base de données.</td>
            <td>La base de données ne contient plus le scénario supprimé.</td>
            <td>30m</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
   </tbody>
</table>