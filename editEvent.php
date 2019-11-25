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
$sqlStatement = "SELECT eventID, eventTitle, venueID, catID, eventStartDate, eventEndDate, eventPrice from NE_events
                 WHERE eventTitle = '$selectedEvent'";//todo join event and category table to sort out venueID and catID

$queryResult = $connection->query($sqlStatement);

while ($rowObj = $queryResult->fetchObject())
{
    echo "<table class=event style='width:100%;border: 1px solid #dddddd;
            text-align: left; padding: 8px;'>
            <tr>
              <th>EventID</th>
              <th>Event Title</th>
              <th>Venue ID</th>
              <th>Category ID</th>
              <th>Event Start Date</th>
              <th>Event End Date</th>
              <th>Event Price</th>
            </tr>
            <tr>
              <td>{$rowObj->eventID}</td>
              <td>{$rowObj->eventTitle}</td>
              <td>{$rowObj->venueID}</td>
              <td>{$rowObj->catID}</td>
              <td>{$rowObj->eventStartDate}</td>
              <td>{$rowObj->eventEndDate}</td>
              <td>{$rowObj->eventPrice}</td>
            </tr>
         </table>";
}

//we want to be able to add new values into the db

try{
    

    $insertSQL = "INSERT INTO p_products (productName, description, categoryID , price) 
					  VALUES(:productName, :description, :categoryID, :price)";
    $stmt = $dbConn->prepare($insertSQL);
    $stmt->execute(array(':productName' => $input['productName'], ':description' => $input['description']
    , ':categoryID' => $input['categoryID'], ':price' => $input['price']));

    echo "<h1>Product details</h1>\n";
    echo "<p>Name:  ".$input['productName']."</p>\n";
    echo "<p>Description:".$input['description']."</p>\n";
    echo "<p>Category: {$input['categoryID']}</p>\n";
    echo "<p>Price: {$input['price']}</p>\n";
}
catch (Exception $e) {
    echo "Records not found: " . $e->getMessage();
}





?>
<script type="text/javascript">

</script>


</body>
</html>