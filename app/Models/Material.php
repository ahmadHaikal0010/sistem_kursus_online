<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'haikal_materials';

    protected $fillable = ['course_id', 'title', 'type', 'content', 'video_path', 'video_link'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function readers()
    {
        return $this->belongsToMany(User::class, 'haikal_material_user')->withTimestamps();
    }
}
