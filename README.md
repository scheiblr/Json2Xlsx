# Json2Xlsx
This small framework allows to export 1:n data from sql and show them in one xlsx file. 
Therefore, we offer some loader functions as well as some formatting tools.
This php package keeps very simple and is intended to visualize more complex data structures with 
the possibility to not display redundant data.

## Installation
Just install the package using [composer](https://getcomposer.org/).
```bash
composer require uklfr/json2xlsx
```
Afterwards, we recommend to include `vendor/autoload.php`.


## Usage
This packages offers 2 classes which are used to fetch and to format data.
In [example](example/README.md) we prepared a fully featured and runnable use case which you can run 
by just checking out this repository. 

**Note**: These examples do rely on relative paths in the repository. If you want to use this lib in 
production as composer package, we recommend to use the common way of the 
[composer autoloading functionality](https://getcomposer.org/doc/01-basic-usage.md#autoloading).

## Requirements
This package was tested and developed under PHP7 with the following extensions activated:

    - php_zip
    - php_xml
    - php_gd2
    
With `schmittr/php-json2xlsx` we provide a php docker with 
exactly these requirements. Maybe it would also work with PHP>=5.6, but we did not test this. 

## License
This software is distributed by [MIT License](LICENSE).