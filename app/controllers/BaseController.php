<?php

namespace App\Controllers;

abstract class BaseController 
{
    //private $settingsUpload = ['foto' => ['urlrelative'=> '', 'DescricaoLabelBotaoUploadImagem' => 'Upload']];
    protected $container;
    protected $records_per_page = 10;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property})
        {
            return $this->container->{$property};
        }
        // else
        // {                        
        //     return $this->{$property};
        // }
    }

    public function DoPagination($query, $page)
    {
        return $query->skip(($page - 1) * $this->records_per_page)->take($this->records_per_page);
    }

    public function Pagination($query, $page, $lenght)
    {
        return $query->skip($page)->take($lenght);
    }
}
