<?php
include('DBstart.php');
include('userLogin.php');
function getNewId($number){
    $zerostr='';
    $newstr='';
    for ($i=1; $i<= 10-strlen($number);$i++){
        $zerostr=$zerostr.'0';
    }
    return $newstr=$newstr.$zerostr.($number);
}

$error=array();
if(isset($_POST['postButton'])){
    $userid = $_SESSION['userid'];
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $link = $_POST['link'];
    $contactauthor= $_POST['contactauthor'];
    $pagenum = intval($_POST['pagenum']);
    echo $pagenum;
    $paper_num = mysqli_num_rows(mysqli_query($connect_handle,"select paper_id from paper"));
    $insert_paper_id = getNewId($paper_num + 1);
    $date1 = date("Y-m-d");
    $insert_query = "insert into paper(paper_id,title,summary,paper_file,post_date,contact_author_id,editor_id) values('$insert_paper_id','$title','$summary','$link','$date1','$contactauthor', '$userid')";
    $insert_result= mysqli_query($connect_handle, $insert_query);
    if ($_POST['role'] == "Research_Paper"){
        $insert_query2="insert into research_paper values ('$insert_paper_id',$pagenum)";
        $insert_result2= mysqli_query($connect_handle, $insert_query2);
    }
    elseif ($_POST['role'] == "Review_Paper"){
        $ISBN = $_POST['ISBN'];
        $bookname = $_POST['bookname'];
        $page = intval($_POST['page']);
        $publishedYear = $_POST['publishedYear'];
        $publisher = $_POST['publisher'];
        $insert_query2 = "insert into book(isbn,name,publish_year,total_page,publisher) values('$ISBN','$bookname','$publishedYear',$page,'$publisher')";
        $insert_result2= mysqli_query($connect_handle, $insert_query2);
        $insert_query3="insert into review_paper values ('$insert_paper_id', $pagenum, '$ISBN')";
        $insert_result3= mysqli_query($connect_handle, $insert_query3);
    }
    else{
        $insert_query2="insert into general_paper values ('$insert_paper_id', $pagenum)";
        $insert_result2= mysqli_query($connect_handle, $insert_query2);
    }
    echo "<script>
    $(window).on('load', function () {
        $('#success-modal').modal('show');
    });
</script>";
};
?>
