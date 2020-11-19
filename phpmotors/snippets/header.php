<?php 
//check if the person has logged in
if($_SESSION['loggedin'] == TRUE) {
     
    //have logged in
    echo '<a id="my_account" href="/phpmotors/accounts/index.php/?action=logout"> Logout </a>';
  
   
}else { 
    echo '<a id="my_account" href="/phpmotors/accounts/index.php/?action=login"> My Account </a>';
}
?>
<img id="logo" src=" /phpmotors/images/site/logo.png" alt="logo for the website">

 


 