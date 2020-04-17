<?php

?>
<div style="margin-left: calc(35%);">
    <h1>Plugin Options - General Settings</h1>
    <form align = "center" method="post" action="">
        <table>
            <tr>
                <td>User Name:</td>
                <td>
                    <input type="text" name="username" value="<?php echo $username;?>"/>
                </td>
            </tr>
            <tr>
                <td>First Name:</td>
                <td>
                    <input type="text" name="first_name" value="<?php echo $first_name;?>"/>
                </td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td>
                    <input type="text" name="last_name" value="<?php echo $last_name;?>"/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="save-general-info" value="Save General Information"/>
                </td>
            </tr>
        </table>
    </form>
</div>