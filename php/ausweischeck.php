<?php
/* Ausweis Check PHP Library
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

  public function Personalausweis($nummer, $return = false) {

    if(strlen($nummer) < 10) {
      return false;
    }

    $ausweisnummer = strtoupper($nummer);
    $prufziffer = substr($ausweisnummer, 9);
    $perso = substr($ausweisnummer,0,9);
    $arr = str_split($perso);
    $iter = 7;
    $arr_zahlen = array();
    $endziffer = 0;
    $alphas = $this->getAlphas();

    // Jedes  Zeichen mit der dazugehörigen Zahl ersetzten und multiplizieren
    for ($i = 0; $i < count($arr); $i++) {

      if($iter == 7) {
        $result = intval($alphas[$arr[$i]]) * $iter;
        array_push($arr_zahlen, $result);
        $iter = 3;

      }else if($iter == 3) {
        $result = intval($alphas[$arr[$i]]) * $iter;
        array_push($arr_zahlen, $result);
        $iter = 1;

      }else if($iter == 1) {
        $result = intval($alphas[$arr[$i]]) * $iter;
        array_push($arr_zahlen, $result);
        $iter = 7;
      }

    }

    // Die letzten Stellen der einzelnen Ergebnisse addieren
    for($i = 0; $i < 9; $i++) {
      $val = strval($arr_zahlen[$i]);
      $temp = substr($val, -1);
      $endziffer += intval($temp);
    }

    $ende = $endziffer % 10;
    if($ende == $prufziffer) {
      $arr['check'] = true;
      $arr['ausweisnummer'] = $perso;
      $arr['type'] = "Personalausweis";
      return $arr;

    }else {
      $arr['check'] = false;
      $arr['error'] = "Prüfsumme stimmt nicht überein";
      return $arr;
    }
  }


  public function Reisepass($nummer, $return = false) {

    if(strlen($nummer) < 11) {
      return false;
    }

    $ausweisnummer = strtoupper($nummer);
    $prufziffer = substr($ausweisnummer, 9,1);
    $reisepass = substr($ausweisnummer,0,9);
    $nation = substr($ausweisnummer, 10);
    $arr = str_split($reisepass);
    $iter = 7;
    $arr_zahlen = array();
    $endziffer = 0;
    $alphas = $this->getAlphas();

    // Jedes  Zeichen mit der dazugehörigen Zahl ersetzten und multiplizieren
    for ($i = 0; $i < count($arr); $i++) {

      if($iter == 7) {
        $result = intval($alphas[$arr[$i]]) * $iter;
        array_push($arr_zahlen, $result);
        $iter = 3;

      }else if($iter == 3) {
        $result = intval($alphas[$arr[$i]]) * $iter;
        array_push($arr_zahlen, $result);
        $iter = 1;

      }else if($iter == 1) {
        $result = intval($alphas[$arr[$i]]) * $iter;
        array_push($arr_zahlen, $result);
        $iter = 7;
      }

    }

    // Die letzten Stellen der einzelnen Ergebnisse addieren
    for($i = 0; $i < 9; $i++) {
      $val = strval($arr_zahlen[$i]);
      $temp = substr($val, -1);
      $endziffern += intval($temp);
    }

    $ende = $endziffern % 10;
    if($ende == $prufziffer) {
      $arr['check'] = true;
      $arr['ausweisnummer'] = $reisepass;
      $arr['type'] = "Reisepass";
      $arr['nation'] = $nation;
      return $arr;

    }else {
      $arr['check'] = false;
      $arr['error'] = "Prüfsumme stimmt nicht überein";
      return $arr;
    }

  }

  function getAlphas() {
    return array (
        '0' => 0,
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        'A' => 10,
        'B' => 11,
        'C' => 12,
        'D' => 13,
        'E' => 14,
        'F' => 15,
        'G' => 16,
        'H' => 17,
        'I' => 18,
        'J' => 19,
        'K' => 20,
        'L' => 21,
        'M' => 22,
        'N' => 23,
        'O' => 24,
        'P' => 25,
        'Q' => 26,
        'R' => 27,
        'S' => 28,
        'T' => 29,
        'U' => 30,
        'V' => 31,
        'W' => 32,
        'X' => 33,
        'Y' => 34,
        'Z' => 35,
      );
  }

}




?>
