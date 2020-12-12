FROM mysql:5.7
ADD init.sql /docker-entrypoint-initdb.d/
ADD createUser.sh /docker-entrypoint-initdb.d/
RUN apt-get update && apt-get install -y locales && rm -rf /var/lib/apt/lists/* $ && localedef -i en_US -c -f UTF-8 -A /usr/share/locale/locale.alias en_US.UTF-8 
ENV LANG en_US.utf8
RUN chown -R mysql:mysql /docker-entrypoint-initdb.d/

CMD ["mysqld", "--character-set-server=utf8mb4", "--collation-server=utf8mb4_unicode_ci"]
ENV MYSQL_ALLOW_EMPTY_PASSWORD='yes'
EXPOSE 3306
