<?php
include('DBstart.php');
include('userLogin.php');

$userid = $_SESSION['userid'];
$get_option_result = NULL;
$get_sum_result = NULL;
$result_text = NULL;

$select_all_criteria_query = "select * from criteria ";
$select_all_criteria_result = mysqli_query($connect_handle, $select_all_criteria_query);
$select_all_rating_query = "select * from rating_level ";
$select_all_rating_result = mysqli_query($connect_handle, $select_all_rating_query);
if(isset($_POST['updatecriteria'])){
    $criteriaId=$_POST['criteriaId'];
    $query1 = "select content from criteria where criteria_id = $criteriaId";
    $reviewer_data = mysqli_query($connect_handle, $query1);
    echo 
        "<script>
            $(window).on('load', function () {
                $('#update-criteria-modal').modal('toggle');
            });
        </script>";
}

if(isset($_POST['updatecriteriaBtn'])){
    $criteriaId = $_POST['criteriaId'];
    $criteriaContent = $_POST['criteriaContent'];

    $query = "update criteria
    set content=ifnull('$criteriaContent',content)
    where criteria_id='$criteriaId'";
    $result = mysqli_query($connect_handle, $query);
    
    echo 
        "<script>
            $(window).on('load', function () {
                $('#update-success-modal').modal('toggle');
            });
        </script>";
};
if(isset($_POST['deleterating'])){
    $criteriaId=$_POST['criteriaId'];
    $description = $_POST['description'];
    $query1 = "delete from rating_level where criteria_id = '$criteriaId' and description = '$description' ";
    if(mysqli_query($connect_handle, $query1)){
    echo 
        "<script>
            $(window).on('load', function () {
                $('#delete-success-modal').modal('toggle');
            });
        </script>";
    }
}
if(isset($_POST['insertrating'])){
    $criteriaId=$_POST['criteriaId'];
    $query1 = "select description, score from criteria where criteria_id = $criteriaId";
    $reviewer_data = mysqli_query($connect_handle, $query1);
    echo 
        "<script>
            $(window).on('load', function () {
                $('#insert-rating-modal').modal('toggle');
            });
        </script>";
};
if(isset($_POST['insertratingBtn'])){
    $criteriaId=$_POST['criteriaId'];
    $description = $_POST['description'];
    $score = $_POST['score'];
    $scorefloat = floatval($score);
    $query1 = "insert into rating_level values('$criteriaId','$description',$scorefloat)";
    if(mysqli_query($connect_handle, $query1)){
    echo 
        "<script>
            $(window).on('load', function () {
                $('#insert-success-modal').modal('toggle');
            });
        </script>";
    }
}
if(isset($_POST['closeBtn'])){
    header("Refresh:0");
};
?>