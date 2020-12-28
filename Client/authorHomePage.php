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
<?php include('../Server/authorServer.php'); ?>

<body>
    <div>
        <?php include_once('component/header.php');?>
    </div>
    <div class="container-fluid" style="padding-top: 80px;">
        <div class="display-4 text-center text-info text-uppercase">Danh sách các bài báo đang được xử lý</div>
        <hr>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Ngày gửi</th>
                    <th scope="col">Tác giả liên lạc</th>
                    <th class="text-center" scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($select_all_paper_result as $paper){ ?>
                <tr>
                    <td>
                        <?php echo '<strong>'.$paper['paper_id'].'</strong>'; ?>
                    </td>
                    <td>
                        <?php echo $paper['title']; ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y', strtotime($paper['post_date']));?>
                    </td>
                    <td>
                    <?php 
                            $author_id = $paper['contact_author_id'];
                            $get_author_name_query = "select last_name, middle_name, first_name from scientist where id = '$author_id'";
                            $get_author_name_result = mysqli_query($connect_handle, $get_author_name_query);
                            $data = mysqli_fetch_assoc($get_author_name_result);
                            echo $data['last_name']." ".$data['middle_name']." ".$data['first_name'];
                        ?>
                    </td>
                    <td class="text-left">
                        <form class="option" method="POST" action="authorHomePage.php">
                            <input type="hidden" name="paperId" value="<?php echo $paper['paper_id'];?>" />
                            <button class="btn btn-success" name="getMoreInfoBtn">Xem chi tiết</button>
                            <?php 
                                $paperid = $paper['paper_id'];
                                $check_query = "select * from paper where paper_id = '$paperid' and contact_author_id = '$userid' and isnull(status)";
                                $check_result = mysqli_query($connect_handle, $check_query);
                            ?>
                            <?php if(mysqli_num_rows($check_result) > 0):?>
                                <button class="btn btn-primary" name="updatePaper">Cập nhật thông tin</button>
                            <?php endif?>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="modal fade" id="moreinfo-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mã Bài báo:
                            <?php echo $moreinfo_paper_data['paper_id'] ?>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p><strong>Tiêu đề :</strong>
                            <?php 
                            $papertitle = $moreinfo_paper_data['title'];
                            if($papertitle != NULL){
                                echo $papertitle;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                            ?>
                        </p>
                        <p><strong>Loại bài báo :</strong>
                            <?php 
                            $paperid = $moreinfo_paper_data['paper_id'];
                            $query1 = "select * from research_paper where paper_id = '$paperid'";
                            $result1 = mysqli_query($connect_handle,$query1);
                            $query2 = "select * from review_paper where paper_id = '$paperid'";
                            $result2 = mysqli_query($connect_handle,$query2);
                            $query3 = "select * from general_paper where paper_id = '$paperid'";
                            $result3 = mysqli_query($connect_handle,$query3);
                            if(mysqli_num_rows($result1) > 0) echo "Bài báo nghiên cứu";
                            elseif(mysqli_num_rows($result2) > 0) echo "Bài báo phản biện sách";
                            elseif(mysqli_num_rows($result3) > 0) echo "Bài báo tổng quan";
                            ?>
                            <?php if(mysqli_num_rows($result2) > 0): ?>
                                <form method="POST" action="authorHomePage.php">
                        <input type="hidden" name="paperId" value="<?php echo $paperid;?>" />
                        <button type="submit" class="btn btn-primary" name="bookInfo">Thông tin sách</button>
                                </form>
                        <?php endif ?>
                        </p>
                        <p><strong>Tóm tắt :</strong>
                            <?php 
                            $papersummary = $moreinfo_paper_data['summary'];
                            if($papersummary != NULL){
                                echo $papersummary;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Link bài báo :</strong>
                            <?php 
                            $paperfile = $moreinfo_paper_data['paper_file'];
                            if($paperfile != NULL){
                                echo "<a href=".$paperfile.">".$paperfile."</a>";
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Các tác giả:</strong>
                        <?php
                            $paperid = $moreinfo_paper_data['paper_id'];
                            $getauthorsquery = "select * from `write` where paper_id = '$paperid' " ;
                            $getauthors = mysqli_query($connect_handle,$getauthorsquery);
                            ?>
                            
                        <?php foreach($getauthors as $author):?>
                            <?php
                                $authorid = $author['author_id'];
                                $get_author_name_query = "select last_name, middle_name, first_name from scientist where id = '$authorid'";
                                $get_author_name_result = mysqli_query($connect_handle, $get_author_name_query);
                                $data = mysqli_fetch_assoc($get_author_name_result);
                                echo "<br>".$data['last_name']." ".$data['middle_name']." ".$data['first_name'];
                                ?>
                                <?php endforeach?>
                        </p>
                        <p><strong>Ngày gửi :</strong>
                            <?php 
                            $paperpostdate = $moreinfo_paper_data['post_date'];
                            if($paperpostdate != NULL){
                                echo date('d/m/Y', strtotime($paperpostdate));
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Tình trạng :</strong>
                            <?php 
                            $paperstatus = $moreinfo_paper_data['status'];
                            if($paperstatus != NULL){
                                echo $paperstatus;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Kết quả sau phản biện :</strong>
                            <?php 
                            $paperafterreviewresult = $moreinfo_paper_data['after_review_result'];
                            if($paperafterreviewresult != NULL){
                                echo $paperafterreviewresult;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Kết quả cuối cùng :</strong>
                            <?php 
                            $paperfinalresult = $moreinfo_paper_data['final_result'];
                            if($paperfinalresult != NULL){
                                echo $paperfinalresult;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Ngày công bố :</strong>
                            <?php 
                            $paperannouncedate = $moreinfo_paper_data['announce_date'];
                            if($paperannouncedate != NULL){
                                echo date('d/m/Y', strtotime($paperannouncedate));
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Người biên tập :</strong>
                            <?php
                            $editor_id = $moreinfo_paper_data['editor_id'];
                            $get_editor_name_query = "select last_name, middle_name, first_name from scientist where id = '$editor_id'";
                            $get_editor_name_result = mysqli_query($connect_handle, $get_editor_name_query);
                            $data = mysqli_fetch_assoc($get_editor_name_result);
                            $editorname = $data['last_name']." ".$data['middle_name']." ".$data['first_name']; 
                            if($editorname != NULL){
                                echo $editorname;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Ghi chú từ biên tập viên :</strong>
                            <?php
                            if($moreinfo_paper_data['note_for_author'] != NULL){
                                echo $moreinfo_paper_data['note_for_author'];
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Ghi chú từ phản biện :</strong>
                        <?php 
                            $paperid=$moreinfo_paper_data['paper_id'];
                            $query_review="select * from review where paper_id='$paperid'";
                            $result_review = mysqli_query($connect_handle, $query_review);
                        ?>
                            <?php foreach($result_review as $review):?>
                            <?php 
                            $reviewid=$review['reviewer_id'];
                            $get_reviewer_name_query = "select last_name, middle_name, first_name from scientist where id = '$reviewid'";
                            $get_reviewer_name_result = mysqli_query($connect_handle, $get_reviewer_name_query);
                            $data = mysqli_fetch_assoc($get_reviewer_name_result);
                            $reviewername = $data['last_name']." ".$data['middle_name']." ".$data['first_name'];
                            echo "<br>";echo $reviewername; echo ": ";
                            if($review['note_for_author'] != NULL){
                                echo $review['note_for_author'];
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                            ?>
                        <?php endforeach?>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="bookinfo-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mã ISBN:
                            <?php 
                            $mypaperid=$moreinfo_paper_data['paper_id'];
                            $myquery = "select * from book where isbn in (select isbn from review_paper where paper_id = '$mypaperid')";
                            $get_book_result = mysqli_query($connect_handle, $myquery);
                            $bookresult = mysqli_fetch_assoc($get_book_result);
                            echo $bookresult['isbn'];           
                            ?>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p><strong>Tên sách :</strong>
                            <?php 
                            $bookname = $bookresult['name'];
                            if($bookname != NULL){
                                echo $bookname;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                            ?>
                        </p>
                        <p><strong>Năm xuất bản :</strong>
                        <?php 
                            $publish_year = $bookresult['publish_year'];
                            if($publish_year != NULL){
                                echo $publish_year;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                            ?>
                        </p>
                        <p><strong>Tổng số trang sách :</strong>
                            <?php 
                            $total_page = $bookresult['total_page'];
                            if($total_page != NULL){
                                echo $total_page;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Nhà xuất bản :</strong>
                        <?php 
                            $publisher = $bookresult['publisher'];
                            if($publisher != NULL){
                                echo $publisher;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                            ?>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update-paper-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cập nhật thông tin cho bài báo :
                            <?php echo $paperId ;?>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-container" name="updatePaperForm" method="POST"
                            action="authorHomePage.php">
                            <div class="form-group">
                                <label for="paperTitle">Tiêu đề</label>
                                <textarea class="form-control" name="paperTitle" rows="2"
                                placeholder="Tiêu đề"
                                required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="paperSumary">Tóm tắt</label>
                                <textarea class="form-control" name="paperSumary" rows="4"
                                placeholder="Tóm tắt"
                                required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="paperFile">Link bài báo</label>
                                <input type="text" class="form-control" name="paperFile" placeholder="Link bài báo" required>
                            </div>
                            <div class="text-right">
                                <input type="hidden" name="paperId" value="<?php echo $paperId ;?>" />
                                <button type="submit" class="btn btn-success" name="updatePaperBtn">Lưu thông
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
                    <form method="POST" action="authorHomePage.php">
                            <button type="submit" class="btn btn-secondary" name="closeBtn">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="display-4 text-center text-info text-uppercase" style="padding-top: 40px;">Danh sách các bài báo
            theo lựa chọn</div>
        <hr>
        <form class="form-container" name="viewOption" method="POST" action="authorHomePage.php">
            <label for="viewOption"><strong>chọn tính năng hiển thị</strong></label>
            <div class="form-row">
                <div class="form-group col-md-7">
                    <select class="custom-select" name="optionView">
                        <option selected>Chọn tác vụ</option>
                        <option value="6">Xem danh sách các bài báo trong một năm</option>
                        <option value="7">Xem danh sách các bài báo đã đăng trong một năm</option>
                        <option value="8">Xem danh sách các bài báo đang được xuất bản</option>
                        <option value="9">Xem danh sách các bài báo có kết quả thấp nhất (rejection)</option>
                        <option value="10">Xem tổng số bài báo đã gởi tạp chí mỗi năm trong 5 năm gần đây nhất</option>
                        <option value="11">Xem tổng số bài báo nghiên cứu được đăng mỗi năm trong 5 năm gần đây nhất</option>
                        <option value="12">Xem tổng số bài báo tổng quan được đăng mỗi năm trong 5 năm gần đây nhất</option>
                        <option value="13">Xem thông tin các tác giả của một bài báo.</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <input type="number" class="form-control" name="year" id="year"
                        aria-describedby="emailHelp" placeholder="Nhập Năm (nếu cần)">
                    </input>
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="paper_id" id="paper_id"
                        aria-describedby="emailHelp" placeholder="Nhập mã số bài báo (nếu cần)">
                    </input>
                </div>
                <div class="form-group text-right col-md-1">
                    <button type="submit" class="btn btn-success" name="viewOption">Hiển thị</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered">
        <?php if($get_option_result != NULL):?>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Mã DOI</th>
                        <th scope="col">Kết quả Cuối cùng</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php foreach ($get_option_result as $paper){ ?>
                <tr>
                    <td>
                        <?php echo '<strong>'.$paper['paper_id'].'</strong>'; ?>
                    </td>
                    <td>
                        <?php
                            if(array_key_exists('title',$paper)){
                                echo $paper['title'];
                            }else{
                                echo "Null";
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if(array_key_exists('doi',$paper)){
                                echo $paper['doi'];
                            }else{
                                echo "Null";
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(array_key_exists('final_result',$paper)){
                            echo $paper['final_result'];
                        }else{
                            echo "Null";
                        } 
                        ?>
                    </td>
                </tr>
                <?php } ?>

        <?php elseif($get_sum_result != NULL): ?>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Tổng số bài báo</th>
                        <th scope="col">Năm</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php foreach ($get_sum_result as $sum){ ?>
                <tr>
                    <td>
                        <?php echo $sum['NumOfPaper']; ?>
                    </td>
                    <td>
                        <?php
                                echo $sum['Year'];
                        ?>
                    </td>
                </tr>
                <?php }?>
                <?php elseif($get_author_result != NULL): ?>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên tác giả</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Nơi công tác</th>
                        <th scope="col">Công việc</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php foreach ($get_author_result as $author){ ?>
                <tr>
                    <td>
                        <?php echo $author['id']; ?>
                    </td>
                    <td>
                        <?php
                                echo $author['last_name']." ".$author['middle_name']." ".$author['first_name'];
                        ?>
                    </td>
                    <td>
                        <?php
                                echo $author['phone'];
                        ?>
                    </td>
                    <td>
                        <?php
                                echo $author['address'];
                        ?>
                    </td>
                    <td>
                        <?php
                                echo $author['organization'];
                        ?>
                    </td>
                    <td>
                        <?php
                                echo $author['job'];
                        ?>
                    </td>
                    <td>
                        <?php
                                echo $author['author_email'];
                        ?>
                    </td>
                </tr>
                <?php }?>
        <?php endif ?>
            </tbody>
        </table>

        <div class="modal fade" id="count-return-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-dark text-uppercase">
                        <strong><?php echo $result_text; ?></strong>
                    </div> 
                    <div class="modal-body">
                        <h5 class="modal-title text-info">Kết quả: <?php
                            if($result_count != FALSE){
                                while($count = mysqli_fetch_assoc($result_count)){
                                    echo $count['Sum']." ";
                                }
                            }else{
                                echo 'Không có';
                            }
                        ?></h5>
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