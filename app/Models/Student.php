<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // so students can log in later
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'name',
        'group',
        'enrollment',
        'password',
        'active',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationship: a student has many reports
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Optional helper: check if student reached 3 or more reports
    public function hasThreeReports(): bool
    {
        return $this->reports()->count() >= 3;
    }

    // Check if student is active
    public function isActive(): bool
    {
        return $this->active;
    }
}
