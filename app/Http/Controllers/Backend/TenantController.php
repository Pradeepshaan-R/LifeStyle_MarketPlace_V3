<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Exception;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->tenant_name;
        $daterange = $request->daterange;
        $date_start = "";
        $date_end = "";

        // $tenant_list = Tenant::get();
        $tenant_list = Tenant::select('*');
        if ($name) {
            $tenant_list = $tenant_list->where("tenant_name", "LIKE", '%' . $name . '%');
        }

        if ($daterange) {
            $date_start = substr($daterange, 0, 10);
            $date_end = substr($daterange, 13);
            $date_end = date('Y-m-d', strtotime($date_end . "+1 days"));
            $tenant_list = $tenant_list->whereBetween('created_at', [$date_start, $date_end]);
        }
        $tenant_list = $tenant_list->paginate(config('pagination.page_size'));

        return view('backend.tenant.list', ['tenant_list' => $tenant_list, 'daterange' => $daterange]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tenant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $this->validate($request, Tenant::$rules);
        // DB::beginTransaction();
        // try {

        //     //CREATE TENANT
        //     $tenant = new Tenant();
        //     $tenant->tenant_name = $request->tenant_name;
        //     $tenant->address = $request->address;
        //     $tenant->city = $request->city;
        //     $tenant->email = $request->email;
        //     $tenant->phone = $request->phone;
        //     $tenant->url = $request->url;
        //     $tenant->save();

        //     $this->message = 'Adding Successful';
        //     DB::commit();
        // } catch (Exception $ex) {
        //     DB::rollBack();
        //     $this->message = 'Adding Unsuccessful';
        // }
        // return redirect('admin/tenant')->withFlashSuccess($this->message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        return view('backend.tenant.view', ['tenant' => $tenant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        // DB::beginTransaction();
        // try {
        //     $tenant->tenant_name = $request->tenant_name;
        //     $tenant->address = $request->address;
        //     $tenant->city = $request->city;
        //     $tenant->email = $request->email;
        //     $tenant->phone = $request->phone;
        //     $tenant->url = $request->url;
        //     $tenant->save();
        //     $this->message = 'Update Successful';
        //     DB::commit();
        // } catch (Exception $ex) {
        //     DB::rollBack();
        //     $this->message = 'Update Unsuccessful';
        // }
        // return redirect('admin/tenant')->withFlashInfo($this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        try {
            $tenant->delete();
            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/tenant')->withFlashInfo($this->message);
    }
}