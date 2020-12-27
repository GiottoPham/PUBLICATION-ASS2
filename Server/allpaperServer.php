<?php
include('DBstart.php');
include('userLogin.php');

$userid = $_SESSION['userid'];
$get_option_result = NULL;
$get_sum_result = NULL;
$result_text = NULL;

$select_all_paper_query = "select * from paper p join published_paper pp on p.paper_id=pp.paper_id";
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
if(isset($_POST['closeBtn'])){
    header("Refresh:0");
};
?>