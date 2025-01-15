
<?php include('../config/connection.php'); ?>

<?php
function is_logged_in() {
    return isset($_SESSION['user']);
}

if(is_logged_in()) //if(isset($_SESSION["user"]))
{
    header('location:'.'index.php');//if user is logged in redirect to index.php
}
function display_messagesuccess($message) {
    $_SESSION['login'] = "<div class='success'>$message</div>";
}
function display_messageerror($message) {
    $_SESSION['login'] = "<div class='error text-center'>$message</div>";
}

?>
     <?php
     echo "<br><br><br><br><br><br>";
         if(isset($_SESSION['login']))
         {
             echo $_SESSION['login'];
             unset($_SESSION['login']);
         }
         if(isset($_SESSION['no-login-message']))
         {
             echo $_SESSION['no-login-message'];
             unset($_SESSION['no-login-message']);
         } 
         
     ?>

<?php 
if(isset($_POST['submit'])){
    $login = mysqli_real_escape_string($conn, $_POST['login']);//https://www.php.net/manual/en/mysqli.real-escape-string.php
    $plaintext_password = mysqli_real_escape_string($conn, $_POST['password']);
    // check if the user with login exists
    $sql = "SELECT * FROM adminaccount WHERE login='$login'";
    $result = mysqli_query($conn, $sql);
    //Count rows to check if the user exists
    $count = mysqli_num_rows($result);//if count is 1 then user exists
    if (!$result) {  echo "Error: " . $sql . "<br>" . mysqli_error($conn); exit(); }
    $verify = false;
    while ($row = mysqli_fetch_assoc($result)) {
        $hash = $row['password'];
        $verify = password_verify($plaintext_password, $hash);//https://www.php.net/manual/en/function.password-verify.php
    }
    if($count==1 && $verify ){//count 1 one user
//https://www.webslesson.info/2016/04/php-login-code-with-remember-me-login-details.html
if(!empty($_POST["remember"]))   
{
    setcookie ("member_login",$login,time()+ (30 * 24 * 60 * 60)); // Set the cookie to expire in one month
    setcookie ("member_password",$plaintext_password,time()+ (30 * 24 * 60 * 60));//https://www.php.net/manual/en/function.setcookie.php
   // $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
   display_messagesuccess("Login Successful.");
    $_SESSION['user'] = $login; // To check whether the user is logged in or not and logout will unset it//zeby nie bylo mozliwosci wejscia na strone bez logowania
}else  
{  
 if(isset($_COOKIE["member_login"]))   
 {  
  setcookie ("member_login","");  //if you dont choose remember => cookie will expire at the end of the session (when the browser closes)
 }  
 if(isset($_COOKIE["member_password"]))
 {  
  setcookie ("member_password","");  
 }  
}  
        // User available and login success
       // $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
       display_messagesuccess("Login Successful.");
        $_SESSION['user'] = $login; // To check whether the user is logged in or not and logout will unset it//zeby nie bylo mozliwosci wejscia na strone bez logowania
        // Redirect to index
        header('location:'.'index.php');
       
      
    }
    else{
        // User not available and login fail
     //   $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match. Please try again</div>";
     display_messageerror("Username or Password did not match. Please try again");
        // Redirect to index
      header('location:'.'login.php');
      
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BookStore System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login container">
        <h1 class="text-center">Please, login to access Admin</h1>
        <br><br>
        <br><br>
        <!-- Login Form, action blank we process in the same page -->
        <form action="" method="POST" class="text-center form">
    <div class="form-field">
     <label for="login">Login:</label>
     <input type="text" name="login" placeholder="Enter login" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>"><br><br>
        </div> 
            <div class="form-field">
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter Password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"><br><br>
            </div>
            <div class="form-field">
            <input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />  
            <label for="remember-me">Remember me</label>
            </div>  
            <br><br>
            <div class="form-field">
            <input type="submit" name="submit" value="Login" class="btn-primary">
            </div>
            <br><br>
        </form>
        <div class="form-field">
        <p style="text-align: center;">Created and administered by <b>Kacper Obrzut</b></p>
        </div>
    </div>
</body>
</html>