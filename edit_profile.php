<?php

$page_name = "Edit Profile";
include_once "views/layouts/header.php";
include_once "Core/Helpers.php";
include_once "Core/Auth.php";
session_start();
?>

<body>
    <div class="mainContainer">
        <div class="profileCon">
            <img src="img9.jpg" alt="profile pic" />
            <h1>Ezey Jr</h1>
            <p><a href="">Click here to change your profile picture</a></p>
            <ul>
                <li><a href="user.html">Profile</a></li>
                <li><a href="../../templates/dashboard.html">Dashboard</a></li>
                <li>
                    <button onclick="history.back()" id="registerBtn">Back</button>
                    <ul id="registerMenu" class="menu">
                        <li><a href="../../login/signIn/signIn.html">Sign In</a></li>
                        <li><a href="../../login/signUp/signUp.html">Sign Up</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="formCon">
            <h2>User Profile</h2>
            <form action="" method="post">

                <label for="name"> Name</label>
                <input type="text" name="name" value="<?= Auth::user()->name; ?>" />


                <label for="email" >Email</label>
                <input type="email" value="<?= Auth::user()->email; ?>" />

                <label for="gender">Profile Picture</label>
                <input type="file" name="profile_picture">

                <button type="submit">Update Profile</button>
              

            </form>
        </div>

        <div class="formCon">
            <label for="password">Password</label>
            <input type="password" id="password" class="pass" />
            <i class="fa-solid fa-eye-slash" id="eyeIcon"></i>

        </div>
    </div>

    <script src="user.js">

    </script>
</body>

</html>


