<?php
namespace Ijdb\Entity;
use \Ninja\Authentication;


use Ninja\DatabaseTable;

class Profile {
    public $id;
    public $bio;
    public $hobbie;
    public $authorid;
    private $profileTable;

    public function __construct(\Ninja\DatabaseTable $profileTable) {
        $this->profileTable = $profileTable;
    }

    public function addProfile($profile) {
        $this->profileTable->save($profile);
    }

}

