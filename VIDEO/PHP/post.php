<form action="nav.php" method="post">
    email :
    <input type="email" name="email" id="">
    password :
    <input type="password" name="password" id="">
    <input type="submit" name="kirim" value="login">
</form>

<?php 

    if (isset($_GET['kirim'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        echo $email;
        echo '<br>';
        echo $password;
    
    }


?>