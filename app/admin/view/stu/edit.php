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
<?php include 'public/view/header.php' ?>
<div class="container">
    <div class="row">
        <?php include 'public/view/left.php' ?>
        <div class="col-lg-9">
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs" role="tablist">
                <li><a href="index.php?s=admin/stu/index">stu list</a></li>
                <li class="active"><a href="javascript:;">edit stu</a></li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">edit stu</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">姓名:</label>
                            <div class="col-sm-10">
                                <input type="text" name="stuname" id="inputID" class="form-control" value="<?php echo $result[0]['stuname']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">性别:</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="sex" value="男" <?php if($result[0]['sex'] == '男') { ?>checked="checked" <?php } ?>> 男
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="sex" value="女" <?php if($result[0]['sex'] == '女') { ?>checked="checked" <?php } ?>> 女
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">年龄:</label>
                            <div class="col-sm-10">
                                <input type="number" name="age" class="form-control" value="<?php echo $result[0]['age'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">班级:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="g_id">
                                    <?php foreach ($grade as $k => $v){
                                        if($v['id'] == $result[0]['g_id']){ ?>
                                            <option value="<?php echo $v['id'] ?>" selected="selected"><?php echo $v['gname'] ?></option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $v['id']; ?>"><?php echo $v['gname'] ?></option>
                                        <?php  } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">编辑</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'public/view/foot.php' ?>
</body>
</html>