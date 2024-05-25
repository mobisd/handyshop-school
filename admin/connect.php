<?php
$db = mysqli_connect("localhost", "root", "", "handyshop");
if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}
?>