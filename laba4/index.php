<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #000;
            overflow: hidden;
            position: relative;
        }

        video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            z-index: -1000;
        }

        .blur {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(10px); 
            z-index: -999; 
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            text-align: center;
            color: white;
            z-index: 1000;
            font-family: 'Intro', sans-serif;
        }

        .content a {
            display: inline-block;
            padding: 20px 40px;
            text-decoration: none;
            color: white;
            background-color: transparent;
            border: 2px solid white;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            font-size: 34px;
            margin-top: 20px;
        }

        .content a:hover {
            background-color: darkgreen;
        }
        .content h1 {
            font-size: 48px;
            text-shadow: 4px 4px 8px rgba(0,0,0,0.8); 
        }
    </style>
</head>
<body>
    <video autoplay loop muted>
        <source src="ESL_Pro_League_Season_9_Opener.mp4" type="video/mp4">
        </video>

        <div class="blur"></div> 

        <div class="content">
            <h1>Start your path to ESL Pro League</h1>
            <p><a href="login.php">Let's get started </a></p>
        </div>
    </body>
    </html>