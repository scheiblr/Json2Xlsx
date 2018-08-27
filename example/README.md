# Json2Xlsx Examples

This example framework shows a simple model of the usage of this package.


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
