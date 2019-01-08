<?php

class HeroEntity
{
    protected $id;
    protected $name;
    protected $role;
    protected $difficulty;
    protected $description;
    protected $descriptionShort;
    protected $abilities;
    protected $nationality;
    protected $health;
    protected $voice;
    protected $realName;
    protected $age;
    protected $occupation;
    protected $baseOfOperations;
    protected $affiliation;
    protected $slogan;
    protected $story;
    protected $pictureName;

    public function __construct(array $data)
    {
        if (isset($data['hero_id'])) {
            $this->id = $data['hero_id'];
        }
        $this->name = $data['hero_name'];
        $this->role = $data['hero_role'];
        $this->difficulty = $data['hero_difficulty'];
        $this->description = $data['hero_description'];
        $this->descriptionShort = $data['hero_description_short'];
        $this->abilities = $data['hero_abilities'];
        $this->nationality = $data['hero_nationality'];
        $this->health = $data['hero_health'];
        $this->voice = $data['hero_voice'];
        $this->realName = $data['hero_realname'];
        $this->age = $data['hero_age'];
        $this->occupation = $data['hero_occupation'];
        $this->baseOfOperations = $data['hero_baseofoperations'];
        $this->affiliation = $data['hero_affiliation'];
        $this->slogan = $data['hero_slogan'];
        $this->story = $data['hero_story'];
        $this->pictureName = $data['hero_picturename'];
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getRole() {
        return $this->role;
    }

    public function getDifficulty() {
        return $this->difficulty;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDescriptionShort() {
        return $this->descriptionShort;
    }

    public function getAbilities() {
        return $this->abilities;
    }

    public function getNationality() {
        return $this->nationality;
    }

    public function getHealth() {
        return $this->health;
    }

    public function getVoice() {
        return $this->voice;
    }

    public function getRealName() {
        return $this->realName;
    }

    public function getAge() {
        return $this->age;
    }

    public function getOccupation() {
        return $this->occupation;
    }

    public function getBaseOfOperations() {
        return $this->baseOfOperations;
    }

    public function getAffiliation() {
        return $this->affiliation;
    }

    public function getSlogan() {
        return $this->slogan;
    }

    public function getStory() {
        return $this->story;
    }

    public function getPictureName() {
        return $this->pictureName;
    }
}