<?php $title = 'Ajouter un jeux';
ob_start(); ?>

<div>
    <h2>Informations du match :</h2>
    <table class="tableListSingle">
        <thead>
            <td>Nom du jeux :</td>
            <td>Date de début : </td>
            <td>Nombre de joueurs minimum</td>
            <td>Nombre de joueurs maximum</td>
            <td>Nombre de joueurs inscrits</td>
            <td>Match gagné part </td>
        </thead>
        <tr>
            <td><?= htmlspecialchars($contestDetailFetchAll[0]['title']) ?></td>
            <td><?= htmlspecialchars($contestDetailFetchAll[0]['start_date']) ?></td>
            <td><?= htmlspecialchars($gameList[0]['min_players']) ?></td>
            <td><?= htmlspecialchars($gameList[0]['max_players']) ?></td>
            <td><?= htmlspecialchars($contestPlayerNbr) ?></td>
            <td><?= ($contestDetailFetchAll[0]['winner_name']) ? htmlspecialchars($contestDetailFetchAll[0]['winner_name']) : '-' ?></td>
        </tr>
    </table>
</div>

<?php if ($contestDetailFetchAll[0]['winner_name'] === NULL) : ?>
    <h2>Ajout d'un joueur au match</h2>
    <form action="index.php?action=contestAddPlayer" method="POST">
        <p>
            <input type="hidden" name="contest_id" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="game_id" value="<?= $_GET['game_id'] ?>">
            <label for="player_list">Séléctionner le joueur à ajouter</label>
            <select name="player_id" id="player_list" required>

                <?php while ($data = $playerList->fetch()) : ?>

                    <option value="<?= htmlspecialchars($data['id']) ?>"><?= htmlspecialchars($data['nickname']) ?></option>

                <?php endwhile;

                $playerList->closeCursor(); ?>
            </select>

        </p>
        <input type="submit" name="submit" value="Ajouter le joueur">
    </form>
<?php endif; ?>


<h2>Les joueurs participant au match</h2>

<?php if ($contestDetailFetchAll[0]['winner_name'] == NULL) :
    if ($contestPlayerNbr < $gameList[0]['min_players']) : ?>
        <p class="playerAlertLow">Attention le nombre de joueurs n’est pas suffisant pour commencer le match !!</p>
    <?php elseif ($contestPlayerNbr > $gameList[0]['max_players']) : ?>
        <p class="playerAlertHight">Le nombre de joueurs est trop important, enlever <?= htmlspecialchars($contestPlayerNbr - $gameList[0]['max_players']) ?> joueurs !!</p>
    <?php else : ?>
        <p class="playerAlertOpen">Il reste <?= htmlspecialchars($gameList[0]['max_players'] - $contestPlayerNbr) ?> places disponible !!</p>
    <?php endif; ?>

<?php endif; ?>
<table class="tableListSingle">

    <thead>
        <th>#</th>
        <th>Email</th>
        <th>Pseudo</th>
        <?= ($contestDetailFetchAll[0]['winner_name'] === NULL) ? '<th>Action</th>' : ''; ?>

    </thead>


    <?php if ($contestPlayerNbr != NULL) :
        while ($data = $contestPLayerList->fetch()) : ?>
            <tr>
                <td><?= htmlspecialchars($data['id']) ?></td>
                <td><?= htmlspecialchars($data['email']) ?></td>
                <td><?= htmlspecialchars($data['nickname']) ?></td>
                <?php if ($contestDetailFetchAll[0]['winner_name'] === NULL) : ?>
                    <td>
                        <p>
                            <a class="actionContest" href="index.php?action=contestDeletePlayer&player_id=<?= htmlspecialchars($data['player_id']) ?>&contest_id=<?= htmlspecialchars($data['contest_id']) ?>&game_id=<?= htmlspecialchars($_GET['game_id']) ?>">Supprimer le joueur</a>
                        </p>
                    <?php endif; ?>
                    <?php if ($data['winner_id'] === NULL) : ?>
                        <?php if ($time->format('Y-m-d H:i') > $contestDetailFetchAll[0]['start_date']) : ?>
                            <?php if ($contestPlayerNbr >= $gameList[0]['min_players']) : ?>
                                <p>

                                    <a class="actionContest" href="index.php?action=contestAddWinner&player_id=<?= htmlspecialchars($data['player_id']) ?>&contest_id=<?= htmlspecialchars($data['contest_id']) ?>&game_id=<?= htmlspecialchars($_GET['game_id']) ?>">Indiquer comme gagnant</a>
                                </p>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    </td>
            </tr>
        <?php endwhile; ?>

    <?php else :  ?>

        <tr>
            <td>Pas de joueurs positionné sur ce match</td>
        </tr>

    <?php endif; ?>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>