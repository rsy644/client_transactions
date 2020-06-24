<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;

use App\Transaction;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;



class transactions_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = DB::table('transactions')->paginate(10);
        
        return view('transactions.index')->with('transactions', $transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($client_id)
    {
        $client = Client::findOrFail($client_id);
        return view('transactions.create')->with('client', $client);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator  = $request->validate([
            'transaction_date'  => ['required', 'date_format:"d/m/Y"'],
            'amount'      => ['required']
        ]);


        if($request->update == 1){
            $transaction = Transaction::findOrFail($request->transaction_id);
            $action = 'updated';
        } else {
            $transaction = new Transaction();
            $action = 'created';
        }

        $formatted_date = date_create_from_format('d/m/Y', $request->transaction_date);
        $date = $formatted_date->format('Y-m-d');
        if(!isset($transaction->client) || $transaction->client != $request->client_id){
            $transaction->client = $request->client_id;
        }
        if(!isset($transaction->client) || $transaction->transaction_date != $date){
            $transaction->transaction_date = $date;
        }
        if(!isset($transaction->client) || $transaction->amount != $request->amount){
            $transaction->amount = $request->amount;
        }

        $transaction->save();

        $request->session()->flash('success', 'Transaction ' . $transaction->date . ' has been ' . $action);
        return redirect::route('clients.show', $request->client_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client_id, $transaction_id)
    {
        $client = Client::findOrFail($client_id);
        $transaction = Transaction::findOrFail($transaction_id);
        return view('transactions.show')->with(['client' => $client, 'transaction' => $transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($client_id, $transaction_id)
    {
        $client = Client::get_client_from_id($client_id);
        $transaction = Transaction::get_transaction_from_id($transaction_id);
        return view('transactions.edit')->with(['client' => $client, 'transaction' => $transaction]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id)->delete();

        return response()->json(['success' => true],200);
    }
}
