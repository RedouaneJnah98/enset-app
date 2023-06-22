<?php

namespace App\DataFixtures;

use App\Factory\AddressFactory;
use App\Factory\DepartmentFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AddressFactory::createMany(40);
//        UserFactory::createOne(['username' => 'r.jnah', 'roles' => ['ROLE_ADMIN'], 'firstName' => 'Redouane', 'lastName' => 'Jnah']);
//        UserFactory::createMany(30);
//
//        DepartmentFactory::createOne(['headOfDepartment' => UserFactory::random()]);
    }
}
