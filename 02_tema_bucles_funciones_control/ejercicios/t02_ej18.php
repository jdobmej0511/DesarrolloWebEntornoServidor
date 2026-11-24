<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercio 18 Tema 2</title>
</head>

<style>
body{
    padding: 20px;
    font-family: 'Segoe UI';
    font-size: 18px;
}

.tarjeta-serie {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 30px;
    border: 1px solid #ccc;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
}

.tarjeta-serie img{
    width: 140px;
    height: 200px;
    border-radius: 12px;
}

.titulo-serie {
    font-size: 28px;
    font-weight: bold;
    display: block;
}
</style>

<body>
    <?php
        $series = [
            "The Walking Dead" => [
                "plataforma" => "Netflix",
                "nota" => "8,1",
                "poster" => "https://media.themoviedb.org/t/p/w300_and_h450_face/kuPOrTbvqJisGskhYIZyUOHrS3J.jpg",
                "argumento" => "El oficial Rick Grimes se despierta del coma para descubrir que el mundo está en ruinas y debe guiar a un grupo de sobrevivientes para permanecer con vida."
            ],
            "Los Simpson" => [
                "plataforma" => "Disney+",
                "nota" => "8,0",
                "poster" => "https://media.themoviedb.org/t/p/w300_and_h450_face/9hmoEmntaYrrlb4HKSFisWUQnqy.jpg",
                "argumento" => "El día a día de una peculiar familia formada por Homer, Marge, Bart, Maggie y Lisa Simpson..."
            ],
            "Prision Break" => [
                "plataforma" => "Disney+",
                "nota" => "7,8",
                "poster" => "https://media.themoviedb.org/t/p/w300_and_h450_face/oqy7vnLWIFwoKBimCQfJHoVRYTS.jpg",
                "argumento" => "Michael Scofield es un hombre desesperado en un situación desesperada..."
            ]
        ];

        foreach ($series as $serie => $info) {
            echo "<div class='tarjeta-serie'>";
                echo "<img src='{$info['poster']}'>";
                echo "<div class='info'>";
                    echo "<span class='titulo-serie'>$serie</span><br/>";
                    echo "<b>Plataforma:</b> {$info['plataforma']}<br>";
                    echo "<b>Nota:</b> {$info['nota']}<br>";
                    echo "{$info['argumento']}<br><br>";
                echo "</div>";
            echo "</div>";
        }
    ?>
</body>
</html>
