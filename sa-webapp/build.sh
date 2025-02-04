#!/bin/bash
DOCKER_REGISTRY=docker.io
DOCKER_PROJECT_ID=djkormo
SERVICE_NAME=sa-webapp
DOCKER_IMAGE_NAME=$DOCKER_PROJECT_ID/$SERVICE_NAME
DOCKER_IMAGE_REPO_NAME=$DOCKER_REGISTRY/$DOCKER_IMAGE_NAME

echo "DOCKER_REGISTRY: $DOCKER_REGISTRY"
echo "DOCKER_PROJECT_ID: $DOCKER_PROJECT_ID"
echo "SERVICE_NAME: $SERVICE_NAME"
echo "DOCKER_IMAGE_NAME: $DOCKER_IMAGE_NAME"
echo "DOCKER_IMAGE_REPO_NAME: $DOCKER_IMAGE_REPO_NAME"

#  build 

docker build -t $SERVICE_NAME . -f Dockerfile

# tag

docker tag $SERVICE_NAME $DOCKER_IMAGE_NAME 

#push

docker push  $DOCKER_IMAGE_NAME

