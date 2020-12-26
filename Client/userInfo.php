<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>User Information</title>
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
<?php include('../Server/userInfoServer.php'); ?>

<body>
    <div>
        <?php include_once('component/header.php');?>
    </div>
    <div class="container-fluid" style="padding-top: 80px;">
        <div class="display-4 text-center text-dark text-uppercase">Thông tin cá nhân</div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-left text-info">Thông tin Scientist</h5>
                    <hr>
                    <div>
                        <p><strong>ID: </strong>
                            <?php if($scientist_data['id']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $scientist_data['id'];?>
                            <?php endif ?>
                        </p>
                        <p><strong>Họ: </strong>
                            <?php if($scientist_data['last_name']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $scientist_data['last_name'];?>
                            <?php endif ?>
                        </p>
                        <p><strong>Tên lót: </strong>
                            <?php if($scientist_data['middle_name']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $scientist_data['middle_name'];?>
                            <?php endif ?>
                        </p>
                        <p><strong>Tên: </strong>
                            <?php if($scientist_data['first_name']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $scientist_data['first_name'];?>
                            <?php endif ?>
                        </p>
                        <p><strong>Số điện thoại: </strong>
                            <?php if($scientist_data['phone']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $scientist_data['phone'];?>
                            <?php endif ?>
                        </p>
                        <p><strong>Địa chỉ: </strong>
                            <?php if($scientist_data['address']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $scientist_data['address'];?>
                            <?php endif ?>
                        </p>
                        <p><strong>Tổ chức: </strong>
                            <?php if($scientist_data['organization']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $scientist_data['organization'];?>
                            <?php endif ?>
                        </p>
                        <p><strong>Công việc: </strong>
                            <?php if($scientist_data['job']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $scientist_data['job'];?>
                            <?php endif ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if($_SESSION['role_reviewer'] == TRUE):?>
                    <h5 class="text-left text-info">Thông tin Reviewer</h5>
                    <hr>
                    <div>
                        <p><strong>Email tổ chức: </strong>
                            <?php if($reviewer_data['business_email']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $reviewer_data['business_email'];?>
                            <?php endif ?>
                        </p>
                        <p><strong>Email cá nhân: </strong>
                            <?php if($reviewer_data['personal_email']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $reviewer_data['personal_email'];?>
                            <?php endif ?>
                        </p>
                        <p><strong>Ngày cộng tác: </strong>
                            <?php if($reviewer_data['collaboration_date']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $reviewer_data['collaboration_date'];?>
                            <?php endif ?>
                        </p>
                        <p><strong>Trình độ học thuật: </strong>
                            <?php if($reviewer_data['qualification']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $reviewer_data['qualification'];?>
                            <?php endif ?>
                        </p>
                    </div>
                    <?php endif ?>
                    <?php if($_SESSION['role_author'] == TRUE):?>
                    <h5 class="text-left text-info">Thông tin Author</h5>
                    <hr>
                    <div>
                        <p><strong>Email cá nhân: </strong>
                            <?php if($author_data['author_email']==NULL):?>
                            <i class="text-muted">
                                <?php echo "Chưa có thông tin";?>
                            </i>
                            <?php else: ?>
                            <?php echo $author_data['author_email'];?>
                            <?php endif ?>
                        </p>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-right" style="padding-bottom: 40px;">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update-modal">
                Cập nhật thông tin
            </button>
        </div>
        <div class="modal fade" id="update-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cập thông tin cho người dùng :
                            <?php echo $scientist_data['id'] ;?>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-container" name="updateForm" method="POST" action="userInfo.php">
                            <div class="text-left text-info text-uppercase"><strong>Phần thông tin Scientist</strong>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="lastname">Họ</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="Họ" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lastname">Tên lót</label>
                                    <input type="text" class="form-control" name="middlename" placeholder="Tên lót"
                                        required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="firstname">Tên</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="Tên" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="number" class="form-control" name="phone" placeholder="Số điện thoại"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" placeholder="Địa chỉ"
                                        required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="organization">Tổ chức ( Nơi công tác )</label>
                                    <input type="text" class="form-control" name="organization"
                                        placeholder="Nơi làm việc" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="job">Công việc</label>
                                    <input type="text" class="form-control" name="job" placeholder="Công việc" required>
                                </div>
                            </div>
                            <?php if($_SESSION['role_reviewer']==TRUE):?>
                            <div class="text-left text-info text-uppercase"><strong>Phần thông tin Reviewer</strong>
                            </div>
                            <hr>
                                <div class="form-group">
                                    <label for="businessEmail">Email tổ chức</label>
                                    <input type="email" class="form-control" name="businessEmail" placeholder="Email"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="personalEmail">Email cá nhân</label>
                                    <input type="email" class="form-control" name="personalEmail" placeholder="Email"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="collaborationDate">Ngày cộng tác</label>
                                    <input type="date" class="form-control" name="collaborationDate"
                                        placeholder="Ngày cộng tác" required>
                                </div>
                                <div class="form-group">
                                    <label for="qualification">Trình độ học thuật</label>
                                    <input type="text" class="form-control" name="qualification"
                                        placeholder="Trình độ, bằng câp" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" placeholder="Địa chỉ"
                                        required>
                                </div>
                            <?php endif ?>
                            <?php if($_SESSION['role_author']==TRUE):?>
                                <div class="text-left text-info text-uppercase"><strong>Phần thông tin Author</strong>
                                </div>
                                <hr>
                                    <div class="form-group">
                                        <label for="personalEmail">Email cá nhân</label>
                                        <input type="email" class="form-control" name="authorEmail" placeholder="Email"
                                            required>
                                    </div> 
                            <?php endif ?>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success" name="updateBtn">Lưu thông tin</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update-success-modal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cập nhật</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-left text-success"><strong>
                                Cập nhật thông tin thành công !
                            </strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="userinfo.php">
                            <button type="submit" class="btn btn-secondary" name="closeBtn">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>