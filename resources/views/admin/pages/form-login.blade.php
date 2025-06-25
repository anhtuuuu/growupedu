<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{ URL::to(config('asset.css_path') . 'login_style.css') }}>
    <title>Document</title>
</head>

<body>
    {{-- <p><?php //print_r(session()->all()) ?></p> --}}
    <?php if(Session::has('message')): ?>
    <div class="message">
        <p>{{Session::get('message')}}</p>
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="box1"></div>
        <div class="box2"></div>
        <div class="box3"></div>
        <div class="box4"></div>
        <div class="box5"></div>
        <div class="box6"></div>
        <form action="<?php echo URL::to('admin-dashboard') ?>" method="post">
            {{csrf_field()}}
            <h1>Welcome!</h1>
            <div class="fill">
                <input type="text" name="email" id="email" required>
                <label for="email">Email</label>
            </div>
            <div class="fill">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>
            <div class="btn"><button>Login</button></div>
            <footer>
                <div class="remember">
                    <input type="checkbox" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="">Forgot password</a>

            </footer>
        </form>
    </div>
</body>

</html>
