<?php
require_once ('libs/init.php');
require_once ('libs/Connection.php');
redirectLogin();


if(isset($_FILES['file']) && isset($_POST['nama']) && isset($_POST['type']) && isset($_POST['description']) && isset($_POST['folder'])){
	
	if(strlen($_POST['nama']) < 1 || strlen($_POST['nama']) > 250 ){
		$_SESSION['error'][] = "Panjang nama haru 1-250 karakter"; 
	}
	$target_dir = "uploads/user-".$_SESSION['login'].'/';
	if(!file_exists($target_dir)){
		@mkdir($target_dir);
	}
	
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$ex = explode(".", basename($_FILES["file"]["name"]));
	$ext = end($ex);
	
	if(count($_SESSION['error']) == 0 ){
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			$sql = 'INSERT INTO file (type, name, ext, pname, description, folder_id) VALUES  ("'._e($_POST['type']).'","'._e($_POST['name']).'", "'.$ext.'", "'.$target_file.'", "'._e($_POST['description']).'", "'._e($_POST['folder']).'")';
			$query = mysqli_query($DB, $sql);
			
			if($query){
				$_SESSION['message'][] = "File berhasil disimpan";
				header('location: dashboard.php', true, 302);
				exit();
			}elsE{
				$_SESSION['error'][] = "Gagal dalam mengupload file";
			}
		} else {
			$_SESSION['error'][] = "File gagal di upload";
		}
	}
}

require_once ('inc/header.php');
showMessage();
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Upload File</h3>
	</div>
	<div class="panel-body" id="files">
		<form class="form-horizontal" method="POST" action="upload.php?folder=<?= $folder ?>" enctype="multipart/form-data">
		  <div class="form-group">
			<label class="col-sm-2 control-label">File</label>
			<div class="col-sm-10">
			  <input type="file" name="file" placeholder="File">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">Folder</label>
			<div class="col-sm-10">
				<select name="folder" class="form-control">
					<?php
					$query = mysqli_query($DB, 'SELECT * FROM folder WHERE user_id='.$user->id);
	
					while($f = mysqli_fetch_object($query)){
					?>
					<option value="<?= $f->id ?>" <?= $f->id == $folder ? 'selected':'' ?>><?= $f->nama ?></option>
					<?php } ?>
				</select>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">Nama File</label>
			<div class="col-sm-10">
			  <input type="text" name="nama" class="form-control" placeholder="Nama File">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">Type</label>
			<div class="col-sm-10">
			  <select name="type" class="form-control">
				<option value="File">File</option>
				<option value="Document">Document</option>
				<option value="Picture">Picture</option>
			  </select>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
			  <textarea name="description" class="form-control" placeholder="Description"></textarea>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-primary">Upload</button>
			</div>
		  </div>
		</form>
	</div>
</div>
<?php include "inc/footer.php"; ?>