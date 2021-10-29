@extends('backend.layouts.app')
@section('content')


<x-forms.post :action="route('admin.client.store')" class="was-validated" id="myForm">

    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title">
                        Client <small class="text-muted mode_label">Create</small>
                    </h4>
                </div>
                <!--col-->

                <div class="col-sm-7">
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

        <section class="card-body">
            <p>Dummy text here</p>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-right">Company name</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="company_name" name="company_name"
                        placeholder="Company Name" required value="{{old('company_name')}}" />
                    @error('company_name') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="contact" class="col-sm-2 col-form-label text-right">Contact</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" pattern="[1-9]\d+" minlength="11" maxlength="15" id="phone"
                        name="company_phone" placeholder="Phone" required value="{{old('company_phone')}}" />
                    @error('company_phone') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Email"
                        required value="{{old('company_email')}}" />
                    @error('company_email') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
        </section>
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