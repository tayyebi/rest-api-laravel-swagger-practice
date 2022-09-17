#!/usr/bin/env bash

# Set container name constraint
IMAGE_NAME="demo-api"
CONTIANER_NAME=$IMAGE_NAME

# Current bash file directory
SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

# Build and run the docker container
docker container stop $IMAGE_NAME
docker container rm $IMAGE_NAME
docker build -t $IMAGE_NAME .
docker run \
    --name $CONTIANER_NAME \
    --network=mysql_mysql \
    --volume=$SCRIPT_DIR:/usr/src/data \
    --restart=always \
    -d \
    -p 8000:8000 \
    -it $IMAGE_NAME \

# docker exec $IMAGE_NAME bash ./script.sh