<form method="post" action="<?php echo $this->createUrl('default/login'); ?>">
    <p><input type="text" name="LoginForm[username]" value="" placeholder="输入您的用户名"></p>
    <p><input type="password" name="LoginForm[password]" value="" placeholder="密码"></p>
    <p class="remember_me">
        <label>
            <input type="checkbox" name="LoginForm[remember_me]" id="remember_me">
            30天内有效
        </label>
    </p>
    <p class="submit"><input type="submit" name="commit" value="登陆"></p>
</form>