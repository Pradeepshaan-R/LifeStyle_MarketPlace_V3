<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\UserExtra;
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
        $type = $request->type;
        $client_list = Client::select('*');
        if ($name) {
            $client_list = $client_list->where("company_name", "LIKE", '%' . $name . '%');
        }
        if ($type) {
            $client_list = $client_list->where("type", $type);
        }
        $client_list = $client_list->paginate(config('pagination.page_size'));

        return view('backend.client.list', ['client_list' => $client_list, 'name' => $name, 'type' => $type]);
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
            //create the primary contact
            $user = new User();
            $user->type = 'admin';
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = "secret";
            $user->save();
            User::find($user->id)->assignRole('Client');

            //create company record

            $client = new Client();
            $client->type = $request->type;
            $client->tenant_id = auth()->user()->user_extra->tenant->id; //currently logged in user's tenant_id
            $client->user_id = $user->id;
            if ($request->type == "Company") {
                $client->company_name = $request->company_name;
                $client->company_phone = $request->company_phone;
                $client->company_email = $request->company_email;
                $client->company_legal_type = $request->company_legal_type;
            }
            $client->save();

            //create user_extra
            $user_extra = new UserExtra();
            $user_extra->title = $request->title;
            $user_extra->phone = $request->phone;
            $user_extra->tenant_id = auth()->user()->user_extra->tenant->id;
            $user_extra->user_id = $user->id;
            $user_extra->save();

            $this->message = 'New Client created. Primary contact adding successful.';
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $this->message = 'Adding Unsuccessful';
            dd($ex);
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
