<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Company extends Model
{
    protected $fillable = ['name', 'vac_per_day'];

    public $timestamps = false;


    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function recentVacations()
    {
        return $this->hasMany(Vacancy::class)->where('created_at', '>', Carbon::now()->subDay()->format('Y-m-d H:i:s'));
    }

    public function canCreate()
    {
        if ($this->vac_per_day < 3 and $this->vac_per_day >= 0) {
            return true;
        } else {
            return false;
        }
    }
}
