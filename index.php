<?php

require_once __DIR__ . "/app/utils/Database.php";

require_once __DIR__ . "/app/models/CoreModel.php";
require_once __DIR__ . "/app/models/CoreGame.php";
require_once __DIR__ . "/app/models/CoreUser.php";
require_once __DIR__ . "/app/models/Category.php";
require_once __DIR__ . "/app/models/Driver.php";
require_once __DIR__ . "/app/models/EntryList.php";
require_once __DIR__ . "/app/models/Participation.php";
require_once __DIR__ . "/app/models/Player.php";
require_once __DIR__ . "/app/models/Questions.php";
require_once __DIR__ . "/app/models/Race.php";
require_once __DIR__ . "/app/models/Score.php";
require_once __DIR__ . "/app/models/Verification.php";


$categoryModel = new Driver();

var_dump($categoryModel->findAll('driver'));
