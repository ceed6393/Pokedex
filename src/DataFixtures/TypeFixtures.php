<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $type1 = new Type();
       $type1->setLibelle("plante");
       $type1->setColor("green");

       $type2 = new Type();
       $type2->setLibelle("feu");
       $type2->setColor("red");

       $type3 = new Type();
       $type3->setLibelle("eau");
       $type3->setColor("blue");

       $type4 = new Type();
       $type4->setLibelle("electrique");
       $type4->setColor("yellow");

       $type5 = new Type();
       $type5->setLibelle("psy");
       $type5->setColor("pink");

       $type6 = new Type();
       $type6->setLibelle("poison");
       $type6->setColor("purple");

       $type7 = new Type();
       $type7->setLibelle("sol");
       $type7->setColor("grey");

       $type8 = new Type();
       $type8->setLibelle("normal");
       $type8->setColor("white");

       $type9 = new Type();
       $type9->setLibelle("insecte");
       $type9->setColor("brown");

       $type10 = new Type();
       $type10->setLibelle("spectre");
       $type10->setColor("black");


$manager->persist($type1);
$manager->persist($type2);
$manager->persist($type3);
$manager->persist($type4);
$manager->persist($type5);
$manager->persist($type6);
$manager->persist($type7);
$manager->persist($type8);
$manager->persist($type9);
$manager->persist($type10);

        $manager->flush();
    }
}
