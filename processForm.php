<!--//this processes the form-->
<?php

list($input, $errors) = validate_form();
if ($errors)
{
    echo show_errors($errors);
}
else
{
    echo process_form($input);
}


function validate_form()
{
    $input = array();
    $errors = array();

    //storing variables into array - also trimming them of whitespace
    $input['eventID'] = filter_has_var(INPUT_GET, 'eventID') ?
        $_GET['eventID'] : null;
    $input['eventID'] = trim($input['eventID']);

    $input['eventTitle'] = filter_has_var(INPUT_GET, 'eventTitle') ?
        $_GET['eventTitle'] : null;
    $input['eventTitle'] = trim($input['eventTitle']);

    $input['eventDescription'] = filter_has_var(INPUT_GET, 'eventDescription') ?
        $_GET['eventDescription'] : null;
    $input['eventDescription'] = trim($input['eventDescription']);

    $input['venueID'] = filter_has_var(INPUT_GET, 'venueID') ?
        $_GET['venueID'] : null;
    $input['venueID'] = trim( $input['venueID']);

    $input['categoryID'] = filter_has_var(INPUT_GET, 'categoryID') ?
        $_GET['categoryID'] : null;
    $input['categoryID'] = trim($input['categoryID']);

    $input['eventStartDate'] = filter_has_var(INPUT_GET, 'eventStartDate') ?
        $_GET['eventStartDate'] : null;
    $input['eventStartDate'] = trim($input['eventStartDate']);

    $input['eventEndDate'] = filter_has_var(INPUT_GET, 'eventEndDate') ?
        $_GET['eventEndDate'] : null;
    $input['eventEndDate'] = trim($input['eventEndDate']);

    $input['eventPrice'] = filter_has_var(INPUT_GET, 'eventPrice') ?
        $_GET['eventPrice'] : null;
    $input['eventPrice'] = trim($input['eventPrice']);



//check for empty fields
    if (empty($input['eventTitle']) || empty($input['eventDescription'])
        || empty($input['venueID']) || empty($input['categoryID'])
        || empty($input['eventStartDate']) || empty($input['eventEndDate'])
        || empty($input['eventPrice']))
    {
        $errors[] = 'Error found: You may have an empty field!';

    }
    else if(strlen($input['eventTitle']) > 50)
    {
        //does this mean its only 1 item in the array?
        $errors[] = 'Error found: Event Title must be less than 50 characters ';
    }
    else if(filter_var($input['eventPrice'], FILTER_VALIDATE_INT))
    {
        $errors[] = 'Error found: Price MUST BE AN INTEGER';
    }


    return array($input, $errors);
}// function validateForm()

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
}

function process_form($input)
{
    try{
        require_once("functions.php");
        $connection = getConnection();

        //this works - dont touch

        $updateSQL = "UPDATE NE_events
                      SET eventTitle = :eventTitle, eventDescription = :eventDescription, venueID = :venueID, catID = :catID,
                       eventStartDate = :eventStartDate, eventEndDate = :eventEndDate, eventPrice = :eventPrice
                       WHERE eventID = :eventID";


        $stmt = $connection->prepare($updateSQL);
        $stmt->execute(array(':eventTitle' => $input['eventTitle'], ':eventDescription' => $input['eventDescription']
        , ':venueID' => $input['venueID'], ':catID' => $input['categoryID'], ':eventStartDate' => $input['eventStartDate']
        , ':eventEndDate' => $input['eventEndDate'], ':eventPrice' => $input['eventPrice'], ':eventID' => $input['eventID'])); //do i need , ':eventPrice' => $input['eventPrice']

        echo "<h1>Event Details</h1>\n";
        echo "<p>Event ID:  ".$input['eventID']."</p>\n";
        echo "<p>Event Title:  ".$input['eventTitle']."</p>\n";
        echo "<p>Event Description:".$input['eventDescription']."</p>\n";
        echo "<p>Venue: {$input['venueID']}</p>\n";
        echo "<p>Category: {$input['categoryID']}</p>\n";
        echo "<p>Start Date: {$input['eventStartDate']}</p>\n";
        echo "<p>End Date: {$input['eventEndDate']}</p>\n";
        echo "<p>Price: {$input['eventPrice']}</p>\n";
    }
    catch (Exception $e) {
        echo "Records not found: " . $e->getMessage();
    }

}
?>