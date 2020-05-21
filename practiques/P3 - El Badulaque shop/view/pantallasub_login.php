<form id="login-form" method="post" action="<?php echo $helper->directori(); ?>index.php?controller=usuaris&action=login">
        Usuari: <input name="myusername" type="text" id="myusername" autofocus="autofocus"/><br>
        Password:<input name="mypassword" type="password" id="mypassword"/><br>
<span id="loginErr">
<?php
        if (isset($_GET['loginErr']))
           echo $_GET['loginErr'];
?>
</span>
        <input type="submit" class="botons" name="login" value="Login"/>
        <a href="index.php?controller=usuaris&action=add">Registra't</a>
</form>
