<?php

namespace App\Models\EventCategory;

use App\Models\Stall\Stall;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property mixed event_category_id
 * @property mixed event_sub_category_name
 * @property mixed event_sub_cat_img
 * @property mixed status
 * @property mixed created_by
 * @property mixed updated_by
 * @property mixed deleted_by
 * @method static latest()
 * @method static findOrFail(int $id)
 */
class EventSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'event_category_id',
        'event_sub_category_name',
        'event_sub_cat_img'
    ];

    public function stall(){
        return $this->hasMany(Stall::class, 'event_sub_category_id', 'id');
    }
}
