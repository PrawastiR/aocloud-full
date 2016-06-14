<?php 
$query = mysqli_query($DB, 'SELECT * FROM user WHERE id = "'.$_SESSION['login'].'"');

$user = mysqli_fetch_object($query);
if(!$user){
	header('location: index.php');
}

$folder = isset($_GET['folder']) ? $_GET['folder']: 0;
$type = isset($_GET['type']) ? $_GET['type']: 0;

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dashboard AO Cloud</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">
			<i class="glyphicon glyphicon-cloud"></i>
		  </a>
		</div>
		
		<div class="text-center" style="position:absolute; display: block; width: 100%;">
			<div id="logo"><i class="glyphicon glyphicon-cloud-upload"></i> AO CLOUD</div>
		</div>
		  <ul class="nav navbar-nav navbar-right">
			<!-- <li><a href="#"><i class="glyphicon glyphicon-bell"></i></a></li>
			<li><a href="#"><i class="glyphicon glyphicon-user"></i></a></li> -->
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $user->nama.' ('.$user->email.')' ?><span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="profil.php">Profile</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			</li>
		  </ul>
	</nav>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
       <form class="form-horizontal" method="POST" action="dashboard.php">
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Nama Folder</label>
			<div class="col-sm-9">
			  <input type="text" name="nama_folder" class="form-control" value="" placeholder="Nama Folder">
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Description</label>
			<div class="col-sm-9">
			  <textarea name="description" class="form-control" placeholder="Description"></textarea>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
			  <button type="submit" class="btn btn-primary">Tambah</button>
			</div>
		  </div>
		</form>
      </div>
    </div>
  </div>
</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<div class="panel panel-default">
					<div class="panel-body">
					  <!-- List group -->
					  <ul id="tree">
						<li><a href="dashboard.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
						<li>
							<a role="button" data-toggle="collapse" href="#my-drive-collapse" aria-expanded="false" aria-controls="my-drive-collapse">
							  <i class="glyphicon glyphicon-folder-open"></i> My Drive
							</a>
							<div class="collapse" id="my-drive-collapse">
								<ul>
									<li><a href="dashboard.php?folder=0"><i class="glyphicon glyphicon-folder-close"></i> All</a></li>
									<?php
									$query = mysqli_query($DB, 'SELECT * FROM folder WHERE user_id='.$user->id);
					
									while($f = mysqli_fetch_object($query)){
									?>
									<li><a href="dashboard.php?folder=<?= $f->id ?>&type=<?= $type ?>"><i class="glyphicon glyphicon-folder-close"></i> <?= $f->nama ?></a></li>
									<?php } ?>
									<li><a href="#" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> New</a></li>
								</ul>
							</div>
						</li>
						<li><a href="dashboard.php?folder=<?= $folder ?>&type=File"><i class="glyphicon glyphicon-file"></i> File</a></li>
						<li><a href="dashboard.php?folder=<?= $folder ?>&type=Document"><i class="glyphicon glyphicon-file"></i> Document</a></li>
						<li><a href="dashboard.php?folder=<?= $folder ?>&type=Picture"><i class="glyphicon glyphicon-picture"></i> Picture</a></li>
					  </ul>
					</div>
				</div>
			</div>
			<div class="col-sm-10">