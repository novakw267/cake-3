<?php
// src/Model/Table/ArticlesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

use Cake\Utility\Text;


class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        // Adding in the time stamp behavior
        $this->addBehavior('Timestamp');
          $this->belongsToMany('Tags'); // Add this line
    }

    public function beforeSave($event, $entity, $options)
{
    if ($entity->isNew() && !$entity->slug) {
        $sluggedTitle = Text::slug($entity->title);
        // trim slug to maximum length defined in schema
        $entity->slug = substr($sluggedTitle, 0, 191);
    }
}
}
