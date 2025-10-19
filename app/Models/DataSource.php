<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'driver',
        'configuration',
    ];

    protected $casts = [
        'configuration' => 'array',
    ];

    public function forms()
    {
        return $this->belongsToMany(FormDefinition::class, 'form_data_source')->withPivot('mapping')->withTimestamps();
    }

    public function reports()
    {
        return $this->belongsToMany(ReportDefinition::class, 'report_data_source')->withPivot('mapping')->withTimestamps();
    }
}
