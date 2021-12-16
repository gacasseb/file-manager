<?php

namespace app\models\core;

class Cabecalho
{
    // Número da próxima linha que está livre
    private $freeSpace;

    public function __construct()
    {
        // Verifica se existe um cabeçalho
            // Se existir, lê o cabeçalho e carrega a próxima linha disponível
            // Se não existir, escreve o cabeçalho e carrega a próxima linha disponível
    }

    public function readCabecalho($fileName)
    {

    }

    public function writeCabecalho()
    {

    }

    public function getFreeSpace()
    {
        return $this->freeSpace;
    }
}