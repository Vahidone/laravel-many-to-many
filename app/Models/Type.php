<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    // relazione con la tabella projects

    public function projects() {
        return $this->hasMany(Project::class);
    }

    protected $fillable = [
        'title',
        'slug'
    ];

    public static function generateSlug($title){
        $slug = Str::slug($title, "-");
        $original_slug = $slug;
        $exists = Project::where("slug", $slug)->first();
        $c = 1;
        while($exists){
            $slug = $original_slug . "-" . $c;
            $exists = Project::where("slug", $slug)->first();

            $c++;
        }
        return $slug;
    }
}
