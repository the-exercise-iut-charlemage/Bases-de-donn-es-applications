<?php

//ajouté dans l'index
$user1 = new User();
$user1->name = 'Robert';
$user1->email = 'darksasuke@gmail.com';
$user1->surname = 'Dupont';
$user1->adress = 'city';
$user1->phone = '0394502846';
$user1->save();


//ajouté dans l'index
$user2 = new User();
$user2->name = 'Gillou';
$user2->email = 'XxGillouxX@gmail.com';
$user2->surname = 'Durand';
$user2->adress = 'othercity';
$user2->phone = '0344328948';
$user2->save();


$mess1 = new Message();
$mess1->title='une pepite';
$mess1->content='ce jeu est trop bien';
$mess1->save();

$mess2 = new Message();
$mess2->title='NUL';
$mess2->content='NUL NUL NUL';
$mess2->save();

$mess3 = new Message();
$mess3->title='TRO BI1';
$mess3->content='JADOR';
$mess3->save();

$mess4 = new Message();
$mess4->title='je le recommande';
$mess4->content='c est un bon jeu';
$mess4->save();

$mess5 = new Message();
$mess5->title='j aime pas';
$mess5->content='parceque j aime pas';
$mess5->save();

$mess6 = new Message();
$mess6->title='bof';
$mess6->content='rien de fou dans ce jeu';
$mess6->save();
