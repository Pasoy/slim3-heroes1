<?php

class HeroMapper extends Mapper {

    public function getHeroes() {
        $sql = "SELECT * FROM heroes";
        $stmt = $this -> db -> query($sql);
        $results = [];
        while($row = $stmt -> fetch()) {
            $results[] = new HeroEntity($row);
        }
        return $results;
    }

    public function getHeroByName($hero_name) {
        $sql = "SELECT * FROM heroes WHERE hero_name = :hero_name";
        $stmt = $this -> db -> prepare($sql);
        $result = $stmt -> execute(["hero_name" => $hero_name]);
        if($result) {
            return new HeroEntity($stmt -> fetch());
        }
    }

    public function getHeroById($hero_id) {
        $sql = "SELECT * FROM heroes WHERE hero_id = :hero_id";
        $stmt = $this -> db -> prepare($sql);
        $result = $stmt -> execute(["hero_id" => $hero_id]);
        if($result) {
            return new HeroEntity($stmt -> fetch());
        }
    }

    public function getHeroesByRole($hero_role) {
        $sql = "SELECT * FROM heroes WHERE hero_role = :hero_role";
        $stmt = $this -> db -> prepare($sql);
        $result = $stmt -> execute([
            "hero_role" => $hero_role
        ]);
        $results = [];
        while($row = $stmt -> fetch()) {
            $results[] = new HeroEntity($row);
        }
        return $results;
    }

    public function getHeroesByAbilities($hero_abilities_from, $hero_abilities_to) {
        $sql = "SELECT * FROM heroes WHERE hero_abilities BETWEEN :hero_abilities_from AND :hero_abilities_to";
        $stmt = $this -> db -> prepare($sql);
        $result = $stmt -> execute([
            "hero_abilities_from" => $hero_abilities_from,
            "hero_abilities_to" => $hero_abilities_to
        ]);
        $results = [];
        while($row = $stmt -> fetch()) {
            $results[] = new HeroEntity($row);
        }
        return $results;
    }

    public function getHeroesByDifficulty($hero_difficulty) {
        $sql = "SELECT * FROM heroes WHERE hero_difficulty = :hero_difficulty";
        $stmt = $this -> db -> prepare($sql);
        $result = $stmt -> execute([
            "hero_difficulty" => $hero_difficulty
        ]);
        $results = [];
        while($row = $stmt -> fetch()) {
            $results[] = new HeroEntity($row);
        }
        return $results;
    }

    public function save(HeroEntity $hero) {
        $sql = "INSERT INTO heroes (hero_name, hero_role, hero_difficulty, hero_description, hero_description_short, hero_abilities, hero_nationality, hero_health, hero_voice, hero_realname, hero_age, hero_occupation, hero_baseofoperations, hero_affiliation, hero_slogan, hero_story, hero_picturename) VALUES (:hero_name, :hero_role, :hero_difficulty, :hero_description, :hero_description_short, :hero_abilities, :hero_nationality, :hero_health, :hero_voice, :hero_realname, :hero_age, :hero_occupation, :hero_baseofoperations, :hero_affiliation, :hero_slogan, :hero_story, :hero_picturename)";

        $stmt = $this -> db -> prepare($sql);
        $result = $stmt -> execute([
            "hero_name" => $hero -> getName(),
            "hero_role" => $hero -> getRole(),
            "hero_difficulty" => $hero -> getDifficulty(),
            "hero_description" => $hero -> getDescription(),
            "hero_description_short" => $hero -> getDescriptionShort(),
            "hero_abilities" => $hero -> getAbilities(),
            "hero_nationality" => $hero -> getNationality(),
            "hero_health" => $hero -> getHealth(),
            "hero_voice" => $hero -> getVoice(),
            "hero_realname" => $hero -> getRealName(),
            "hero_age" => $hero -> getAge(),
            "hero_occupation" => $hero -> getOccupation(),
            "hero_baseofoperations" => $hero -> getBaseOfOperations(),
            "hero_affiliation" => $hero -> getAffiliation(),
            "hero_slogan" => $hero -> getSlogan(),
            "hero_story" => $hero -> getStory(),
            "hero_picturename" => $hero -> getPictureName(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

    public function edit(HeroEntity $hero, HeroEntity $new_hero) {
        $sql = "UPDATE heroes SET hero_name = :hero_name, hero_role = :hero_role, hero_difficulty = :hero_difficulty, hero_description = :hero_description, hero_description_short = :hero_description_short, hero_abilities = :hero_abilities, hero_nationality = :hero_nationality, hero_health = :hero_health, hero_voice = :hero_voice, hero_realname = :hero_realname, hero_age = :hero_age, hero_occupation = :hero_occupation, hero_baseofoperations = :hero_baseofoperations, hero_affiliation = :hero_affiliation, hero_slogan = :hero_slogan, hero_story = :hero_story, hero_picturename = :hero_picturename WHERE heroes . hero_id = :hero_id";

        $stmt = $this -> db -> prepare($sql);
        $result = $stmt -> execute([
            "hero_id" => $hero -> getId(),
            "hero_name" => $new_hero -> getName(),
            "hero_role" => $new_hero -> getRole(),
            "hero_difficulty" => $new_hero -> getDifficulty(),
            "hero_description" => $new_hero -> getDescription(),
            "hero_description_short" => $new_hero -> getDescriptionShort(),
            "hero_abilities" => $new_hero -> getAbilities(),
            "hero_nationality" => $new_hero -> getNationality(),
            "hero_health" => $new_hero -> getHealth(),
            "hero_voice" => $new_hero -> getVoice(),
            "hero_realname" => $new_hero -> getRealName(),
            "hero_age" => $new_hero -> getAge(),
            "hero_occupation" => $new_hero -> getOccupation(),
            "hero_baseofoperations" => $new_hero -> getBaseOfOperations(),
            "hero_affiliation" => $new_hero -> getAffiliation(),
            "hero_slogan" => $new_hero -> getSlogan(),
            "hero_story" => $new_hero -> getStory(),
            "hero_picturename" => $new_hero -> getPictureName(),
        ]);
        if(!$result) {
            throw new Exception("could not edit record");
        }
    }

    public function remove($hero_id) {
        $sql = "DELETE FROM heroes WHERE hero_id = :hero_id";

        $stmt = $this -> db -> prepare($sql);
        $result = $stmt -> execute([
            "hero_id" => $hero_id,
        ]);
        if(!$result) {
            throw new Exception("could not remove record");
        }
    }

    public function search($search) {
        $sql = "SELECT * FROM heroes WHERE hero_id LIKE :search OR hero_name LIKE :search OR hero_role LIKE :search OR hero_difficulty LIKE :search OR hero_description LIKE :search OR hero_description_short LIKE :search OR hero_abilities LIKE :search OR hero_nationality LIKE :search OR hero_health LIKE :search OR hero_voice LIKE :search OR hero_realname LIKE :search OR hero_age LIKE :search OR hero_occupation LIKE :search OR hero_baseofoperations LIKE :search OR hero_affiliation LIKE :search OR hero_slogan LIKE :search OR hero_story LIKE :search OR hero_picturename LIKE :search";

        $bind_search = "%".$search."%";

        $stmt = $this -> db -> prepare($sql);
        $result = $stmt -> execute([
            ":search" => $bind_search,
        ]);
        if(!$result) {
            throw new Exception("could not search for any record");
        }

        $results = [];
        while($row = $stmt -> fetch()) {
            $results[] = new HeroEntity($row);
        }
        return $results;
    }

}