<?php
/** Core Path **/
define("view","views/");


/** Database connection **/

define("host","localhost");
define("username","root");
define("password","");
define("database","sales_db");
/** Auth **/

define("table","tbl_user");
define("user_session_id","user_id");
define("passwordHashing",true);
define("error_message","Your Credentials did not matched");

/** Function / Classes **/

//inside dir
define ("VALUE",serialize (array ("auth.php","my_functions.php")));
?>