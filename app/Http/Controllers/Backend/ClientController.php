<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client_list = Client::get();
        return view('backend.client.list', ['client_list' => $client_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = "";
        DB::beginTransaction();
        try {
            $client = new Client();
            $client->company_name = $request->company_name;
            $client->company_phone = $request->company_phone;
            $client->company_email = $request->company_email;
            $client->save();
            $message = 'Adding Successful';
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $message = 'Adding Unsuccessful';
        }
        return redirect('admin/client')->withFlashInfo($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('backend.client.view', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $message = "";
        DB::beginTransaction();
        try {
            $client->company_name = $request->company_name;
            $client->company_phone = $request->company_phone;
            $client->company_email = $request->company_email;
            $client->save();
            $message = 'Update Successful';
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $message = 'Update Unsuccessful';
        }
        return redirect('admin/client')->withFlashInfo($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        try {
            $client->delete();
            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/client')->withFlashInfo($this->message);

    }
}
