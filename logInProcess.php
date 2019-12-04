<?php

ini_set("session.save_path", "/home/unn_w17006267/sessionData");
session_start();
//---------------this is to do with the function at the bottom-----------------------------------------------
list($input, $errors) = validate_logon();
if ($errors)
{
echo show_errors($errors);
}
else
{
    set_session('logged-in', 'true');
    header("Location: adminFacility.php");

}
//--------------------------------------------------------------


function validate_logon()
{

$input = array();
$errors = array();

//storing variables into array - also trimming them of whitespace
$input['username'] = filter_has_var(INPUT_POST, 'username') ?
$_POST['username'] : null;
$input['username'] = trim($input['username']);

$input['password'] = filter_has_var(INPUT_POST, 'password') ?
$_POST['password'] : null;
$input['password'] = trim($input['password']);

try {

require_once("functions.php");
$dbConnection = getConnection();

$querySQL = "SELECT passwordHash FROM NE_users WHERE username = :username";

//prepare SQL statement
$statement = $dbConnection->prepare($querySQL);
//execute SQL statement
$statement->execute(array(':username' => $input['username']));

$user = $statement->fetchObject();
if ($user && $input['password'])
{
    $passwordhash = $user->passwordhash;

if(password_verify($input['password'], $passwordhash))
{
    echo "Correct password! Welcome!";
    $_SESSION['logged-in'] = 'true';
    echo $_SESSION['logged-in'];

}
}// end if
else
{
    $errors[] = 'Error found: Username Password combination incorrect.';
}// end else

}// try
catch (Exception $e)
{
    echo "There was a problem: " . $e->getMessage();
}

return array($input, $errors);
}// end validate_logon()

function show_errors(array $theArray)
{
//loop through each item in array
//add each item to a string + concatenate
//add text to string that asks the user to try the form again with a link back to it
// return the string
$theString = "<p>The following problem(s) occured when trying to process your request:</p>\n";
foreach ($theArray as $item)
{
$theString .= $item;
}
$theString .= "\n \n Please try the form again \n (ADD LINK HERE)";

return $theString;
}// end show_errors()







?>