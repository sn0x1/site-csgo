<?php
include("includes/header.php");
?>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      height: 2000px; 
    }

    .container {
      position: fixed;
      top: 0;
      width: 100%;
      transition: top 0.3s; 
      background-color: #f2f2f2;
      padding: 20px;
      z-index: 1000;
    }

    ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
    }

    .menu {
      display: flex;
      justify-content: center;
    }

    .menu li {
      margin-right: 40px;
      height: 40px;
      border: none;
      transition: background-color 0.3s;
      display: flex;
      align-items: center;
      border-radius: 5px;
    }

    .menu a {
      color: #333;
      text-decoration: none;
      padding: 15px 10px;
      text-align: center;
      font-size: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 5px;
    }

    .menu li:hover {
      background-color: #ccc;
    }
  </style>
</head>
<body>

<div class="container" id="menu">
  <nav class="menu">
    <ul>
      <li class="home"><a href="regteam.php">Create your team</a></li>
      <li><a href="showteams.php">Teams</a></li>
      <li><a href="showplayers.php">Players</a></li>
      <li><a href="showuserinfo.php">Profile</a></li>
    </ul>
  </nav>
</div>

<script>
  let prevScrollpos = window.pageYOffset;
  const menu = document.getElementById("menu");

  window.onscroll = function() {
    const currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      menu.style.top = "0";
    } else {
      menu.style.top = "-60px"; 
    }
    prevScrollpos = currentScrollPos;
  };

  menu.onmouseover = function() {
    menu.style.top = "0";
  };

  menu.onmouseout = function() {
    menu.style.top = "-60px"; 
  };
</script>
