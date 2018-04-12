<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    public function scopeSearchCategory($query, $term) {
        $result = $query->select('id', 'title')->where('title', "LIKE", "%$term%")->get();
        return $result;
    }
}
