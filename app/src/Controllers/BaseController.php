<?php
namespace App\Controllers;

class BaseController
{
    /**
     * Slim's app container
     * @var Object
     */
    protected $container;
    
    /**
     * Instantiate a new instance.
     * @param Object $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }
}
