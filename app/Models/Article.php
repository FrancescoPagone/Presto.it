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
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'body',
        'price',
        'user_id',
        'category_id',
        'user'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }

    public static function toBeRevisedCount()
    {
        return Article::where('is_accepted', null)->count();
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price,
            'category' => $this->category,
            'user' => $this->user
        ];
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
