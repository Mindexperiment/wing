<?php

namespace Agpretto\Wing;

/**
 * 
 */
trait HasWing
{
    /**
     * Get the model wing relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function wing()
    {
        return $this->morphOne(Wing::class, 'model');
    }

    /**
     * Get the model metadata
     * 
     * @return stdObject
     */
    public function metadata()
    {
        return $this->wing->metadata;
    }
}
