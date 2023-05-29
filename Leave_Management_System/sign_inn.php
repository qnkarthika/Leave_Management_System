<?php
// Database connectivity configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reason_page";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$alertMessage = "";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind the query
    $stmt = $conn->prepare("SELECT * FROM login WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, validate the password
        $row = $result->fetch_assoc();
        if ($row['password'] == $password) {
            // Password is correct, redirect to success page
            header("Location: course.html");
            exit();
        } else {
            // Invalid password
                   $alertMessage="Invalid Password";

        }
    } else {
        // User not found
            $alertMessage='User Not Found';

    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,500;0,600;0,700;1,100;1,200;1,300&display=swap');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;

}
body{
    background: #FF4B2B;
}

.login-page {
    height: 100vh;
    width: 100%;
    align-items: center;
    display: flex;
    justify-content: center;
}

.form {
  position: relative;
  filter:drop-shadow(0 0 2px #000000);
  border-radius: 5px;
  width: 360px;
  height: 520px;
  background-color: #ffffff;
  padding:40px;
}

.form img {
    position: absolute;
    height: 20px;
    top: 230px;
    right: 60px;
    cursor: pointer;
}

.form input {
    outline: 0;
    background: #f2f2f2;
    border-radius: 4px;
    width: 100%;
    border: 0;
    margin: 15px 0;
    padding: 15px;
    font-size: 14px;
}

.form input:focus {
    box-shadow: 0 0 5px 0 rgba(106, 98, 210);
}

span {
    color: red;
    margin: 10px 0;
    font-size: 14px;
}

.form button {
    outline: 0;
    background: #FF4B2B;
    width: 100%;
    border: 0;
    margin-top: 10px;
    border-radius: 3px;
    padding: 15px;
    color: #FFFFFF;
    font-size: 15px;
    -webkit-transition: all 0.3 ease;
    transition: all 0.4s ease-in-out;
    cursor: pointer;
}

.form button:hover,
.form button:active,
.form button:focus {
    background: black;
    color: #fff;

}

.message{
    margin: 15px 0;
    text-align: center;

}
.form .message a {
    font-size: 14px;
    color: #6a62d2;
    text-decoration: none;
}
    </style>
</head>
<body>
    <div class="login-page">
        <div class="form">
            <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                <h2>SIGN IN TO YOUR ACCOUNT</h2>
                <input type="text" placeholder="Username" id="user" name="username" autocomplete="off" required />
                <input type="hidden" id="fake-password" />
                <input type="password" placeholder="Password" id="pass" name="password" autocomplete="off" required />
                <span id="error-msg" style="color: red;"><?php echo $alertMessage; ?></span>
                <img src="https://cdn2.iconfinder.com/data/icons/basic-ui-interface-v-2/32/hide-512.png" onclick="show()" id="showimg">
                <span id="vaild-pass"></span>
                <button class="btn btn-primary profile-button" type="submit" name="submit">SIGN IN</button>
                <p class="message"><a href="password.html">Forgot your password?</a></p>
            </form>
            <form class="signup-form" action="sign_up.html">
                <button class="btn btn-primary profile-button" type="submit">SIGN UP</button>
            </form>
        </div>
    </div>
    <script>
        function formvalid() {
  var vaildpass = document.getElementById("pass").value;

  if (vaildpass.length <= 8 || vaildpass.length >= 20) {
    document.getElementById("vaild-pass").innerHTML = "Minimum 8 characters";
    return false;
  } else {
    document.getElementById("vaild-pass").innerHTML = "";
  }
}

function show() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
    document.getElementById("showimg").src =
      "https://static.thenounproject.com/png/777494-200.png";
  } else {
    x.type = "password";
    document.getElementById("showimg").src =
      "https://cdn2.iconfinder.com/data/icons/basic-ui-interface-v-2/32/hide-512.png";
  }
}
    </script>
</body>
</html>