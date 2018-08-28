#!/usr/bin/env bash

docker run \
        --net json2xlsx-example_default \
        -it \
        --rm \
        --link json2xlsx-example_db_1 \
        --name docker-php \
        -v "$PWD/../":/usr/src/myapp \
        -w /usr/src/myapp/example \
        -u `id -u $USER` \
        schmittr/php-json2xlsx php $1