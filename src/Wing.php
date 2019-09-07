<?php

namespace Agpretto\Wing;

use Illuminate\Database\Eloquent\Model;

class Wing extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'wings';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $guarded = [];

    /**
     * Don't use timestamp informations
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
    */
    protected $casts = [
        'metadata' => 'object'
    ];

    /**
     * Get the owning model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }
}
