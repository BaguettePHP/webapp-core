Contributing
============

Setup
-----

Fork, then clone the repo:

    git clone git@github.com:your-username/baguette.git

Set up your machine:

    rake

Coding Standard
---------------

* [PSR-2 — Coding Style Guide](http://www.php-fig.org/psr/psr-2/)
  * Class name and Interface as *UpperCamelCase*
  * Method name as *lowerCamelCase*
  * Variable name as *snake_case*
* PHPDoc
  * Require [@param](http://phpdoc.org/docs/latest/references/phpdoc/tags/param.html) and [@return](http://phpdoc.org/docs/latest/references/phpdoc/tags/return.html) tag in header of the method declaration.
* Do not use `?>`, [define](http://php.net/manual/function.define.php) and [Variable variables](http://php.net/manual/language.variables.variable.php)
