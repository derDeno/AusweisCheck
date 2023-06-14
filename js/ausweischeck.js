/* Ausweis Check Javascript Library
*
*  Version: 0.0.2
*  Author: Deniz Celebi
*
*  A mini library to check the authenticity of European identity cards or international passports using the serial number.
*
*
*  MIT License
*
*  Copyright 2023 Deniz Celebi / code7.io
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


  constructor(id) {
    this.id = id.toUpperCase();
    this.alphas = { "0": 0, "1": 1, "2": 2, "3": 3, "4": 4, "5": 5, "6": 6, "7": 7, "8": 8, "9": 9, "A": 10, "B": 11, "C": 12, "D": 13, "E": 14, "F": 15, "G": 16, "H": 17, "I": 18, "J": 19, "K": 20, "L": 21, "M": 22, "N": 23, "O": 24, "P": 25, "Q": 26, "R": 27, "S": 28, "T": 29, "U": 30, "V": 31, "W": 32, "X": 33, "Y": 34, "Z": 35 };
  }

  get checkEuId() {

    // If ID length is under 10, fail
    if (this.id.length < 10) {
      return false;
    }

    const checksum = this.id.substring(9);
    const euId = this.id.substring(0, 9);
    var arr = euId.split('');
    let iter = 7;
    let arrNum = [];
    let endNum = 0;

    // Replace each character with the corresponding number and multiply it
    for (let i = 0; i < arr.length; i++) {

      if (iter == 7) {
        const result = parseInt(this.alphas[arr[i]]) * iter;
        arrNum.push(result);
        iter = 3;

      } else if (iter == 3) {
        const result = parseInt(this.alphas[arr[i]]) * iter;
        arrNum.push(result);
        iter = 1;

      } else if (iter == 1) {
        const result = parseInt(this.alphas[arr[i]]) * iter;
        arrNum.push(result);
        iter = 7;
      }
    }

    // Add the last digits of the individual results
    for (let i = 0; i < 9; i++) {
      let val = String(arrNum[i]);
      const temp = val.substring(val.length - 1);
      endNum += parseInt(temp);
    }

    const end = endNum % 10;
    if (end == checksum) {
      return { "result": true, "id": euId, "type": "EU ID" };
    } else {
      return { "result": false, "error": "Checksum did not match" };
    }

  }


  get checkPassport() {

    // If ID length is under 10, fail
    if (this.id.length < 11) {
      return false;
    }

    const passportId = this.id.substring(0, 9);
    const checksum = this.id.charAt(9);
    let nation = this.id.substring(10);
    let arr = passportId.split('');
    let iter = 7;
    let arrNum = [];
    let endNum = 0;

    // Replace each character with the corresponding number and multiply it
    for (let i = 0; i < arr.length; i++) {

      if (iter == 7) {
        const result = parseInt(this.alphas[arr[i]]) * iter;
        arrNum.push(result);
        iter = 3;

      } else if (iter == 3) {
        const result = parseInt(this.alphas[arr[i]]) * iter;
        arrNum.push(result);
        iter = 1;

      } else if (iter == 1) {
        const result = parseInt(this.alphas[arr[i]]) * iter;
        arrNum.push(result);
        iter = 7;
      }

    }

    // Add the last digits of the individual results
    for (let i = 0; i < 9; i++) {
      let val = String(arrNum[i]);
      const temp = val.substring(val.length - 1);
      endNum += parseInt(temp);
    }

    const end = endNum % 10;
    if (end == checksum) {
      return { "result": true, "id": passportId, "type": "Passport", "nation": nation };
    } else {
      return { "result": false, "error": "Checksum did not match" };
    }
  }
}
