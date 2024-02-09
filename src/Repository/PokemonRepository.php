<?php

namespace App\Repository;

use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pokemon>
 *
 * @method Pokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pokemon[]    findAll()
 * @method Pokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    public function search($filters)
    {
       $requete = $this->createQueryBuilder('p')
       ->join('p.Type', "t");
            $requete->getQuery()
            ->getResult();

        if (!is_null($filters["textSearch"])) {
            $requete
                ->andWhere("p.nom LIKE :value OR p.description LIKE :value2 OR t.libelle LIKE :value3")
              
                ->setParameter("value", '%' . $filters["textSearch"] . '%')
                ->setParameter("value2", '%' . $filters["textSearch"] . '%')
                ->setParameter("value3", '%' . $filters["textSearch"] . '%');

        }

        if(count($filters["typeSearch"]) != 0){

            $requete->andWhere("t IN (:tableau)");
            $requete->setParameter('tableau',$filters["typeSearch"]);
          }

if(!is_null($filters["pvMin"])){
    $requete->andWhere('p.pointDeVie > :pdv')
    ->setParameter('pdv', $filters["pvMin"]);
}
if(!is_null($filters["pvMax"])){
    $requete->andWhere('p.pointDeVie < :pvMax')
    ->setParameter('pvMax', $filters["pvMax"]);
}

if(!is_null($filters["attaqueMin"])){
    $requete->andWhere('p.attaque > :attaque')
    ->setParameter('attaque', $filters["attaqueMin"]);
}
if(!is_null($filters["attaqueMax"])){
    $requete->andWhere('p.attaque < :attaqueMax')
    ->setParameter('attaqueMax', $filters["attaqueMax"]);
}

if(!is_null($filters["defenseMin"])){
    $requete->andWhere('p.defense > :defenseMin')
    ->setParameter('defenseMin', $filters["defenseMin"]);
}
if(!is_null($filters["defenseMax"])){
    $requete->andWhere('p.defense < :defenseMax')
    ->setParameter('defenseMax', $filters["defenseMax"]);
}
                return $requete->getQuery()
            ->getResult();


    }

}

//    /**
//     * @return Pokemon[] Returns an array of Pokemon objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            
//        ;
//    }

//    public function findOneBySomeField($value): ?Pokemon
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

