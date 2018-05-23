# XML Schema processor for PHP

**Table of contents**
* [About the project](#about-the-project)
* [License](#license)
* [Contributing](#contributing)
* [Install](#istall)
* [Getting started](#getting-started)

## About the project

PHP includes the DOM and SimpleXML features to read and manipulate XML documents.  But it does not provide a mechanism to
parse schema documents and build a respository of type information from XML schema documents (.xsd).  This project provides 
a light-weight means to parse  schema files and make the type information in them available to an application.  

Type information can be exported to and imported from JSON files to improve performance when schema documents are used regularly.

This project is not a full implementation of the XML Schema specification supporting all the particles and components
defined in the XML Schema specification.  Instead it generates a list of the elements, attributes and types defined
by one or more schemas.  These lists can then be accessed as collection of indexed arrays.

### Motivation

This project is standalone but is part of the XBRL project.  XBRL makes extensive use of XML Schema documents to define 
the elements, attributes and types used in its taxonomies.  Validation of these taxonomies cannot take place without 
reference to the element, attribute and type information defined in the XML schema documents.

### Dependencies

This project depends on [pear/log](https://github.com/pear/Log

## License

This project is released under [GPL version 3.0](LICENCE)

**What does this mean?**

It means you can use the source code in any way you see fit.  However, the source code for any changes you make must be made available to others and must be made
available on the same terms as you receive the source code in this project: under a GPL v3.0 license.  You must include the license of this project with any
distribution of the source code whether the distribution includes all the source code or just part of it.  For example, if you create a class that derives 
from one of the classes provided by this project - a new taxonomy class, perhaps - that is derivative.

**What does this not mean?**

It does *not* mean that any products you create that only *use* this source code must be released under GPL v3.0.  If you create a budgeting application that uses
the source code from this project to access data in instance documents, used by the budgeting application to transfer data, that is not derivative. 

## Contributing

We welcome contributions.  See our [contributions page](https://gist.github.com/bseddon/cfe04753192087c82766bee583f519aa) for more information.  If you do choose
to contribute we will ask you to agree to our [Contributor License Agreement (CLA)](https://gist.github.com/bseddon/cfe04753192087c82766bee583f519aa).  We will 
ask you to agree to the terms in the CLA to assure other users that the code they use is not going to be encumbered by a labyrinth of different license and patent 
liabilities.  You are also urged to review our [code of conduct](CODE_OF_CONDUCT.md).

## Install

The project can be installed by [composer](https://getcomposer.org/).   Assuming Composer is installed and a shortcut to the program is called 'composer'
then the command to install this project is:

```
composer require lyquidity/xml:dev-master --prefer-dist
```

Or fork or download the repository.  The source can be found in the 'source' sub-folder.

## Getting started

The examples folder includes illustrations of using the library to read schema type information and apply it to XML instant documents.

Assuming you have installed the library using composer then this PHP application will run the test:

```
<?php
require_once __DIR__ . '/vendor/autoload.php';
include __DIR__ . "/vendor/lyquidity/xml/examples/examples.php";
```

