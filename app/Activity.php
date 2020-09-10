<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity as ActivityModel;

class Activity extends ActivityModel
{
    public function user()
    {
        return $this->belongsTo('\App\User', 'causer_id', 'id');
    }

    public function getChangesOnlyAttribute()
    {
        return $this->calculateChanges();
    }

    public function getLinkAttribute()
    {
        return $this->getLink();
    }

    protected function calculateChanges()
    {
        $changes = $this->changes();
        $value = '';

        if (isset($changes['old'])){
            $value = array_diff($changes['attributes'], $changes['old']);
        } else {
            $value = $changes['attributes'];
        }

        return $value;
    }

    protected function getLink(){
        if($this->subject_type === 'App\Offer'){
            $sub = '';
        } else {
            $sub = '/edit';
        }
        return strtolower(substr($this->subject_type, 4))  . '/'. $this->subject_id . $sub ;
    }


}
