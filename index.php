<?php
$title = "Carousel";
require 'src/Carousel.php';
require 'src/Slide.php';
require 'config.php';


$carousel1 = new Carousel(
    [
        new Slide(
            'Perferendis non eum eius exercitationem sunt iusto. Quaerat magnam veritatis sint temporibus eaque aspernatur ea dolore? Blanditiis provident aliquam eius laudantium nostrum.',
            'Perferendis non eum',
            'misc1.jpg',
            '#'
        ),
        new Slide(
            'Possimus dolore est molestias qui accusamus, placeat totam earum! Itaque earum excepturi nesciunt at voluptas laborum corrupti unde. Repudiandae laboriosam saepe eos!',
            'Possimus dolore est',
            'misc2.jpg',
            '#'
        ),
        new Slide(
            'Est fugit quos, atque, maxime quo architecto reprehenderit doloribus numquam expedita dolore vel harum, accusantium quisquam similique eius iste amet voluptatem dolor.',
            'Est fugit quos',
            'misc3.jpg',
            '#'
        ),
        new Slide(
            'Doloremque atque blanditiis velit veniam dolores minima mollitia non libero, repudiandae, saepe nemo nulla. Ad molestias alias asperiores ipsam nesciunt quo cum.',
            'Doloremque atque blanditiis',
            'misc4.jpg',
            '#'
        ),
        new Slide(
            'Incidunt dolores optio animi odit obcaecati esse deleniti dicta repellat alias temporibus, perspiciatis quibusdam maiores similique repellendus neque, illo consequatur iste accusantium.',
            'Incidunt dolores optio animi',
            'misc5.jpg',
            '#'
        ),
        new Slide(
            'Debitis veritatis cum, sequi expedita laboriosam quaerat facere ducimus perferendis adipisci, fuga, suscipit iusto minus eveniet aspernatur accusamus necessitatibus aliquid consectetur natus!',
            'Debitis veritatis cum',
            'misc6.jpg',
            '#'
        ),
        new Slide(
            'Est fugit quos, atque, maxime quo architecto reprehenderit doloribus numquam expedita dolore vel harum, accusantium quisquam similique eius iste amet voluptatem dolor.',
            'Est fugit quos',
            'misc7.jpg',
            '#'
        )
    ],
    [
        'slidesVisible' => 3,
        'slidesToScroll' => 2,
        'infiniteScroll' => 1,
        'autoPlay' => 1
    ]
);
$carousel2 = new Carousel(
    [
        new Slide(
            'Perferendis non eum eius exercitationem sunt iusto. Quaerat magnam veritatis sint temporibus eaque aspernatur ea dolore? Blanditiis provident aliquam eius laudantium nostrum.',
            'Perferendis non eum',
            'city2.jpg'
        ),
        new Slide(
            'Possimus dolore est molestias qui accusamus, placeat totam earum! Itaque earum excepturi nesciunt at voluptas laborum corrupti unde. Repudiandae laboriosam saepe eos!',
            'Possimus dolore est',
            'city1.jpg'
        ),
        new Slide(
            'Doloremque atque blanditiis velit veniam dolores minima mollitia non libero, repudiandae, saepe nemo nulla. Ad molestias alias asperiores ipsam nesciunt quo cum.',
            'Doloremque atque blanditiis',
            'city3.jpg'
        ),
        new Slide(
            'Eaque odio perferendis laborum possimus fugiat illum distinctio mollitia unde. Laudantium totam perferendis sapiente impedit nostrum doloremque ex quidem distinctio eius molestias!',
            'Eaque odio perferendis laborum',
            'city4.jpg'
        )
    ],
    [
        'slidesVisible' => 1,
        'slidesToScroll' => 1
    ]
);
$carousel3 = new Carousel(
    [
        new Slide(
            'Perferendis non eum eius exercitationem sunt iusto. Quaerat magnam veritatis sint temporibus eaque aspernatur ea dolore? Blanditiis provident aliquam eius laudantium nostrum.',
            'Perferendis non eum',
            'guitare5.jpg',
            '#'
        ),
        new Slide(
            'Possimus dolore est molestias qui accusamus, placeat totam earum! Itaque earum excepturi nesciunt at voluptas laborum corrupti unde. Repudiandae laboriosam saepe eos!',
            'Possimus dolore est',
            'guitare1.jpg'
        ),
        new Slide(
            'Est fugit quos, atque, maxime quo architecto reprehenderit doloribus numquam expedita dolore vel harum, accusantium quisquam similique eius iste amet voluptatem dolor.',
            'Est fugit quos',
            'guitare3.jpg'
        ),
        new Slide(
            'Doloremque atque blanditiis velit veniam dolores minima mollitia non libero, repudiandae, saepe nemo nulla. Ad molestias alias asperiores ipsam nesciunt quo cum.',
            'Doloremque atque blanditiis',
            'guitare2.jpg',
            '#'
        ),
        new Slide(
            'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis non eum eius exercitationem sunt iusto. Quaerat magnam veritatis sint temporibus eaque aspernatur ea dolore? Blanditiis provident aliquam eius laudantium nostrum.',
            'Lorem ipsum dolor sit',
            'guitare4.jpg'
        )
    ],
    [
        'slidesVisible' => 2,
        'slidesToScroll' => 1,
        'infiniteScroll' => 1
    ]
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= APP_PATH ?>style.css">
    <link rel="stylesheet" href="<?= APP_PATH ?>lib/fonts/montserrat/montserrat.css">

    <title><?= $title ?></title>
</head>

<body>
    <div class="title-container">
        <h1>Caroussel</h1>
    </div>
    <?php Carousel::showAll($carousel1, $carousel2, $carousel3) ?>
</body>

</html>