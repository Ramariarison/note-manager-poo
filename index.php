<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div>
            <div class="title">
                <h1><span>Welcome</span> Back</h1>
                <h4>Please enter your details.</h4>
            </div>
            <div class="box">
                <div class="first-form">
                    <form action="controllers/authentication.php" method="post">
                        <div class="first-label">
                            <label for="username">Email address</label>
                            <br>
                                <input type="text" placeholder="email@address.com" required>
                            <br>
                        </div>
                        <div class="label">
                            <label for="password">Password</label>
                            <br>
                            <div class="password-container">
                                <input id="password" type="password" required>
                                <div id="toggle">
                                    <i class="fa fa-eye"></i>
                                </div>
                            </div>
                        </div>
                        <div class="btn">
                            <button type="submit">Login</button>
                            <div><a href="register.php">Want to register ?</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('toggle');
        const passwordInput = document.getElementById('password');
        const toggleIcon = toggle.querySelector('i');
        
        toggle.addEventListener('click', function() {
            // Basculer entre type password et text
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Basculer la classe pour changer l'icône
            this.classList.toggle('hide');
            
            // Alternative: Changer directement la classe Font Awesome
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>
</html>