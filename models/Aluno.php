<?php

namespace app\models;

use app\models\core\Model;

class Aluno extends Model
{
    public static function columns()
    {
        return [
            'id',
            'nome',
            'sobrenome'
        ];
    }

    public function fileName()
    {
        return 'alunos';
    }
}