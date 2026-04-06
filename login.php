<?php
session_start();
require_once "Core/Config.php";
require_once    ROOT . "/Core/Message.php";
require_once ROOT . "/Core/Auth.php";
require_once ROOT . "/views/components/inc_login.php";
Auth::logout_redirect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Blog | Login</title>
  <link rel="stylesheet" href="assets/css/guest.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="container">
    <div class="signInCon">
      <div class="logo">
        <i class="fa-solid fa-qrcode"></i>
        Blueco
      </div>
      <div class="signInDetails">
        <h1>Welcome Back!</h1>
        <p>To keep connecting with us please login with your personal info.</p>
        <button class="signInBtn"><a href="">Sign In</a></button>
      </div>
    </div>

    <div class="signUpCon">
      <h1>Login To Your Account</h1>
      <div class="signUpLogos">
        <i class="fa-brands fa-facebook-f"></i>
        <i class="fa-brands fa-google-plus-g"></i>
        <i class="fa-brands fa-linkedin-in"></i>
      </div>
      <p>Or use your email to login:</p>

      <form action="" method="post">
        <div class="signUpData">
          <i class="fa-regular fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" <?php if (Helpers::old_value("email")) { ?> value="<?= Helpers::old_value("email") ?>" <?php } ?>>
        </div>
        <div class="signUpData">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" placeholder="Password">
        </div>
        <?php if (Message::check()): ?>
          <span class="error">
            <?= htmlspecialchars(Message::getMessage(), ENT_QUOTES, 'UTF-8'); ?>
          </span>
        <?php endif; ?>

        <button class="signUpBtn" type="submit">Sign In</button>
      </form>
    </div>
  </div>
</body>

</html>