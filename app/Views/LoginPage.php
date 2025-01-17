<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php base_url() ?>/assets/login.css">
    <link href="//fonts.googleapis.com/css?family=Sirin+Stencil" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container demo-1" style="margin: 0; padding: 0;max-width: 100%; height: 100%;">
        <div class="content">
            <div id="large-header" class="large-header">
                <div style="display: flex; justify-content: center; margin-top: 10px; margin-bottom: 50px;"><img class="login-form__logo" src="<?php base_url() ?>/assets/img/logo_course.png" alt="Logo"></div>

                <div class="main-agileits">
                    <div class="form-w3-agile">
                        <h2 style="font-family: Arial, Helvetica, sans-serif">ĐĂNG NHẬP</h2>
                        <form action="/LoginController/login" method="POST">
                            <div class="form-sub-w3">
                                <input class="login-form__account-input" type="text" placeholder="Tài khoản" name="account" id="1">
                                <div class="icon-w3">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="form-sub-w3">
                                <input class="login-form__password-input" type="password" name="password" id="2">

                            </div>
                            <div class="clear"></div>
                            <div class="submit-w3l">
                                <input style="font-family: Arial, Helvetica, sans-serif" class="login-form__submit" type="submit" name="login" value="Đăng nhập">
                            </div>
                            <div style="color: red; margin-top: 20px">
                                <?php
                                if (isset($validator)) {
                                    echo $validator->listErrors();
                                }
                                ?>
                                <?php
                                if (isset($login_failed)) {
                                    echo $login_failed;
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                    <!--//form-ends-here-->
                </div><!-- copyright -->
                <div class="copyright w3-agile">
                    <p>Design by LEARN HUB ACADEMY</p>
                </div>
                <!-- //copyright -->
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>