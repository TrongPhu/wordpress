<?php

?>
<div style="margin-left: calc(35%);">
    <h1>Plugin Options - Advanced Settings</h1>
    <form align = "center" method="post" action="">
        <table>
            <tr>
                <td>National</td>
                <td>
                    <input type="text" name="national" value="<?php echo $national;?>"/>
                </td>
            </tr>
            <tr>
                <td>City</td>
                <td>
                    <input type="text" name="city" value="<?php echo $city;?>"/>
                </td>
            </tr>
            <tr>
                <td>District</td>
                <td>
                    <input type="text" name="district" value="<?php echo $district;?>"/>
                </td>
            </tr>
            <tr>
                <td>Zip code</td>
                <td>
                    <input type="text" name="zip" value="<?php echo $zip;?>"/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="save-advanced-info" value="Save Advanced Information"/>
                </td>
            </tr>
        </table>
    </form>
</div>