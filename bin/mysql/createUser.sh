#!/bin/bash
mysql -u "root" -e "CREATE USER 'user'@'%' IDENTIFIED BY '';"
mysql -u "root" -e "GRANT ALL PRIVILEGES ON *.* TO 'user'@'%' WITH GRANT OPTION;"
mysql -u "root" -e "FLUSH PRIVILEGES;"