<?php
include('DBstart.php');

function getNewId($number){
    $zerostr='';
    $newstr='';
    for ($i=1; $i<= 10-strlen($number);$i++){
        $zerostr=$zerostr.'0';
    }
    return $newstr=$newstr.$zerostr.($number);
}

$error=array();

if(isset($_POST['signUpButton'])){
    $user_name = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $firstname = $_POST['firstname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $organization = $_POST['organization'];
    $job = $_POST['job'];

    if(strlen($user_name) > 20){
        array_push($error, "Tài khoản phải từ 0 - 20 kí tự !");
        echo 
            "<script>
                $(window).on('load', function () {
                    $('#error-modal').modal('show');
                });
            </script>";
    }elseif(strlen($password) > 20){
        array_push($error, "Mật khẩu phải từ 0 - 20 kí tự !");
        echo 
            "<script>
                $(window).on('load', function () {
                    $('#error-modal').modal('show');
                });
            </script>";
    }elseif($password != $confirmPassword){
        array_push($error, "Mật khẩu và mật khẩu xác thực không giống nhau !");
        echo 
            "<script>
                $(window).on('load', function () {
                    $('#error-modal').modal('show');
                });
            </script>";
    }else{
        $check_username = "select * from account where username = '$user_name'";
        $check_username_result = mysqli_query($connect_handle, $check_username);
        if(mysqli_num_rows($check_username_result) == 0){
            //username phu hop
            if(count($error)==0){
                //insert data vao account
                $account_num = mysqli_num_rows(mysqli_query($connect_handle,"select id from account"));
                $insert_account_id = getNewId($account_num + 1);
                //insert data vao scientist
                $check = "select * from scientist where id = '$insert_account_id'";
                $check_result = mysqli_query($connect_handle, $check);
                if(mysqli_num_rows($check_result)>0){
                    //da co data -> update
                    $update_query = "update scientist 
                    set last_name = '$lastname', middle_name = '$middlename', first_name='$firstname', phone = '$phone', address = '$address', organization = '$organization', job = '$job'
                    where id='$insert_account_id'";
                    $update_result = mysqli_query($connect_handle, $update_query);
                        echo 
                            "<script>
                                $(window).on('load', function () {
                                    $('#success-modal').modal('show');
                                });
                            </script>";
                            }
                else{
                    //chua co data -> insert
                    $author = False;
                    $reviewer = False;
                    $editor = False;
                    foreach($_POST['role'] as $value){
                        if($value == 'Author') $author = True;
                        if ($value == 'Reviewer') $reviewer = True;
                        if ($value == 'Editor') $editor = True;
                    }
                    if ($author == True && $editor == True) echo "<script>
                    $(window).on('load', function () {
                        $('#failed-author-modal').modal('show');
                    });
                </script>";
                    else{
                    $insert_query = "insert into scientist (id, last_name, middle_name, first_name, phone, address, organization, job) 
                    values ('$insert_account_id','$lastname','$middlename','$firstname','$phone','$address','$organization','$job')";
                    $insert_result = mysqli_query($connect_handle, $insert_query);
                    $insert_query = "insert into account(id, username, password) values ('$insert_account_id','$user_name','$password')";
                    $insert_result = mysqli_query($connect_handle, $insert_query);
                    //update at 17:16 26-12-2020
                    
                    if ($author == True && $editor == True) echo "<script>
                    $(window).on('load', function () {
                        $('#failed-author-modal').modal('show');
                    });
                </script>";
                    
                    if ($author == True){
                        $insert_query_author = "insert into author(id) values ('$insert_account_id')";
                        $insert_result = mysqli_query($connect_handle, $insert_query_author);
                    }
                    if($reviewer == True)
                    {   $date = date("Y-m-d");
                        $insert_query_reviewer = "insert into reviewer(id, collaboration_date) values ('$insert_account_id', '$date')";
                        $insert_result = mysqli_query($connect_handle, $insert_query_reviewer);
                    }
                    if($editor == True){
                        $insert_query_editor = "insert into editor(id) values ('$insert_account_id')";
                        $insert_result = mysqli_query($connect_handle, $insert_query_editor);
                    }
                    //end update
                    echo 
                        "<script>
                            $(window).on('load', function () {
                                $('#success-modal').modal('show');
                            });
                        </script>";
                }
            }
            }
        }else{
            //trung ten username
            array_push($error, "Tên tài khoản này đã tồn tại !");
            echo 
            "<script>
                $(window).on('load', function () {
                    $('#error-modal').modal('show');
                });
            </script>";
        };
    };
};
?>
