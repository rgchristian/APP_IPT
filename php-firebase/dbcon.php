<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Auth;

$factory = (new Factory)
    ->withServiceAccount('crud-ipt-firebase-adminsdk-fknm1-948a91fd1d.json')
    ->withDatabaseUri('https://crud-ipt-default-rtdb.firebaseio.com/');
    
$database = $factory->createDatabase();
$auth = $factory->createAuth();

?>