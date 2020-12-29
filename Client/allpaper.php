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
<?php include('../Server/allpaperServer.php'); ?>

<body>
    <div>
        <?php include_once('component/header.php');?>
    </div>
    <div class="container-fluid" style="padding-top: 80px;">
        <div class="display-4 text-center text-info text-uppercase">Danh sách tất cả bài báo đã đăng</div>
        <hr>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Loại bài báo</th>
                    <th scope="col">Dạng xuất bản</th>
                    <th scope="col">Mã DOI</th>
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
                    <?php 
                            $paperid = $paper['paper_id'];
                            $query1 = "select * from research_paper where paper_id = '$paperid'";
                            $result1 = mysqli_query($connect_handle,$query1);
                            $query2 = "select * from review_paper where paper_id = '$paperid'";
                            $result2 = mysqli_query($connect_handle,$query2);
                            $query3 = "select * from general_paper where paper_id = '$paperid'";
                            $result3 = mysqli_query($connect_handle,$query3);
                            if(mysqli_num_rows($result1) > 0) echo "Research Paper";
                            elseif(mysqli_num_rows($result2) > 0) echo "Review Book Paper";
                            elseif(mysqli_num_rows($result3) > 0) echo "General Paper";
                            ?>
                            
                    </td>
                    <td>
                        <?php echo $paper['published_type'];?>
                    </td>
                    <td>
                    <?php echo $paper['doi'];?>
                    </td>
                    <td class="text-left">
                        <form class="option" method="POST" action="allpaper.php">
                            <input type="hidden" name="paperId" value="<?php echo $paper['paper_id'];?>" />
                            <button class="btn btn-success" name="getMoreInfoBtn">Xem chi tiết</button>
                            <?php if(mysqli_num_rows($result2) > 0): ?>
                        <button type="submit" class="btn btn-success" name="bookInfo">Thông tin sách</button>
                        <?php endif ?>
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
                            if(mysqli_num_rows($result1) > 0) echo "Research Paper";
                            elseif(mysqli_num_rows($result2) > 0) echo "Review Book Paper";
                            elseif(mysqli_num_rows($result3) > 0) echo "General Paper";
                            ?>
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
                        <p><strong>Tác giả liên lạc :</strong>
                            <?php 
                            $author_id = $moreinfo_paper_data['contact_author_id'];
                            $get_author_name_query = "select last_name, middle_name, first_name from scientist where id = '$author_id'";
                            $get_author_name_result = mysqli_query($connect_handle, $get_author_name_query);
                            $data = mysqli_fetch_assoc($get_author_name_result);
                            $paperauthorname = $data['last_name']." ".$data['middle_name']." ".$data['first_name'];
                            if($paperauthorname != NULL){
                                echo $paperauthorname;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Ngày đăng :</strong>
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