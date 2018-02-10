/* Ausweis Check Javascript Library
*
*  Version: 0.0.1
*  Autor: Deniz Celebi
*
*  Eine mini Library um Personalausweise oder Internationale Reisepässe auf
*  Echtheit zu überprüfen mit Hilfe der Seriennummer
*
*
*  MIT License
*
*  Copyright 2018 Deniz Celebi / Pixelart
*  Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"),
*  to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
*  and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
*
*  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
*
*  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
*  WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

class AusweisCheck {


  constructor(ausweisnummer) {
    this.nummer = ausweisnummer.toUpperCase();
    this.alphas = {"0":0,"1":1,"2":2,"3":3,"4":4,"5":5,"6":6,"7":7,"8":8,"9":9,"A":10, "B":11, "C":12, "D":13, "E":14, "F":15, "G":16, "H":17, "I":18, "J":19, "K":20, "L":21, "M":22, "N":23, "O":24, "P":25, "Q":26, "R":27, "S":28, "T":29, "U":30, "V":31, "W":32, "X":33, "Y":34, "Z":35};
  }

  get checkPerso() {

    // Wenn eingegebene Personummer weniger als 10 Zeichen hat abbrechen
    if(this.nummer.length < 10) {
      return false;
    }

    var prufziffer = this.nummer.substr(9);
    var personummer = this.nummer.substr(0,9);
    var arr = personummer.split('');
    var iter = 7;
    var arr_zahlen = [];
    var endziffern = 0;

    // Jedes  Zeichen mit der dazugehörigen Zahl ersetzten und multiplizieren
    for (var i = 0; i < arr.length; i++) {

      if(iter == 7) {
        var result = parseInt(this.alphas[arr[i]]) * iter;
        arr_zahlen.push(result);
        iter = 3;

      }else if(iter == 3) {
        var result = parseInt(this.alphas[arr[i]]) * iter;
        arr_zahlen.push(result);
        iter = 1;

      }else if(iter == 1) {
        var result = parseInt(this.alphas[arr[i]]) * iter;
        arr_zahlen.push(result);
        iter = 7;
      }

    }

    // Die letzten Stellen der einzelnen Ergebnisse addieren
    for(i = 0; i < 9; i++) {
      var val = String(arr_zahlen[i]);
      var temp = val.substr(val.length - 1);
      endziffern += parseInt(temp);
    }

    var ende = endziffern % 10;
    if(ende == prufziffer) {
      var resarr = {"result": true, "ausweisnummer": personummer, "type": "Personalausweis"}
      return resarr;
    }else {
      var resarr = {"result": false, "error": "Prüfsumme stimmt nicht überein"}
      return resarr;
    }

  }


  get checkReisepass() {

    // Wenn eingegebene Personummer weniger als 10 Zeichen hat abbrechen
    if(this.nummer.length < 11) {
      return false;
    }

    var passnummer = this.nummer.substring(0, 9);
    var prufziffer = this.nummer.charAt(9);
    var nation = this.nummer.substring(10);
    var arr = passnummer.split('');
    var iter = 7;
    var arr_zahlen = [];
    var endziffern = 0;

    // Jedes  Zeichen mit der dazugehörigen Zahl ersetzten und multiplizieren
    for (var i = 0; i < arr.length; i++) {

      if(iter == 7) {
        var result = parseInt(this.alphas[arr[i]]) * iter;
        arr_zahlen.push(result);
        iter = 3;

      }else if(iter == 3) {
        var result = parseInt(this.alphas[arr[i]]) * iter;
        arr_zahlen.push(result);
        iter = 1;

      }else if(iter == 1) {
        var result = parseInt(this.alphas[arr[i]]) * iter;
        arr_zahlen.push(result);
        iter = 7;
      }

    }

    // Die letzten Stellen der einzelnen Ergebnisse addieren
    for(i = 0; i < 9; i++) {
      var val = String(arr_zahlen[i]);
      var temp = val.substr(val.length - 1);
      endziffern += parseInt(temp);
    }

    var ende = endziffern % 10;
    if(ende == prufziffer) {
      var resarr = {"result": true, "ausweisnummer": passnummer, "type": "Reisepass", "nation": nation}
      return resarr;
    }else {
      var resarr = {"result": false, "error": "Prüfsumme stimmt nicht überein"}
      return resarr;
    }
  }


}
