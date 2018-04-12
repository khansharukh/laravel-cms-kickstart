<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Grade;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function searchProducts(Request $request)
    {
        $term = $this->sanitizeInput($request->get('term'));
        $result['products'] = Product::searchProducts($term);
        $result['categories'] = Category::searchCategory($term);
        if ($result) {
            return response()->json(['success' => true, 'response' => $result], 201);
        } else {
            return response()->json(false);
        }
    }

    public function getAppSliders()
    {
        $result = DB::table('app_sliders')->where('status', '1')->get();
        if ($result) {
            return response()->json(['success' => true, 'response' => $result], 201);
        } else {
            return response()->json(false);
        }
    }

    public function getProducts()
    {
        $result['products'] = Product::where('status', '1')->get();
        if ($result) {
            return response()->json(['success' => true, 'response' => $result], 201);
        } else {
            return response()->json(false);
        }
    }

    public function getProduct($id)
    {
        $id = $this->sanitizeInput($id);
        $result['products'] = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('grades', 'products.grade_id', '=', 'grades.id')
            ->leftJoin('packagings', 'products.packaging_id', '=', 'packagings.id')
            ->leftJoin('units', 'products.unit_id', '=', 'units.id')
            ->select('products.id', 'products.title', 'products.color', 'products.size', 'products.quantity', 'products.description', 'products.price', 'products.qr_code', 'products.user_id', 'categories.title AS category', 'grades.title AS grade', 'units.title AS unit', 'packagings.title AS packaging')
            ->where('products.id', $id)
            ->where('status', '1')
            ->get();
        $result['files'] = DB::table('product_images')->select('filename')->where('product_id', $id)->get();
        if ($result) {
            return response()->json(['success' => true, 'response' => $result], 201);
        } else {
            return response()->json(false);
        }
    }

    public function insertGrade(Request $request)
    {
        $title = $this->sanitizeInput($request->get('title'));
        $last_id = Grade::title($title);
        if ($last_id) {
            return response()->json(['success' => true, 'title' => $title, 'id' => $last_id], 201);
        } else {
            return response()->json(false);
        }
    }

    public function getCategory()
    {
        $result = DB::table('categories')
            ->leftJoin('products', 'products.category_id', '=', 'categories.id')
            ->select(DB::raw('COUNT(products.id) AS prod_count'), 'categories.*')
            ->groupBy('categories.id')
            ->get();
        if ($result) {
            return response()->json(['success' => true, 'response' => $result], 201);
        } else {
            return response()->json(false);
        }
    }

    public function getCategoryProducts($cid)
    {
        $cid = $this->sanitizeInput($cid);
        $result = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('grades', 'products.grade_id', '=', 'grades.id')
            ->leftJoin('packagings', 'products.packaging_id', '=', 'packagings.id')
            ->leftJoin('units', 'products.unit_id', '=', 'units.id')
            ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.id', 'products.title', 'products.color', 'products.size', 'products.quantity', 'products.price', 'products.qr_code', 'products.q_left', 'products.user_id', 'categories.title AS category', 'grades.title AS grade', 'units.title AS unit', 'packagings.title AS packaging', 'product_images.filename')
            ->where('categories.id', $cid)
            ->where('status', '1')
            ->groupBy('products.id')
            ->get();
        if ($result) {
            return response()->json(['success' => true, 'response' => $result], 201);
        } else {
            return response()->json(false);
        }
    }

    public function registerUser(Request $request)
    {
        $name = $this->sanitizeInput($request->get('name'));
        $email = $request->get('email');
        $password = $request->get('password');

        if ($this->emailExist($email)) {
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => hash('sha512', $password),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table('users')->insert($data);

            return response()->json(['success' => true, 'response' => $data], 201);
        } else {
            return response()->json(['success' => false, 'status_code' => '1', 'message' => 'Email already exist, please try another'], 201);
        }
    }

    public function authUser(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $hashPass = hash('sha512', $password);

        $userInfo = DB::table('users')->select('id', 'name', 'fb_link', 'twitter_link', 'ins_link', 'whatsapp', 'address', 'about', 'loca', 'file', 'cover', 'email')->where('email', $email)->where('password', $hashPass)->first();
        if (!empty($userInfo)) {
            $data = json_encode($userInfo);
            return response()->json(['success' => true, 'response' => $data], 201);
        } else {
            return response()->json(['success' => false, 'status_code' => '1', 'message' => 'Invalid email or password'], 201);
        }
    }

    public function createOrder(Request $request)
    {
        $carts = json_decode($request->get('cart'), TRUE);
        $user = $request->get('user');
        $user_id = $request->get('user_id');
        $total = $request->get('total');
        $del_type = $request->get('del_type');
        $payment_method = $request->get('payment_method');

        $del_type = $del_type === 'take' ? '0' : '1';

        $data = [
            'user_id' => $user_id,
            'total' => $total,
            'discount' => '0',
            'del_type' => $del_type,
            'payment_mode' => $payment_method,
            's_ins' => '',
            'created_at' => date('Y-m-d H:i:s')
        ];
        $last_id = DB::table('orders')->insertGetId($data);

        foreach ($carts AS $cart) {
            $data = [
                'user_id' => $user_id,
                'order_id' => $last_id,
                'product_id' => $cart['id'],
                'quantity' => $cart['qty'],
                'sub_total' => $cart['price'],
                'total' => $cart['price'] * $cart['qty'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('order_details')->insert($data);
        }
        $rdata = [
            'insert_id' => $last_id
        ];
        return response()->json(['success' => true, 'response' => $rdata], 201);
    }

    public function processPayment(Request $request)
    {
        $card = $request->get('card');
        $cardType = strtoupper($request->get('cardType'));
        $holder = $request->get('holder');
        $expiry = $this->sanitizeInput($request->get('expiry'));
        $cvc = $request->get('cvc');
        $user_id = $request->get('user_id');
        $total = $request->get('total');

        $paramerter = array(
            'accountId' => 700152,
            'amount' => 10,
            'reference' => 'Reference',
            'particular' => 'Particular',
            'cardNumber' => '4987654321098769',
            'cardType' => 'VISA',
            'cardExpiry' => '0517',
            'cardHolder' => 'Mr John Smith',
            'cardCSC' => '111',
            'storeCard' => 1,
            'tokenReference' => 'TokenReference',
        );

        //Card token
        /*$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://uat.paymarkclick.co.nz/api/transaction/purchase/$dps_billing",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"accountId\": 622216,\n\t\"amount\": $sprice,\n\t\"reference\": \"Reference\",\n\t\"particular\": \"Particular\",\n\t\"email\": null\n}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic MTAyMDg0OjZkZGE0ZGRpZQ==",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 77c5a5ea-04ce-6295-1710-d3c32d1c1bce"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $pstatus = $response->status;
        echo $pstatus;*/


        /*$curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://demo.paymarkclick.co.nz/api/transaction/purchase/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{  \r\n   \"accountId\":622216,\r\n   \"amount\":10.00,\r\n   \"reference\":\"Reference\",\r\n   \"particular\":\"Particular\",\r\n   \"cardNumber\":\"4987654321098769\",\r\n   \"cardType\":\"VISA\",\r\n   \"cardExpiry\":\"0537\",\r\n   \"cardHolder\":\"Mr John Smith\",\r\n   \"cardCSC\":\"111\",\r\n   \"storeCard\":1,\r\n   \"tokenReference\":\"TokenReference\"\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic MTAyMDg0OjZkZGE0ZGRpZQ==",
                "Cache-Control: no-cache",
                "Content-Type: application/json",
                "Postman-Token: 3384cd33-e3fc-732e-54d0-45f91451a385"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }*/
        /*if ($pstatus == 'SUCCESSFUL') {

        }*/
    }

    public function applyCoupon(Request $request)
    {
        $coupon = $request->get('coupon_code');
        $supplier = $request->get('supplier');
        $amount = $request->get('amount');
        $log_id = $request->get('user');
        $suppliers = json_decode($supplier, TRUE);

        $wheres = [
            'coupon' => $coupon,
            'user_id' => $log_id
        ];
        $hasApplied = $this->checkExist('coupon_applied', $wheres);
        if($hasApplied) {
            return response()->json(['success' => false, 'status_code' => '4', 'message' => 'This coupon code already used by you!'], 201);
        }

        $wheres = [
            'coupon' => $coupon
        ];
        $doesExist = $this->selectFunction('coupons', array('id', 'start', 'end', 'min_amt', 'value', 'unit', 'uid'), $wheres);
        if (!empty($doesExist[0]->id)) {
            $id = !empty($doesExist[0]->id) ? $doesExist[0]->id : '';
            $start = !empty($doesExist[0]->start) ? $doesExist[0]->start : '';
            $end = !empty($doesExist[0]->end) ? $doesExist[0]->end : '';
            $value = !empty($doesExist[0]->value) ? $doesExist[0]->value : '';
            $user_id = !empty($doesExist[0]->uid) ? $doesExist[0]->uid : '';

            $coupon_date = strtotime(date("Y-m-d"));


            if ($coupon_date < strtotime($start) || $coupon_date > strtotime($end)) {
                $bool = false;
            } else {
                $bool = true;
            }
            $bool2 = false;
            for ($i = 0; $i <= count($suppliers)-1; $i++) {
                if (in_array($user_id, $suppliers[$i])) {
                    $bool2 = true;
                }
            }
            if ($bool && $bool2) {
                $log_price = '';
                for ($i = 0; $i <= count($suppliers)-1; $i++) {
                    $sup = $suppliers[$i]['user'];
                    $price = $suppliers[$i]['price'];

                    if($user_id == $sup) {
                        $log_price = $price;
                        $discount_val = round(($value * $price) / 100, 2);
                    }
                }
                if(!empty($amount)) {
                    $discount = $discount_val > $amount ? $discount_val - $amount : $amount - $discount_val;
                } else {
                    $discount = $amount;
                }
                $data = [
                    'coupon_id' => $id,
                    'coupon' => $coupon,
                    'discount' => $discount,
                    'discounted' => $discount_val,
                    'percent' => $value,
                    'total' => $amount,
                    'supplier_amount' => $log_price,
                    'supplier' => $user_id
                ];
                $iData = [
                    'coupon_id' => $id,
                    'coupon' => $coupon,
                    'supplier' => $user_id,
                    'user_id' => $log_id
                ];
                $this->insertFunction('coupon_applied', $iData);

                return response()->json(['success' => true, 'response' => $data], 201);
            } else {
                if (!$bool) {
                    //expired
                    return response()->json(['success' => false, 'status_code' => '2', 'message' => 'Coupon code is expired!'], 201);
                }
                if (!$bool2) {
                    //supplier not found
                    return response()->json(['success' => false, 'status_code' => '3', 'message' => 'Supplier not found, coupon is not valid for current products'], 201);
                }
            }
            /*if($bool) {
                $data = [];
                for ($i = 0; $i <= count($suppliers)-1; $i++) {
                    $bool2 = false;
                    $bool3 = false;
                    $sup = $suppliers[$i]['user'];
                    $price = $suppliers[$i]['price'];
                    if($user_id == $sup) {
                        $bool2 = true;
                    }
                    if($bool2) {
                        if($price >= $min_amt) {
                            $bool3 = true;
                        }
                    }
                    if($bool3) {
                        if($unit == 'percentage') {
                            $discount = round(($value * $price) / 100, 2);
                            //$discount = $discount > $price ? $discount - $price : $price - $discount;
                        }
                        if($unit == 'flat') {
                            $discount = $value;
                            //$total = $price > $value ? $price - $value : $value - $price;
                        }
                        $data = [
                            'coupon_id' => $id,
                            'discount' => $discount,
                            'supplier' => $sup
                        ];
                    }
                }
                return response()->json(['success' => true, 'response' => $data], 201);
            } else {
                return response()->json(['success' => false, 'status_code' => '1', 'message' => 'Invalid coupon code'], 201);
            }*/
        } else {
            return response()->json(['success' => false, 'status_code' => '1', 'message' => 'Invalid coupon code'], 201);
        }
        //return response()->json(['success' => true, 'response' => $supplier], 201);
    }
}
