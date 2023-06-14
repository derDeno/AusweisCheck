<?php

require_once('../php/ausweischeck.php');

 ?>

 <html>
   <body>

     <form method="post" id="exampleform">
       <input id="perso-field" name="perso-field" type="text" maxlength="10" placeholder="EU ID" required>
       <input type="submit">
     </form>

     <form method="post" id="exampleform2">
       <input id="reisepass-field" name="reisepass-field" type="text" maxlength="13" placeholder="Passport" required>
       <input type="submit">
     </form>

     <b>Result:</b><br>
     <div id="result">
       <?php

       if(isset($_POST['perso-field']) && !empty($_POST['perso-field']) ) {

         $as = new AusweisCheck($_POST['perso-field']);
         $check = $as->checkEuId();

         if($check != false && $check['check'] === true) {
           echo "Check: " . $check['check'] ."<br>ID: ". $check['id'] ."<br>Type: ". $check['type'];

         }else if($check != false && $check['check'] === false) {
           echo "Check1: ". $check['check'] ."<br>Error: ". $check['error'];

         }else if(!$check){
           echo "false";
         }

       }

       if(isset($_POST['reisepass-field']) && !empty($_POST['reisepass-field']) ) {

         $as = new AusweisCheck($_POST['reisepass-field']);
         $check = $as->checkPassport();

         if($check != false && $check['check'] === true) {
           echo "Check: " . $check['check'] ."<br>ID: ". $check['id'] ."<br>Type: ". $check['type'] ."<br>Nation: ". $check['nation'];

         }else if($check != false && $check['check'] === false) {
           echo "Check2: ". $check['check'] ."<br>Error: ". $check['error'];

         }else if(!$check){
           echo "false";
         }

       }

       ?>
     </div>

   </body>
 </html>
