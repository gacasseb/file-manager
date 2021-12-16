<?php

namespace app\models\core;

use app\models\core\FileParser;

abstract class Filer {

    private $fileName;
    private $file;

    private $nextRow;

    const PATH = '/app/store';

    public function __construct()
    {
        $this->fileName = $this->fileName();
        $this->loadFile();
    }

    /**
     * Abre o arquivo e retorna a última linha disponível
     */
    private function getNextRow()
    {
        // Percorre todas as linhas e procura pela próxima linha vazia
        $this->nextRow = 0;
    }

    /**
     * Busca o arquivo de leitura
     */
    private function loadFile()
    {
        $this->file = fopen($this->getFilePath(), "a+");
    }

    public function getFilePath()
    {
        return self::PATH . '/' . $this->fileName . '.txt';
    }

    // Salva o model no arquivo
    public function saveOnFile($row)
    {
        // Pegar o último espaço livre
        $nextRow = $this->nextRow;
        // Escrever no espaço
        fwrite($this->file, $row);
    }

    public function updateOnFile()
    {
        // Encontra a linha do registro no arquivo
        // Remove a linha do registro
        // Salva novo cadastro na linha do registro removido
    }

    public function deleteOnFile($attribute, $value)
    {
        
        $line = $this->findOnFile($attribute, $value);

        $contents = file_get_contents($this->getFilePath());
        $contents = str_replace($line, '', $contents);

        file_put_contents($this->getFilePath(), $contents);
    }

    /**
     * Encontra o registro no arquivo dado o atributo e o valor
     * 
     * @return string $line retorna a linha de registro no arquivo
     */
    public function findOnFile($attribute, $value)
    {
        if ( ($index = array_search($attribute, $this->columns())) === false ) {
            return false;
        }
        
        while( ($line = fgets($this->file)) !== false ) {
            $values = explode(",", $line);
            if ( $values[$index] == $value ) {
                rewind($this->file);
                return $line;
            }
        }
        
        rewind($this->file);
        return false;
    }

    /**
     * Encontra a linha no arquivo dado o atributo e o valor
     * 
     * @return string $line retorna a linha de registro no arquivo
     */
    public function findLineOnFile($attribute, $value)
    {
        if ( ($index = array_search($attribute, $this->columns())) === false ) {
            return false;
        }

        $lineNumber = 0;
        while( ($line = fgets($this->file)) !== false ) {
            $values = explode(",", $line);
            if ( $values[$index] == $value ) {
                return $lineNumber;
            }
            $lineNumber++;
        }

        return false;
    }

    public function getLastIdOnFile($id = 'id')
    {
        $index = array_search('$id', $this->columns());
        $biggerId = 0;

        while( ($line = fgets($this->file)) !== false ) {
            $values = explode(",", $line);
            if ( $line[$index] > $biggerId ) {
                $biggerId = $line[$index];
            }
        }

        return $biggerId;
    }
}
