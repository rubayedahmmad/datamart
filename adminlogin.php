<?php
session_start();

// Check if the user is already logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("location: servicelist.php");
   exit;
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check credentials
    if($_POST['username'] === 'admin' && $_POST['email'] === 'adminpanel@gmail.com' && $_POST['password'] === 'admiN#13839'){
        // Set session variables
        $_SESSION['loggedin'] = true;
        header("location: servicelist.php");
    } else {
        $error = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        :root {
            --main-color: #0fa4af;
            --black: #13131a;
            --border: .1rem solid rgba(255, 255, 255, .3);
        }

        * {
            font-family: "Roboto", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            text-transform: capitalize;
            transition: .2s linear;
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
            scroll-padding-top: 9rem;
            scroll-behavior: smooth;
        }

        html::-webkit-scrollbar {
            width: .8rem;
        }

        html::-webkit-scrollbar-track {
            background: transparent;
        }

        html::-webkit-scrollbar-thumb {
            background: #fff;
            border-radius: 5rem;
        }

        body {
            background-image: url("images/bg.jpeg");
        }

        .login-form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: #fff;
            padding: 2rem;
            border-radius: .5rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            width: 30rem;
        }

        h3 {
            font-size: 2.5rem;
            color: var(--black);
            margin-bottom: 1rem;
            text-align: center;
        }

        .box {
            width: 100%;
            padding: 1rem;
            font-size: 1.6rem;
            color: var(--black);
            margin: 1rem 0;
            border: .1rem solid rgba(0, 0, 0, 0.1);
            border-radius: .5rem;
            text-transform: none;
        }

        .box label {
            color: var(--black);
        }

        .box input {
            width: calc(100% - 2rem);
            padding: .5rem;
            font-size: 1.6rem;
            border: none;
            outline: none;
            border-bottom: var(--border);
            margin-top: 0.5rem;
            text-transform: none;
        }

        .btn {
            display: inline-block;
            padding: 1rem 3rem;
            font-size: 1.7rem;
            color: #fff;
            background: var(--main-color);
            cursor: pointer;
            text-align: center;
            border-radius: .5rem;
            margin-top: 1rem;
            width: 100%;
        }

        .btn:hover {
            background: var(--black);
        }

        p {
            text-align: center;
            font-size: 1.4rem;
            color: var(--black);
            margin-top: 1rem;
        }

        p a {
            color: var(--main-color);
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-form-container">
        <form method="post" action="">
            <h3>Admin Login</h3>
            <?php if(isset($error)) echo "<p>$error</p>"; ?>
            <div class="box">
                <input type="text" id="username" placeholder="Username" name="username" required>
            </div>
            <div class="box">
                
                <input type="email" id="email" placeholder="Email" name="email" required>
            </div>
            <div class="box">
                
                <input type="password" id="password" placeholder="Password" name="password" required>
            </div>
            <input type="submit" class="btn" value="Login">
        </form>
    </div>
</body>
</html>
