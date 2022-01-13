<?php
session_start();
$bdd = mysqli_connect('localhost', 'Claudio', '1234', 'claudio-romeo_livreor');
mysqli_set_charset($bdd, 'utf8');
