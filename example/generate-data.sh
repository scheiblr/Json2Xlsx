#!/usr/bin/env bash

cat db/src/tables.sql | datafiller > db/src/data.sql

while true ; do
  echo "Working..."
  cat db/src/tables.sql | datafiller > db/src/data.sql

  result=$(grep -nE '\\N' db/src/data.sql) # -n shows line number

  echo "DEBUG: Result found is $result"
  if [ -z ${result} ]
  then
    echo "COMPLETE!"
    break
  fi
#  sleep 1
done