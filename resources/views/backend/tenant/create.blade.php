@extends('backend.layouts.app')
@section('content')

@push('after-scripts')
<script>
$(document).ready(function(e) {});
</script>
@endpush

<x-forms.post :action="route('admin.tenant.store')" class="was-validated" id="myForm">

    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">
                        Tenant <small class="text-muted mode_label">Create</small>
                    </h4>
                </div>
                <!--col-->

                <div class="col-2">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.tenant.index') }}" title="Close" class="btn btn-light btn-sm"><i
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

            <!-- CREATE TENANT ADMIN START -->
            <section id="tenant_info_admin">
                <h4>Tenant Company Information</h4>
                <div class="form-group row">
                    <label for="tenant_name" class="col-sm-2 col-form-label text-lg-right text-sm-start">Tenant
                        Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tenant_name" name="tenant_name" placeholder="Name"
                            required value="{{old('tenant_name')}}" />
                        @error('tenant_name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label text-lg-right text-sm-start">Tenant Email</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required
                            value="{{old('email')}}" />
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <label for="phone" class="col-sm-2 col-form-label text-lg-right text-sm-start">Tenant Phone</label>
                    <div class="col-sm-3">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone No" required
                            value="{{old('phone')}}" />
                        <small class="form-text text-muted">
                            Minimum 10 digits. eg: 94112334455
                        </small>
                        @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label text-lg-right text-sm-start">Tenant
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
                    <label for="url" class="col-sm-2 col-form-label text-lg-right text-sm-start">Tenant URL</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="url" name="url" placeholder="URL" required
                            value="{{old('url')}}" />
                        @error('url') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label text-lg-right text-sm-start">Password</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="******"
                            required value="{{old('password')}}" />
                        @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <label for="name" class="col-sm-3 col-form-label text-lg-right text-sm-start">Confirm
                        Password</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="******"
                            required value="{{old('password')}}" />
                        @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div> -->
            </section>
            <!-- CREATE TENANT ADMIN END -->

            <!-- CREATE TENANT CONTACT START -->
            <section id="tenant_info_person">
                <hr />
                <h4>Tenant Admin</h4>
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
                        <input type="text" class="form-control" id="tenant_name" name="tenant_name" placeholder="Name"
                            required value="{{old('tenant_name')}}" />
                        @error('tenant_name') <span class="text-danger error">{{ $message }}</span>@enderror
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
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone No"
                            required value="{{old('phone')}}" />
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
                    <label for="address" class="col-sm-2 col-form-label text-lg-right text-sm-start">
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
                    <label for="url" class="col-sm-2 col-form-label text-lg-right text-sm-start">URL</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="url" name="url" placeholder="URL" required
                            value="{{old('url')}}" />
                        @error('url') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </section>
            <!-- CREATE TENANT CONTACT END -->

        </main>
        <!--card-body-->

        <section class="card-footer">
            <div class="text-right">
                @can('TENANT_CREATE')
                <button type="submit" class="btn btn-success">Save</button>
                @endcan
            </div>
        </section>
        <!--card-footer-->
    </article>
    <!--card-->
    <small class="float-right text-muted">

    </small>
</x-forms.post>

@endsection