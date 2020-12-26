<?php
include('DBstart.php');
include('userLogin.php');

$userid = $_SESSION['userid'];
$get_option_result = NULL;
$get_author_result = NULL;
$result_text = NULL;

$select_all_paper_query = "select * from paper ";
$select_all_paper_result = mysqli_query($connect_handle, $select_all_paper_query);

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

if(isset($_POST['updateRevieweBtn'])){
    $paperId = $_POST['paperId'];
    $noteForAuthor = $_POST['noteForAuthor'];
    $noteForEditor = $_POST['noteForEditor'];
    $reviewResult = $_POST['reviewResult'];

    $query = "update review
    set note_for_author = ifnull('$noteForAuthor',note_for_author),
        note_for_editor = ifnull('$noteForEditor',note_for_editor),
        review_result = ifnull('$reviewResult',review_result)
    where paper_id = '$paperId' and reviewer_id = '$userid'";
    $result = mysqli_query($connect_handle, $query);
    
    echo 
        "<script>
            $(window).on('load', function () {
                $('#update-success-modal').modal('toggle');
            });
        </script>";
};

if(isset($_POST['viewOption'])){
    $optionView = $_POST['optionView'];
    $authorid = $_POST['authorid'];

    $query3 = "select paper_id,title, case when paper_id in (select paper_id from research_paper) then 'Research Paper' 
    when paper_id in (select paper_id from review_paper) then 'Review Book Paper' 
    when paper_id in (select paper_id from general_paper) then 'General Paper' end as Category
    from paper
    where paper_id in (select paper_id from review where review.reviewer_id = '$userid')
    ";    
    
    $query4 = "select paper_id,title, case when paper_id in (select paper_id from research_paper) then 'Research Paper' 
    when paper_id in (select paper_id from review_paper) then 'Review Book Paper' 
    when paper_id in (select paper_id from general_paper) then 'General Paper' end as Category
    from paper
    where paper_id in (select paper_id from assign where assign.reviewer_id = '$userid' and (year(now())-year(assign_date)<3))";
    
    $query5= "select paper_id, title
    from paper
    where paper_id in (select paper_id from `write` where author_id='$authorid')";

    $query6="select paper_id, title
    from paper
    where paper_id in(select paper_id from `write` where author_id='$authorid') and paper_id in (select paper_id from assign where year(now())-year(assign_date)<3)";

    $query7="select id, last_name, middle_name, first_name
    from scientist 
    where id in (
    select a.contact_author_id from (
    select count(*) paper_num, paper.contact_author_id 
    from paper inner join assign on paper.paper_id = assign.paper_id 
    where assign.reviewer_id = reviewer_id_for_search group by paper.contact_author_id) a 
    where a.paper_num = (
    select max(b.paper_num) 
    from (
    select count(*) paper_num, paper.contact_author_id 
    from paper inner join assign on paper.paper_id = assign.paper_id 
    where assign.reviewer_id = reviewer_id_for_search 
    group by paper.contact_author_id) b) 
    group by a.contact_author_id)";

    $query8="select paper_id, review_result from review where paper_id in (select paper_id from assign where reviewer_id = '$userid' and (year(now())=year(assign_date))) group by paper_id";

    $query9="select year(post_date) as Sum
    from paper
    where paper_id in (select paper_id 
    from review
    where (reviewer_id = '$userid'))
    group by year(post_date)
    order by count(*) desc
    limit 0,3";

    $query10="select * 
    from paper
    where paper_id in (select paper_id 
    from review
    where (reviewer_id = '$userid')) and final_result = 'acceptance'   
    limit 0,3";

    $query11="select * 
    from paper
    where paper_id in (select paper_id 
    from review
    where (reviewer_id = '$userid')) and final_result = 'rejection'   
    limit 0,3";

    $query12="select count(*)/5 as Sum
    from paper
    where paper_id in (select paper_id 
    from review
    where (reviewer_id = '$userid')) and year(post_date) + 5 > year(curdate())";
    
    switch ($optionView) {
        case '3':
            $get_option_result = mysqli_query($connect_handle, $query3);
        break;

        case '4':
            $get_option_result = mysqli_query($connect_handle, $query4);
        break;

        case '5':
            $get_option_result = mysqli_query($connect_handle, $query5);
        break;

        case '6':
            $get_option_result = mysqli_query($connect_handle, $query6 );
        break;

        case '7':
            $get_author_result = mysqli_query($connect_handle, $query7);
        break;

        case '8':
            $get_option_result = mysqli_query($connect_handle, $query8);
        break;

        case '9':
            $result_text = "Xem 3 năm có số bài báo mà mình đã phản biện nhiều nhất";
            $result_count = mysqli_query($connect_handle, $query9);
            echo 
                "<script>
                    $(window).on('load', function () {
                        $('#count-return-modal').modal('toggle');
                    });
                </script>";
        break;

        case '10':
            $get_option_result = mysqli_query($connect_handle, $query10);
        break;

        case '11':
            $get_option_result = mysqli_query($connect_handle, $query11);
        break;

        case '12':
            $result_text = "Xem trung bình số bài báo mỗi năm mà mình đã phản biện trong 5 năm gần đây nhất";
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