<?php

if (!$User->isLoggedIn()) {
    \library\Redirect::to('/');
}


?>

<h1>Upadate details</h1>
<form action="/act/update" method="post">
    <input type="text" name="full_name" value="<?php echo $Validate->escape($User->data()->full_name)?>">
    <input type="hidden" name="token" value="<?php echo $Token::generate()?>">
    <button type="submit">Submit</button>
</form>
<br><br><br><br>

<h1>Upadate password</h1>
<form action="/act/changePassword" method="post">
    <label for="">Password current</label>
    <input type="text" name="password_current"><br><br>
    <label for="">New password</label>
    <input type="text" name="password_new"><br><br>
    <label for="">New password again</label>
    <input type="text" name="password_new_again"><br><br>
    <input type="hidden" name="token" value="<?php echo $Token::generate()?>">
    <button type="submit">Submit</button>
</form>
