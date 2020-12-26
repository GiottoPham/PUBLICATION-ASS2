<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Publications-Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/login.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<?php include('Server/userLogin.php'); ?>
<body>
    <div class="container-fluid bg">
        <section>
            <div class="row justify-content-center" style="padding-top: 40px;">
                <div class="col-md-auto">
                    <h4 class="display-4 text-center text-primary text-uppercase"><b>Đăng Nhập</b></h4>
                    <h6 class="text-center text-light text-uppercase"><b>Chào mừng bạn đến với hệ thống Quản lý các bài báo. Nơi quy tụ của những tác giả hàng đầu trong các lĩnh vực nghiên cứu khoa học.</b></h6>  
                    <br>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-5 col-md-5">
                    <form class="form-container" name="loginForm" id="loginForm" method="POST" action="index.php">
                        <div class="form-group">
                            <label for="userName">Tên tài khoản</label>
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="User Name" required>
                            <div class="text-right" id="usernameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" required>
                            <div class="text-right text-danger" id="passwordError"></div>
                        </div>
                        <!-- update at 17:16 26-12-2020 -->
                        <legend class="col-form-label">Chọn vai trò đăng nhập</legend>
                                <div class="form-row">
                                <div class="form-group form-check col-md-4">
                                <input type="radio" class="form-check-input" name = "role" value="Author" checked>
                                <label class="form-check-label" for="Author">Tác giả liên lạc</label>
                                </div>
                                <div class="form-group form-check col-md-4">
                                <input type="radio" class="form-check-input" name = "role" value="Reviewer">
                                <label class="form-check-label" for="Reviewer">Phản biện</label>
                                </div>
                                <div class="form-group form-check col-md-4">
                                <input type="radio" class="form-check-input" name = "role" value="Editor">
                                <label class="form-check-label" for="Editor">Ban biên tập</label>
                                </div>
                                </div>
                                <!-- end update -->
                        <br>
                        <button type="submit" class="btn btn-primary btn-block" name="loginButton">Đăng nhập</button>
                        <br>
                        <div>Bạn chưa có tài khoản ? <a href="Client/register.php" class="text-primary">Đăng kí
                                ngay!</a></div>
                    </form>
                </div>
            </div>
    </div>
    </section>

    <div class="modal fade" id="error-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đăng kí</h4>
                </div>
                <div class="modal-body">
                    <p class="text-left text-danger"><strong>
                        <?php foreach($error as $e){echo $e;};?>
                        </strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    
    </div>
</body>

</html>