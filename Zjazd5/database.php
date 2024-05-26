<?php
$servername = "localhost";
$username = "root";
$password = "";

$connection = new mysqli($servername, $username, $password);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
echo "Connected successfully<br>";

mysqli_select_db($connection,"gym_database");

echo("Query1 fetchrow results:<br>" );
$query1 = mysqli_query($connection,"SELECT * FROM trainers");
while ($row = mysqli_fetch_row($query1)){
    echo "ID: " . $row[0] . " Name: " . $row[1] . " Surname: " . $row[2] . "<br>";
}

echo("<br>Query2 fetcharray results:<br>" );
$query2 = mysqli_query($connection, "SELECT * FROM gymlocations");
while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)){
    echo "Location ID: " . $row['location_id'] . " " .
        "Location Name: " . $row['location_name'] . " " .
        "Address: " . $row['address'] . " " .
        "City:  " . $row['city'] . " " .
        "State:  " . $row['state'] . " " .
        "Zip Code:  " . $row['zip_code'] . "<br>" ;
}

$location_name = "TotalFitness";
$address = "Aleja grunwaldzka";
$city = "Gdansk";
$state = "Pomorskie";
$zip_code = "123-45";

$stmt = $connection->prepare("INSERT INTO gymlocations (location_name, address, city, state, zip_code) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $location_name, $address, $city, $state, $zip_code);

if ($stmt->execute()) {
    echo "New gym location added successfully<br>";
} else {
    echo "Error: " . $stmt->error . "<br>";
}

$stmt->close();

echo("<br>Query2 fetcharray results:<br>" );
$query2 = mysqli_query($connection, "SELECT * FROM gymlocations");
while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)){
    echo "Location ID: " . $row['location_id'] . " " .
        "Location Name: " . $row['location_name'] . " " .
        "Address: " . $row['address'] . " " .
        "City:  " . $row['city'] . " " .
        "State:  " . $row['state'] . " " .
        "Zip Code:  " . $row['zip_code'] . "<br>" ;
}


echo("<br>Query3 numrows results:<br>" );
$query3 = mysqli_query($connection,"SELECT * FROM memberpayments");
echo "Number of rows queried: " . mysqli_num_rows($query3) . "<br>" ;
while ($row = mysqli_fetch_row($query3)){
    echo "ID: " . $row[0] . " Payment date: " . $row[2] . " Amount: " . $row[3] . "<br>";
}




mysqli_close($connection);
