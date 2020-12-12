#!/bin/sh

# Run a container in the background that says Hello every second for 5s.
docker-compose up -d

# In the run command we named the container "testwait", so we're using it
# here. We could pass in the container ID instead too.
status_code="$(docker container wait projet-cdp-test-cypress)"

# You won't see this message for 5 seconds, and the status code will be
# whatever the container exited with. It will be 0 in this case since the loop
# will exit successfully.
echo "Status code of last run command: ${status_code}"
docker logs projet-cdp-test-cypress
docker-compose down

