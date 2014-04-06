# FlorianWolters\Component\Util\Reflection

[![Build Status](https://secure.travis-ci.org/FlorianWolters/PHP-Component-Util-Reflection.png?branch=master)](http://travis-ci.org/FlorianWolters/PHP-Component-Util-Reflection)
[![Latest Stable Version](https://poser.pugx.org/florianwolters/component-util-reflection/version.png)](https://packagist.org/packages/florianwolters/component-util-reflection)
[![Latest Unstable Version](https://poser.pugx.org/florianwolters/component-util-reflection/v/unstable.png)](https://packagist.org/packages/florianwolters/component-util-reflection)

| Period of Time         | Number of Downloads                                                                                                                                                      |
| ----------------------:|:------------------------------------------------------------------------------------------------------------------------------------------------------------------------:|
| <small>Total</small>   | [![Total Downloads](https://poser.pugx.org/florianwolters/component-util-reflection/downloads.png)](https://packagist.org/packages/florianwolters/component-util-reflection)   |
| <small>Monthly</small> | [![Monthly Downloads](https://poser.pugx.org/florianwolters/component-util-reflection/d/monthly.png)](https://packagist.org/packages/florianwolters/component-util-reflection) |
| <small>Daily</small>   | [![Daily Downloads](https://poser.pugx.org/florianwolters/component-util-reflection/d/daily.png)](https://packagist.org/packages/florianwolters/component-util-reflection)     |

**FlorianWolters\Component\Util\Reflection** is a simple-to-use [PHP][17] component that provides operations for the [PHP Reflection Application Programming Interface (API)][26].

## Table of Contents (ToC)

* [Introduction](#introduction)
* [Features](#features)
* [Requirements](#requirements)
* [Usage](#usage)
* [Installation](#installation)
  * [Local Installation](#local-installation)
  * [System-Wide Installation](#system-wide-installation)
* [As A Dependency On Your Component](#as-a-dependency-on-your-component)
  * [Composer](#composer)
  * [PEAR](#pear)
* [Development Environment](#development-environment)
* [Contributing](#contributing)
* [Credits](#credits)
* [License](#license)

## Introduction

**FlorianWolters\Component\Util\Reflection** consists of one artifact:

* The static class [`FlorianWolters\Component\Util\ReflectionUtils`][27]: Provides methods which simplify the usage of the [PHP Reflection Application Programming Interface (API)][26].

## Features

* Artifacts tested with both static and dynamic test procedures:
    * Dynamic component tests (unit tests) implemented using [PHPUnit][19].
    * Static code analysis performed using the following tools:
        * [PHP_CodeSniffer][14]: Style Checker
        * [PHP Mess Detector (PHPMD)][18]: Code Analyzer
        * [phpcpd][4]: Copy/Paste Detector (CPD)
        * [phpdcd][5]: Dead Code Detector (DCD)
* Installable via [Composer][3] or the [PEAR command line installer][11]:
    * Provides a [Packagist][25] package which can be installed using the dependency manager [Composer][3].
        * Click [here][24] for the package on [Packagist][25].
    * Provides a [PEAR package][13] which can be installed using the package manager [PEAR installer][11].
        * Click [here][9] for the [PEAR channel][12].
* Provides a complete Application Programming Interface (API) documentation generated with the documentation generator [phpDocumentor][2].
    * Click [here][1] for the current API documentation.
* Follows the following "standards" from the [PHP Framework Interoperability Group (FIG)][29]. PSR stands for PHP Standards Recommendation:
    * [PSR-0][6]: Autoloading Standards

        > Aims to provide a standard file, class and namespace convention to allow plug-and-play code.
    * [PSR-1][7]: Basic Coding Standard

        > Aims to ensure a high level of technical interoperability between shared PHP code.
    * [PSR-2][8]: Coding Style Guide

        > Provides a Coding Style Guide for projects looking to standardize their code.
    * [PSR-4][28]: Autoloader

        > A more modern take on autoloading reflecting advances in the ecosystem.
* Follows the [Semantic Versioning][20] Specification (SemVer) 2.0.0-rc.1.

## Requirements

* [PHP][17] >= 5.4
* [Composer][3]

## Usage

The best documentation for **FlorianWolters\Component\Util\Reflection** are the unit tests, which are shipped in the package. You will find them installed into your [PEAR][10] repository, which on Linux systems is normally `/usr/share/php/test`.

## Installation

### Local Installation

**FlorianWolters\Component\Util\Reflection** should be installed using the dependency manager [Composer][3]. [Composer][3] can be installed with [PHP][6].

    php -r "eval('?>'.file_get_contents('http://getcomposer.org/installer'));"

> This will just check a few [PHP][17] settings and then download `composer.phar` to your working directory. This file is the [Composer][3] binary. It is a PHAR ([PHP][17] archive), which is an archive format for [PHP][17] which can be run on the command line, amongst other things.
>
> Next, run the `install` command to resolve and download dependencies:

    php composer.phar install

### System-Wide Installation

**FlorianWolters\Component\Util\Reflection** should be installed using the [PEAR installer][11]. This installer is the [PHP][17] community's de-facto standard for installing [PHP][17] components.

    pear channel-discover pear.florianwolters.de
    pear install --alldeps fw/Reflection

## As A Dependency On Your Component

### Composer

If you are creating a component that relies on **FlorianWolters\Component\Util\Reflection**, please make sure that you add **FlorianWolters\Component\Util\Reflection** to your component's `composer.json` file:

```json
{
    "require": {
        "florianwolters/component-util-reflection": "0.3.*"
    }
}
```

### PEAR

If you are creating a component that relies on **FlorianWolters\Component\Util\Reflection**, please make sure that you add **FlorianWolters\Component\Util\Reflection** to your component's `package.xml` file:

```xml
<dependencies>
  <required>
    <package>
      <name>Reflection</name>
      <channel>pear.florianwolters.de</channel>
      <min>0.3.0</min>
      <max>0.3.99</max>
    </package>
  </required>
</dependencies>
```

## Development Environment

If you want to patch or enhance this component, you will need to create a suitable development environment. The easiest way to do that is to install [phix4componentdev][16]:

    # phix4componentdev
    pear channel-discover pear.phix-project.org
    pear install phix/phix4componentdev

You can then clone the Git repository:

    # PHP-Component-Util-Reflection
    git clone http://github.com/FlorianWolters/PHP-Component-Util-Reflection

Then, install a local copy of this component's dependencies to complete the development environment:

    # build vendor/ folder
    phing build-vendor

To make life easier for you, common tasks (such as running unit tests, generating code review analytics, and creating the [PEAR package][13]) have been automated using [phing][15]. You'll find the automated steps inside the `build.xml` file that ships with the component.

Run the command `phing` in the component's top-level folder to see the full list of available automated tasks.

## License

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Lesser General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License along with this program. If not, see <http://gnu.org/licenses/lgpl.txt>.

[1]: http://blog.florianwolters.de/PHP-Component-Util-Reflection
     "FlorianWolters\Component\Util | Application Programming Interface (API) documentation"
[2]: http://phpdoc.org
     "phpDocumentor 2"
[3]: http://getcomposer.org
     "Composer"
[4]: https://github.com/sebastianbergmann/phpcpd
     "sebastianbergmann/phpcpd · GitHub"
[5]: https://github.com/sebastianbergmann/phpdcd
     "sebastianbergmann/phpdcd · GitHub"
[6]: http://php-fig.org/psr/psr-0
     "PSR-0: Autoloading Standards"
[7]: http://php-fig.org/psr/psr-1
     "PSR-1: Basic Coding Standard"
[8]: http://php-fig.org/psr/psr-2
     "PSR-2: Coding Style Guide"
[9]: http://pear.florianwolters.de
     "PEAR channel of Florian Wolters"
[10]: http://pear.php.net
      "PEAR - PHP Extension and Application Repository"
[11]: http://pear.php.net/manual/en/guide.users.commandline.cli.php
      "Manual :: Command line installer (PEAR)"
[12]: http://pear.php.net/manual/en/guide.users.concepts.channel.php
      "Manual :: PEAR Channels"
[13]: http://pear.php.net/manual/en/guide.users.concepts.package.php
      "Manual :: PEAR Packages"
[14]: http://pear.php.net/package/PHP_CodeSniffer
      "PHP_CodeSniffer"
[15]: http://phing.info
      "Phing"
[16]: https://github.com/stuartherbert/phix4componentdev
      "stuartherbert/phix4componentdev · GitHub"
[17]: http://php.net
      "PHP: Hypertext Preprocessor"
[18]: http://phpmd.org
      "PHPMD - PHP Mess Detector"
[19]: http://phpunit.de
      "sebastianbergmann/phpunit · GitHub"
[20]: http://semver.org
      "Semantic Versioning"
[24]: http://packagist.org/packages/florianwolters/component-util-reflection
      "florianwolters/component-util-reflection - Packagist"
[25]: http://packagist.org
      "Packagist"
[26]: http://php.net/book.reflection
      "PHP: Reflection"
[27]: src/php/FlorianWolters/Component/Util/ReflectionUtils.php
      "FlorianWolters\Component\Util\ReflectionUtils"
[28]: http://php-fig.org/psr/psr-4
      "PSR-4: Improved Autoloading"
[29]: http://php-fig.org
      "PHP-FIG — PHP Framework Interop Group"
