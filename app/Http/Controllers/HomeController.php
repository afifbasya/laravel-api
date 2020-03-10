<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jsonurl = env("API_URL")."/accounts";
        $json = file_get_contents($jsonurl);
        $datas = json_decode($json);

        return view('home', compact('datas'));
    }

    public function detail(Request $request, $account_number)
    {
        $jsonurl = env("API_URL")."/account/".$account_number;
        $json = file_get_contents($jsonurl);
        $data = json_decode($json);

        $keyword = $request->get('date');
        if (!empty($keyword)) {
            $date = $keyword;
        }else {
            $date = Carbon::now()->toDateString();
        }
        
        $jsonurl_transaction = env("API_URL")."/transaction/search?accountNumber=".$account_number."&date=".$date;
        $json_transaction = file_get_contents($jsonurl_transaction);
        $transactions = json_decode($json_transaction);
        
        return view('detail', compact('data','transactions', 'date'));
    }

    public function balance($account_number)
    {
        $jsonurl = env("API_URL")."/account/".$account_number;
        $json = file_get_contents($jsonurl);
        $data = json_decode($json);

        return view('balance', compact('data'));
    }

    public function store_balance(Request $request, $account_number)
    {
        $transaction = new Transaction();
        $transaction->account = $account_number;
        $transaction->ammount = $request->ammount;

        $data_json = json_encode($transaction);

        // API URL to update data
        $url = env("API_URL")."/transaction/balance";
        
        // curl initiate
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        
        // SET Method as a PUT
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        
        // Pass data in POST command
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Execute curl and assign returned data
        $response  = curl_exec($ch);
        $message = json_decode($response);
        
        // Close curl
        curl_close($ch);

        if($message->status == 200)
        {
            alert()->success('Success', $message->message);
        }else 
        {
            alert()->error('Error', $message->message);
        }
       

        return redirect('account/'.$account_number);
    }

    public function transfer($account_number)
    {
        $jsonurl = env("API_URL")."/account/".$account_number;
        $json = file_get_contents($jsonurl);
        $data = json_decode($json);

        //All Data
        $jsonurl_all = env("API_URL")."/accounts";
        $json_all = file_get_contents($jsonurl_all);
        $datas = json_decode($json_all);

        return view('transfer', compact('data', 'datas'));
    }

    public function store_transfer(Request $request, $account_number)
    {
        $transaction = new Transaction();
        $transaction->account = $account_number;
        $transaction->ammount = $request->ammount;
        $transaction->to = $request->account;
        $transaction->description = $request->description;

        $data_json = json_encode($transaction);

        // API URL to update data
        $url = env("API_URL")."/transaction/transfer";
        
        // curl initiate
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        
        // SET Method as a PUT
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        
        // Pass data in POST command
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
         // Execute curl and assign returned data
         $response  = curl_exec($ch);
         $message = json_decode($response);
         
         // Close curl
         curl_close($ch);
 
         if($message->status == 200)
         {
             alert()->success('Success', $message->message);
         }else 
         {
             alert()->error('Error', $message->message);
         }

        return redirect('account/'.$account_number);
    }

    public function pulsa($account_number)
    {
        $jsonurl = env("API_URL")."/account/".$account_number;
        $json = file_get_contents($jsonurl);
        $data = json_decode($json);

        return view('pulsa', compact('data'));
    }

    public function store_pulsa(Request $request, $account_number)
    {
        $transaction = new Transaction();
        $transaction->account = $account_number;
        $transaction->ammount = $request->ammount;
        $transaction->nohp = $request->nohp;

        $data_json = json_encode($transaction);

        // API URL to update data
        $url = env("API_URL")."/transaction/pulsa";
        
        // curl initiate
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        
        // SET Method as a PUT
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        
        // Pass data in POST command
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
         // Execute curl and assign returned data
         $response  = curl_exec($ch);
         $message = json_decode($response);
         
         // Close curl
         curl_close($ch);
 
         if($message->status == 200)
         {
             alert()->success('Success', $message->message);
         }else 
         {
             alert()->error('Error', $message->message);
         }

        return redirect('account/'.$account_number);
    }

    public function point($account_number)
    {
        $transaction = new Transaction();
        $transaction->account = $account_number;

        $data_json = json_encode($transaction);

        // API URL to update data
        $url = env("API_URL")."/transaction/point";
        
        // curl initiate
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        
        // SET Method as a PUT
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        
        // Pass data in POST command
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
          // Execute curl and assign returned data
          $response  = curl_exec($ch);
          $message = json_decode($response);
          
          // Close curl
          curl_close($ch);
  
          if($message->status == 200)
          {
              alert()->success('Success', $message->message);
          }else 
          {
              alert()->error('Error', $message->message);
          }

        return redirect('account/'.$account_number);
    }

}
