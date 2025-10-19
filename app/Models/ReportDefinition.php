<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDefinition extends Model
{
    use HasFactory;

    protected $fillable = [
        'panel_id',
        'name',
        'slug',
        'description',
        'query',
        'visualization',
    ];

    protected $casts = [
        'visualization' => 'array',
    ];

    public function panel()
    {
        return $this->belongsTo(Panel::class);
    }

    public function dataSources()
    {
        return $this->belongsToMany(DataSource::class, 'report_data_source')->withPivot('mapping')->withTimestamps();
    }
}
