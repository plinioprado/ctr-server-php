<container>

    <h2>Audita</h2>

    <ul>
    <?php 
        foreach ($list as $key=>$value) {
            echo "<li><a href='index.php?srv=audit&id={$key}&token=$token'>{$value}<a></li>";
        }
    ?>        
    </ul>

</container>