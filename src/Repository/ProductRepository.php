<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Requete qui recup les produits en fonction des filtres
     */
    public function findWithSearch(Search $search){
        $query = $this
            ->createQueryBuilder('p') // on crée une query avec la table produit, représentée par un p
            ->select('c','p','s') // on séléctionne c pour catégorie et p pour product
            ->join('p.category','c') // on fait la jointure entre le produit de la catégorie et la categ
            ->join('p.subCategory','s');

        if(!empty($search->categories)){
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories',$search->categories);
        }
        if(!empty($search->subCategory)){
            $query = $query
                ->andWhere('s.id IN (:subCategory)')
                ->setParameter('subCategory',$search->subCategory);
        }

        if (!empty($search->string)) {
            $query = $query
                ->andWhere('p.name LIKE :string')
                ->setParameter('string', "%{$search->string}%");
        }


        return $query->getQuery()->getResult();
    }

    // trier par categ
    public function findWithCategoryDog(){
        $query = $this
            ->createQueryBuilder('p') // on crée une query avec la table produit, représentée par un p
            ->select('c','p') // on séléctionne c pour catégorie et p pour product
            ->andWhere('p.category = 1')
            ->join('p.category','c') // on fait la jointure entre le produit de la catégorie et la categ
            ;

        return $query->getQuery()->getResult();
    }


    public function findWithCategoryCat(){
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p')
            ->andWhere('p.category = 2')
            ->join('p.category','c')
        ;

        return $query->getQuery()->getResult();
    }

    //trier par Chien et  sous categ
    public function findWithSubCat1(){ // pour chercher accessoires pour chien
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','s')
            ->join('p.category','c')
            ->join('p.subCategory','s')
            ->andWhere('p.category = 1')
            ->andWhere('p.subCategory = 1');
        return $query->getQuery()->getResult();
    }

    public function findWithSubCat2(){ // pour chercher soins pour chien
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','s')
            ->join('p.category','c')
            ->join('p.subCategory','s')
            ->andWhere('p.category = 1')
            ->andWhere('p.subCategory = 2');
        return $query->getQuery()->getResult();
    }

    public function findWithSubCat3(){ // pour chercher jouets pour chien
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','s')
            ->join('p.category','c')
            ->join('p.subCategory','s')
            ->andWhere('p.category = 1')
            ->andWhere('p.subCategory = 3');
        return $query->getQuery()->getResult();
    }

    public function findWithSubCat4(){ // pour chercher alimentation pour chien
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','s')
            ->join('p.category','c')
            ->join('p.subCategory','s')
            ->andWhere('p.category = 1')
            ->andWhere('p.subCategory = 4');
        return $query->getQuery()->getResult();
    }

    public function findWithSubCat5(){ // pour chercher voyage pour chien
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','s')
            ->join('p.category','c')
            ->join('p.subCategory','s')
            ->andWhere('p.category = 1')
            ->andWhere('p.subCategory = 5');
        return $query->getQuery()->getResult();
    }

    //trier par Chat et  sous categ
    public function findWithSubCateg1(){ // pour chercher accessoires pour chat
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','s')
            ->join('p.category','c')
            ->join('p.subCategory','s')
            ->andWhere('p.category = 2')
            ->andWhere('p.subCategory = 1');
        return $query->getQuery()->getResult();
    }

    public function findWithSubCateg2(){ // pour chercher soins pour chat
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','s')
            ->join('p.category','c')
            ->join('p.subCategory','s')
            ->andWhere('p.category = 2')
            ->andWhere('p.subCategory = 2');
        return $query->getQuery()->getResult();
    }

    public function findWithSubCateg3(){ // pour chercher jouets pour chat
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','s')
            ->join('p.category','c')
            ->join('p.subCategory','s')
            ->andWhere('p.category = 2')
            ->andWhere('p.subCategory = 3');
        return $query->getQuery()->getResult();
    }

    public function findWithSubCateg4(){ // pour chercher alimentation pour chat
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','s')
            ->join('p.category','c')
            ->join('p.subCategory','s')
            ->andWhere('p.category = 2')
            ->andWhere('p.subCategory = 4');
        return $query->getQuery()->getResult();
    }

    public function findWithSubCateg5(){ // pour chercher voyage pour chat
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','s')
            ->join('p.category','c')
            ->join('p.subCategory','s')
            ->andWhere('p.category = 2')
            ->andWhere('p.subCategory = 5');
        return $query->getQuery()->getResult();
    }



}
