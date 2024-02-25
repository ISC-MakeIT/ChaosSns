#!/bin/bash

main() {
    docker build -t backend:latest -f ./../../docker/backend.Dockerfile ./
    docker build -t frontend:latest -f ./../../docker/frontend.Dockerfile ./
    docker build -t database:latest -f ./../../docker/database.Dockerfile ./
    cd ..
    kubectl apply -f deployment.yaml
}

main