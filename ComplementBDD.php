<?php

$user1 = new User();
$user1->name = 'Robert';
$user1->id = 1;
$user1->email = 'darksasuke@gmail.com';
$user1->surname = 'Dupont';
$user1->adress = 'city';
$user1->phone = '0394502846';
$user1->save();

$user2 = new User();
$user2->name = 'Gillou';
$user2->id = 2;
$user2->email = 'XxGillouxX@gmail.com';
$user2->surname = 'Durand';
$user2->adress = 'othercity';
$user2->phone = '0344328948';
$user2->save();