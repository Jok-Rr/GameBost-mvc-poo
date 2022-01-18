<?php $title = 'Ajouter un jeux';
ob_start(); ?>


<h1>Ajouter un jeux</h1>

<form action="index.php?action=gameAddTraitment" method="POST">
    <p>
        <label for="game_title">Titre du jeux</label>
        <input type="text" name="game_title" id="game_title" required>
    </p>
    <p>
        <label for="game_min_players">Nombre de joueurs minimum :</label>
        <input type="number" name="game_min_players" id="game_min_players" min="1" max="15" required>
    </p>
    <p>
        <label for="game_max_players">Nombre de joueurs maximum :</label>
        <input type="number" name="game_max_players" id="game_max_players" min="2" max="15" required>
    </p>
    <input type="submit" name="submit" value="Ajouter le jeux">
</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>