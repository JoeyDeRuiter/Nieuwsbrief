<?php

class DatabaseController extends mysqli
{
    function __construct()
    {
        if(file_exists(ROOT . DS . 'config' . DS . 'nieuwsbrief.ini'))
        {
            $config = parse_ini_file(ROOT . DS . 'config' . DS . 'nieuwsbrief.ini');
        }
        else
        {
            throw new Exception('Nieuwsbrief: Config file not found');
        }

        parent::__construct($config['db_host'], $config['db_username'], 'JcEt9dj9FMq9VwSv', 'stage');
    }
}