#  AusweisCheck Library

AusweisCheck ist eine Library für PHP und JavaScript um mit wenige Zeilen die Echtheit eines Ausweises zu überprüfen. Es lassen sich Deutsche Personalausweise überprüfen, oder alternativ Internationale Reisepässe inklusive der Nationalität.

*ausweischeck.min.js* ist nur **2 KB groß** und braucht zur überprüfung nur **eine einzige Zeile code**!


##  Beispiele
Für alle Sprachen gibt es im Ordner *examples* Beispiele für die Nutzung. PHP ist nur auf eigenem Server ausführbar, JavaScript auch direkt hier.



## Nutzung

#### JavaScript
Wenn die Ausweisnummer durch ein Formular oder ähnliches schon vorhanden ist:
```javascript
var check = new AusweisCheck(ausweisnummer).checkPerso;
```
oder für einen Internationalen Reisepass:
```javascript
var check = new AusweisCheck(ausweisnummer).checkReisepass;
```

wobei `ausweisnummer` die zu überprüfende Ausweisnummer ist.
Als Antwort liefern beide Funktionen 3 Möglichkeiten:

**False**
Die Variable `check` aus unserem Beispiel hat den Wert `false`. Das bedeutet das die Ausweisnummer nicht vollständig ist / zu kurz ist.

**Array true**
Ist die Ausweisnummer gültig ist die Variable `check` aus dem Beispiel ein Array das so aussieht:
```javascript
array (
	"check" => true,
	"ausweisnummer" => "1234567890",
	"type" => "Personalausweis" oder "Reisepass"
	"nation" => "D" // nur bei Reisepass
);
```
Dieses Array liefert nicht nur das Ergebnis sondern auch andere nützliche Informationen zur Weiterverarbeitung.

**Array false**
Ist die Ausweisnummer ungültig ist die Variable `check` aus unserem Beispiel ein Array das so aussieht:
```javascript
array (
	"check" => false,
	"error" => "Prüfsumme stimmt nicht überein"
);
```

#### PHP
DIe PHP Version ist in großen Teilen identisch wie die Javascript Version aufgebaut.
Wenn die Ausweisnummer schon bekannt ist:
```php
$as = new AusweisCheck();
$check = $as->Personalausweis($ausweisnummer);
```
oder bei einem Internationalen Reisepass
```php
$as = new AusweisCheck();
$check = $as->Reisepass($ausweisnummer);
```
wobei `$ausweisnummer` die zu überprüfende Ausweisnummer ist.
Als Antwort liefern beide Funktionen 3 Möglichkeiten:

**False**
Die Variable `check` aus unserem Beispiel hat den Wert `false`. Das bedeutet das die Ausweisnummer nicht vollständig ist / zu kurz ist.

**Array true**
Ist die Ausweisnummer gültig ist die Variable `check` aus dem Beispiel ein Array das so aussieht:
```javascript
array (
	"check" => true,
	"ausweisnummer" => "1234567890",
	"type" => "Personalausweis" oder "Reisepass"
	"nation" => "D" // nur bei Reisepass
);
```
Dieses Array liefert nicht nur das Ergebnis sondern auch andere nützliche Informationen zur Weiterverarbeitung.

**Array false**
Ist die Ausweisnummer ungültig ist die Variable `check` aus unserem Beispiel ein Array das so aussieht:
```javascript
array (
	"check" => false,
	"error" => "Prüfsumme stimmt nicht überein"
);
```


## Sonstiges
Bei Fragen oder Anregungen einfach ein neues Issue öffnen!


## Changelog
Version 0.0.1: Inital Release
