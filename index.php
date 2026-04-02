<?php
session_start();
require_once "Core/Config.php";
require_once ROOT . "/Core/Session.php";
require_once ROOT . "/Core/Message.php";
require_once ROOT . "/Core/Helpers.php";
require_once ROOT . "/Core/Auth.php";
require_once ROOT . "/Controller/PostController.php";


// start session everytime
$total_posts = count(PostController::index());
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog</title>
  <link rel="stylesheet" href="assets/css/modal.css" />
  <link rel="stylesheet" href="assets/css/page.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />


</head>


<body>
  <!-- main container -->
  <div class="container">
    <!-- first section -->
    <section>
      <div class="headerCon">
        <div class="header">
          <div class="pageLogo">
            <i class="fa-solid fa-qrcode"></i>
            Blog
          </div>

          <?php if (Auth::check() === true): ?>
            <div class="nav">
              <ul>
                <li><a href="edit_profile.php">Profile</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
              </ul>
            </div>
          <?php endif; ?>

          <div class="searchCon">
            <input type="search" name="" id="searchInput" placeholder="search.." />
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>

          <?php if (Auth::check() == false) : ?>
            <div class="userDetails">
              <p><a href="login.php">Login</a></p>
              <p><a href="register.php">Sign Up</a></p>
            </div>
        </div>
      <?php endif; ?>
      <!-- second div in the first section -->
      <div class="headerDetails">
        <p class="blog">Destination</p>
        <h1 class="blogTitle">Exploring the Wonders of Hiking</h1>
        <p class="blogContent">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore
          quasi sed earum quae error quas.
        </p>
      </div>
      </div>
    </section>

    <!-- second section -->
    <section>
      <div class="cardContainer">
        <h1 class="blogTitle">Blog</h1>
        <p class="blogContent">
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </p>
        <div class="nav">
          <ul>
            <li class="active"><a href="">All</a></li>
            <li><a href="">Destination</a></li>
            <li><a href="">Culinary</a></li>
            <li><a href="">lifestyle</a></li>
            <li><a href="">Tips & Hacks</a></li>
          </ul>
        </div>

        <!-- cards -->
        <div class="cardsWrapper" id="card-wrapper">
        </div>
      </div>
    </section>

    <!-- third section -->
    <section>
      <div class="imgCon">
        <div class="firstImg">
          <div class="images">
            <h1 class="blogTitle">Do you Want To Post?</h1>
            <p class="blogContent">Lorem ipsum dolor sit amet.</p>
            <button>Post Now</button>
          </div>
          <div class="images two">
            <p class="blogContent">Lorem ipsum dolor sit amet</p>
            <p><b>76</b></p>
          </div>
        </div>

        <div class="secondImg">
          <div class="images three">
            <h1 class="blogTitle">
              Creating memories that will last till eternity
            </h1>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="footCon">
        <div class="footNavs">
          <div class="pageLogo">
            <i class="fa-solid fa-qrcode"></i>
            Blog
          </div>
          <br />
          <div class="footContent">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt
            aspernatur quis nostrum culpa voluptatibus dolor sequi
            necessitatibus, perferendis repudiandae maiores!
          </div>
          <br />
          <div style="color: white">
            <b>2026 Blog, All rights reserved</b>
          </div>
        </div>

        <div class="footNavs">
          <ul>
            <li><a href="" class="active">About</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="">Blog</a></li>
            <li><a href="">Career</a></li>
          </ul>
        </div>

        <div class="footNavs">
          <ul>
            <li><a href="" class="active">Support</a></li>
            <li><a href="">Contact Us</a></li>
            <li><a href="">Return</a></li>
            <li><a href="">FAQ</a></li>
          </ul>
        </div>

        <div class="footNavs">
          <p>Get updates</p>
          <br />
          <div class="footEmail">
            <input
              type="email"
              name="email"
              id="email"
              placeholder="Enter your email.." />
            <button>Subscribe</button>
          </div>
          <br />
          <div class="footIcons">
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-x-twitter"></i>
            <i class="fa-brands fa-tiktok"></i> <br /><br />
            <ul class="footIconsNav">
              <li><a href="">Privacy policy</a></li>
              <li><a href="">Terms and Conditions</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <?php // include modals
  include_once ROOT . "/views/components/post-view-modal.php";
  ?>

  <script src="assets/js/page.js" type="module"></script>


</body>

</html>