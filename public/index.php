<?php

require_once("/app/models/core/Filer.php");
require_once("/app/models/core/Model.php");
require_once("/app/models/core/FileParser.php");
require_once("/app/models/Aluno.php");

use app\models\Aluno;

$aluno = new Aluno();

// $dieniffer->delete();
// $dieniffer->delete();
// $aluno::find('id', 2);
$aluno = $aluno->find('nome', 'Jessica');
$aluno->nome = 'Jeh';
$aluno->sobrenome = 'Lacerda';
$aluno->update();
var_dump($aluno);
// $aluno->delete();
// $aluno->nome = 'Mavi';
// $aluno->sobrenome = 'Casseb';
// $aluno->save();
// $aluno->deleteOnFile('nome', 'Gabriel');

echo 'Hello paizão';
