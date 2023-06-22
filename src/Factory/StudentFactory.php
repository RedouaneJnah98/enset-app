<?php

namespace App\Factory;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Student>
 *
 * @method        Student|Proxy create(array|callable $attributes = [])
 * @method static Student|Proxy createOne(array $attributes = [])
 * @method static Student|Proxy find(object|array|mixed $criteria)
 * @method static Student|Proxy findOrCreate(array $attributes)
 * @method static Student|Proxy first(string $sortedField = 'id')
 * @method static Student|Proxy last(string $sortedField = 'id')
 * @method static Student|Proxy random(array $attributes = [])
 * @method static Student|Proxy randomOrCreate(array $attributes = [])
 * @method static StudentRepository|RepositoryProxy repository()
 * @method static Student[]|Proxy[] all()
 * @method static Student[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Student[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Student[]|Proxy[] findBy(array $attributes)
 * @method static Student[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Student[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class StudentFactory extends ModelFactory
{
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'birthDate' => self::faker()->dateTime(),
            'cardId' => self::faker()->text(10),
            //'createdAt' => self::faker()->dateTime(),
            'email' => self::faker()->unique()->email(),
            'field' => FieldFactory::new(),
            'firstName' => self::faker()->text(100),
            'gender' => self::faker()->text(20),
            'lastName' => self::faker()->text(100),
            'mobileNumber' => self::faker()->text(100),
            'plainPassword' => 'test',
            //'password' => self::faker()->text(),
            'roles' => ['ROLE_USER'],
            // 'updatedAt' => self::faker()->dateTime(),
            'username' => self::faker()->unique()->userName(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function (Student $student): void {
                if ($student->getPlainPassword()) {
                    $student->setPassword(
                        $this->passwordHasher->hashPassword($student, $student->getPlainPassword())
                    );
                }
            });
    }

    protected static function getClass(): string
    {
        return Student::class;
    }
}
