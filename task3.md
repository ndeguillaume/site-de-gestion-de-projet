# Sprint 3 : 19/11/20 -> 11/12/20

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
            <td>1</td>
            <td>Création du fichier <code>getTestHistory.php</code> qui récupère l'historique d'un test de la base de données.</td>
            <td>La requête renvoie le résultat de la recherche</td>
            <td>30m</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Création du fichier <code>onTestHistoryClicked.js.php</code> qui ajouter une listener sur le clique des boutons historiques. Lorsque l'utilisateur clique sur un bouton, le script envoie une requête à la page getTestHistory.php et affiche le résultat reçu (dates et résultats) dans un tableau dans une fenêtre. L'utilisateur ne peut pas cliquer sur le bouton historique d'un test qui n'a jamais été lancé.</td>
            <td>Lorsque l'on clique sur historique une fenêtre s'ouvre bien affichant les données du test lié</td>
            <td>1h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Création du fichier <code>DeleteDocumentation.php</code> qui supprime une documentation (utilisateur ou installation selon le paramètre de la requête) de la base de données et du sereveur</td>
            <td>La documentation est supprimé de la base de données et du serveur</td>
            <td>1h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Création du fichier <code>DeleteDocumentation.js</code> qui ajoute un listener sur le clique des boutons supprimer. Lorsque l'utilisateur clique sur un bouton, le script envoie une requête à la page DeleteDocumentation.php</td>
            <td>Lorsque l'on clique sur supprimer une fenêtre de validation apparait. Lorsqu'on clique sur supprimer de nouveau une requête est envoyée vers la page et cette dernière DeleteDocumentation.php renvoie true</td>
            <td>30m</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>5</td>
            <td>Création du fichier <code>getTestHistory.php</code> qui récupère l'historique d'un test de la base de données.</td>
            <td>La requête renvoie le résultat de la recherche</td>
            <td>30m</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Création des fichiers <code>UploadInstallDocumentation.php</code> <code>UploadUserDocumentation.php</code> qui enregistrent le fichier donné sur le serveur dans le dossier <code>file/install_documentation</code> ou <code>file/user_documentation</code> et qui ajoutent le (chemin du) document à la base de donnée.</td>
            <td>Le fichier se trouve sur le serveur au bon endroit et que le document a bien été créé dans la base de données</td>
            <td>2h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>7</td>
            <td>Création des fichiers <code>UsePreviousInstallDocumentation.php</code> et <code>UsePreviousUserDocumentation.php</code> ajoute comme document (installation ou utilisateur) courant le même document que celui que l'on souhaite réutiliser.</td>
            <td>Le document a bien été créé dans la base de données et est le même que l'historique sur lequel on a cliqué</td>
            <td>1h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>8</td>
            <td>Création du fichier <code>Documentation.php</code> qui affiche 2 catégories : documentation utilisateur et documentation d'installation. Si aucun document actif n'est créé, il y a une formulaire avec un input file à sélectionner et un bouton valider. Si il y a un document actif il y a son nom, un bouton supprimer et un bouton télécharger. Le bouton supprimer envoie une requête à la base <code>DeleteDocumentation.php</code>. S'il y a un historique de documentation utilisateur ou installation dans ce cas là il y a affiché en bas de chaque catégorie un bouton "réutiliser la documentation X" qui envoie une requête à <code>UsePreviousInstallDocumentation.php</code> ou <code>UsePreviousUserDocumentation.php</code></td>
            <td>3h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>9</td>
            <td>Création des fichiers <code>InstallDocumentation.php</code> et <code>UseDocumentation.php</code> qui implémentent les fonctions read(), create(path) et delete pour accéder à la base de données</td>
            <td>Les méthodes renvoient toutes true ou un tableau de résultat</td>
            <td>1h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>10</td>
            <td>Création des fichiers <code>InstallDocumentationHistory.php</code> et <code>UseDocumentationHistory.php</code> qui implémentent les fonctions get() et create(path) pour accéder à la base de données</td>
            <td>Les méthodes renvoient toutes true ou un tableau de résultat</td>
            <td>1h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>11</td>
            <td>Création du fichier <code>CreateRelease.js</code> qui ajoute un listener sur le clique de "ajouter une release". Une fenêtre apparait alors dans laquelle il y a, si un sprint est en cours : un input file, un liste de boutons radios pour sélectionner si la release est major minor ou patch et une liste des issues terminées liées à la release générées automatiquement. Si il n'y a pas de sprint en cours la release est par défaut un patch et il ne peut que upload une archive. Lorsqu'un utilisateur appuie sur valider, une requête est envoyée à la page <code>CreateRelease.php</code>. Lorsque la fenêtre est ouverte une requête est envoyée à la page <code>GetRelease.php</code> afin de récupérer des informations sur la dernière release 
            </td>
            <td>Lorsque je clique sur ajouter une release une fenêtre apparait avec les bons champs disponibles (si sprint courant ou non) et lorsque je clique sur valider la requête renvoie true</td>
            <td>2h</td>
            <td></td>
            <td></td>
            <td>Fabien, Pierre</td>
            <td></td>
        </tr>
        <tr>
            <td>12</td>
            <td>Création du fichier <code>GetRelease.php</code> qui récupère le dernier numéro de la release mineure, majeure et patch ainsi que la liste des issues terminées du sprint courant et le renvoie</td>
            <td>La requête renvoie le résultat de la recherche</td>
            <td>2h</td>
            <td></td>
            <td></td>
            <td>Fabien</td>
            <td></td>
        </tr>
        <tr>
            <td>13</td>
            <td>Création du fichier <code>Release.php</code> qui implémentent les fonctions read(), create(path), delete(project_id, id), addFinishedIssue(project_id, release_id, issue_id), getLastRelease(), getAllRelease() et getFinishedIssues(project_id, release_id) pour accéder à la base de données</td>
            <td>Les méthodes renvoient toutes true ou un tableau de résultat</td>
            <td>2h</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
        <tr>
            <td>14</td>
            <td>Création du fichier <code>Release.php</code> qui affiche un tableau des releases contenant la version, date, issues réalisées, lien de téléchargement de l'archive, lien de téléchargement de la doc utilisateur et lien de téléchargement de la doc installation. Il y a un bouton ajouter une release en bas de la page.</td>
            <td>La page affiche bien un tableau contenant toutes les releases et avec les bonnes colonnes</td>
            <td>2h</td>
            <td></td>
            <td></td>
            <td>Fabien, Pierre</td>
            <td></td>
        </tr>
        <tr>
            <td>15</td>
            <td>Création du fichier <code>getTestHistory.php</code> qui récupère l'historique d'un test de la base de données.</td>
            <td>La requête renvoie le résultat de la recherche</td>
            <td>30m</td>
            <td></td>
            <td></td>
            <td>Nicolas</td>
            <td></td>
        </tr>
   </tbody>
</table>