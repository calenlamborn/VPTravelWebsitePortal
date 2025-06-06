<?php $this->layout('master', ['title' => 'Sign Up']) ?>

<main>
    <div class="background-container" id="parallax">
        <img src="/venturepilot/assets/signup-background.jpg" alt="Sign-up Background" class="background-image">
        <div class="login-container">
            <div class="login-box">
                <img src="./assets/logo.png" alt="Logo" class="logo">
                <h6>Create New Account</h6>
                <form action="<?= $this->url('signup') ?>" method="post">
                    <div class="input-wrapper">
                        <img src="./assets/user-icon.png" alt="Username Icon" class="input-icon">
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-wrapper">
                        <img src="./assets/password-icon.png" alt="Password Icon" class="input-icon">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="signup-btn">Create Account</button>
                </form>
                <a href="<?= $this->url('login') ?>" class="login-link">Login</a>
            </div>
        </div>
    </div>
</main>

<style>
    .background-container {
        position: relative;
        overflow: hidden;
        height: 100vh;
    }

    .background-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .login-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
    }

    .login-box {
        background-color: rgba(30, 30, 30, 0.95);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 400px;
        width: 100%;
    }

    .logo {
        width: 100px;
        margin-bottom: 20px;
    }

    .input-wrapper {
        position: relative;
        margin-bottom: 20px;
    }

    .input-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
    }

    input[type="text"],
    input[type="password"] {
        padding: 10px 40px;
        width: calc(100% - 80px);
        border: 1px solid #ccc;
        border-radius: 20px;
        outline: none;
    }

    .signup-btn {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 10px 40px;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    }

    .signup-btn:hover {
        background-color: #218838;
    }

    .signup-link {
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
    }

    .signup-link:hover {
        text-decoration: underline;
    }

    h6 {
        padding-bottom: 10px;
    }

</style>

<!-- Parallax effect for the sign-up background -->
<script>
    var parallaxContainer = document.getElementById('parallax');
    var backgroundImage = document.querySelector('.background-image');
    
    parallaxContainer.addEventListener('mousemove', function(event) {
        var containerRect = parallaxContainer.getBoundingClientRect();

        var mouseX = event.clientX - containerRect.left;
        var mouseY = event.clientY - containerRect.top;

        var offsetX = mouseX - containerRect.width / 2;
        var offsetY = mouseY - containerRect.height / 2;

        backgroundImage.style.transform = 'translate(' + offsetX / 220 + 'px, ' + offsetY / 220 + 'px)';
    });
</script>