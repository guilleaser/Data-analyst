<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="files/style/style.css">
</head>
<body>
    <form action="files/php/home.php" method="POST">
        <label for="user">Usuario / correo</label>
        <input type="text" name="user" id="user" placeholder="Usuario">
        <input type="password" name="pass" id="pass" placeholder="Password">
        <input type="submit" value="Log in">
    </form>
    
</body>
</html>