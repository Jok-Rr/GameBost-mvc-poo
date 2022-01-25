<?php $title = 'Ajouter un jeux';
ob_start(); ?>


<h1>Ajouter d'un Joueur</h1>

<form action="index.php?action=playerAddTraitment" method="POST">
    <p>
        <label for="player_email">Email du joueur :</label>
        <input type="email" name="player_email" id="player_email" required>
    </p>
    <p>
        <label for="player_nickname">Nom du joueur :</label>
        <input type="text" name="player_nickname" id="player_nickname" required>
    </p>

    <input type="submit" name="submit" value="Ajouter le joueur">
</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>