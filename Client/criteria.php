<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Home Page</title>
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
<?php include('../Server/criteriaServer.php'); ?>

<body>
    <div>
        <?php include_once('component/header.php');?>
    </div>
    <div class="container-fluid" style="padding-top: 80px;">
        <div class="display-4 text-center text-info text-uppercase">Danh sách các tiêu chí đánh giá hiện nay</div>
        <hr>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nội dung của tiêu chí đánh giá</th>
                    <th class="text-center" scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($select_all_criteria_result as $criteria){ ?>
                <tr>
                    <td>
                        <?php echo '<strong>'.$criteria['criteria_id'].'</strong>'; ?>
                    </td>
                    <td>
                        <?php echo $criteria['content']; ?>
                    </td>
                    <td class="text-left">
                        <form class="option" method="POST" action="criteria.php">
                            <input type="hidden" name="criteriaId" value="<?php echo $criteria['criteria_id'];?>" />
                            <?php
                                $check_query = "select * from editor where id = '$userid'";
                                $check_result = mysqli_query($connect_handle, $check_query);
                            ?>
                            <?php if(mysqli_num_rows($check_result) > 0 && $_SESSION['role_editor'] == TRUE):?>
                                <button class="btn btn-primary" name="updatecriteria">Cập nhật tiêu chí</button>
                                <button class="btn btn-primary" name="insertrating">Thêm mức đánh giá</button>
                            <?php endif?>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <form method="POST" action="criteria.php">
                            <?php
                                $check_query = "select * from editor where id = '$userid'";
                                $check_result = mysqli_query($connect_handle, $check_query);
                            ?>
                            <?php if(mysqli_num_rows($check_result) > 0 && $_SESSION['role_editor'] == TRUE):?>
                                
                                <button type = "input" class="btn btn-primary float-left" name="insertcriteria">Thêm tiêu chí</button>
                                <br>
                            <?php endif?>
                        </form>                     
        <div class="modal fade" id="update-criteria-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cập nhật tiêu chí đánh giá :
                            <?php echo $criteriaId ;?>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-container" name="updatecriteriaForm" method="POST"
                            action="criteria.php">
                            <div class="form-group">
                                <label for="criteriaContent">Nội dung</label>
                                <textarea class="form-control" name="criteriaContent" rows="2"
                                placeholder="Nội dung"
                                required></textarea>
                            </div>
                            <div class="text-right">
                                <input type="hidden" name="criteriaId" value="<?php echo $criteriaId ;?>" />
                                <button type="submit" class="btn btn-success" name="updatecriteriaBtn">Lưu thông
                                    tin</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="insert-criteria-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm tiêu chí đánh giá :
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-container" name="updatecriteriaForm" method="POST"
                            action="criteria.php">
                            <div class="form-group">
                                <label for="criteriaContent">Nội dung</label>
                                <textarea class="form-control" name="criteriaContent" rows="2"
                                placeholder="Nội dung"
                                required></textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success" name="insertcriteriaBtn">Lưu thông
                                    tin</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update-success-modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog">
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
                    <form method="POST" action="criteria.php">
                            <button type="submit" class="btn btn-secondary" name="closeBtn">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="insert-criteria-success-modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm tiêu chí</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-left text-success"><strong>
                                Thêm tiêu chí đánh giá thành công !
                            </strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                    <form method="POST" action="criteria.php">
                            <button type="submit" class="btn btn-secondary" name="closeBtn">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="display-4 text-center text-info text-uppercase">Danh sách các mức đánh giá hiện nay</div>
        <hr>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Thuộc về tiêu chí đánh giá</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Điểm</th>
                    <th class="text-center" scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($select_all_rating_result as $rating){ ?>
                <tr>
                    <td>
                        <?php echo '<strong>'.$rating['criteria_id'].'</strong>'; ?>
                    </td>
                    <td>
                        <?php echo $rating['description']; ?>
                    </td>
                    <td>
                        <?php echo $rating['score']; ?>
                    </td>
                    <td class="text-left">
                        <form class="option" method="POST" action="criteria.php">
                            <input type="hidden" name="criteriaId" value="<?php echo $rating['criteria_id'];?>"/>
                            <input type="hidden" name="description" value="<?php echo $rating['description'];?>"/>
                            <?php
                                $check_query = "select * from editor where id = '$userid'";
                                $check_result = mysqli_query($connect_handle, $check_query);
                            ?>
                            <?php if(mysqli_num_rows($check_result) > 0 && $_SESSION['role_editor'] == TRUE):?>
                                <button class="btn btn-primary" name="deleterating">Xoá mức đánh giá</button>
                            <?php endif?>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="modal fade" id="insert-rating-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm mức đánh giá cho tiêu chí :
                            <?php echo $criteriaId;?>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-container" name="insertratingForm" method="POST"
                            action="criteria.php">
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" name="description" rows="2"
                                placeholder="Mô tả"
                                required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="score">Điểm</label>
                                <textarea class="form-control" name="score" rows="3"
                                placeholder="Điểm"
                                required></textarea>
                            </div>
                            <div class="text-right">
                                <input type="hidden" name="criteriaId" value="<?php echo $criteriaId ;?>" />
                                <button type="submit" class="btn btn-success" name="insertratingBtn">Lưu thông
                                    tin</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete-success-modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Xoá</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-left text-success"><strong>
                                Xoá mức đánh giá thành công !
                            </strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                    <form method="POST" action="criteria.php">
                            <button type="submit" class="btn btn-secondary" name="closeBtn">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="insert-success-modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm vào</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-left text-success"><strong>
                                Thêm mức đánh giá thành công !
                            </strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                    <form method="POST" action="criteria.php">
                            <button type="submit" class="btn btn-secondary" name="closeBtn">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="update-success-modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog">
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
                    <form method="POST" action="criteria.php">
                            <button type="submit" class="btn btn-secondary" name="closeBtn">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        



    </div>
</body>

</html>