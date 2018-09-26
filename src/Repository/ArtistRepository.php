<?php

namespace App\Repository;

use App\Entity\Artist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ArtistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Artist::class);
    }
    
    public function findAllAndPopulateAlbums(): array
    {
        $qb = $this->createQueryBuilder('artist')
            ->select('artist, album')
            ->leftJoin('artist.albums','album');

        return $qb->getQuery()->execute();
    }
}