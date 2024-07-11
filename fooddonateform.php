<?php
// Include the login.php file to establish the session
include("login.php");

// Check if the user is logged in
if($_SESSION['name'] == ''){
    header("location: signin.php");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$emailid = $_SESSION['email'];

// Establish database connection
$connection = mysqli_connect("localhost", "root", "", "demo");

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data
    $foodname = mysqli_real_escape_string($connection, $_POST['foodname']);
    $meal = mysqli_real_escape_string($connection, $_POST['meal']);
    $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);
    $phoneno = mysqli_real_escape_string($connection, $_POST['phoneno']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);

    // Insert form data into database
    $query = "INSERT INTO food_donations (email, food, type, category, phoneno, location, address, name, quantity) 
              VALUES ('$emailid', '$foodname', '$meal', '', '$phoneno', '', '$address', '$name', '$quantity')";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        // Send email
        sendEmail($foodname, $meal, $quantity, $phoneno, $address, $name);

        // Redirect to a delivery confirmation page
        header("location: delivery.html");
    } else {
        echo '<script type="text/javascript">alert("Data not saved")</script>';
    }
}

// Function to send email
function sendEmail($foodname, $meal, $quantity, $phoneno, $address, $name) {
    // Include PHPMailer classes
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    // Create a PHPMailer instance
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP(); // Send using SMTP
    $mail->Host = 'smtp.gmail.com'; // SMTP server
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'pavanachebrolu@gmail.com'; // SMTP username
    $mail->Password = 'pqpcezaaowarwjvg'; // SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 465; // TCP port to connect to, use 587 if you're using `PHPMailer::ENCRYPTION_STARTTLS`

    
    // Sender and recipient
    $mail->setFrom('vrihi06@gmail.com','vrihi-food-donation'); // Sender email and name
    $mail->addAddress('22b91a1223srkrec@gmail.com'); 
    $mail->addAddress('karrikartheekareddy2005@gmail.com'); 
    $mail->addReplyTo('vrihi06@gmail.com','vrihi-food-donation'); // Reply to sender email

    // Email content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'New Food Donation'; // Email subject
    $mail->Body = "Food Name: $foodname<br>Meal Type: $meal<br>Quantity: $quantity<br>Phone Number: $phoneno<br>Address: $address<br>Name: $name"; // Email body

    // Send email
    $mail->send();
    // Success message
    echo "<script>alert('Message was sent successfully!');</script>";
    echo "<script>document.location.href = 'newindex.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donate</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body style="background-color: #06C167;">
    <div class="container">
        <div class="regformf">
            <form action="" method="post">
                <p class="logo"><b style="color: #06C167; ">VRIHI</b></p>
                <div class="input">
                    <label for="foodname"> Food Name:</label>
                    <input type="text" id="foodname" name="foodname" required/>
                </div>
                <div class="radio">
                    <label for="meal">Meal type :</label> 
                    <br><br>
                    <input type="radio" name="meal" id="veg" value="veg" required/>
                    <label for="veg" style="padding-right: 40px;">Veg</label>
                    <input type="radio" name="meal" id="Non-veg" value="Non-veg" >
                    <label for="Non-veg">Non-veg</label>
                </div>
                <br>
                <div class="input">
                    <br><br>
                </div>
                <div class="input">
                    <label for="quantity">Quantity:(number of person /kg)</label>
                    <input type="text" id="quantity" name="quantity" required/>
                </div>
                <b><p style="text-align: center;">Contact Details</p></b>
                <div class="input">
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $_SESSION['name'] ;?>" required/>
                    </div>
                    <div>
                        <label for="phoneno">PhoneNo:</label>
                        <input type="text" id="phoneno" name="phoneno" maxlength="10" pattern="[0-9]{10}" required />
                    </div>
                </div>
                <div class="input">
                    <label for="location"></label>
                    <label for="address" style="padding-left: 10px;">Address:</label>
                    <textarea id="address" name="address" rows="4" cols="50"></textarea>
                </div>
                <div class="btn">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
