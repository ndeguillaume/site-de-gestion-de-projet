# Installation

0. Téléchargez la dernière release du projet <a href="https://github.com/ndeguillaume/g2-eq3-release"> ici </a>

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

6. Remplissez la base de données avec <code>mysql < data/mysql/fillDB.sql</code>

6. Lancez le serveur Apache s'il n'est pas déjà lancé avec <code>sudo systemctl start apache2</code>

7. Accédez aux site à l'adresse <a href="http://127.0.0.1/">127.0.0.1</a>

