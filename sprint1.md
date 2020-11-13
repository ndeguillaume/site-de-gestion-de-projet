# Sprint 1 : 02/11/20 -> 13/11/20

<table>
  <tbody>
      <th>ID</th>
      <th>US</th>
      <th>Coût</th>
      <th>Priorité</th>
<tr>
      <td>5</td>
      <td>En tant qu’utilisateur, je souhaite avoir accès à une barre de navigation où il y aura les boutons :
      <ul>
<li>pour accéder au backlog</li>
<li>pour accéder à la gestion des gherkins</li>
<li>pour accéder à la liste des tâches</li>
<li>pour accéder à la page des tests</li>
<li>pour accéder à la page des releases </li>
<li>pour accéder à la page des documentations</li>
<li>pour accéder au trello des tâches</li>
<li>pour accéder au sprint actif</li>
</ul>
ainsi qu'un bouton avec liste déroulante pour accéder à la page regroupant tous les projets, pour créer un nouveau projet et qui affiche les projets récents sur lesquels on peut cliquer
</td>
      <td>1</td>
      <td>Moyenne</td>
</tr>

<tr>
      <td>6</td>
      <td>En tant qu’utilisateur, je souhaite avoir accès à une page “backlog” regroupant toutes les issues décrites par leur identifiant, titre, difficulté, état et coût.  Les issues sont soit dans la catégorie backlog soit dans une des catégories sprint. A côté de chaque catégorie il y a écrit le nombre d’issues associées</td>
      <td>3</td>
      <td>Haute</td>
</tr>

<tr>
      <td>7</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “+” présent sous chaque catégorie sur la page “backlog” afin d’ajouter une issue en renseignant son titre. Son identifiant est affecté automatiquement.</td>
      <td>1</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>8</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “x” présent à gauche de chaque issue sur la page “backlog” afin de supprimer l’issue. Une fenêtre de validation apparaît alors me demandant de valider mon choix ou d’annuler.</td>
      <td>1</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>9</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur une issue du backlog ce qui ouvre une fenêtre pré-remplie avec les données de l’issue afin de pouvoir modifier cette issue en renseignant jusqu’à: 
      <ul>
<li>un titre dans boîte de texte</li>
<li>une US dans une boîte de texte</li>
<li>une difficulté dans une boîte de texte n’acceptant que les nombres positifs</li>
<li>une priorité à choisir entre la plus haute, haute, moyenne, faible, la plus faible.</li>
</ul>
Dès qu’un champs est modifié, sa valeur est sauvegardée.
</td>
      <td>5</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>10</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir effectuer un drag and drop sur la page "backlog" d’une issue dans une catégorie afin de l’affecter à un sprint particulier ou de la remettre dans le backlog. Si je souhaite déplacer une issue depuis ou vers un sprint actif, une fenêtre de confirmation s’affiche. Si j’appuie sur le bouton “Confirmer”, l’issue est déplacée.</td>
      <td>3</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>11</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “créer un sprint” à côté de la catégorie backlog sur la page “backlog” qui crée une catégorie sprint numérotée automatiquement.</td>
      <td>1</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>12</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir lancer le prochain sprint en cliquant sur un bouton qui m’ouvrira une fenêtre permettant de donner la date de début (date et heure) modifiable initialisée à la date actuelle ainsi que la date de fin du sprint. Ce bouton est présent en face du prochain sprint (sprint 1 si aucun n’a été lancé) mais il n’est pas possible de cliquer dessus si un sprint est en cours.</td>
      <td>2</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>13</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “x” présent à droite de chaque sprint sur la page “backlog” afin de supprimer le sprint. Une fenêtre de validation apparaît alors me demandant de valider mon choix ou d’annuler. Si je valide, les issues qui étaient associées au sprint seront réaffectées à la catégorie backlog.</td>
      <td>1</td>
      <td>Moyenne</td>
</tr>

<tr>
      <td>14</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “modifier” présent à droite du sprint actif sur la page “backlog” afin de modifier le sprint. Une fenêtre apparaît permettant de modifier la date de début (date et heure) et la date de fin du sprint. Je peux alors valider la modification ou l’annuler.</td>
      <td>2</td>
      <td>Très basse</td>
</tr>

<tr>
      <td>15</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “terminer” sur la page “backlog” afin de pouvoir terminer le sprint actif avant que la date de fin ne soit atteinte. Les issues qui sont dans la catégorie “terminées” apparaissent alors barrées sur la page “backlog” et ne sont plus déplaçables et celles qui sont en “cours” ou “à faire” sont réaffectées à la catégorie “backlog”</td>
      <td>2</td>
      <td>Moyenne</td>
</tr>

<tr>
      <td>16</td>
      <td>En tant qu’utilisateur, je souhaite avoir accès à une page “sprint actif” qui affiche 3 catégories “à faire”, “en cours” et “terminée” dans lesquelles il y écrit, pour chaque issue du sprint actif, son titre, sa difficulté, sa priorité et son identifiant. S’il n’y a pas de sprint actif, la page l’affiche.</td>
      <td>3</td>
      <td>Très haute</td>
</tr>
<tr>
      <td>17</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur une issue de la page “sprint actif” afin d’afficher toutes ses informations dans une fenêtre qui apparaît.</td>
      <td>2</td>
      <td>Basse</td>
</tr>


<tr>
      <td>18</td>
      <td>En tant qu’utilisateur, je souhaite avoir accès à une page “liste des tâches” regroupant toutes les tâches décrites par leur identifiant, durée, dépendances et US correspondante.  Les tâches sont placées soit dans la catégorie “En attente” soit dans une des catégories sprint en fonction de la position de leur US correspondante.</td>
      <td>3</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>19</td>
      <td>En tant qu’utilisateur, je souhaite avoir accès à une page “trello” qui affiche 3 catégories “à faire”, “en cours” et “terminée” dans lesquelles sont écrites les tâches qui correspondent aux issues du sprint actif. S’il n’y a pas de sprint actif la page affiche un trello vide. </td>
      <td>3</td>
      <td>Très haute</td>
</tr>


<tr>
      <td>20</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “+” présent en haut de la page des tâches afin d’ajouter une tâche en renseignant son titre et en sélectionnant l’User Story qui lui correspond grâce à une liste déroulante. Son identifiant est affecté automatiquement.</td>
      <td>1</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>21</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “x” présent à gauche de chaque tâche sur la page de la liste des tâches afin de supprimer la tâche. Une fenêtre de validation apparaît alors me demandant de valider mon choix ou d’annuler.</td>
      <td>1</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>22</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur une tâche de la liste des tâches, ce qui ouvre une fenêtre pré-remplie avec les données de la tâche afin de pouvoir modifier cette tâche qui comporte les champs suivant: 
      <ul>
<li>un titre dans boîte de texte</li>
<li>une tâche dans une boîte de texte</li>
<li>une Definition of Done dans une boîte de texte
<li>une durée en heure/homme dans une boîte de texte n’acceptant que les nombres positifs de 1 à 8 </li>
<li>une ou plusieurs tâches dont elle dépend dans une liste déroulante des id des tâches (peut être vide). Les tâches sélectionnées auront une marque à côté de leur id dans la liste pour signaler qu’elles le sont. Les id des tâches sélectionnées seront affichés en ligne à droite de la liste déroulante. Cliquer sur une tâches marquée dans la liste ou sur une croix d’une tâche affichée à droite supprimera la dépendance</li>
<li>la ou les User Stories qui lui correspondent dans une liste déroulante des id des issues (ne peut pas être vide). L’ajout ou la suppression de dépendance se fera comme pour les tâches. Cependant, il devra y avoir au moins une User Story de selectionnée pour valider la modification.</li>
</ul>
</td>
      <td>5</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>23</td>
      <td> En tant qu’utilisateur, je souhaite pouvoir effectuer un drag and drop sur la page “trello” entre les 3 catégories “à faire”, “en cours” et “terminée” afin de modifier l’avancement de la tâche: 
      <ul>
<li>si une issue a au moins une tâches qui dépend d’elle dans la catégorie “en cours”, cette issue sera dans cette catégorie sur la page du sprint actif</li>
<li>si une issue toutes les tâches qui dépendent d’elle dans la catégorie “terminée”, cette issue sera dans cette catégorie sur la page du sprint actif</li>
<li>si une issue a toutes les tâches qui dépendent d’elle dans la catégorie “à faire”, cette issue sera dans cette catégorie sur la page du sprint actif</li>
</ul>
</td>
      <td>5</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>24</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur une tâche de la page “trello” afin d’afficher toutes ses informations dans une fenêtre qui apparaît.</td>
      <td>2</td>
      <td>Basse</td>
</tr>

   </tbody>
</table>
<hr/>
<p>
Nombre d'issues durant le sprint: <strong>19</strong>
</p>
<p>
Somme de la difficulté des issues du sprint: <strong>47</strong>
</p>
<p>
Somme de la difficulté des issues réalisées du sprint: <strong>36</strong>
</p>
