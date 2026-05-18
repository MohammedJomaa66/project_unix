#!/bin/bash

echo "Adding files::"
git add .

echo "Committing changes::"
git commit -m "auto update"

echo "Pushing to GitHub::"
git push origin main

echo "Done"