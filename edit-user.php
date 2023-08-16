<?php
   include("config.php"); // Include your database connection configuration
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = mysqli_real_escape_string($link, $_POST['username']);
      $newPassword = mysqli_real_escape_string($link, $_POST['new_password']);
      
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $username = mysqli_real_escape_string($db, $_POST['username']);
         $newInfo = mysqli_real_escape_string($db, $_POST['new_info']);
         
         // Check if the user exists
         $userExistsQuery = "SELECT * FROM users WHERE username = '$username'";
         $userExistsResult = mysqli_query($db, $userExistsQuery);
         
         if (mysqli_num_rows($userExistsResult) == 0) {
            echo "User does not exist. Edit user information failed.";
         } else {
            // Update the user's information in the database
            $sql = "UPDATE users SET info = '$newInfo' WHERE username = '$username'";
            
            if (mysqli_query($db, $sql)) {
               echo "User information updated successfully!";
            } else {
               echo "Error updating user information: " . mysqli_error($db);
            }
         }
   }
?>

<!-- Your HTML form to update user credentials -->
<html>
   <body>
      <form action="" method="post">
         <label>Username:</label>
         <input type="text" name="username" required><br><br>
         
         <label>New Password:</label>
         <input type="password" name="new_password" required><br><br>
         
         <input type="submit" value="Update Password">
      </form>
   </body>
</html>