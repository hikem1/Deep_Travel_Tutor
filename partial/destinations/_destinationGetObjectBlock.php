<?php
use App\repository\DestinationRepository;

$destinationRepo = new DestinationRepository();
$destinationObject = $destinationRepo->findOneById($destinationId);