<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function emailExist($email) {
        $hasUser = DB::table('users')->select('id')->where('email', $email)->first();
        if(!empty($hasUser)) {
            return false;
        }
        return true;
    }
    public function checkExist($table, $wheres) {
        $db_val = DB::table($table)->select('id')->where($wheres)->first();
        if($db_val) {
            return true;
        } else {
            return false;
        }
    }
    public function selectFunction($table, $select = array(), $wheres, $orderByCol = 'id', $orderByType = 'ASC') {
        if(!empty($wheres)) {
            $data = DB::table($table)
                ->select($select)
                ->where($wheres)
                ->orderBy($orderByCol, $orderByType)
                ->get();
        } else {
            $data = DB::table($table)
                ->select($select)
                ->orderBy($orderByCol, $orderByType)
                ->get();
        }
        return $data;
    }
    public function selectLimitFunction($table, $select = array(), $wheres, $limit = '1', $orderByCol = 'id', $orderByType = 'ASC') {
            $data = DB::table($table)
                ->select($select)
                ->where($wheres)
                ->orderBy($orderByCol, $orderByType)
                ->limit($limit)
                ->get();
        return $data;
    }
    public function insertFunction($table, $data) {
        $last_id = DB::table($table)->insertGetId($data);
        return $last_id;
    }
    public function updateFunction($table, $data, $col, $val) {
        DB::table($table)
            ->where($col, $val)
            ->update($data);
    }
    public function deleteFunction($table, $col, $id) {
        DB::table($table)->where($col, '=', $id)->delete();
    }
    public function sanitizeInput($input) {
        return preg_replace('#[^a-z0-9]#i', '', $input);
    }
    public function dbGetProduct($id) {
        $data = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('grades', 'products.grade_id', '=', 'grades.id')
            ->leftJoin('packagings', 'products.packaging_id', '=', 'packagings.id')
            ->leftJoin('units', 'products.unit_id', '=', 'units.id')
            ->select('products.id', 'products.title', 'products.color', 'products.size', 'products.quantity', 'products.description', 'products.price', 'products.qr_code', 'products.user_id', 'categories.title AS category', 'grades.title AS grade', 'units.title AS unit', 'packagings.title AS packaging')
            ->where('products.id', $id)
            ->where('status', '1')
            ->get();
        return $data;
    }
}
