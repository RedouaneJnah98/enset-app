<?php

namespace App\Factory;

use App\Entity\Field;
use App\Repository\FieldRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Field>
 *
 * @method        Field|Proxy create(array|callable $attributes = [])
 * @method static Field|Proxy createOne(array $attributes = [])
 * @method static Field|Proxy find(object|array|mixed $criteria)
 * @method static Field|Proxy findOrCreate(array $attributes)
 * @method static Field|Proxy first(string $sortedField = 'id')
 * @method static Field|Proxy last(string $sortedField = 'id')
 * @method static Field|Proxy random(array $attributes = [])
 * @method static Field|Proxy randomOrCreate(array $attributes = [])
 * @method static FieldRepository|RepositoryProxy repository()
 * @method static Field[]|Proxy[] all()
 * @method static Field[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Field[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Field[]|Proxy[] findBy(array $attributes)
 * @method static Field[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Field[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class FieldFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'createdAt' => self::faker()->dateTime(),
            'degree' => self::faker()->text(100),
            'department' => DepartmentFactory::new(),
            'name' => self::faker()->text(200),
            'shortName' => self::faker()->text(100),
            'status' => self::faker()->text(100),
            'type' => self::faker()->text(100),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Field $field): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Field::class;
    }
}
