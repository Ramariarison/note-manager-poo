<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div>
            <div class="title">
                <h1>Welcome Back</h1>
                <h3>Please enter your details to login.</h3>
            </div>
            <div class="box">
                <div class="second-form">
                    <form action="controllers/authentication.php" method="post">
                        <div class="first-label">
                            <label for="username">Email address</label>
                            <br>
                                <input type="text" placeholder="  email@address.com" required>
                            <br>
                        </div>
                        <div class="label">
                            <label for="password">Password</label>
                            <br>
                                <input type="password" required>
                            <br>
                        </div>
                        <div class="btn">
                            <div><button type="submit">Login</button></div>
                            <div><a href="register.php">Want to register ?</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>