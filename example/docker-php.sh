#!/usr/bin/env bash

if [ -z $1 ]; then
    echo "please define a file which should be run:"
    echo "   ./docker-php.sh somefile.php"
    exit
fi

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