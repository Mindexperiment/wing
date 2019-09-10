<?php

namespace Agpretto\Wing;

/**
 * 
 */
trait HasWing
{
    /**
     * Add data to a wing relation
     * 
     * @param mixed $data
     * @return $this
     */
    public function addWing($data)
    {
        $this->wing()->updateOrCreate([ 'metadata' => $data ]);

        return $this;
    }

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

    /**
     * Check if exists a metadata key
     * 
     * @return bool
     */
    public function hasMetadata($key)
    {
        if (is_string($value = $this->metadata())) {
            return false;
        }

        return array_key_exists($key, $value);
    }
}
