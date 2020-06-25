<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use App\Client;

use App\Transaction;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Session;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = DB::table('clients')->paginate(10);
        
        return view('clients.index')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'email:rfc,dns']
        ]);

        if($request->update == 1){
            $client = Client::findOrFail($request->client_id);
            $action = 'updated';
        } else {
            $client = new Client();
            $action = 'created';
            $request->validate([
                'first_name' => ['unique:clients'],
                'last_name' => ['unique:clients'],
                'avatar' => 'required'
            ]);
        }

        if(!isset($client->first_name) || $client->first_name != $request->first_name){
            $client->first_name = $request->first_name;
        }
        if(!isset($client->last_name) || $client->last_name != $request->last_name){
            $client->last_name = $request->last_name;
        }

        if(!isset($client->avatar) || ($request->file('avatar') != null && $client->avatar != $request->file('avatar'))){
            $image_name = $request->file('avatar')->getClientOriginalName();
            $file = $request->file('avatar')->storeAs('/public', $image_name);
            $client->avatar = $image_name;
        }
        if(!isset($client->email) || $client->email != $request->file('email')){
            $client->email = $request->email;
        }
        $client->save();

        return redirect::route('clients.index')->with('success', 'Client "' . $client->first_name . ' ' . $client->last_name . '" was ' . $action . '!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transactions = DB::table('transactions')->paginate(10);
        $client = DB::table('clients')->where('id', '=', $id)->get();
        return view('clients.show')->with(['client' => $client[0], 'transactions' => $transactions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = DB::table('clients')->where('id', '=', $id)->get();
        return view('clients.edit')->with('client', $client[0]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($client_id)
    {
        $saved_client = Client::findorFail($client_id);
        $client = Client::findOrFail($client_id)->delete();

        return response()->json(['code' => 200, 'success' => $saved_client->first_name . ' ' . $saved_client->last_name . ' has been deleted!']);
    }

    public function logout(){        

        Auth::logout();

        return redirect('/');
    }
}
