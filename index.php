<?php

require 'vendor/autoload.php';

require 'db.config.php';
\ch\rammler\DB::config($config);

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);
new \ch\rammler\slim\group\Agenda($app);
new \ch\rammler\slim\group\Galerie($app);
new \ch\rammler\slim\group\Register($app);
new \ch\rammler\slim\group\Mitglied($app);
new \ch\rammler\slim\group\Sponsor($app);
new \ch\rammler\slim\group\Vorstand($app);
new \ch\rammler\slim\group\RammlerDerWoche($app);
new \ch\rammler\slim\group\Mitgliederportrait($app);

// Run app
$app->run();