<?php
echo'       <html>
    <head><title>Example</title></head>
    <body>
        <form action="tallennustesti2.php" method="post">
            <table width="50%">
            <tr>
        <td><input type="checkbox"name="boxes[]"value="8am">1</input></td>
                <td>8am</td>
            </tr>
            <tr>
        <td><input type="checkbox"name="boxes[]"value="9am">2</input></td>
                <td>9am</td>
            </tr>
            <tr>
        <td><input type="checkbox"name="boxes[]"value="10am">3</input></td>
                <td>10am</td>
            </tr>
            </table>
            <input type="submit" name="submit">
        </form>

</body>
</html>';



