<nav class="navbar navbar-inverse" style="border-radius: 0">
    <div class="container">
        <a class="navbar-brand" href="javascript:;">学生管理系统</a>
        <ul class="nav navbar-nav" style="float: right;">
            <li class="active">
                <a href="index.php" target="_blank">前台主页</a>
            </li>
            <li>
                <a href="index.php?s=admin/entry/index">后台主页</a>
            </li>
            <li>
                <a href="index.php?s=admin/login/logout"><span style="color: red"><?php echo $_SESSION['username'] ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;退出</a>
            </li>
        </ul>
    </div>
</nav>