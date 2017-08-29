<?php

function get_content($URL){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $URL);
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   $result = curl_exec($ch);
   curl_close($ch);
   $result = preg_replace("#(<\s*a\s+[^>]*href\s*=\s*[\"'])(?!http)([^\"'>]+)([\"'>]+)#",'$1http://www.your_external_website.com/$2$3', $result);
   return $result;
}

if (!empty($_POST)) {

   $path = 'http://www.immaginareservice.com.br/app/twssrv1/api/login?user=joao@exemplo.com.br&pass=123456';
   $path = 'http://www.immaginareservice.com.br/app/twssrv1/api/login/test.txt';

   $result = get_content($path);
   $txt = $result;
}

?>
<!doctype html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
      <meta http-equiv="Pragma" content="no-cache" />
      <meta http-equiv="Expires" content="0" />
      <meta name="format-detection" content="telephone=no">
      <title>Teste</title>
  </head>
  <body>

   <header>
     <nav>
       <h1>Teste</h1>
    </nav>
    </header>

   <main>
      <container>
         <h2>Login</h1>

            <form action="#" method="POST">
               <table class="dialog">
                 <tr>
                     <td>Login:</td>
                     <td><input type="text" name="login"></td>
                 </tr>
                 <tr>
                     <td>Senha:</td>
                     <td><input type="password" name="pass"></td>
                 </tr>
                 <tr>
                     <td colspan="2" align="right">
                         <button type="submit" value="Submit">Ok</button>
                     </td>
                 </tr>
               </table>
            </form>
            <hr>
            <?php
            echo $txt;
            ?>
      </container>
   </main>

   </body>
</html>