<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model {
    public function scopeTitle($query, $title) {
        $grade = new Grade;
        $grade->title = $title;
        $saved = $grade->save();
        if(!$saved){
            return false;
        } else {
            return $grade->id;
        }
    }
}
