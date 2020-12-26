<?php
include('DBstart.php');
include('userLogin.php');

$userid = $_SESSION['userid'];
$get_option_result = NULL;
$get_sum_result = NULL;
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

if(isset($_POST['updatePaper'])){
    $paperId=$_POST['paperId'];
    $query1 = "select id, last_name, middle_name, first_name from scientist where scientist.id in (select reviewer_id from review where paper_id = '$paperId')";
    $reviewer_data = mysqli_query($connect_handle, $query1);

    $query2 ="select id, last_name, middle_name, first_name from scientist where id in (select id from reviewer) and not (id in (select id from scientist where scientist.id in (select reviewer_id from review where paper_id = '$paperId')))";
    $all_reviewer_data = mysqli_query($connect_handle, $query2);

    echo 
        "<script>
            $(window).on('load', function () {
                $('#update-paper-modal').modal('toggle');
            });
        </script>";
}

if(isset($_POST['updatePaperBtn'])){
    $paperId = $_POST['paperId'];
    $paperTitle = $_POST['paperTitle'];
    $paperSumary = $_POST['paperSumary'];
    $paperFile = $_POST['paperFile'];

    $query = "update paper
    set title=ifnull('$paperTitle',title), 
        summary=ifnull('$paperSumary',summary),
        paper_file=ifnull('$paperFile',paper_file)
    where paper_id='$paperId'";
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
    $year = $_POST['year'];
    
    $query6 = "select paper_id, title
    from paper
    where year(post_date)='$year'
    ";    

    $query7="select paper_id, title
    from paper
    where year(post_date)='$year' and `status`='posted'";

    $query8="select paper_id, title
    from paper
    where status='publishing'";

    $query9="select paper_id,title
    from paper  
    where final_result='rejection'";

    $query10="select count(paper_id) as NumOfPaper, year(post_date) as Year
    from paper
    where contact_author_id='$userid' and year(now())-year(post_date)<5
    group by year(post_date)";

    $query11="select count(rp.paper_id) as NumOfPaper, year(p.post_date) as Year
    from research_paper rp join paper p on rp.paper_id=p.paper_id
    where status='posted' and year(now())-year(p.post_date)<5
    group by year(p.post_date)";

    $query12="select count(gp.paper_id) as NumOfPaper, year(p.post_date) as Year
    from general_paper gp join paper p on gp.paper_id=p.paper_id
    where status='posted' and year(now())-year(p.post_date)<5
    group by year(p.post_date)";
    
    switch ($optionView) {
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
            $get_sum_result = mysqli_query($connect_handle, $query10);
        break;

        case '11':
            $get_sum_result = mysqli_query($connect_handle, $query11);
        break;

        case '12':
            $get_sum_result = mysqli_query($connect_handle, $query12);
        break;
    };
};

if(isset($_POST['closeBtn'])){
    header("Refresh:0");
};
?>