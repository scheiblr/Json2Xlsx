# Json2Xlsx Examples

This example framework shows a simple model of the usage of this package.

## Usage
You can simply try out the package by first starting the database and then running the script.
Please install all packages in the root folder of this project with composer. The requirements are docker-compose, docker and composer.

```bash
# install composer packages
cd .. 
composer install --ignore-platform-reqs
cd example

# starting the database
docker-compose up -d

# running a command
./docker-php.sh example1.php
```

## Database
In `db` we show a sample database structure. Use this design to built you own export views an functions.

## Sample Data:

We generated the sample data wirh [datafiller](https://github.com/memsql/datafiller) based on the word lists of which we 
took the name lists from [here](http://www.outpost9.com/files/WordLists.html). You can download it there datafiller as follows:

```bash
    wget -q https://raw.githubusercontent.com/memsql/datafiller/master/datafiller -O /usr/local/bin/datafiller \
	    && chmod +x /usr/local/bin/datafiller
```
