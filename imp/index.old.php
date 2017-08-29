
<html>
<head>
<title>Upload</title>
</head>
<body>
<?php

// require_once('bimp.php');


// if (isset($_FILES[arquivo]) and isset($_POST['pass'])) {

//     try {

//         $obj = new BanMovImp();
//         $msg = $obj->imp($_POST['pass'], $_FILES[arquivo]);
//     } catch (Exception $e) {

//         echo ($e->getMessage());
//     }
// }

?> 
<p>
<form name="upload" action="" method="post" enctype="multipart/form-data">
<input type="file" name="arquivo" size="60">
<input type="password" name="pass">
</p>

<p><input type="submit" name="enviar" value="Upload"></p>
 
</form>
<p>
<?php echo $msg ?>
</p>
</body>
</html>