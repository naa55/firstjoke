<?php
namespace Ijdb\Entity;
class Joke
{
    public $id;
    public $authorid;
    public $jokedate;
    public $joketext;
    private $authorsTable;
    private $author;
    private $jokesCategoriesTable;
    public function __construct(\Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $jokesCategoriesTable){
        $this->authorsTable = $authorsTable;
        $this->jokesCategoriesTable = $jokesCategoriesTable;
    }
    public function getAuthor() {
        if (empty($this->author)) {
            return $this->authorsTable->findById($this->authorid);
        }
    }
    public function addCategory($categoryId) {
        var_dump($categoryId);
            $jokeCate = ['jokeId'=>$this->id, 'catId'=>$categoryId];
            $this->jokesCategoriesTable->save($jokeCate);
    }
 
    public function hasCategory($categoryId) {
        $jokeCategories = $this->jokesCategoriesTable->find('jokeId', $this->id);
        foreach($jokeCategories as $jokeCategory) {
            if($jokeCategory->catId == $categoryId) {
                return true;
            }
        }
    }


    public function clearCategories() {
        $this->jokesCategoriesTable->deleteWhere('jokeId', $this->id);
    }

}