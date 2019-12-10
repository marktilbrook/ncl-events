<?php
//this works dont touch
session_start();
require_once "functions.php";

log_out();
header("Location: logInForm.php");
