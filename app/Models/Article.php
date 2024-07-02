<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Category;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
   protected $fillable = [
    'title' , 'subtitle' , 'body' , 'price', 'img','category_id','user_id'

   ];
    use HasFactory,Searchable;

    public function toSearchableArray()
    {
        $category = $this->category;
        $array = [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'body' => $this->body,
            'price' => $this->price,
            'category' => $category,

        ];
        // Customize array...

        return $array;
    }


    public function getFormattedDate(){
        return $this->created_at->format('d/m/Y');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }

    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }

    public static function toBeRevisionedCount()
    {
        return Article::where('is_accepted', null)->count();
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
