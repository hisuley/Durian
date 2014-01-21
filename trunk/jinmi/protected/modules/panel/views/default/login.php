<form action="<?php echo Yii::app()->createUrl('panel/default/login'); ?>" method="post">
    <table>
        <tr>
            <td><label for="username">用户名：</label></td>
            <td><input type="text" id="username" name="LoginForm[username]"/></td>
        </tr>
        <tr>
            <td><label for="password">密码：</label></td>
            <td><input type="password" id="password" name="LoginForm[password]"/></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="登录"/>
            </td>
        </tr>
    </table>
</form>