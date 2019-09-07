<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->createDepartment('Direction', 'direction@test.fr');
        $this->createDepartment('Ressource humaine', 'rh@test.fr');
        $this->createDepartment('Développeur', 'dev@test.fr');
        $this->createDepartment('Communication', 'com@test.fr');
        $this->createDepartment('Manager', 'manager@test.fr');
        $manager->flush();
    }

    /**
     * Create a department with a specified name and an email
     *
     * @param string $name
     * @param string $email
     * @return void
     */
    private function createDepartment(string $name, string $email)
    {
        $department = new Department();
        $department->setName($name);
        $department->setEmail($email);
        $this->manager->persist($department);
    }
}
