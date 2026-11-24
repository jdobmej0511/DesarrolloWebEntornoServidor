<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercio 17 Tema 2</title>
</head>
<body>
    <?php
        $series = [
            "The Walking Dead" => [
                "Plataforma" => "Netflix",
                "Nota" => "8,1"
            ],
            
            "Los Simpson" => [
                "Plataforma" => "Disney+",
                "Nota" => "80"
            ],

            "Prision Break" => [
                "Plataforma" => "Disney+",
                "Nota" => "7,8"
            ]
        ];

        foreach ($series as $serie => $info) {
            echo "<b>$serie</b><br/>";
            echo "Plataforma: {$info['Plataforma']}<br>";
            echo "Nota: {$info['Nota']}<br><br>";
        }
    ?>
</body>
</html>