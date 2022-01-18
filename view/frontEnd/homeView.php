<?php $title = 'Accueil'; 
 ob_start(); ?>


<h1>L'accueil</h1>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
