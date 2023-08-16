<?php
   include("config.php"); // Include your database connection configuration
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = mysqli_real_escape_string($link, $_POST['username']);
      $newPassword = mysqli_real_escape_string($link, $_POST['new_password']);
      
      // Check if the user exists
      $userExistsQuery = "SELECT * FROM users WHERE username = '$username'";
      $userExistsResult = mysqli_query($link, $userExistsQuery);
      
      if (mysqli_num_rows($userExistsResult) == 0) {
         echo "User does not exist. Password reset failed.";
      } else {
         // Hash the new password securely
         $hashed_new_password = password_hash($newPassword, PASSWORD_DEFAULT);
         
         // Update the user's password in the database
         $sql = "UPDATE users SET password = '$hashed_new_password' WHERE username = '$username'";
         
         if (mysqli_query($link, $sql)) {
            echo "Password reset successfully!";
         } else {
            echo "Error resetting password: " . mysqli_error($link);
         }
      }
   }
?>

<!-- Your HTML form to reset user password -->
<html>
   <body>
      <form action="" method="post">
         <label>Username:</label>
         <input type="text" name="username" required><br><br>
         
         <label>New Password:</label>
         <input type="password" name="new_password" required><br><br>
         
         <input type="submit" value="Reset Password">
      </form>
   </body>
</html>
