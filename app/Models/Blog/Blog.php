<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property mixed company_id
 * @property mixed user_id
 * @property mixed event_category_id
 * @property mixed title
 * @property mixed tropic
 * @property mixed feature_image
 * @property mixed live_broadcust
 * @property mixed description
 * @property mixed status
 * @property mixed created_by
 * @method static latest()
 * @method static findOrFail(int $id)
 */
class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
