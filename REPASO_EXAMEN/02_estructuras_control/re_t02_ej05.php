<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table>
        <?php for ($i=0; $i < 10; $i++): ?>
            <tr>
                <?php for ($j=0; $j < 10; $j++): ?>
                    <td><?= $i . ',' . $j ?></td>
                    <?php endfor ?>
            </tr>
            <?php endfor ?>
    </table>

</body>
</html>