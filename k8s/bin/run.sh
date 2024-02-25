#!/bin/bash

main() {
    docker build -t backend:latest -f ./docker/backend.Dockerfile ./../../docker
    docker build -t frontend:latest -f ./docker/frontend.Dockerfile ./../../docker
    docker build -t database:latest -f ./docker/database.Dockerfile ./../../docker
    cd ..
    kubectl apply -f deployment.yaml
}

main