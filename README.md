# Prérequis

<a href="https://www.docker.com/get-started">Docker doit être installé sur la machine</a>

# Installation

1. Télécharger la release (docker) 3.0.0 du projet <a href="https://ndeguillaume.github.io"> ici </a>

2. Décompresser l'archive avec la commande <code>tar xf 3.0.0_docker.tar.gz</code>

3. Lancer le docker du projet avec la commande <code>sh deploy.sh</code>
4. Accédez au site à l'adresse <a href="http://127.0.0.1/">127.0.0.1</a>

# Fonctionnalités
* **Manipuler des sprints** : créer, supprimer, démarrer et terminer des sprints depuis la page *Backlog*
* **Manipuler des issues** : créer dans un sprint spécifique (ou le backlog), modifier, supprimer et déplacer des issues depuis la page *Backlog*  
* **Manipuler des tâches** : créer, modifier et supprimer des tâches depuis la page *Tâches*  
* **Gérer l'avancement des tâches actives** : déplacer une tâche liée à une issue du sprint actif afin de mettre à jour son avancement <i>TODO, IN PROGRESS, DONE</i> depuis la page *Kanban*
* **Manipuler des scénarios de tests** : créer, modifier, valider et supprimer des scénarios de tests unitaires ou E2E depuis la page *Scénarios*  
* **Manipuler des tests** : supprimer des tests depuis la page *Tests*. Récupérer des requêtes pour faire une requête de modification du résultat du test depuis un fichier de test et ainsi modifier le test.  
* **Accéder à l'historique de chaque test** : accéder à l'historique de chaque tests depuis la page *Tests*. Une fenêtre s'ouvre pour afficher le ratio succès/echec d'un test et son historique (date et résultat) 
* **Manipuler une release** : créer, modifier et supprimer une release depuis la page *Releases*. Lorsqu'un utilisateur choisit de terminer un sprint manuellement, ce dernier doit créer une release dans la fenêtre qui apparaît. 

# Tests

## E2E - Cypress
1. Se rendre dans le dossier <code>e2e/</code>

2. Lancer le docker des tests end 2 end avec la commande <code>sh test.sh</code>. Cela lance les tests dans le dossier <code>cypress/integration/examples</code>

3. Le résultat des tests sera affiché dans la console. Des vidéos des tests sont enregistrées dans <code>e2e/cypress/videos</code>. Des captures d'écran des tests sont enregistrées dans <code>e2e/cypress/screenshots</code>

## Unitaire - PHPUnit
1. Se rendre dans le dossier <code>unit/</code>

2. Lancer le docker des tests unitaires avec la commande <code>sh init.sh</code>. Cela lance les tests qui sont dans le dossier <code>tests</code>

3. Le résultat des tests sera affiché et enregistré dans le fichier <code>results.xml</code>
