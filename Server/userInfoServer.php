<?php 
include('DBstart.php');
include('userLogin.php');

$userid = $_SESSION['userid'];

$scientist_query = "select * from scientist where id = '$userid'";
$scientist_query_result = mysqli_query($connect_handle,$scientist_query);
$scientist_data = mysqli_fetch_assoc($scientist_query_result);

if($_SESSION['role_reviewer'] == TRUE){
    $reviewer_query = "select * from reviewer where id = '$userid'";
    $reviewer_result = mysqli_query($connect_handle,$reviewer_query);
    $reviewer_data = mysqli_fetch_assoc($reviewer_result);
}

if($_SESSION['role_author'] == TRUE){
    $author_query = "select * from author where id = '$userid'";
    $author_result = mysqli_query($connect_handle,$author_query);
    $author_data = mysqli_fetch_assoc($author_result);
}

if(isset($_POST['updateBtn'])){
    //scientist
    $lastname= $_POST['lastname'];
    $middlename= $_POST['middlename'];
    $firstname= $_POST['firstname'];
    $phone= $_POST['phone'];
    $address= $_POST['address'];
    $organization= $_POST['organization'];
    $job= $_POST['job'];

    $scientist_query="update scientist
    set first_name=ifnull('$firstname',first_name), 
        middle_name=ifnull('$middlename',middle_name),
        last_name=ifnull('$lastname',last_name), 
        phone=ifnull('$phone',phone), 
        address=ifnull('$address',address),
        organization=ifnull('$organization',organization),
        job=ifnull('$job',job)
    where id='$userid'";

    $scientist_result = mysqli_query($connect_handle,$scientist_query);

    if($_SESSION['role_reviewer']==TRUE){
        //reviewer
        $businessEmail= $_POST['businessEmail'];
        $personalEmail= $_POST['personalEmail'];
        $collaborationDate= date('Y-m-d', strtotime($_POST['collaborationDate']));
        $qualification= $_POST['qualification'];

        $reviewer_query="update reviewer
        set business_email = ifnull('$businessEmail',business_email),
            personal_email = ifnull('$personalEmail',personal_email),
            collaboration_date = ifnull('$collaborationDate',collaboration_date),
            qualification = ifnull('$qualification',qualification)
        where id = '$userid'";

        $reviewer_result = mysqli_query($connect_handle,$reviewer_query);
    };

    if($_SESSION['role_author']==TRUE){
        //reviewer
        $authorEmail= $_POST['authorEmail'];
        
        $author_query="update author
        set author_email = ifnull('$authorEmail',author_email)
        where id = '$userid'";
        
        $author_result = mysqli_query($connect_handle,$author_query);
    };

    echo 
        "<script>
            $(window).on('load', function () {
                $('#update-success-modal').modal('show');
            });
        </script>";

}

if(isset($_POST['closeBtn'])){
    header("Refresh:0");
}
?>