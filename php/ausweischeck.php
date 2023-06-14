<?php
/* Ausweis Check PHP Library
*
*  Version: 0.0.2
*  Autor: Deniz Celebi
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

  private $id;
  private $alphas = array(
    "0" => 0, "1" => 1, "2" => 2, "3" => 3, "4" => 4, "5" => 5, "6" => 6, "7" => 7, "8" => 8, "9" => 9,
    "A" => 10, "B" => 11, "C" => 12, "D" => 13, "E" => 14, "F" => 15, "G" => 16, "H" => 17, "I" => 18, "J" => 19,
    "K" => 20, "L" => 21, "M" => 22, "N" => 23, "O" => 24, "P" => 25, "Q" => 26, "R" => 27, "S" => 28, "T" => 29,
    "U" => 30, "V" => 31, "W" => 32, "X" => 33, "Y" => 34, "Z" => 35
  );

  public function __construct($id) {
    $this->id = strtoupper($id);
  }

  public function checkEuId() {
    // If ID length is under 10, fail
    if (strlen($this->id) < 10) {
      return false;
    }

    $checksum = substr($this->id, 9);
    $euId = substr($this->id, 0, 9);
    $arr = str_split($euId);
    $iter = 7;
    $arrNum = array();
    $endNum = 0;

    // Replace each character with the corresponding number and multiply it
    foreach ($arr as $char) {
      if ($iter == 7) {
        $result = intval($this->alphas[$char]) * $iter;
        $arrNum[] = $result;
        $iter = 3;
      } elseif ($iter == 3) {
        $result = intval($this->alphas[$char]) * $iter;
        $arrNum[] = $result;
        $iter = 1;
      } elseif ($iter == 1) {
        $result = intval($this->alphas[$char]) * $iter;
        $arrNum[] = $result;
        $iter = 7;
      }
    }

    // Add the last digits of the individual results
    for ($i = 0; $i < 9; $i++) {
      $val = strval($arrNum[$i]);
      $temp = substr($val, -1);
      $endNum += intval($temp);
    }

    $end = $endNum % 10;
    if ($end == $checksum) {
      return array("result" => true, "id" => $euId, "type" => "EU ID");
    } else {
      return array("result" => false, "error" => "Checksum did not match");
    }
  }

  public function checkPassport() {
    // If ID length is under 11, fail
    if (strlen($this->id) < 11) {
      return false;
    }

    $passportId = substr($this->id, 0, 9);
    $checksum = $this->id[9];
    $nation = substr($this->id, 10);
    $arr = str_split($passportId);
    $iter = 7;
    $arrNum = array();
    $endNum = 0;

    // Replace each character with the corresponding number and multiply it
    foreach ($arr as $char) {
      if ($iter == 7) {
        $result = intval($this->alphas[$char]) * $iter;
        $arrNum[] = $result;
        $iter = 3;
      } elseif ($iter == 3) {
        $result = intval($this->alphas[$char]) * $iter;
        $arrNum[] = $result;
        $iter = 1;
      } elseif ($iter == 1) {
        $result = intval($this->alphas[$char]) * $iter;
        $arrNum[] = $result;
        $iter = 7;
      }
    }

    // Add the last digits of the individual results
    for ($i = 0; $i < 9; $i++) {
      $val = strval($arrNum[$i]);
      $temp = substr($val, -1);
      $endNum += intval($temp);
    }

    $end = $endNum % 10;
    if ($end == $checksum) {
      return array("result" => true, "id" => $passportId, "type" => "Passport", "nation" => $nation);
    } else {
      return array("result" => false, "error" => "Checksum did not match");
    }
  }
}
