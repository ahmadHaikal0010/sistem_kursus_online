<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'description', 'thumbnail'];

    protected $table = 'haikal_courses';

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'haikal_course_user')->withTimestamps();
    }
}
