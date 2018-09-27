<!-- File: src/Template/Articles/index.ctp -->

<h1>Articles</h1>
<?= $this->Html->link('Add Article', ['action' => 'add']) ?>
<table>
    <tr>
        <th>Title</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($articles as $article): ?>
    <tr>
        <td>
            <!-- $this is an example of the built in htmlhelper cakephp comes With
        It assists with tasks such as creating links, forms, and paginate buttons.
        The link(link text is the first param / url is the second param)-->
            <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
        </td>
        <td>
            <?= $article->created->format(DATE_RFC850) ?>
        </td>
        <td>
           <?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?>
           <?= $this->Form->postLink(
              'Delete',
              ['action' => 'delete', $article->slug],
              ['confirm' => 'Are you sure?'])
          ?>
       </td>
    </tr>
    <?php endforeach; ?>
</table>
