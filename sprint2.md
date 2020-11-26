# Sprint 2 : 16/11/20 -> 29/11/20

<table>
  <tbody>
      <th>ID</th>
      <th>US</th>
      <th>Coût</th>
      <th>Priorité</th>
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
      <td>Haute</td>
</tr>
<tr>
      <td>24</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur une tâche de la page “trello” afin d’afficher toutes ses informations dans une fenêtre qui apparaît.</td>
      <td>2</td>
      <td>Basse</td>
</tr>
<tr>
      <td>25</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir avoir accès à une page “liste des tests” qui contient tous les tests de mon projet. Pour chaque test,  il y a d’affiché l’identifiant, le titre, le dernier lancement, le résultat et un bouton “visionner le test” qui affiche la vidéo du dernier lancement du test. En haut de la page je vois le taux de réussite de tous les tests de la liste</td>
      <td>2</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>26</td>
      <td>En tant qu’utilisateur, je souhaite avoir accès à une page “scénarios de tests” où je peux voir tous les scénarios de test que j’ai proposés</td>
      <td>2</td>
      <td>Très basse</td>
</tr>

<tr>
      <td>27</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir, depuis la page “scénarios de tests”, appuyer sur un bouton “+” qui ouvre un formulaire contenant un champs texte “scénario”. Lorsque je valide le scénario, ce dernier est ajouté à la liste de scénario.</td>
      <td>1</td>
      <td>Très haute</td>
</tr>

<tr>
      <td>28</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir, depuis la page “scénarios de tests”, appuyer sur un bouton “Modifier” en face d’un scénario qui ouvre un formulaire avec un champs texte pré-rempli avec le scénario correspondant, et qui est modifiable.
</td>
      <td>2</td>
      <td>Basse</td>
</tr>
<tr>
      <td>29</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir, depuis la page “scénarios de tests”, appuyer sur un bouton “Valider” en face d’un scénario et le rajouter dans la liste des tests et rediriger vers la page “liste des tests”.</td>
      <td>2</td>
      <td>Très haute</td>
</tr>
<tr>
      <td>30</td>
      <td>En tant qu’utilisateur, je souhaite que lorsque que j’ai validé un scénario sur la page “scénarios de tests” et que je suis redirigé vers la page “liste des tests”, qu’une fenêtre s’ouvre alors dans laquelle je dois renseigner :
<ul>
<li>le titre du test dans une boîte de texte
le type du test (fonctionnel, intégration, unitaire) à sélectionner à l’aide d’une liste déroulante </li>
<li>si le type de test est fonctionnel je sélectionne une issue dans une liste déroulante pour associer le test à l’issue</li>
<li>si le test passe en cochant une une boîte “OK” ou ne passe pas en cochant une boîte “KO”. Lorsque je coche une boîte, un calendrier apparaît : je dois cliquer sur une date afin de renseigner la date à laquelle le test est ou n’est pas passé</li>
</ul>
Un bouton "Test en cypress" est présent sous ces champs, si j'appuie dessus, un bouton "Upload une video" apparait. Lorsque j'appuie sur ce bouton, un explorateur de fichier s'ouvre pour que j'upload une vidéo du test.
Je ne peux pas valider la création à moins d’avoir tout renseigné mais je peux l’annuler. 
Je peux éventuellement renseigner une boîte de texte “commentaire”.
L’identifiant du test est généré automatiquement.
</td>
      <td>3</td>
      <td>Très haute</td>
</tr>
<tr>
      <td>31</td>
      <td> En tant qu’utilisateur, je souhaite pouvoir cliquer sur un test ce qui ouvre une fenêtre où je peux sélectionner à quelle date du test je veux accéder. Pour une date sélectionnée je peux lire :
      <ul>
<li>le résultat de cette date du test</li>
<li>la vidéo de cette date du test si elle existe</li>
<li>le commentaire de cette date du test</li>
</ul>
et je peux lire, peu importe la date : 
<ul>
<li>l’identifiant</li>
<li>le titre</li>
<li>le résultat attendu</ul>
</ul>
</td>
      <td>3</td>
      <td>Haute</td>
</tr>
<tr>
      <td>32</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “x” présent à gauche de chaque test sur la page “liste des tests” afin de supprimer le test. Une fenêtre de validation apparaît alors me demandant de valider mon choix ou d’annuler.</td>
      <td>2</td>
      <td>Haute</td>
</tr>
<tr>
      <td>33</td>
      <td>En tant qu’utilisateur, je souhaite pouvoir cliquer sur un bouton “Tester à nouveau” présent à droite de chaque test sur la page “liste des tests” afin de le tester à nouveau. Une fenêtre apparaît dans laquelle je dois renseigner :
      <ul>
<li>si le test passe en cochant une une boîte “OK” ou ne passe pas en cochant une boîte “KO”. Lorsque je coche une boîte, un calendrier apparaît : je dois cliquer sur une date afin de renseigner la date à laquelle le test est ou n’est pas passé</li>
<li>une vidéo du test en explorant mes fichiers pour uploader la vidéo, si le test est réalisé en cypress.</li>
</ul>
Je peux éventuellement renseigner un boîte de texte “commentaire”.
</td>
      <td>3</td>
      <td>Très haute</td>
</tr>
   </tbody>
</table>
<hr/>
<p>
Nombre d'issues durant le sprint: <strong>11</strong>
</p>
<p>
Somme de la difficulté des issues du sprint: <strong>27</strong>
</p>
<p>
Somme de la difficulté des issues réalisées du sprint: <strong></strong>
</p>
