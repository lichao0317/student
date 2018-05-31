<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius: 0">
    <div class="container">
        <a class="navbar-brand" href="index.php" target="_blank">Student Manager</a>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="">
            <!-- TAB NAVIGATION -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>年龄</th>
                    <th>班级</th>
                    <th width="150">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $k => $v){
//                    ?>
                    <tr>

                        <td><?php echo $v['uid']?></td>
                        <td><?php echo $v['stuname']?></td>
                        <td><?php echo $v['sex']?></td>
                        <td><?php echo $v['age']?></td>
                        <td><?php echo $v['gname']?></td>
                        <td>
                            <div class="btn-group">
                                <a href="index.php?s=home/entry/show&id=<?php echo $v['uid']; ?>" class="btn btn-primary">查看</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function del(id) {
            if(confirm('确定删除该班级数据吗?')){
                location.href = 'index.php?s=admin/stu/delete&id=' + id;
            }
        }

        // function del(id) {
        //     if (confirm('确定删除该班级数据吗?')) {
        //         //如果确定要删除,发送ajax
        //         $.ajax({
        //             url:'index.php?s=admin/stu/ajaxDelete&id=' + id,
        //             type:'get', //如果请求方式是post,就需要data属性,如果是get可以不要
        //             dataType:'json', //定义返回数据类型
        //             success:function (phpData) {
        //                 alert(phpData.message);
        //                 if (phpData.valid){
        //                     //刷新当前页面
        //                     window.location.reload();
        //                 }
        //             }
        //
        //         })
        //     }
        // }
    </script>
    <?php include 'public/view/foot.php' ?>
</body>
</html>