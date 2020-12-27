<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Post Paper</title>
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
<?php include('../Server/postPaperServer.php'); ?>
<body>
    <div class="container-fluid bg">
        <section>
            <div class="row justify-content-center" style="padding-top: 40px;">
                <div class="col-md-auto">
                    <h4 class="display-4 text-center text-primary text-uppercase"><b>Thêm bài báo</b></h4>
                </div>
            </div>
            <div class="row justify-content-center">
            <form class="form-container" name="signUpForm" id="signUpForm" method="POST" action="postPaper.php">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <div class="form-group">
                                <div class="text-left text-info text-uppercase"><strong>Phần thông tin bài báo</strong></div>
                                <hr>    
                                <label for="title">Tiêu đề</label>
                                <textarea class="form-control" rows="3" id="title" name="title" placeholder="Tối đa 255 chữ" required></textarea>
                                </textarea>
                                </div>
                                <div class="form-group">
                                <label for="summary">Tóm tắt</label>
                                <textarea class="form-control" rows="3" id="summary" name="summary" placeholder="Tối đa 255 chữ" required></textarea>
                                </textarea>
                                </div>
                                <div class="form-group">
                                <label for="link">File bài báo</label>
                                    <input type="text" class="form-control" name="link"
                                        placeholder="File bài báo (link)" required>
                                </div>
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="contactauthor">Tác giả liên lạc</label>
                                    <input type="text" class="form-control" name="contactauthor"
                                        placeholder="Id của tác giả liên lạc" required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="pagenum">Số trang</label>
                                    <input type="number" class="form-control" name="pagenum"
                                        placeholder="Số trang bài báo" required>
                                </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <div class="text-left text-info text-uppercase"><strong>Thông tin sách (phản biện sách)</strong></div>
                                <hr>  
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="bookname">Tên sách</label>
                                        <input type="text" class="form-control" name="bookname" placeholder="Tên sách"
                                            >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="ISBN">ISBN</label>
                                        <input type="number" class="form-control" name="ISBN"
                                            placeholder="ISBN" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="publishedYear">Năm xuất bản</label>
                                        <input type="text" class="form-control" name="publishedYear" placeholder="Năm xuất bản"
                                            >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="page">Số trang</label>
                                        <input type="number" class="form-control" name="page"
                                            placeholder="Số trang" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="publisher">Nhà xuất bản</label>
                                        <input type="text" class="form-control" name="publisher" placeholder="Nhà xuất bản"
                                            >
                                    </div>
                                </div>
                                <!-- update at 17:16 26-12-2020 -->
                                <legend class="col-form-label">Loại bài báo</legend>
                                <div class="form-row">
                                <div class="form-group form-check">
                                <input type="radio" class="form-check-input" name = "role" value="Research_Paper" checked>
                                <label class="form-check-label" for="Research_Paper">Bài báo nghiên cứu</label>
                                </div>
                                </div>
                                <div class="form-row">
                                <div class="form-group form-check">
                                <input type="radio" class="form-check-input" name = "role" value="Review_Paper">
                                <label class="form-check-label" for="Review_Paper">Bài báo phản biện sách</label>
                                </div>
                                </div>
                                <div class="form-row">
                                <div class="form-group form-check">
                                <input type="radio" class="form-check-input" name = "role" value="General_Paper">
                                <label class="form-check-label" for="General_Paper">Bài báo tổng quan</label>
                                </div>
                                </div>
                                <!-- end update -->
                            </div>
                        </div>
                        <div class="text-right">
                        <button type="submit" class="btn btn-primary" name="postButton">Thêm bài báo</button>
                        <button type="reset" class="btn btn-secondary" name="postButton">Làm mới</button>
                        </div>
                        <div class="text-left text-dark">Bạn đã thêm bài báo rồi? <a href="editorHomePage.php" class="text-primary">Quay lại trang chủ</a></div>
                    </form> 
                </div>
            </div>
    </div>
    </section>

    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm bài báo</h4>
                </div>
                <div class="modal-body">
                    <p class="text-left text-success"><strong>Chúc mừng, bạn đã thêm một bài báo thành công</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <a href="editorHomePage.php" class="btn btn-primary" role="button">Về trang chủ</a>
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