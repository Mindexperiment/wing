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
        $this->wing()->create([ 'metadata' => $data ]);

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
     * @return null | stdObject
     */
    public function metadata()
    {
        return $this->wing()->exists() ? $this->wing->metadata : null;
    }

    /**
     * Check if exists a metadata key
     * 
     * @return bool
     */
    public function hasMetadata($key)
    {
        if (!$this->wing()->exists() || is_string($value = $this->metadata())) {
            return false;
        }

        return array_key_exists($key, $value);
    }
}
