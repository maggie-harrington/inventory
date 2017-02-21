<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Item.php";
    require_once __DIR__."/../src/Category.php";


    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {

        return $app['twig']->render('items.html.twig');
    });

    $app->post("/items", function() use($app) {
        $item = new Item($_POST['description']);
        $item->save();
        return $app['twig']->render('items.html.twig', array('items' => Item::getAll()));
    });

    $app->post("/", function() use($app) {
        Item::deleteAll();
        return $app['twig']->render('items.html.twig');
    });

    return $app;
?>
