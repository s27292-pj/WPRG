<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numPeople = $_POST['num_people'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $address = $_POST['address'];
    $creditCard = $_POST['credit_card'];
    $email = $_POST['email'];
    $stayDate = $_POST['stay_date'];
    $arrivalTime = $_POST['arrival_time'];
    $extraBed = isset($_POST['extra_bed']) ? "Yes" : "No";
    $amenities = isset($_POST['amenities']) ? implode(", ", $_POST['amenities']) : "None";

    $personForms = "";
    for ($i = 1; $i <= $numPeople; $i++) {
        $personForms .= "
            <h3>Person $i</h3>
            <label for='first_name_$i'>First Name:</label>
            <input type='text' id='first_name_$i' name='first_name_$i' required><br>
            <label for='last_name_$i'>Last Name:</label>
            <input type='text' id='last_name_$i' name='last_name_$i' required><br>
            <hr>
        ";
    }

    $summary = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Reservation Summary</title>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 800px; margin: 0 auto; }
                h2, h3 { color: #333; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Reservation Summary</h2>
                <h3>Reservation Details</h3>
                <table>
                    <tr><th>Field</th><th>Value</th></tr>
                    <tr><td>Number of People</td><td>$numPeople</td></tr>
                    <tr><td>First Name</td><td>$firstName</td></tr>
                    <tr><td>Last Name</td><td>$lastName</td></tr>
                    <tr><td>Address</td><td>$address</td></tr>
                    <tr><td>Credit Card</td><td>$creditCard</td></tr>
                    <tr><td>Email</td><td>$email</td></tr>
                    <tr><td>Stay Date</td><td>$stayDate</td></tr>
                    <tr><td>Arrival Time</td><td>$arrivalTime</td></tr>
                    <tr><td>Extra Bed for Child</td><td>$extraBed</td></tr>
                    <tr><td>Amenities</td><td>$amenities</td></tr>
                </table>
                <h3>Guest Information</h3>
                <form action='process_guests.php' method='post'>
                    $personForms
                    <input type='submit' value='Submit Reservation'>
                </form>
            </div>
        </body>
        </html>
    ";

    echo $summary;
}
?>
