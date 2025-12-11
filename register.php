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
    <title>Register page</title>
</head>
<body>
    <div class="container">
        <div>
            <div class="title">
                <h1><span>Register</span> Page</h1>
                <h4>Please enter your details.</h4>
            </div>
            <div class="box">
                <div class="second-form">
                    <form action="controllers/authentication.php" method="post">
                        <div class="first-label">
                            <label for="username">Username</label>
                            <br>
                                <input type="text" placeholder="Vintsy" required>
                            <br>
                        </div>
                        <div class="label">
                            <label for="email">Email address</label>
                            <br>
                                <input type="email" placeholder="email@address.com" required>
                            <br>
                        </div>
                        <div class="label">
                            <label for="password">Password</label>
                            <div class="password-container">
                                <input id="password" type="password" required>
                                <div class="toggle" data-target="password">
                                    <i class="fa fa-eye"></i>
                                </div>
                            </div>
                        </div>
                        <div class="label">
                            <label for="password-confirmation">Password confirmation</label>
                            <div class="password-container">
                                <input id="password-confirmation" type="password" required>
                                <div class="toggle" data-target="password-confirmation">
                                    <i class="fa fa-eye"></i>
                                </div>
                            </div>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = document.querySelectorAll('.toggle');
        
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const toggleIcon = this.querySelector('i');
                
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                if (toggleIcon.classList.contains('fa-eye')) {
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            });
        });
    });
</script>
</html>