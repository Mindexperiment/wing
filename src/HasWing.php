<?php

namespace Agpretto\Wing;

/**
 * 
 */
trait HasWing
{
    /**
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function wing()
    {
        return $this->morphOne(Wing::class, 'model');
    }
}
