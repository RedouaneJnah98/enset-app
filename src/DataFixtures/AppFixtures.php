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
use Zenstruck\Foundry\Factory;

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
        UserFactory::createMany(35);
        DepartmentFactory::createSequence([
            ['name' => 'Administrative Sciences and Techniques and Skills Engineering'],
            ['name' => 'Electrical Engineering'],
            ['name' => 'Mechanical Engineering'],
            ['name' => 'Mathematics and Computer Science'],
            ['name' => 'Economics and Management Engineering']
        ]);
        FieldFactory::createSequence([
            ['name' => 'Industrial Engineering and Logistics', 'shortName' => 'GIL'],
            ['name' => 'Mechanical Engineering of Industrial Systems - Automation of Industrial Systems', 'shortName' => 'GMASI'],
            ['name' => 'Mechanical Engineering and Industrial Maintenance', 'shortName' => 'GMMI'],
            ['name' => 'Automotive and Aeronautical Engineering', 'shortName' => 'IAA'],
            ['name' => 'Industrial Engineering', 'shortName' => 'II'],
            ['name' => 'Energy Management of Industrial Systems', 'shortName' => 'MESI'],
            ['name' => 'Computer Engineering, Big Data and Cloud Computing', 'shortName' => 'BDCC'],
            ['name' => 'Data Science and Artificial Intelligence', 'shortName' => 'SDIA'],
            ['name' => 'Administration and CyberSecurity of Computer Systems and Networks', 'shortName' => 'ACSRI'],
            ['name' => 'Web and Mobile Development', 'shortName' => 'DWM'],
            ['name' => 'Electrical Engineering', 'shortName' => 'GE'],
            ['name' => 'Electrical and Mechatronics Engineering', 'shortName' => 'GEM'],
            ['name' => 'Electrical Systems Engineering', 'shortName' => 'GSE'],
            ['name' => 'Industrial Embedded System', 'shortName' => 'SEI']
        ]);

        StudentFactory::createMany(150);
    }
}
