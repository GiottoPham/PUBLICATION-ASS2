<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/login.css">
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
<?php include('../Server/userRegister.php'); ?>
<body>
    <div class="container-fluid bg">
        <section>
            <div class="row justify-content-center" style="padding-top: 40px;">
                <div class="col-md-auto">
                    <h4 class="display-4 text-center text-primary text-uppercase"><b>Đăng kí</b></h4>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-6 col-md-10">
                    <form class="form-container" name="signUpForm" id="signUpForm" method="POST" action="register.php">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <div class="form-group">
                                <div class="text-left text-info text-uppercase"><strong>Phần thông tin tài khoản</strong></div>
                                <hr>    
                                <label for="userName">Tên tài khoản</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Tên tài khoản" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Mật khẩu" required>
                                </div>
                                <div class="form-group">
                                    <label for="confrimPassword">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" name="confirmPassword"
                                        placeholder="Nhập lại mật khẩu" required>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <div class="text-left text-info text-uppercase"><strong>Phần thông tin cá nhân</strong></div>
                                <hr>  
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="lastname">Họ</label>
                                        <input type="text" class="form-control" name="lastname" placeholder="Họ"
                                            required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="lastname">Tên lót</label>
                                        <input type="text" class="form-control" name="middlename" placeholder="Tên lót"
                                            required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="firstname">Tên</label>
                                        <input type="text" class="form-control" name="firstname" placeholder="Tên"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="number" class="form-control" name="phone"
                                            placeholder="Số điện thoại" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" class="form-control" name="address" placeholder="Địa chỉ"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="organization">Nơi công tác</label>
                                        <input type="text" class="form-control" name="organization"
                                            placeholder="Nơi làm việc" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="job">Công việc</label>
                                        <input type="text" class="form-control" name="job" placeholder="Công việc"
                                            required>
                                    </div>
                                </div>
                                <!-- update at 17:16 26-12-2020 -->
                                <legend class="col-form-label">Đăng kí vai trò</legend>
                                <div class="form-row">
                                <div class="form-group form-check col-md-4">
                                <input type="checkbox" class="form-check-input" name = "role[]" value="Author" checked>
                                <label class="form-check-label" for="Author">Tác giả liên lạc</label>
                                </div>
                                <div class="form-group form-check col-md-4">
                                <input type="checkbox" class="form-check-input" name = "role[]" value="Reviewer">
                                <label class="form-check-label" for="Reviewer">Phản biện</label>
                                </div>
                                <div class="form-group form-check col-md-4">
                                <input type="checkbox" class="form-check-input" name = "role[]" value="Editor">
                                <label class="form-check-label" for="Editor">Ban biên tập</label>
                                </div>
                                </div>
                                <!-- end update -->
                            </div>
                        </div>
                        <div class="text-right">
                        <button type="submit" class="btn btn-primary" name="signUpButton">Đăng ký</button>
                        <button type="reset" class="btn btn-secondary" name="signUpButton">Làm mới</button>
                        </div>
                        <div class="text-left text-dark">Bạn đã có tài khoản ? <a href="../index.php" class="text-primary">Đăng nhập
                                ngay!</a></div>
                    </form> 
                </div>
            </div>
    </div>
    </section>

    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đăng kí</h4>
                </div>
                <div class="modal-body">
                    <p class="text-left text-success"><strong>Chúc mừng, bạn đã đăng kí thành công !, mọi thông tin của bạn đã được lưu</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <a href="../index.php" class="btn btn-primary" role="button">Về đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="failed-author-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đăng kí</h4>
                </div>
                <div class="modal-body">
                    <p class="text-left text-success"><strong>Bạn không thể đăng kí cùng lúc 2 vai trò là tác giả liên lạc và ban biên tập</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="error-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đăng nhập</h4>
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