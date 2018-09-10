# SemExpert_FixSalesDecimals

This module implements the fix from https://github.com/magento/magento2/pull/14346 and is meant to be used with Magento 
2.2.x

[![Build Status](https://travis-ci.org/SemExpert/SemExpert_FixSalesDecimals.svg?branch=master)](https://travis-ci.org//SemExpert/SemExpert_FixSalesDecimals)

## References

* [Issue #14328](https://github.com/magento/magento2/issues/14328) - Qty to ship and Qty to invoice are handling decimals poorly
* [PR #14346](https://github.com/magento/magento2/pull/14346) - Fixed decimal handling in order quantities

## Getting Started

### Prerequisitos

The module requires a completely installed and functional copy of Magento 2.2

### Installation

Add the module as a dependency to your Magento project 

Edit composer.json

```json
{
  "require": {
    "semexpert/module-fix-sales-decimals": "1.0.0"
  }
}
```

then

```bash
php composer.phar install
```

or with `composer require`

```bash
php composer.phar require semexpert/module-fix-sales-decimals
```

After installing the package, you need to enable the module from Magento CLI

```bash
php bin/magento module:enable SemExpert_FixSalesDecimals
```

## Running the tests

All the included tests can be run from the Magento CLI. Refer to the 
[documentation](https://devdocs.magento.com/guides/v2.2/config-guide/cli/config-cli-subcommands-test.html).

### Included tests

The same tets that were included in the original Pull Request are provided but as integration tests.

There are additional unit tests specific for the plugin funcionality.

### Coding Styles

All the provided code follows the 
[Magento 2 coding standard](https://devdocs.magento.com/guides/v2.2/coding-standards/bk-coding-standards.html).

## Deployment

This module should not be used in Magento 2.3+ as the referenced fixes have already been applied. This is reflected on 
the version dependencies so you will need to explicitly remove it to upgrade Magento.

```bash
php composer.phar remove semexpert/module-fix-sales-decimals
```

You should also consider removing it if the fix ever makes it into Magento 2.2.

## Magento 2

### Components

2 plugins are provided. One for `Magento\Sales\Order\Item::getSimpleQtyToShip()` and one for 
`Magento\Sales\Order\Item::getQtyToInvoice()` 

## Versioning

We use [SemVer](http://semver.org/) for versioning. To see all available versions, check the 
[tags for this repository](https://github.com/SemExpert/SemExpert_FixSalesDecimals/tags). 

## Autores

* **Matías Montes** - *Original core fix and initial version of this module* - [barbazul](https://github.com/barbazul)

Also check the list of [contributors](https://github.com/SemExpert/SemExpert_FixSalesDecimals/contributors) who 
collaborated in this project.

## License

This module is licensed under the [MIT License](/LICENSE). 

