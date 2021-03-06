<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Book events</title>
</head>
<body>

<?php
/* This code dynamically generates a web page containing a form designed with the html required to display one
checkbox for each of the records currently held in the nmc_records database table has been provided for you in the
assessment section for the module on blackboard. The user can select one or more records that they are interested in
ordering by clicking the checkboxes.
Use the browser to look at the structure of the html generated by the php code. */

$url = "http://unn-izge1.newnumyspace.co.uk/KF5002/assessment/bookEventsFormInc.php";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
echo $result;
?>
<!--//this works-->
<?php


echo "<form method=\"post\" action=\"logOut.php\" style='position: absolute;
  top: 8px;
  right: 16px;
  font-size: 18px;'>
    <input type=\"submit\" value=\"logout\">
       </form>";
?>

<!-- Here you need to add Javascript or a link to a script (.js file) to process the form as required for the assignment -->
<!--this script answers question B-->
<script type="text/javascript">
    window.addEventListener('load', function () {
        "use strict";

        const l_Form = document.getElementById("bookingForm");


        l_Form.termsChkbx.onchange = function () {
            if (l_Form.termsChkbx.checked == true) {
                document.getElementById("termsText").style.fontWeight = "normal";
                document.getElementById("termsText").style.color = "black";
                l_Form.submit.disabled = false;
            }
            if (l_Form.termsChkbx.checked == false) {
                document.getElementById("termsText").style.fontWeight = "bold";
                document.getElementById("termsText").style.color = "red";
                l_Form.submit.disabled = true;
            }
        };
    });
</script>


<!--this works - this script answers question C and D -->
<script type="text/javascript">
    window.addEventListener('load', function () {
        "use strict";
        const l_form = document.getElementById("bookingForm");
        const l_surnameField = document.querySelector("#retCustDetails > input[type=text]:nth-child(2)");
        const l_submit = document.querySelector("#makeBooking > p:nth-child(6) > input[type=submit]");

        l_form.onchange = calculateTotal;
        l_submit.onclick = validate;

        let isSomethingChecked = false;
        let isNameEmpty        = false;

        function calculateTotal()
        {
            let total = 0;
            const eventsForm = l_form.querySelectorAll('div.item');
            const eventsCount = eventsForm.length;

            for (let i = 0; i < eventsCount; i++)
            {
                const event = eventsForm[i];
                const checkBox = event.querySelector('input[data-price][type=checkbox]');

                if (checkBox.checked === true)
                {
                    total += parseFloat(checkBox.dataset.price);
                    isSomethingChecked = true;
                }
            }
            const radio = l_form.querySelector('input[data-price][type=radio]');
            if (radio.checked === true)
            {
                total += parseFloat(radio.dataset.price);
            }
            l_form.total.value = total;

        }

        function validate()
        {
            if (l_surnameField.value == "" || l_surnameField.value == null || isSomethingChecked == false)
            {
                alert("Missing Field...Please Try Again.");
                return false;
            }
        }

    });
</script>
<!--this works, this answers question e-->
<script type="text/javascript">
    window.addEventListener('load', function () {
        "use strict";
        const l_form = document.getElementById("bookingForm");
        const l_selectBox = document.querySelector("#makeBooking > select");
        const customerDiv = document.querySelector("#retCustDetails");
        const tradeDiv = document.querySelector("#tradeCustDetails");

        l_selectBox.onchange = function()
        {
            let value = l_selectBox.options[l_selectBox.selectedIndex].value;
            if (value == "ret")
            {
                //alert("got value");
                customerDiv.style.visibility='visible';
                tradeDiv.style.visibility='hidden';
            }
            else if (value == "trd")
            {
                customerDiv.style.visibility='hidden';
                tradeDiv.style.visibility='visible';
            }
            else
            {
                customerDiv.style.visibility='hidden';
                tradeDiv.style.visibility='hidden';
            }
        };
    });
</script>
</body>
</html>