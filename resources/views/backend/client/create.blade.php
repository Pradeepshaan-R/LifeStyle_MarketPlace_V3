@extends('backend.layouts.app')
@section('content')

@push('after-scripts')
<script>
$(document).ready(function(e) {
    $('#client_info_company').hide();
    $('#client_info_person').hide();
});

function select_type(client_type) {
    console.log(client_type);
    if (client_type == "Individual") {
        $('#client_info_company').hide();
        $('#client_info_person').show();
    } else {
        $('#client_info_company').show();
        $('#client_info_person').show();
    }
}
</script>
@endpush

<x-forms.post :action="route('admin.client.store')" class="was-validated" id="myForm">

    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">
                        Client <small class="text-muted mode_label">Create</small>
                    </h4>
                </div>
                <!--col-->

                <div class="col-2">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.client.index') }}" title="Close" class="btn btn-light btn-sm"><i
                                class="fas fa-times"></i></a>
                    </div>
                    <!--btn-toolbar-->
                </div>
                <!--col-->
            </div>
            <!--card-header-actions-->
        </section>
        <!--card-header-->

        <main class="card-body">
            <p>A Client can be an individual or a company. In case for a company, please include a primary contact.</p>

            <aside class="alert alert-dark">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="type" id="client_type1" value="Individual" class="custom-control-input"
                        onclick="select_type(value)">
                    <label class="custom-control-label" for="client_type1">Individual</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="type" id="client_type2" value="Company" class="custom-control-input"
                        onclick="select_type(value)">
                    <label class="custom-control-label" for="client_type2">Company</label>
                </div>
            </aside>

            <!-- CREATE COMPANY START -->
            <section id="client_info_company">
                <h4>Company information</h4>
                <div class="form-group row">
                    <label for="company_name" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company
                        Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="company_name" name="company_name"
                            placeholder="Company Name" required value="{{old('company_name')}}" />
                        @error('company_name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="company_legal_type" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company
                        Type</label>
                    <div class="col-sm-3">
                        <select class="form-control" name='company_legal_type' id="company_legal_type" required>
                            <option value="">--Type--</option>
                            @foreach( App\Models\Client::getEnum('Types') as $value)
                            <option value="{{ $value }}" {{ old('title')==$value?'selected':''}}>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('company_legal_type') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <label for="company_pv_no" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company PV
                        Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="company_pv_no" name="company_pv_no"
                            placeholder="PV Number" required value="{{old('company_pv_no')}}" />
                        @error('company_pv_no') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="company_email" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company
                        Email</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="company_email" name="company_email"
                            placeholder="Company Email" required value="{{old('company_email')}}" />
                        @error('company_email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <label for="company_phone" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company
                        Phone</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" pattern="[1-9]\d+" minlength="11" maxlength="15"
                            id="company_phone" name="company_phone" placeholder="Company Phone" required
                            value="{{old('company_phone')}}" />
                        <small class="form-text text-muted">
                            Minimum 10 digits. eg: 94112334455
                        </small>
                        @error('company_phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company
                        Address</label>
                    <textarea class="form-control col-sm-9" name="address" id="address" rows="5" required
                        value="{{old('address')}}"></textarea>
                    @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group row">
                    <label for="city" class="col-sm-2 col-form-label text-lg-right text-sm-start">City</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" required
                            value="{{old('city')}}" />
                        @error('city') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <label for="country_id" class="col-sm-1 col-form-label text-lg-right text-sm-start">Country</label>
                    <div class="col-sm-4">
                        <select class="form-control" name='country_id' id="country_id" required>
                            <option value="">--Country--</option>
                            @foreach( App\Models\Country::get_all() as $one)
                            <option value="{{ $one->id }}" {{ old('country_id')==$one->id?'selected':''}}>
                                {{ $one->country }}</option>
                            @endforeach
                        </select>
                        @error('country_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="company_website" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company
                        Website</label>
                    <div class="col-sm-9">
                        <input type="url" class="form-control" id="company_website" name="company_website"
                            placeholder="Company Website" required value="{{old('company_website')}}" />
                        @error('company_website') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </section>
            <!-- CREATE COMPANY END -->

            <!-- CREATE PRIMARY CONTACT START -->
            <section id="client_info_person">
                <hr />
                <h4>Primary contact</h4>

                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label text-lg-right text-sm-start">Name</label>
                    <div class="col-sm-2">
                        <select class="form-control" name='title' id="title" required>
                            <option value="">--Title--</option>
                            @foreach( App\Models\UserExtra::getEnum('Titles') as $value)
                            <option value="{{ $value }}" {{ old('title')==$value?'selected':''}}>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required
                            value="{{old('name')}}" />
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label text-lg-right text-sm-start">Email</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required
                            value="{{old('email')}}" />
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <label for="phone" class="col-sm-1 col-form-label text-lg-right text-sm-start">Phone</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" id="phone" name="phone" pattern="[1-9]\d+" minlength="11"
                            maxlength="15" placeholder="Phone" required value="{{old('phone')}}" />
                        <small class="form-text text-muted">
                            Minimum 10 digits. eg: 94112334455
                        </small>
                        @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nationality"
                        class="col-sm-2 col-form-label text-lg-right text-sm-start">Nationality</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="nationality" name="nationality"
                            placeholder="Nationality" required value="{{old('nationality')}}" />
                        @error('nationality') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <label for="nic" class="col-sm-1 col-form-label text-lg-right text-sm-start">NIC</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="nic" name="nic" placeholder="NIC" required
                            value="{{old('nic')}}" />
                        @error('nic') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="designation"
                        class="col-sm-2 col-form-label text-lg-right text-sm-start">Designantion</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="designation" name="designation"
                            placeholder="Designantion" required value="{{old('designation')}}" />
                        @error('designation') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </section>
            <!-- CREATE PRIMARY CONTACT END -->

        </main>
        <!--card-body-->

        <section class="card-footer">
            <div class=" row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6 text-right">
                    @can('CLIENT_CREATE')
                    <button type="submit" class="btn btn-success">Save</button>
                    @endcan
                </div>
            </div>
        </section>
        <!--card-footer-->
    </article>
    <!--card-->
    <small class="float-right text-muted">

    </small>
</x-forms.post>

@endsection