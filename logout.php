<?php 
session_start();
if (isset($_SESSION['userlogin'])) {
   session_destroy();
   header('Location: index.php');

}else{
   header('Location: login.php');
}
