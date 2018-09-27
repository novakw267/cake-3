<h1>Add Article</h1>
<?php
// this->form->create is short hand for
// <form method="post" action="/articles/add">
// Since create() is called without a url option
// form helper assumes we want to go back to the current action
    echo $this->Form->create($article);
    // Hard code the user for now.
    // This method is used to create fom elements of the same name
    // The first parameter gives what field the post will correspond to
    // The second set of parameters allows you to specify options,
    // here that being text area size.
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']);
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
    echo $this->Form->control('tags._ids', ['options' => $tags]);
?>
<?= $this->Html->link('Return', ['action' => 'index']) ?>
