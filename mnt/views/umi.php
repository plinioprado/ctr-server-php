<container>

    <h2>Login</h2>

    <form name="upload" action="" method="post" enctype="multipart/form-data">
    <input type="file" name="arquivo" size="60">
    <input type="password" name="pass">
    </p>

    <p><input type="submit" name="enviar" value="Upload"></p>
     
    </form>

    <p>
    <?php echo $msg ?>
    </p>

</container>