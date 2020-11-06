
<form method="post" action="<?php echo 'upDel.php?resetPass='.$_GET['idResetPass'];?>">      
    <label>Mot de passe :
        <input type="password" name="password" required />
    </label> <br />
    <label>Confirmez le nouveau mot de passe :
        <input type="password" name="confirmPassw" required />
    </label><br>
    <input type="submit" name="sub" value="Modifier" />
    <input type="reset" name="effacer" value="Effacer" />
</form>
