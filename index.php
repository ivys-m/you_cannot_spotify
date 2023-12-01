<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>yuri</title>

    <link rel="stylesheet" href="./styles/user-access.css">
    <script src="./scripts/user_access.js" defer></script>
</head>

<body>
    <div class="wrapper grid-center">
        <form action="#">
            <input type="radio" name="radio" id="login" checked>
            <input type="radio" name="radio" id="register">
            <div class="btns-wrapper">
                <label for="login" class="btn">login</label>
                <label for="register" class="btn">register</label>
            </div>
            <div class="form-body">
                <div class="input-wrapper">
                    <input type="text" id="email" placeholder=" ">
                    <label for="email" id="email-label"></label>
                </div>
                <div class="input-wrapper username">
                    <input type="text" id="username" placeholder=" ">
                    <label for="username">username</label>
                </div>>
                <div class="input-wrapper">
                    <input type="password" id="pswd1" placeholder=" ">
                    <label for="pswd1">password</label>
                </div>
                <div class="input-wrapper pswd2">
                    <input type="password" id="pswd2" placeholder=" ">
                    <label for="pswd2">confirm password</label>
                </div>
                <div class="input-wrapper type">
                    <input type="checkbox" id="type">
                    <label for="type">artist?</label>
                </div>
                <button class="submit-btn btn">
                    sign
                    <span class="relative">up
                        <span class="absolute">in</span>
                    </span>
                </button>
                <div class="forgot-password-wrapper">
                    <a href="#" class="forgot-password" id="error-msg">forgot your password? I don't care</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>