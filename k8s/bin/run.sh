#!/bin/bash

main() {
    docker build -t backend:latest ./../../docker/backend.Dockerfile
    docker build -t frontend:latest ./../../docker/frontend.Dockerfile
    docker build -t database:latest ./../../docker/database.Dockerfile
    cd ..
    kubectl apply -f deployment.yaml
}

main