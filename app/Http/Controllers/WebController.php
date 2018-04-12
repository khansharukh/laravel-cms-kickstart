<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller {
    private $baseUrl;

    public function __construct() {
        $this->baseUrl = 'http://localhost:8000/';
    }
    public function getHome() {
        return view('site.pages.home.home');
    }
    public function getAbout() {
        return view('site.pages.about.about');
    }
    public function getContact() {
        return view('site.pages.contact.contact');
    }
    public function getCategoryProducts($id, $title) {
        $wheres = [
            'id' => $id
        ];
        $data = $this->selectFunction('categories', array('id', 'title'), $wheres);
        $ul_cats = $this->selectFunction('categories', array('title', 'id'), '');
        return view('site.pages.category.category')->with('category', $data)->with('ul_cats', $ul_cats);
    }
    public function getCategories() {
        return view('site.pages.categories.categories');
    }
    public function getProduct($id, $title) {
        $data = $this->dbGetProduct($id);
        $wheres = [
            'product_id' => $id
        ];
        $images = $this->selectFunction('product_images', array('filename', 'id'), $wheres);
        return view('site.pages.products.products')->with('product', $data)->with('images', $images);
    }
    public function getBuyers() {
        return view('site.pages.for-buyers.for-buyers');
    }
    public function getPayParameter($sprice, $uid) {
        $sprice = !empty($sprice) ? $sprice : '1.00';
        $rurl = $this->baseUrl."app/payment/redirect/";
        $postvar = "cmd=_xclick&username=102084&account_id=622216&password=6dda4ddie&amount=$sprice&reference=Test&particular=Test&return_url=$rurl&store_card=1";
        $url = "https://demo.paymarkclick.co.nz/api/webpayments/paymentservice/rest/WPRequest";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvar);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close($ch);

        //print_r($server_output);exit();
        $doc = (array)simplexml_load_string($server_output);
        redirect()->to($doc[0])->send();
    }
    public function getPaymentResponse(Request $request) {
        /*
         * ONLY FOR REFERENCE PURPOSE - POST RESPONSE FROM PAYMARK
         $repoinse = 'Array
                        (
                            [TransactionId] => P180210005724498
                            [Type] => PURCHASE
                            [AccountId] => 622216
                            [Status] => SUCCESSFUL
                            [TransactionDate] => 23/02/2018 7:32:50 p.m.
                            [BatchNumber] => 20180223
                            [ReceiptNumber] => 30876489
                            [AuthCode] => 999999
                            [Amount] => 10
                            [Reference] => Test
                            [Particular] => Test
                            [CardType] => Visa
                            [CardNumber] => 411111******1111
                            [CardExpiry] => 1221
                            [CardHolder] => TEST
                            [CardStored] => true
                            [CardToken] => 1603314197090
                            [TokenReference] =>
                            [ErrorCode] =>
                            [ErrorMessage] =>
                            [AcquirerResponseCode] => 00
                            [MerchantToken] =>
                            [Surcharge] => 0.00
                        )';*/
        if($request->get('Status') == 'SUCCESSFUL') {
            $card_token = $request->get('CardToken');
            $transaction_id = $request->get('TransactionId');
            $card = $request->get('CardNumber');
            $expiry = $request->get('CardExpiry');
            $holder = $request->get('CardHolder');

            echo $card_token.' '.$transaction_id;
            exit;
        } else if($request->get('Status') == 'CANCELLED') {
            echo 'cancelled';
        } else {
            echo 'failure';
        }
    }
}
