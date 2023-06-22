<?php

namespace App\DataFixtures;

use App\Factory\AddressFactory;
use App\Factory\DepartmentFactory;
use App\Factory\FieldFactory;
use App\Factory\Sequence\DepartmentName;
use App\Factory\StudentFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AddressFactory::createMany(40);
        UserFactory::createOne([
            'username' => 'r.jnah',
            'roles' => ['ROLE_ADMIN'],
            'firstName' => 'Redouane',
            'lastName' => 'Jnah',
            'address' => AddressFactory::random()
        ]);
        UserFactory::createMany(30);
        DepartmentFactory::createSequence([
            ['name' => 'Administrative Sciences and Techniques and Skills Engineering'],
            ['name' => 'Electrical Engineering'],
            ['name' => 'Mechanical Engineering'],
            ['name' => 'Mathematics and Computer Science'],
            ['name' => 'Economics and Management Engineering']
        ]);
        FieldFactory::createSequence([
            ['name' => 'Industrial Engineering and Logistics'],
            ['name' => 'Mechanical Engineering of Industrial Systems - Automation of Industrial Systems'],
            ['name' => 'Mechanical Engineering and Industrial Maintenance'],
            ['name' => 'Automotive and Aeronautical Engineering'],
            ['name' => 'Industrial Engineering'],
            ['name' => 'Energy Management of Industrial Systems'],
            ['name' => 'Computer Engineering, Big Data and Cloud Computing'],
            ['name' => 'Data Science and Artificial Intelligence'],
            ['name' => 'Administration and CyberSecurity of Computer Systems and Networks'],
            ['name' => 'Web and Mobile Development']
        ]);

        StudentFactory::createMany(5);
    }
}
