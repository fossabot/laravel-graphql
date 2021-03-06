<?php
declare(strict_types = 1);


namespace Folklore\GraphQL\Registry;

use Folklore\GraphQL\Error\TypeNotFoundException;
use GraphQL\Type\Definition\Type;

/**
 * TODO: Missing class description.
 *
 * @author Nicolai Agersbæk <na@smartweb.dk>
 *
 * @api
 */
class TypeRegistry implements TypeRegistryInterface
{
    
    /**
     * @var Type[]
     */
    private $types = [];
    
    /**
     * @inheritDoc
     */
    public function get(string $typeName) : Type
    {
        $type = $this->types[$typeName] ?? null;
        
        if ($type === null) {
            throw new TypeNotFoundException($typeName);
        }
        
        return $type;
    }
    
    /**
     * @inheritDoc
     */
    public function has(string $typeName) : bool
    {
        return \array_key_exists($typeName, $this->types);
    }
    
    /**
     * @inheritDoc
     */
    public function register(Type $type, ?string $name = null) : Type
    {
        $typeName = $name ?? $type->name;
        
        $this->types[$typeName] = $type;
        
        return $type;
    }
}
