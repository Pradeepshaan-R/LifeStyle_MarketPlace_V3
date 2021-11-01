<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Traits\Common;
use DB;
use Exception;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use Common;
    protected $code = 200;
    protected $message;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->client_name;
        $client_list = Client::select('*');
        if ($name) {
            $client_list = $client_list->where("company_name", "LIKE", '%' . $name . '%');
        }
        $client_list = $client_list->paginate(config('pagination.page_size'));

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
        $validatedData = $this->validate($request, Client::$rules);
        DB::beginTransaction();
        try {
            $client = new Client();
            $client->type = $request->client_type;
            $client->company_name = $request->company_name;
            $client->company_phone = $request->company_phone;
            $client->company_email = $request->company_email;
            $client->tenant_id = auth()->user()->user_extra->tenant->id; //currently logged in user's tenant_id
            $client->save();
            $this->message = 'Adding Successful';
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $this->message = 'Adding Unsuccessful';
        }
        return redirect('admin/client')->withFlashInfo($this->message);
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
        DB::beginTransaction();
        try {
            $client->company_name = $request->company_name;
            $client->company_phone = $request->company_phone;
            $client->company_email = $request->company_email;
            $client->save();
            $this->message = 'Update Successful';
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/client')->withFlashInfo($this->message);
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
