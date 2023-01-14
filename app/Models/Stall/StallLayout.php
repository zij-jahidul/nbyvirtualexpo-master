<?php

namespace App\Models\Stall;

use App\Models\Company\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed event_sub_category_id
 * @property mixed layout_name
 * @property mixed layout_img
 * @property mixed layout_color
 * @property mixed layout_size
 * @property mixed layout_description
 * @property mixed status
 * @property mixed created_by
 * @method static latest()
 * @method static findOrFail(int $id)
 * @method static insert(array $data)
 * @method static create(array $all)
 * @method static where(string $string)
 */
class StallLayout extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'event_sub_category_id',
        'company_id',
        'layout_name' , 
        'layout_img' , 
        'image_path' , 
        'layout_color' , 
        'layout_size' , 
        'layout_description' , 
        'status' , 
        'created_by' , 
        'updated_by' , 
        'deleted_by' , 
    ];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
