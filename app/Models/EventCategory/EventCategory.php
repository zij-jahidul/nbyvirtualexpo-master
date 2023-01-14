<?php

namespace App\Models\EventCategory;

use Illuminate\Database\Eloquent\Model;
use App\Models\EventCategory\EventSubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property mixed event_category_name
 * @property mixed event_cat_img
 * @property mixed status
 * @method static findOrFail(int $id)
 * @method static latest()
 */
class EventCategory extends Model
{
    use HasFactory;

    public function eventSubCategory()
    {
        return $this->hasMany(EventSubCategory::class, 'event_category_id', 'id');
    }
}
