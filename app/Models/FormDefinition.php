<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDefinition extends Model
{
    use HasFactory;

    protected $fillable = [
        'panel_id',
        'name',
        'slug',
        'description',
        'schema',
        'submit_handler',
    ];

    protected $casts = [
        'schema' => 'array',
    ];

    public function panel()
    {
        return $this->belongsTo(Panel::class);
    }

    public function dataSources()
    {
        return $this->belongsToMany(DataSource::class, 'form_data_source')->withPivot('mapping')->withTimestamps();
    }
}
