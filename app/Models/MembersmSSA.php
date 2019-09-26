<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembersmSSA extends Model
{
    protected $table = 'Members_m_SSA';

    public function countryOfBirth(){
        return $this->hasOne('App\Models\EventzCountry', 'id', 'countryofbirth');
    }

    public function nationalityTable(){
        return $this->hasOne('App\Models\EventzCountry', 'id', 'nationality');
    }
}
