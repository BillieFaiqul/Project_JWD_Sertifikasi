<?php include("../include/koneksi.php");

session_start();
//atur variable
$err ="";
$username ="";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah sudah ada isian di bagian username dan password
    if ($username == '' or $password == '') {
        $err .= "<li>Silahkan masukkan username dan juga password</li>";
    } else {
        // Cek pada bagian database apakah username ada
        $sql1 = "select * from admin where username = '$username'";
        // Masukkan hasil query ke dalam variabel
        $q1 = mysqli_query($db, $sql1);
        $r1 = mysqli_fetch_array($q1);
    }

    // Cek apakah username dan password ada di database
    if ($r1['username'] == '') {
        $err .= "<li>Username tidak tersedia</li>";
    } elseif ($r1['password'] != md5($password)) {
        $err .= "<li>Password tidak sesuai</li>";
    }

    // Memastikan tidak ada error dalam proses login
    if (empty($err)) {
        $_SESSION['session-username'] = $username;
        $_SESSION['session-password'] = md5($password);
        header("location:dashboard.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPSDMP Kominfo Surabaya</title>
    <link rel="shortcut icon" href="../logo BPSDMP.png" type="image/x-icon">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<div class="container my-4">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Login dan Masuk Ke Sistem</div>
            </div>      
            <div style="padding-top:30px" class="panel-body" >
                <?php if($err){ ?>
                    <div id="login-alert" class="alert alert-danger col-sm-12">
                        <ul><?php echo $err ?></ul>
                    </div>
                <?php } ?>                
                <form id="loginform" class="form-horizontal" action="" method="post" role="form">       
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="username">                                        
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" name="login" class="btn btn-primary" value="Login"/>
                            <a href="../index.php"><button type="button" class="btn btn-danger">Kembali</button></a>
                        </div>
                    </div>
                </form>    
            </div>                     
        </div>  
    </div>
</div>
</body>
</html>