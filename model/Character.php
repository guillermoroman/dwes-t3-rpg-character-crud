<?php

class Character{
    protected $id;
    protected $name;
    protected $description;
    protected $health;
    protected $strength;
    protected $defense;
    protected $image;
    protected $userId;

    protected $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function save(){
        $stmt = $this->db->prepare ("INSERT INTO characters (name, description, health, strength, defense, image, user_id) VALUES (:name, :description, :health, :strength, :defense, :image, :user_id)");
        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':description', $this->getDescription());
        $stmt->bindValue(':health', $this->getHealth());
        $stmt->bindValue(':strength', $this->getStrength());
        $stmt->bindValue(':defense', $this->getDefense());
        $stmt->bindValue(':image', $this->getImage());
        $stmt->bindValue(':user_id', $this->getUserId());

        return $stmt->execute();
    }

    public function update(){
        $stmt = $this->db->prepare ("UPDATE characters 
                SET name = :name,
                    description = :description,
                    health = :health,
                    strength = :strength,
                    defense = :defense,
                    image = :image
                WHERE id = :id");
        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':description', $this->getDescription());
        $stmt->bindValue(':health', $this->getHealth());
        $stmt->bindValue(':strength', $this->getStrength());
        $stmt->bindValue(':defense', $this->getDefense());
        $stmt->bindValue(':image', $this->getImage());
        $stmt->bindValue(':id', $this->getId());

        return $stmt->execute();
    }



    public static function delete($db, $id){
        try{
            $stmt = $db->prepare("DELETE FROM characters WHERE id = :id");
            $stmt->bindValue(":id", $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al borrar de la base de datos: " . $e->getMessage();
        }
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of health
     */ 
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Set the value of health
     *
     * @return  self
     */ 
    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get the value of strength
     */ 
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set the value of strength
     *
     * @return  self
     */ 
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get the value of defense
     */ 
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * Set the value of defense
     *
     * @return  self
     */ 
    public function setDefense($defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}
