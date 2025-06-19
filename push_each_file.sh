#!/bin/bash

# Find all untracked or modified files (excluding .git directory)
FILES=$(git ls-files --others --modified --exclude-standard)

for FILE in $FILES; do
  git add "$FILE"
  git commit -m "Added or updated: $FILE"
  echo "Committed: $FILE"
done

# Push all commits
git push origin main
