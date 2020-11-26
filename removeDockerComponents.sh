#!/bin/bash
docker-compose down
docker image rm -f $(docker images -a)
docker volume rm -f $(docker volume ls -q)
docker volume prune
docker image prune
docker system prune

