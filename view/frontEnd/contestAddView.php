<?php $title = 'Ajout d\'un Match';
ob_start(); ?>

<h1><?= $title ?></h1>

<form action="index.php?action=contestAddTraitment" method="POST">
    <p>
        <label for="contest_game">Choix du jeux :</label>
        <select name="contest_game" id="contest_game" required>
            <?php while ($data = $gameList->fetch()) : ?>
                <option value="<?= htmlspecialchars($data['id']) ?>"><?= htmlspecialchars($data['title']) ?> (entre <?= htmlspecialchars($data['min_players']) ?> et <?= htmlspecialchars($data['max_players']) ?> joueurs)</option>
            <?php endwhile;
            $gameList->closeCursor(); ?>
        </select>
    </p>
    <p>
        <label for="start_date">Date de démarrage :</label>
        <input type="datetime-local" name="start_date" id="start_date" required>
    </p>

    <input type="submit" name="submit" value="Ajouter le match">
</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>