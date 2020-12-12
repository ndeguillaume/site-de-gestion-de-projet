#!/bin/bash
cp sample.env .env
docker-compose up --exit-code-from phpunit
docker-compose down
