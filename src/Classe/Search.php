<?php

namespace App\Classe;

use App\Entity\Category;
use App\Entity\SubCategory;

class Search{

    /**
     * @var string
     */
    public $string = "";

    /**
     * @var Category[]
     */
    public $categories = [] ;


    /**
     * @var SubCategory[]
     */
    public $subCategory = [] ;
}