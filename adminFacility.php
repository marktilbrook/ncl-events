<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Facility</title>
</head>
<body>
<h1>Admin Facility</h1><br>
<p>Please select an event to edit</p>

<!--this script will be referencing the adminFacility.html file for task 1-->
<!--dont fuck with this its working fine-->
<?php
require_once "functions.php";
set_session("logged-in","true");

//this creates a reference to the connection which is in the functions.php file
$connection = getConnection();


//this displays the different events, from there, the user can go to editEvent.php
$sqlGetEventTitle = "SELECT eventTitle from NE_events";
$queryResult = $connection->query($sqlGetEventTitle);


echo "<form action='editEvent.php' method='get'>";
echo "Event Title: <select name='eventTitle'>";
while ($record = $queryResult->fetchObject()) {
    echo "<option value='{$record->eventTitle}'>{$record->eventTitle}</option>";
}
echo "</select>";
echo "<input type='submit' value='Get Event Details'></form>";
echo "<br><br>";

?>

<script type="text/javascript">

</script>


</body>
</html>