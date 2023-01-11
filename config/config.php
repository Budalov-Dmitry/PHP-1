<?php
define('TEMPLATES_DIR', '../templates/');
define('LAYOUTS_DIR', 'layouts/');


define('HOST', 'localhost:3307');
define('USER', 'root');
define('PASS', 'root');
define('DB', 'gallery');


include "../engine/render.php";
include "../engine/db.php";
include "../engine/auth.php";
include "../engine/controller.php";
include "../models/feedback.php";
include "../models/basket.php";
include "../models/catalog.php";
include "../models/orders.php";