<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/reset.css">
    <link href="public/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;800;900&amp;family=Roboto:wght@300;400;500;700;900&amp;family=Raleway:wght@100;200;300;400;500;600;700;800;900&amp;display=swap">
</head>

<body>
    <header class="header-container">
        <a href="./">
            <p class="logo-website">Game Bost</p>
        </a>
        <nav class="nav-links-container">
            <p><a href="index.php"><i class="far fa-home"></i> Accueil</a></p>
            <p><a href="index.php?action=gameAddView"><i class="far fa-newspaper"></i> Ajouter un jeux</a></p>
        </nav>
    </header>
    <main class="wrapper">
        <?= $content ?>
    </main>
</body>

</html>