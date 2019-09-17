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
     * Update data inside a wing
     * 
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function updateWing($key, $value)
    {
        $wing = $this->wing()->first();
        $wing->metadata = [ $key => $value ];
        $wing->save();

        return $this->refresh();
    }

    /**
     * Update part of data inside a wing
     * 
     * @param string $path
     * @param mixed $value
     * @return $this
     */
    public function updatePartOfWing($path, $value)
    {
        $key = "metadata->{$path}";
        $data = [];
        $data[$key] = $value;

        $wing = $this->wing()->first()->update($data);

        return $this->refresh();
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
