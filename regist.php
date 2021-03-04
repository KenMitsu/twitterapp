<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width,initial-scale=1.0">
   <link rel="stylesheet" href="c.css">
   <title>Account Registration</title>
 </head>
 <body>
   	<id="top"><h2>Account Registration</h2>
   <form action="regist_result.php" method="post">
     <label for="username">Username</label>
     <input type="username" name="username">
     <br>
     <label for="password">Password</label>
     <input type="password" name="password">
     <br>
     <button type="submit" class="square_btn2">Sign Up!</button>

     <p>Set the password using at least 8 characters including 1 or more half-width alphanumeric characters.</p>
   </form>
 </body>
</html>
