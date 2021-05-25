<html>

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login with Google in Codeigniter</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport' />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
        <div class="container">
                <br />
                <h2 align="center">Login using Google Account with Codeigniter</h2>
                <br />
                <div class="panel panel-default">
                        <?php
   if(!isset($login_button))
   {

    $user_data = $this->session->userdata('user_data');
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$user_data['profile_picture'].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name : </b>'.$user_data["first_name"].' '.$user_data['last_name']. '</h3>';
    echo '<h3><b>Email :</b> '.$user_data['email_address'].'</h3>';
    echo '<h3><a href="http://localhost/catatan/login/logout">Logout</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
                </div>
        </div>
</body>

</html>