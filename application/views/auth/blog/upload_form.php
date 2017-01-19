<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>
<?php preprint($photo);?>
<?php preprint($upload_data);?>
<?php echo form_open_multipart('photo/upload');?>

<p><input type="file" name="file_upload" multiple = "multiple" id="imgInp" style="width:20%;"></p>
<img src="#" id ='upload_img'/>
<p>Album:
<select name="album_id">
	<?php 
		$albums = (array) Albums::find_all();
		foreach ($albums as $album) {
			echo "<option value='". $album->id."'>". $album->album_title."</option>";
		}
	 ?>
</select></p>
<input type="radio" name="visible" value= "1" checked="checked">Visible
<input type="radio" name="visible" value= "0">Hidden

<p>Photo Title: <input type="text" name="pic_title" value=""></p>
<p>Caption: <input type="text" name="caption" value=""></p>
	<input type="submit" name="submit" value = "Upload">
</form>




<br /><br />

<input type="submit" value="upload" />
<?php
    if(isset($upload_data)){
        echo "<ul>";
        foreach($upload_data as $item => $value){
            echo '<li>'.$item.':'.$value.'</li>';
        }
        echo "</ul>";
    }
?>

</form>

</body>
</html>