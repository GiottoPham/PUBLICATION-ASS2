<?php
include('DBstart.php');

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$error = array();

if(isset($_POST['loginButton'])){
    $user_name = $_POST['username'];
    $password = $_POST['password'];
    $check_query="select * from account where username='$user_name' and password='$password'";
    $check_login_result = mysqli_query($connect_handle,$check_query);
    if(mysqli_num_rows($check_login_result) > 0 ){
        //check co => dang nhap thanh cong
        
        $select_name_query = "select scientist.id, last_name, middle_name, first_name from scientist, account where account.username='$user_name' and scientist.id = account.id";
        $select_name_result = mysqli_query($connect_handle, $select_name_query);
        $data = mysqli_fetch_assoc($select_name_result);
        //get full user name
        $username = $data['last_name']." ".$data['middle_name']." ".$data['first_name'];
        $userid = $data['id'];
        $_SESSION['username'] = $username;
        $_SESSION['userid']=$userid;
        //check role
        $_SESSION['role_editor'] = FALSE;
        $_SESSION['role_reviewer'] = FALSE;
        $_SESSION['role_author'] = FALSE;
        //editor 
        $myrole = $_POST['role'];
        $select_role_query = "select * from account where username='$user_name' and id in (select id from editor)";
        $select_role_result = mysqli_query($connect_handle, $select_role_query);
        if(mysqli_num_rows($select_role_result) == 1 && $myrole=="Editor"){
            $_SESSION['role_editor'] = TRUE;
        }

        //reviewer 
        $select_role_query = "select * from account where username='$user_name' and id in (select id from reviewer)";
        $select_role_result = mysqli_query($connect_handle, $select_role_query);
        if(mysqli_num_rows($select_role_result) == 1 && $myrole=="Reviewer"){
            $_SESSION['role_reviewer'] = TRUE;
        }

        //reviewer 
        $select_role_query = "select * from account where username='$user_name' and id in (select id from author)";
        $select_role_result = mysqli_query($connect_handle, $select_role_query);
        if(mysqli_num_rows($select_role_result) == 1 && $myrole=="Author"){
            $_SESSION['role_author'] = TRUE;
        }
        if($_SESSION['role_editor'] == TRUE){
             // (editor / reviewer / author) -> editor
            header('location: Client/editorHomepage.php');
        }elseif($_SESSION['role_reviewer'] == TRUE){
            //not editor => (reviewer / author) -> if(reviewer) -> reviewer
            header('location: Client/reviewerHomepage.php');
        }elseif($_SESSION['role_author'] == TRUE){
            //not editor, reviewer => author -> author
            header('location: Client/authorHomepage.php');
        }
        else{
            array_push($error, "Vai trò này của bạn chưa được đăng kí");
        echo 
            "<script>
                $(window).on('load', function () {
                    $('#error-modal').modal('show');
                });
            </script>";
        }
    }else{
        array_push($error, "Sai tên đăng nhập hoặc mật khẩu");
        echo 
            "<script>
                $(window).on('load', function () {
                    $('#error-modal').modal('show');
                });
            </script>";
    }
};

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header('location: index.php');
}
?>
