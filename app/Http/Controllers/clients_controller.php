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

class clients_controller extends Controller
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
            'first_name' => ['required', 'unique:clients', 'max:255'],
            'last_name' => ['required', 'unique:clients', 'max:255'],
            'avatar' => ['required'],
            'email' => ['required', 'email:rfc,dns']
        ]);

        if($request->update == 1){
            $client = Client::findOrFail($request->client_id);
            $action = 'updated';
        } else {
            $client = new Client();
            $action = 'created';
        }

        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $image_name = $request->file('avatar')->getClientOriginalName();
        $file = $request->file('avatar')->storeAs('/public', $image_name);
        $client->avatar = $image_name;
        $client->email = $request->email;
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
        $client = Client::get_client_from_id($id);
        return view('clients.show')->with(['client' => $client, 'transactions' => $transactions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::get_client_from_id($id);
        return view('clients.edit')->with('client', $client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($client_id)
    {
        $client = Client::findOrFail($client_id)->delete();

        return response()->json(['success' => true],200);
    }

    public function logout(){        

        Auth::logout();

        return redirect('/');
    }
}
