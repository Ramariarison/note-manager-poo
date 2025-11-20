<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/index.css">
    <title>Register page</title>
</head>
<body>
    <div>
        <div class="title">
            <h1>Register Page</h1>
            <h4>Please enter your details to register.</h4>
        </div>
        <div class="box">
            <div class="first-form">
                <form action="controllers/authentication.php" method="post">
                    <div class="label">
                        <label for="username">Username</label>
                        <br>
                            <input type="text" placeholder="  Vintsy">
                        <br>
                    </div>
                    <div class="label">
                        <label for="email">Email address</label>
                        <br>
                            <input type="email" placeholder="  email@address.com">
                        <br>
                    </div>
                    <div class="label">
                        <label for="password">Password</label>
                        <br>
                            <input type="password">
                        <br>
                    </div>
                    <div class="label">
                        <label for="passwordConfirmation">Password confirmation</label>
                        <br>
                            <input type="password">
                        <br>
                    </div>
                    <div class="btn">
                        <button type="submit">Register</button>
                        <div><a href="index.php">Login ?</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>