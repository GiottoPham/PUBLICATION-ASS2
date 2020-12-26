<!DOCTYPE html>
<html lang="vi">
<?php include('../Server/userLogin.php'); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="header">
    <meta name="author" content="team 20">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="navbar-nav" style="margin-right: auto;">
                    <?php if($_SESSION['role_editor'] == TRUE): ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="editorHomepage.php"><strong>Mục Editor</strong></a>
                    </li>
                    <?php endif ?>
                    <?php if($_SESSION['role_reviewer'] == TRUE):?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="reviewerHomePage.php"><strong>Mục Reviewer</strong></a>
                    </li>
                    <?php endif ?>
                    <?php if($_SESSION['role_author'] == TRUE):?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="authorHomePage.php"><strong>Mục Author</strong></a>
                    </li>
                    <?php endif ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#"><strong>Liên hệ</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="criteria.php"><strong>Tiêu chí đánh giá</strong></a>
                    </li>
                </ul>
                <?php if(isset($_SESSION['username'])): ?>
                <div class="nav-item dropdown">
                    <a class="text-light nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <?php if($_SESSION['role_editor'] == TRUE):?>
                            <i class="text-info" >Editor </i>
                        <?php endif ?>
                        <?php if($_SESSION['role_reviewer'] == TRUE):?>
                            <i class="text-info">Reviewer </i>
                        <?php endif ?>
                        <?php if($_SESSION['role_author'] == TRUE):?>
                            <i class="text-info">Author </i>
                        <?php endif ?>
                        <strong>
                        <i class="fa fa-user" aria-hidden="true"></i> <?php echo $_SESSION['username']; ?>
                        </strong></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php if(($_SESSION['role_reviewer'] == TRUE) or ($_SESSION['role_author'] == TRUE)):?>
                            <a class="dropdown-item" href="userInfo.php"><i class="fas fa-user-circle"></i> Thông tin cá nhân</a>
                            <div class="dropdown-divider"></div>
                        <?php endif ?>
                        <a class="dropdown-item" href="../index.php?logout=true"><i class="fas fa-sign-out-alt"></i> Đăng
                            xuất</a>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </nav>
    </header>
</body>

</html>