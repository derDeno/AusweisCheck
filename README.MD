#  AusweisCheck Library

[![GitHub license](https://img.shields.io/github/license/derDeno/AusweisCheck.svg)](https://github.com/derDeno/AusweisCheck) [![GitHub issues](https://img.shields.io/github/issues/derDeno/AusweisCheck.svg)](https://github.com/derDeno/AusweisCheck/issues) [![GitHub forks](https://img.shields.io/github/forks/derDeno/AusweisCheck.svg)](https://github.com/derDeno/AusweisCheck/network) [![GitHub stars](https://img.shields.io/github/stars/derDeno/AusweisCheck.svg)](https://github.com/derDeno/AusweisCheck/stargazers)

AusweisCheck is a library for PHP and JavaScript to check the authenticity of an ID card with a few lines. It can check EU identity cards, or alternatively international passports including the nationality.

*ausweischeck.min.js* is only **2 KB** and need only **one line of code**!


##  Sample Code
For all languages there are examples of usage in the *examples* folder. PHP is only executable on a dedicated server, The JavaScript can be tested local

Sample IDs:

**EU ID:** T220001293

**Passport:** 1220001297D



## Usage

The serial number of the ID card with the check digit at the end or with the country code for passports is always required.
In the case of a EU ID, this number can be found on the back in the first line according to IDD. The length of the serial number including the check digit is 10 characters. In the passport, it can also be found at the bottom of the second line. The length of the serial number incl. check digit and country code is min. 11 characters max. 13 characters (some countries have only one letter others three).

### JavaScript
If the EU ID number is already available through a form or similar:
```javascript
const check = new AusweisCheck(id).checkEuId;
```
or for an International Passport:
```javascript
const check = new AusweisCheck(id).checkPassport;
```

where `id` is the badge number to be checked.
As answer both functions return 3 possibilities:

**False**
The variable `check` from our example has the value `false`. This means that the badge number is not complete / is too short.

**Array true**
If the ID number is valid, the variable `check` from the example is an array that looks like this:
```javascript
array (
"check" => true,
"id" => "1234567890",
"type" => "EU ID" or "Passport"
"nation" => "D" // only for passports
);
```
This array provides not only the result but also other useful information for further processing.

**Array false**
If the ID number is invalid, the variable `check` from our example is an array that looks like this:
```javascript
array (
"check" => false,
"error" => "checksum did not match"
);
```

### PHP
The PHP version is in large parts identical to the Javascript version.
If the ID number is already known:
```php
$as = new AusweisCheck($id);
$check = $as->checkEuId();
```
or for an International Passport:
```php
$as = new AusweisCheck($id);
$check = $as->checkPassport();
```
where `id` is the badge number to be checked.
As answer both functions return 3 possibilities:

**False**
The variable `check` from our example has the value `false`. This means that the badge number is not complete / is too short.

**Array true**
If the ID number is valid, the variable `check` from the example is an array that looks like this:
```javascript
array (
"check" => true,
"id" => "1234567890",
"type" => "EU ID" or "Passport"
"nation" => "D" // only for passports
);
```
This array provides not only the result but also other useful information for further processing.

**Array false**
If the ID number is invalid, the variable `check` from our example is an array that looks like this:
```javascript
array (
"check" => false,
"error" => "checksum did not match"
);
```


## Other
For questions or suggestions just open a new issue!


## Changelog
**Version 0.0.2:**
```
Breaking Changes:
renamed all functions, translated to english and fixed typos
```

**Version 0.0.1:**
```
Inital Release
```
