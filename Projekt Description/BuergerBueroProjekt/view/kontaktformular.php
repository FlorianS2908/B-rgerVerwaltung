<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktformular</title>
    <link rel="stylesheet" href="./style/kontaktformular.css">
</head>

<body>

    <div class="container">
        <h2>Kontaktformular</h2>
        <form action="#" method="post">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Vorname</th>
                </tr>
                <tr>
                    <td><input type="text" name="name"></td>
                    <td><input type="text" name="vorname"></td>
                </tr>
                <tr>
                    <th colspan="2">Betreff</th>
                </tr>
                <tr>
                    <td colspan="2"><input type="text" name="betreff"></td>
                </tr>
                <tr>
                    <th colspan="2">Email</th>
                </tr>
                <tr>
                    <td colspan="2"><input type="email" name="email"></td>
                </tr>
                <tr>
                    <th colspan="2">Nachricht</th>
                </tr>
                <tr>
                    <td colspan="2"><textarea name="nachricht" rows="4" cols="50"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Anfragesenden"></td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>