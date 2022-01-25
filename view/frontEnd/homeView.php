<?php $title = 'Accueil';
ob_start(); ?>

<div class="myscoreboard">

    <h1>My ScoreBoard</h1>
    <p>Tenez à jour vos résultats entre amis !</p>

</div>

<hr>

<div class="table-container">
    <table class="tablePlayer">
        <thead>
            <th>#</th>
            <th>Email</th>
            <th>Pseudo</th>
        </thead>
        <?php while ($dataPlayerList = $playerList->fetch()) : ?>
            <tr>
                <td><?= htmlspecialchars($dataPlayerList['id']) ?></td>
                <td><?= htmlspecialchars($dataPlayerList['email']) ?></td>
                <td><?= htmlspecialchars($dataPlayerList['nickname']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <table class="tableGame">
        <thead>
            <th>#</th>
            <th>Jeu</th>
            <th>Joueurs</th>
        </thead>
        <?php while ($dataGameList = $gameList->fetch()) : ?>
            <tr>
                <td><?= htmlspecialchars($dataGameList['id']) ?></td>
                <td><?= htmlspecialchars($dataGameList['title']) ?></td>
                <td>De <?= htmlspecialchars($dataGameList['min_players']) ?> à <?= htmlspecialchars($dataGameList['max_players']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <table class="tableContest">
        <thead>
            <th>#</th>
            <th>Jeu</th>
            <th>Infos</th>
        </thead>
        <?php ?>
        <?php while ($dataContestList = $contestList->fetch()) : ?>
            <tr class="match <?= ($time->format('Y-m-d H:i') > htmlspecialchars($dataContestList['start_date'])) ? "matchStart" : "" ?>">
                <td>
                    <p><?= htmlspecialchars($dataContestList['id']) ?></p>
                    <p class="actionContest"><a href="index.php?action=contestSingleView&id=<?= htmlspecialchars($dataContestList['id']) ?>&game_id=<?= htmlspecialchars($dataContestList['game_id']) ?>">Gérer</a></p>
                    <p class="actionContest"><a href="index.php?action=contestDelete&contest_id=<?= htmlspecialchars($dataContestList['id']) ?>">Supprimer</a></p>

                </td>
                <td><?= htmlspecialchars($dataContestList['title']) ?></td>
                <td>
                    <p><?= htmlspecialchars($dataContestList['nombre_joueur']) ?> joueurs inscrits</p>
                    <p class="startDate">Commence le <?= htmlspecialchars($dataContestList['start_date']) ?></p>
                    <?= ($dataContestList['player_winner'] != null) ? "<p class=winner>Gagné par " . htmlspecialchars($dataContestList['player_winner']) . "</p>" : "" ?>
                </td>

            </tr>
        <?php endwhile; ?>
    </table>


</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>