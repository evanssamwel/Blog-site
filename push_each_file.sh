#!/bin/bash

# Make sure you're in the root of your Git repository
REPO_DIR=$(pwd)

# Find all files (excluding .git directory)
FILES=$(find . -type f ! -path "./.git/*")

for FILE in $FILES; do
  git add "$FILE"
  git commit -m "Added file: $FILE"
  echo "Committed: $FILE"
done

# Push all commits to remote
git push origin main
