# Installation

0. Téléchargez la release 2.0.0 du projet <a href="https://ndeguillaume.github.io"> ici </a>

1. Installez la pile logicielle LAMP avec : <code>sudo apt install apache2 php libapache2-mod-php mysql-server php-mysql</code>

2. Installez les modules les plus courants avec : <code>sudo apt install php-curl php-gd php-intl php-json php-mbstring php-xml php-zip</code>

3. Déplacez le projet dans le dossier d'Apache <code>/var/www/html/</code>

4. Créez un nouvel utilisateur 
<pre>
CREATE USER 'user'@'%' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON *.* TO 'user'@'%';
FLUSH PRIVILEGES;
</pre>
 
5. Créez la base de données avec <code>mysql < data/mysql/createDB.sql</code>

6. Si vous le souhaitez, remplissez la base de données avec <code>mysql < data/mysql/fillDB.sql</code>

6. Lancez le serveur Apache s'il n'est pas déjà lancé avec <code>sudo systemctl start apache2</code>

7. Accédez aux site à l'adresse <a href="http://127.0.0.1/">127.0.0.1</a>

# Fonctionnalités
* **Manipuler des sprints** : créer, supprimer, démarrer et terminer des sprints depuis la page *Backlog*
* **Manipuler des issues** : créer dans un sprint spécifique (ou le backlog), modifier, supprimer et déplacer des issues depuis la page *Backlog*  
* **Manipuler des tâches** : créer, modifier et supprimer des tâches depuis la page *Tâches*  
* **Gérer l'avancement des tâches actives** : déplacer une tâche liée à une issue du sprint actif afin de mettre à jour son avancement <i>TODO, IN PROGRESS, DONE</i> depuis la page *Kanban*
* **Manipuler des scénarios de tests** : créer, modifier, valider et supprimer des scénarios de tests unitaires ou E2E depuis la page *Scénarios*  
* **Manipuler des scénarios de tests** : supprimer des tests depuis la page *Tests*. Récupérer des requêtes pour faire une requête de modification du résultat du test depuis un fichier de test et ainsi modifier le test.  
