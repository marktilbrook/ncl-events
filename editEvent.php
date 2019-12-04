<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Facility</title>
</head>
<body>
<h1>Edit event details</h1><br>
<p>You are currently editing: </p>

<!--this script will be referencing the adminFacility.html file for task 1-->
<?php
session_start();
require_once "functions.php";

//this creates a reference to the connection which is in the functions.php file
$connection = getConnection();

//we want to show all event details based upon the event selected

//if the the selected event is chosen, store it in $selectedEvent
$selectedEvent = null;
if(isset($_GET['eventTitle']))
{
    $selectedEvent = $_GET['eventTitle'];
}
else
{
    echo "selected event is not declared...";
}

//this echos out the selected event, all details area shown except the description
$sqlStatement = "SELECT eventID, eventTitle, venueName, catDesc, eventStartDate, eventEndDate, eventPrice FROM NE_events
                 JOIN NE_venue ON NE_events.venueID = NE_venue.venueID
                 JOIN NE_category ON NE_events.catID = NE_category.catID
                 WHERE eventTitle = '$selectedEvent'";

$queryResult = $connection->query($sqlStatement);

//this dynamically creates a form which the user can see what event they are editing, and allow them to edit. NOTE: eventID is readonly, meaning it cannot be edited.
while ($rowObj = $queryResult->fetchObject()) {

    echo "<form method=\"get\" action=\"processForm.php\" style='width:100%;border: 1px solid #553c46;
            text-align: left; padding: 8px;'>
    Event ID: <input type=\"text\" name=\"eventID\" value='{$rowObj->eventID}' readonly>
    Event Title: <input type=\"text\" name=\"eventTitle\" value='{$rowObj->eventTitle}'>
    Event Description: <textarea name=\"eventDescription\"></textarea> 
    Venue:
    <select name=\"venueID\">
        <option value=\"v1\">Theatre Royal</option>
        <option value=\"v2\">BALTIC Centre for Contemporary Art</option>
        <option value=\"v3\">Laing Art Gallery</option>
        <option value=\"v4\">The Biscuit Factory</option>
        <option value=\"v5\">Discovery Museum</option>
        <option value=\"v6\">HMS Calliope</option>
        <option value=\"v7\">Utilita Arena Newcastle</option>
        <option value=\"v8\">Mill Volvo Tyne Theatre</option>
        <option value=\"v9\">PLAYHOUSE Whitley Bay</option>
        <option value=\"v10\">Shipley Art Gallery</option>
        <option value=\"v11\">Seven Stories</option>
    </select>
    Category:
    <select name=\"categoryID\">
        <option value=\"c1\">Carnival</option>
        <option value=\"c2\">Theatre</option>
        <option value=\"c3\">Comedy</option>
        <option value=\"c4\">Exhibition</option>
        <option value=\"c5\">Festival</option>
        <option value=\"c6\">Family</option>
        <option value=\"c7\">Music</option>
        <option value=\"c8\">Sport</option>
        <option value=\"c9\">Dance</option>
    </select>
    Event Start Date: <input type=\"date\" name=\"eventStartDate\" value='{$rowObj->eventStartDate}'>
    Event End Date: <input type=\"date\" name=\"eventEndDate\" value='{$rowObj->eventEndDate}'>
    Price <input type=\"text\" name=\"eventPrice\" value='{$rowObj->eventPrice}'>
    <input type=\"submit\" value=\"Add Event\">
</form>";
}




?>








<script type="text/javascript">

</script>


</body>
</html>