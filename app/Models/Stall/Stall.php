<?php

namespace App\Models\Stall;

use App\Models\Company\Company;
use App\Models\District\District;
use App\Models\Stall\StallLayout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property mixed company_id
 * @property mixed stall_layout_id
 * @property mixed event_sub_category_id
 * @property mixed stall_name
 * @property mixed brand_name
 * @property mixed manufacturer_name
 * @property mixed open_time
 * @property mixed close_time
 * @property mixed stall_brochure
 * @property mixed stall_description
 * @property mixed stall_live_boardcust
 * @property mixed stall_announcement
 * @property mixed status
 * @property mixed created_by
 * @method static latest()
 * @method static findOrFail(int $id)
 * @method static where(string $string, $companyId)
 */
class Stall extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'id',
        'company_id',
        'stall_layout_id',
        'event_sub_category_id',
        'stall_name',
        'brand_name',
        'manufacturer_name',
        'open_time',
        'close_time',
        'stall_brochure',
        'stall_description',
        'stall_live_boardcust',
        'stall_announcement',
        'status',
        'created_by',

    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function stalllayout(){
        return $this->belongsTo(StallLayout::class,'stall_layout_id','id');
    }

    public function stallAds()
    {
        return $this->hasMany(StallAds::class, 'stall_id', 'id');
    }
    public function delivery_district()
    {
        return $this->belongsToMany(District::class);
    }

}
