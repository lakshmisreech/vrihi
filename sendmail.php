<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $foodname = $_POST["foodname"];
    $mealtype = $_POST["meal"];
    $category = $_POST["category"];
    $quantity = $_POST["quantity"];
    $email = $_POST["email"];
    $phoneno = $_POST["phoneno"];
    $address = $_POST["address"];

    // Database connection parameters
    $servername = "localhost"; // Replace with your server name
    $db_username = "root"; // Replace with your database username (default is "root" for XAMPP)
    $db_password = ""; // Replace with your database password (default is "" for XAMPP)
    $dbname = "demo"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername,$db_username,$db_password,$dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " .$conn->connect_error);
    }

    // Insert form data into database
    $sql = "INSERT INTO food  (username,foodname,mealtype,category,quantity,email,phoneno,address)
            VALUES ('$username','$foodname','$mealtype','$category','$quantity','$email','$phoneno','$address')";

    $sql2 =  "select * from ngos where ngoloc='$address'";
    $sres=mysqli_query($conn,$sql2);

    $headers = "From: vrihi06@gmail.com";

    while($row= mysqli_fetch_array($sres))
    {
        echo "<p>".$row[1]."</p></br>";
        if(mail("$row[1]","$username is ready to send","$foodname for $quantity members. The donar phone number is $phoneno",$headers))
        {
                echo "Email sent";
        }
        else
        {
                echo "Email sending failed ";
        }



    }


    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    // Close connection
    $conn->close();
}
?>