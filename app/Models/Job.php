<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'company_id',
        'title',
        'min_salary',
        'max_salary',
        'job_nature',
        'vacancy',
        'applied',
        'location',
        'position',
        'description',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    public function company() {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
