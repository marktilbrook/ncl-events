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

while ($rowObj = $queryResult->fetchObject())
{
    echo "<table class=event style='width:100%;border: 1px solid #dddddd;
            text-align: left; padding: 8px;'>
            <tr>
              <th>EventID</th>
              <th>Event Title</th>
              <th>Venue</th>
              <th>Category</th>
              <th>Event Start Date</th>
              <th>Event End Date</th>
              <th>Event Price</th>
            </tr>
            <tr>
              <td>{$rowObj->eventID}</td>
              <td>{$rowObj->eventTitle}</td>
              <td>{$rowObj->venueName}</td>
              <td>{$rowObj->catDesc}</td>
              <td>{$rowObj->eventStartDate}</td>
              <td>{$rowObj->eventEndDate}</td>
              <td>{$rowObj->eventPrice}</td>
            </tr>
         </table>";
}

//we want to be able to add new values into the db

//try{
//
//
//    $insertSQL = "INSERT INTO NE_events (eventTitle, venueID, catID, eventStartDate, eventEndDate, eventPrice )
//					  VALUES(:productName, :description, :categoryID, :price)";
//    $stmt = $dbConn->prepare($insertSQL);
//    $stmt->execute(array(':productName' => $input['productName'], ':description' => $input['description']
//    , ':categoryID' => $input['categoryID'], ':price' => $input['price']));
//
//    echo "<h1>Product details</h1>\n";
//    echo "<p>Name:  ".$input['productName']."</p>\n";
//    echo "<p>Description:".$input['description']."</p>\n";
//    echo "<p>Category: {$input['categoryID']}</p>\n";
//    echo "<p>Price: {$input['price']}</p>\n";
//}
//catch (Exception $e) {
//    echo "Records not found: " . $e->getMessage();
//}





?>

<form method="get" action="processForm.php">
    Event Title: <input type="text" name="eventTitle">
    Event Description: <textarea name="eventDescription"></textarea>
    Venue:
    <select name="venueID">
        <option value="v1">Theatre Royal</option>
        <option value="v2">BALTIC Centre for Contemporary Art</option>
        <option value="v3">Laing Art Gallery</option>
        <option value="v4">The Biscuit Factory</option>
        <option value="v5">Discovery Museum</option>
        <option value="v6">HMS Calliope</option>
        <option value="v7">Utilita Arena Newcastle</option>
        <option value="v8">Mill Volvo Tyne Theatre</option>
        <option value="v9">PLAYHOUSE Whitley Bay</option>
        <option value="v10">Shipley Art Gallery</option>
        <option value="v11">Seven Stories</option>
    </select>
    Category:
    <select name="categoryID">
        <option value="c1">Carnival</option>
        <option value="c2">Theatre</option>
        <option value="c3">Comedy</option>
        <option value="c4">Exhibition</option>
        <option value="c5">Festival</option>
        <option value="c6">Family</option>
        <option value="c7">Music</option>
        <option value="c8">Sport</option>
        <option value="c9">Dance</option>
    </select>
    Event Start Date: <input type="date" name="eventStartDate">
    Event End Date: <input type="date" name="eventEndDate">
    Price <input type="text" name="eventPrice">
    <input type="submit" value="Add Event">
</form>






<script type="text/javascript">

</script>


</body>
</html>