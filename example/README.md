# Json2Xlsx Examples

This example framework shows a simple model of the usage of this package.

## Usage
You can simply try the package out by first starting the database and then running the script.
The requirements are docker-compose and docker.

```bash
# starting the database
docker-compose up -d

# running a command
docker-php.sh example1.php
```

## Database
In `db` we show a sample database structure. Use this design to built you own export views an functions.

## Sample Data:

Use [datafiller](https://github.com/memsql/datafiller). You can just download it there:

```
    wget -q https://raw.githubusercontent.com/memsql/datafiller/master/datafiller -O /usr/local/bin/datafiller \
	    && chmod +x /usr/local/bin/datafiller
```
Name word lists from [here](http://www.outpost9.com/files/WordLists.html).
```
    cat db/src/tables.sql | datafiller > db/src/data.sql
```
