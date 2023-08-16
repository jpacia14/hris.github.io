<?php
   include('session.php'); // Include your database connection configuration
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = mysqli_real_escape_string($link, $_POST['username']);
      $password = mysqli_real_escape_string($link, $_POST['password']);
      
      // Hash the password securely
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      
      // Insert the user's credentials into the database
      $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
      
      if (mysqli_query($link, $sql)) {
         echo "User created successfully!";
      } else {
         echo "Error: " . mysqli_error($link);
      }
   }
?>

<!-- Your HTML form to capture user credentials -->
<html>
   <body>
      <form action="" method="post">
         <label>Username:</label>
         <input type="text" name="username" required><br><br>
         
         <label>Password:</label>
         <input type="password" name="password" required><br><br>
         
         <input type="submit" value="Create User">
      </form>
   </body>
</html>