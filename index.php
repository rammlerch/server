<?php

require 'vendor/autoload.php';

require 'db.config.php';
\ch\rammler\DB::config($config);

$app = new \Slim\App();
new \ch\rammler\slim\group\Agenda($app);
new \ch\rammler\slim\group\Galerie($app);
new \ch\rammler\slim\group\Register($app);
new \ch\rammler\slim\group\Sponsor($app);
new \ch\rammler\slim\group\Vorstand($app);

// Run app
$app->run();