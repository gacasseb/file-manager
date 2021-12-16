<?php

namespace app\models\core;

use app\models\core\Filer;

abstract class Model extends Filer {

    /**
     * Retorna todos os valores no formato de um array
     */
    public function getValues()
    {
        $attributes = $this->columns();
        
        $values = [];
        
        foreach($attributes as $i => $attribute) {
            $values[$i] = $this->$attribute;
        }

        return $values;
    }

    // Salva o model
    public function save()
    {
        // Pego os atributos
        $this->id = $this->getLastIdOnFile() + 1;
        $values = $this->getValues();
        // Codifica os valores para uma string
        $row = FileParser::encode($values);
        // Salva no arquivo
        $this->saveOnFile($row);
    }

    // Lê o arquivo
    public function find($attribute, $value)
    {
        // cria instância da classe
        $className = get_called_class();
        $instance = new $className();

        // procura no arquivo
        $row = $instance->findOnFile($attribute, $value);
        if ( $row === false ) {
            return false;
        }
        $values = FileParser::decode($row);

        // carrega a classe com as informações
        $instance->load($values);

        // retorna a classe
        return $instance;
    }

    // Atualiza o arquivo
    public function update()
    {
        // Encontra a linha do cadastro pelo id
        // Remove a linha
        // Salva a nova linha
        $this->find();
    }

    // Remove do arquivo
    public function delete()
    {
        //Encontra a linha do cadastro no arquivo pelo id
        if ( !empty($this->id) ) {
            $this->deleteOnFile('id', $this->id);
        }
    }

    public function load($values)
    {
        $columns = $this->columns();
        foreach($columns as $i => $attribute) {
            $this->$attribute = $values[$i]; 
        }

        return true;
    }
}