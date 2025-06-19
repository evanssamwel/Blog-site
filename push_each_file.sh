#!/bin/bash

# Loop through all files, including files in subfolders
FILES=$(find . -type f ! -path "./.git/*")

for FILE in $FILES; do
  git add "$FILE"
  git commit -m "Added file: $FILE"
  echo "Committed: $FILE"
done

# Push all commits
git push origin main
