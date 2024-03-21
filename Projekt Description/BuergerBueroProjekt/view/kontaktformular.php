<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktformular</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    th {
        text-align: left;
        /* Stellen wir text lings*/
    }

    table,
    th,
    td {

        padding: 10px;
    }

    input[type="text"],
    input[type="email"],
    textarea {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 22%;
        padding: 10px;
        background-color: #808080;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
    </style>
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