<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

class ArticlesController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }
    // find by slug is a dynamic finder
    // This creates a basic query to find articles by a given slug
    // Then with the first or fail function, it will throw back the first
    // relevent article or throw message saying not found.
    // slug in this case represents the users search paramiters
    public function view($slug = null)
{
    $article = $this->Articles->findBySlug($slug)->firstOrFail();
    $this->set(compact('article'));
}    public function add()
    {
        //The add action
        // The goal is to make a request that includes and object
        // This contains information about the request
        // By usign the is('method') it is able to check that it is a post
        // request being made.
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            // The data for our post is in getData()
            // you can use pr() or debug() to print the data if you want
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $article->user_id = 1;

            // In order to save the data it get it gets compiled into the article
            // entity and passed to the database in the articles table.
            if ($this->Articles->save($article)) {
                // If the data is successfully saved it will flash a message
                // saying it has been saved, and redirect you to the next page.
                // this->flash is the function for displaying flash messages
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            // same thing here except this is for if you are not successfull
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article);
    }
        public function edit($slug)
        {
            // If a slug parameter is not used, an error will be thrown.
            // This is to be sure that the user is editing an actual entity
            //Next it then determines
            $article = $this->Articles->findBySlug($slug)->firstOrFail();
            if ($this->request->is(['post', 'put'])) {
                $this->Articles->patchEntity($article, $this->request->getData());
                if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('article', $article);
}
    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The {0} article has been deleted.', $article->title));
            return $this->redirect(['action' => 'index']);
        }
    }

}
