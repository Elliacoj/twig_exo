<?php

use RedBeanPHP\R;

R::setup("mysql:host=localhost;dbname=twig_exo;charset=utf8", 'root', '');
R::getDatabaseAdapter()->getDatabase()->stringifyFetches(false);
R::getDatabaseAdapter()->getDatabase()->getPDO()->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);