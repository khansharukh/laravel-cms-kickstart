<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    public function scopeSearchProducts($query, $term) {
        $result = $query->select('id', 'title')->where('title', "LIKE", "%$term%")->where('status', '1')->get();
        return $result;
    }
}
