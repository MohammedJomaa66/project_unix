#!/bin/bash

echo "Pulling latest code..."
git pull origin master

echo "Stopping containers..."
docker compose down

echo "Building and starting containers..."
docker compose up -d --build

echo "Done! Application deployed."