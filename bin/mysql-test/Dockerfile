FROM mysql:5.7
ADD init.sql /docker-entrypoint-initdb.d/
ADD createUser.sh /docker-entrypoint-initdb.d/
RUN chown -R mysql:mysql /docker-entrypoint-initdb.d/
CMD ["mysqld", "--character-set-server=utf8mb4", "--collation-server=utf8mb4_unicode_ci"]
ENV MYSQL_ALLOW_EMPTY_PASSWORD='yes'
EXPOSE 3306
