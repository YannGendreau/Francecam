<?php

 namespace App\Tests\Entity;

use App\Entity\Film;
use App\Entity\Pays;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FilmTest extends KernelTestCase{

    public function testValidFilmEntity()
    {
       $code = (new Film())
        ->setTitle('Test')
       ;
    
        self::bootKernel();
        $container = self::$container;
        $error = $container->get($code);
        $this->assertCount(0, $error);
    }

}