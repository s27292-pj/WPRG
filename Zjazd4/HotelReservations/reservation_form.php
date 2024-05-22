<?php
session_start();

// Ustawienia do logowania
$valid_username = "admin";
$valid_password = "password";

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        setcookie('username', $username, time() + (86400 * 30), "/"); // 30 dni
    } else {
        $login_error = "Invalid username or password.";
    }
}

if (isset($_POST['clear_form'])) {
    setcookie('form_data', '', time() - 3600, "/"); // Usunięcie ciasteczka
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reservation'])) {
    $form_data = [
        'num_people' => $_POST['num_people'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'address' => $_POST['address'],
        'credit_card' => $_POST['credit_card'],
        'email' => $_POST['email'],
        'stay_date' => $_POST['stay_date'],
        'arrival_time' => $_POST['arrival_time'],
        'extra_bed' => isset($_POST['extra_bed']) ? "Yes" : "No",
        'amenities' => isset($_POST['amenities']) && is_array($_POST['amenities']) ? implode(", ", $_POST['amenities']) : "None"
    ];

    setcookie('form_data', serialize($form_data), time() + (86400 * 30), "/"); // 30 dni

    $numPeople = $form_data['num_people'];
    $firstName = $form_data['first_name'];
    $lastName = $form_data['last_name'];
    $address = $form_data['address'];
    $creditCard = $form_data['credit_card'];
    $email = $form_data['email'];
    $stayDate = $form_data['stay_date'];
    $arrivalTime = $form_data['arrival_time'];
    $extraBed = $form_data['extra_bed'];
    $amenities = $form_data['amenities'];

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

    echo "
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
                <form action='' method='post'>
                    $personForms
                    <input type='hidden' name='num_people' value='$numPeople'>
                    <input type='hidden' name='first_name' value='$firstName'>
                    <input type='hidden' name='last_name' value='$lastName'>
                    <input type='hidden' name='address' value='$address'>
                    <input type='hidden' name='credit_card' value='$creditCard'>
                    <input type='hidden' name='email' value='$email'>
                    <input type='hidden' name='stay_date' value='$stayDate'>
                    <input type='hidden' name='arrival_time' value='$arrivalTime'>
                    <input type='hidden' name='extra_bed' value='$extraBed'>
                    <input type='hidden' name='amenities' value='$amenities'>
                    <input type='submit' name='finalize_reservation' value='Submit Reservation'>
                </form>
            </div>
        </body>
        </html>
    ";
    exit();
}

if (isset($_COOKIE['form_data'])) {
    $form_data = unserialize($_COOKIE['form_data']);
} else {
    $form_data = [
        'num_people' => '',
        'first_name' => '',
        'last_name' => '',
        'address' => '',
        'credit_card' => '',
        'email' => '',
        'stay_date' => '',
        'arrival_time' => '',
        'extra_bed' => '',
        'amenities' => ''
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation Form</title>
</head>
<body>
<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
    <h2>Hotel Reservation Form</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="num_people">Number of People:</label>
        <select name="num_people" id="num_people" required>
            <option value="1" <?php if ($form_data['num_people'] == '1') echo 'selected'; ?>>1</option>
            <option value="2" <?php if ($form_data['num_people'] == '2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if ($form_data['num_people'] == '3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if ($form_data['num_people'] == '4') echo 'selected'; ?>>4</option>
        </select><br>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($form_data['first_name']); ?>" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($form_data['last_name']); ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($form_data['address']); ?>" required><br>

        <label for="credit_card">Credit Card:</label>
        <input type="text" id="credit_card" name="credit_card" value="<?php echo htmlspecialchars($form_data['credit_card']); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($form_data['email']); ?>" required><br>

        <label for="stay_date">Stay Date:</label>
        <input type="date" id="stay_date" name="stay_date" value="<?php echo htmlspecialchars($form_data['stay_date']); ?>" required><br>

        <label for="arrival_time">Arrival Time:</label>
        <input type="time" id="arrival_time" name="arrival_time" value="<?php echo htmlspecialchars($form_data['arrival_time']); ?>" required><br>

        <label for="extra_bed">Extra Bed for Child:</label>
        <input type="checkbox" id="extra_bed" name="extra_bed" <?php if ($form_data['extra_bed'] == "Yes") echo 'checked'; ?>><br>

        <label for="amenities">Amenities:</label><br>
        <input type="checkbox" id="air_conditioning" name="amenities[]" value="Air Conditioning" <?php if (strpos($form_data['amenities'], 'Air Conditioning') !== false) echo 'checked'; ?>>
        <label for="air_conditioning">Air Conditioning</label><br>
        <input type="checkbox" id="smoking_area" name="amenities[]" value="Smoking Area" <?php if (strpos($form_data['amenities'], 'Smoking Area') !== false) echo 'checked'; ?>>
        <label for="smoking_area">Smoking Area</label><br>

        <button type="submit" name="reservation">Submit Reservation</button>
        <button type="submit" name="clear_form">Clear Form</button>
    </form>
    <form method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
<?php else: ?>
    <h2>Login</h2>
    <?php if (isset($login_error)) echo "<p style='color:red;'>$login_error</p>"; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Access to the hotel reservation form is restricted to logged-in users only.</p>
<?php endif; ?>
</body>
</html>
