<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * @var array
     */
    protected $appends = [
        'date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function from()
    {
        return $this->hasOne(User::class, 'id', 'from_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function to()
    {
        return $this->hasOne(User::class, 'id', 'to_id');
    }

    /**
     * @return mixed
     */
    public function getDateAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
