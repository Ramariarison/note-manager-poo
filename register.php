<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <title>Register page</title>
</head>
<body>
    <div class="container">
        <div>
            <div class="title">
                <h1><span>Register</span> Page</h1>
                <h4>Please enter your informations to register.</h4>
            </div>
            <div class="box">
                <div class="second-form">
                    <form action="controllers/authentication.php" method="post">
                        <div class="first-label">
                            <label for="username">Username</label>
                            <br>
                                <input type="text" placeholder="Vintsy">
                            <br>
                        </div>
                        <div class="label">
                            <label for="email">Email address</label>
                            <br>
                                <input type="email" placeholder="email@address.com">
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
                            <div><a href="index.php">Want to login ?</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>