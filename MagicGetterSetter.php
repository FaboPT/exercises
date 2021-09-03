<?php

/**
 * I Choose The class instead of Trait Or Interface , because the interface all methods are abstracts 
 * and the child classes would be forced to rewrite the method would not be general,
 * The Trait are mostly used to simulate multi-inheritance, so in this case it's not the best to be used.
 * 
 *  
 */

abstract class MagicGetterSetter
{

    public function __get($property)
    {
        if (property_exists($this, $property))
            return $this->property;
        throw new \Exception("Property doesn't exist");
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
            $this->property = $value;

        throw new \Exception("Property doesn't exist");
    }
}
