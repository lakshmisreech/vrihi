<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyle.css">
    <!-- Add other CSS links as needed -->
</head>
<body>

<div class="container">
    <div class="regform">
        <form action="" method="post" id="emailForm">
            <p class="logo"><b style="color: #06C167;">VRIHI</b></p>
            <p id="heading">Create your account</p>
            <div class="input">
                <label class="textlabel" for="name">User name</label><br>
                <input type="text" id="name" name="name" required/>
            </div>
            <div class="input">
                <label class="textlabel" for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <span id="emailError" style="color: red;"></span>
            </div>
            <div class="password">
                <label class="textlabel" for="password">Password</label>
                <input type="password" name="password" id="password" required/>
                <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>
            </div>
            <div class="radio">
                <input type="radio" name="gender" id="male" value="male" required/>
                <label for="male" >Male</label>
                <input type="radio" name="gender" id="female" value="female">
                <label for="female" >Female</label>
            </div>
            <div class="btn">
                <button type="submit" name="sign">Continue</button>
            </div>
            <div class="signin-up">
                <p style="font-size: 20px; text-align: center;">Already have an account? <a href="signin.php"> Sign in</a></p>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById("emailForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    var emailInput = document.getElementById("email").value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (emailInput === "") {
        document.getElementById("emailError").innerText = "Email is required";
        return false;
    }
    
    if (!emailRegex.test(emailInput)) {
        document.getElementById("emailError").innerText = "Invalid email format";
        return false;
    }
    
    if (!emailInput.endsWith("@gmail.com")) {
        document.getElementById("emailError").innerText = "Only Gmail addresses are allowed";
        return false;
    }
    
    // If all validations pass, submit the form
    alert("Form submitted successfully!");
    // Replace alert with form submission code
});
</script>

</body>
</html>
