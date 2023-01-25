<?php
include_once './repository/MainRepository.php';

class SpaceShipRepository extends MainRepository
{
    public function __construct()
    {
        parent::__construct(SpaceShip::class);
    }

    public function addSpaceShip(SpaceShip $spaceship):SpaceShip {
        $query = $this->pdo->prepare('INSERT INTO spaceship VALUE(null, ?, ?, ?)');
        $query->bindValue(1, $spaceship->getName());
        $query->bindValue(2, $spaceship->getPassengerCapacity());
        $query->bindValue(3, $spaceship->getDescription());
        $query->execute();
        $spaceship->setId($this->pdo->lastInsertId());
        return $spaceship;
    }
}