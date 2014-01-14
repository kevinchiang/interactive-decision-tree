<?php
session_start();
if (!$_SESSION['isLoggedIn']){
    header('Location: login.php');
}

include('../_CONFIG.php');
include('../_THEME.php');

try {
        $dbh = new PDO("mysql:host=" . DBHOST . ";dbname=" . DATABASE_NAME , DBUSERNAME, DBPASSWD);
    }
catch(PDOException $e)
    {
        echo $e->getMessage();
    }

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Interactive Decision Tree - Admin</title>
<link href="../public/css/editor.css" rel="stylesheet" type="text/css" />
<link href="../public/bower_components/bootstrap/dist/css/<?php echo BOOTSTRAP_THEME; ?>" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="editTree.php">Interactive Decision Tree - Admin</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="editTree.php">Trees</a></li>
      <li><a href="theme_chooser.php">Theme</a></li>
      <li><a class="active" href="referral_sources.php">Referral Sources</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
<div class="container">
<h1>Manage Referral Sources</h1>

<div class="table-responsive">

    <table class="table table-hover">
        <thead><tr><td>Name</td><td>Address</td><td>City</td><td>Email</td><td>Phone</td><tr></thead>
        <tbody>
<?php 
    $q = $dbh->prepare('SELECT * from referrals ORDER BY id asc');
    $q->execute();
    $rows = $q->fetchALL(PDO::FETCH_ASSOC);
    foreach ($rows as $r) {extract($r)
?>
        <tr>
        <td><?php echo $r['name'];?></td>
        <td><?php echo $r['address'];?></td>
        <td><?php echo $r['city'];?></td>
        <td><?php echo $r['email'];?></td>
        <td><?php echo $r['phone'];?></td>
        </tr>
    <?php
    }
    ?>
        </tbody>
    </table>
</div>

</div>
<script type="text/javascript" src="../public/js/jquery.min.js"></script>
<script type="text/javascript" src="../public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../public/bower_components/bootstrap/js/tooltip.js"></script>
<script type="text/javascript" src="../public/bower_components/bootstrap/js/popover.js"></script>
</body>
</html>