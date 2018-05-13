<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 *
 * @package App
 * @property string $title
 * @property string $user
 * @property tinyInteger $published
 * @property text $content
 * @property string $published_at
*/
class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'published', 'content', 'published_at'];
    protected $hidden = [];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
        'deleted_at',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
