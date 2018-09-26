<?php
// src/Model/Table/ArticlesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        // Adding in the time stamp behavior
        $this->addBehavior('Timestamp');
    }
}
