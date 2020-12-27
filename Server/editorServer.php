<?php 
include('DBstart.php');
include('userLogin.php');

$userid = $_SESSION['userid'];
$select_all_paper_query = "select * from paper where paper_id not in (select paper_id from paper where status='posted')";
$select_all_paper_result = mysqli_query($connect_handle, $select_all_paper_query);
$get_option_result = NULL;

if(isset($_POST['getMoreInfoBtn'])){
    $paperId=$_POST['paperId'];
    $moreinfo_paper_query = "select * from paper where paper_id = '$paperId'";
    $moreinfo_paper_result = mysqli_query($connect_handle, $moreinfo_paper_query);
    $moreinfo_paper_data = mysqli_fetch_assoc($moreinfo_paper_result);

    echo 
        "<script>
            $(window).on('load', function () {
                $('#moreinfo-modal').modal('toggle');
            });
        </script>";
}

if(isset($_POST['updateReivewer'])){
    $paperId=$_POST['paperId'];
    $query1 = "select id, last_name, middle_name, first_name from scientist where scientist.id in (select reviewer_id from review where paper_id = '$paperId')";
    $reviewer_data = mysqli_query($connect_handle, $query1);

    $query2 ="select id, last_name, middle_name, first_name from scientist where id in (select id from reviewer) and not (id in (select id from scientist where scientist.id in (select reviewer_id from review where paper_id = '$paperId')))";
    $all_reviewer_data = mysqli_query($connect_handle, $query2);

    echo 
        "<script>
            $(window).on('load', function () {
                $('#update-review-modal').modal('toggle');
            });
        </script>";
}

if(isset($_POST['updatePaper'])){
    $paperIdToUpdate=$_POST['paperIdToUpdate'];
    echo 
        "<script>
            $(window).on('load', function () {
                $('#update-modal').modal('toggle');
            });
        </script>";
}

if(isset($_POST['updateBtn'])){
    $status = $_POST['status'];
    $after_review_result = $_POST['after_review_result'];
    $final_result = $_POST['final_result'];
    $paperIdToUpdate = $_POST['paperIdToUpdate'];

    $query = "update paper set status = '$status', after_review_result = '$after_review_result', final_result = '$final_result' where paper_id='$paperIdToUpdate'";
    $result = mysqli_query($connect_handle, $query);
    
    echo 
        "<script>
            $(window).on('load', function () {
                $('#update-success-modal').modal('toggle');
            });
        </script>";
}

if(isset($_POST['updateReviewerBtn'])){
    $reviewerid = $_POST['reviewer'];
    $paperId = $_POST['paperId'];
    $moreinfo_paper_query = "select * from paper where paper_id = '$paperId'";
    $moreinfo_paper_result = mysqli_query($connect_handle, $moreinfo_paper_query);
    $moreinfo_paper_data = mysqli_fetch_assoc($moreinfo_paper_result);
    $editor_id = $moreinfo_paper_data['editor_id'];
    $date1 = date("Y-m-d");
    $reviewer_num = mysqli_num_rows(mysqli_query($connect_handle,"select * from assign where paper_id = '$paperId'"));
    if ($reviewer_num >= 3) echo "<script>
    $(window).on('load', function () {
        $('#update-failed-modal').modal('toggle');
    });
</script>";
    else{
    $query1 = "insert into review (paper_id, reviewer_id) values('$paperId','$reviewerid')";
    $result = mysqli_query($connect_handle, $query1);
    $query2 = "insert into assign (paper_id,reviewer_id,editor_id, assign_date) values('$paperId','$reviewerid','$editor_id','$date1')";
    $result = mysqli_query($connect_handle, $query2);
    echo 
        "<script>
            $(window).on('load', function () {
                $('#update-success-modal').modal('toggle');
            });
        </script>";
    }
}


if(isset($_POST['viewOption'])){
    $optionView = $_POST['optionView'];
    $authorid = $_POST['authorid'];

    $query5 = "select paper_id,title, case when paper_id in (select paper_id from research_paper) then 'Research Paper' 
    when paper_id in (select paper_id from review_paper) then 'Review Book Paper' 
    when paper_id in (select paper_id from general_paper) then 'General Paper' end as Category
    from paper
    where isnull(`status`)";
    
    $query6 = "select pp.paper_id,title,DOI, case when pp.paper_id in (select paper_id from research_paper) then 'Research Paper' 
    when pp.paper_id in (select paper_id from review_paper) then 'Review Book Paper' 
    when pp.paper_id in (select paper_id from general_paper) then 'General Paper' end as Category
    from published_paper pp join paper p on pp.paper_id=p.paper_id";
    
    $query7= "select paper_id, title, case when paper_id in (select paper_id from research_paper) then 'Research Paper' 
    when paper_id in (select paper_id from review_paper) then 'Review Book Paper' 
    when paper_id in (select paper_id from general_paper) then 'General Paper' end as Category
    from paper
    where year(now())-year(post_date)<3 and `status`='posted'";

    $query8="select pp.paper_id,title,DOI
    from published_paper pp join paper p on pp.paper_id=p.paper_id 
    where pp.paper_id in (select paper_id from `write` where author_id='$authorid')";

    $query9="select paper_id, title
    from paper
    where `status`='posted' and paper_id in (select paper_id from `write` where author_id='$authorid')";

    $query10="select count(paper_id) as Sum
    from paper
    where `status`='in review';";

    $query11="select count(paper_id) as Sum
    from paper
    where `status`='response review'";

    $query12="select count(paper_id) as Sum
    from paper
    where `status`='publishing'";
    
    switch ($optionView) {
        case '5':
            $get_option_result = mysqli_query($connect_handle, $query5);
        break;

        case '6':
            $get_option_result = mysqli_query($connect_handle, $query6);
        break;

        case '7':
            $get_option_result = mysqli_query($connect_handle, $query7);
        break;

        case '8':
            $get_option_result = mysqli_query($connect_handle, $query8);
        break;

        case '9':
            $get_option_result = mysqli_query($connect_handle, $query9);
        break;

        case '10':
            $result_text = "tổng số bài báo đang được phản biện";
            $result_count = mysqli_query($connect_handle, $query10);
            echo 
                "<script>
                    $(window).on('load', function () {
                        $('#count-return-modal').modal('toggle');
                    });
                </script>";
        break;

        case '11':
            $result_text = "tổng số bài báo đang được phản hồi phản biện";
            $result_count = mysqli_query($connect_handle, $query11);
            echo 
                "<script>
                    $(window).on('load', function () {
                        $('#count-return-modal').modal('toggle');
                    });
                </script>";
        break;

        case '12':
            $result_text = "Xem tổng số bài báo đang được xuất bản";
            $result_count = mysqli_query($connect_handle, $query12);
            echo 
                "<script>
                    $(window).on('load', function () {
                        $('#count-return-modal').modal('toggle');
                    });
                </script>";
        break;
    };
};


?>