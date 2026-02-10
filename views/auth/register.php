<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/authentication.css">
    <title>Register page</title>
</head>
<body>
    <div class="container">
        <div>
            <div class="title">
                <h1><span>Register</span> Page</h1>
                <h4>Please enter your details.</h4>
            </div>

            <!-- Messages d'erreur/succés -->
            <?php if (!empty($success) && is_string($success)) : ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error) && is_string($error)) : ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($errors['general'])) : ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($errors['general']) ?>
                </div>
            <?php endif; ?>

            <div class="box">
                <div class="second-form">
                    <form action="/crashProject/public/register" method="post">
                        <div class="first-label">
                            <label for="username">Username</label>
                            <br>
                                <input name="username" type="text" 
                                    placeholder="Vintsy"
                                    value="<?= htmlspecialchars($old['username'] ?? '') ?>"
                                    class="<?= isset($errors['username']) ? 'form-input error' : '' ?>"
                                    required>
                            <br>
                            <?php if (isset($errors['username'])) : ?>
                                <div class="error-message"><?= htmlspecialchars($errors['username']) ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="label">
                            <label for="email">Email address</label>
                            <br>
                                <input name="email" type="email" 
                                    placeholder="email@address.com" 
                                    value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                                    class="<?= isset($errors['email']) ? 'form-input error' : '' ?>"
                                    required>
                            <br>
                            <?php if(isset($errors['email'])) : ?>
                                <div class="error-message"><?= htmlspecialchars($errors['email']) ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="label">
                            <label for="password">Password</label>
                            <div class="password-container">
                                <input name="password" id="password" type="password"
                                    class="<?= isset($errors['password']) ? 'form-input error' : '' ?>"
                                    required>
                                <div class="toggle" data-target="password">
                                    <i class="fa fa-eye"></i>
                                </div>
                            </div>
                            <?php if(isset($errors['password'])) : ?>
                                <div class="error-message"><?= htmlspecialchars($errors['password']) ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="label">
                            <label for="password-confirmation">Password confirmation</label>
                            <div class="password-container">
                                <input name="password_confirm" id="password-confirmation" type="password" required>
                                <div class="toggle" data-target="password-confirmation">
                                    <i class="fa fa-eye"></i>
                                </div>
                            </div>
                        </div>
                        <div class="btn">
                            <button type="submit">Register</button>
                            <div><a href="/crashProject/public/loginPage">Want to login ?</a></div>
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

        // Validation correspondance des mots de passe
        const form = document.querySelector('form');
        const password = document.getElementById('password');
        const passwordConfirm = document.getElementById('password-confirmation');
        
        form.addEventListener('submit', function(e) {
            if (password.value !== passwordConfirm.value) {
                e.preventDefault();
                alert('Passwords do not match!');
                password.focus();
            }
        });
    });
</script>
</html>