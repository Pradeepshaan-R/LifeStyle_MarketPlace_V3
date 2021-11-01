@extends('backend.layouts.app')
@section('content')

@push('after-scripts')
<script>
    $(document).ready(function(e) {
        $('#client_info_company').hide();
        $('#client_info_person').hide();
    });
    function select_type(client_type){
        console.log(client_type);
        if(client_type=="Individual"){
            $('#client_info_company').hide();
            $('#client_info_person').show();
        }else{
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
                    <input type="radio" name="type" id="client_type1" value="Individual"
                        class="custom-control-input" onclick="select_type(value)">
                    <label class="custom-control-label" for="client_type1">Individual</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="type" id="client_type2" value="Company"
                        class="custom-control-input" onclick="select_type(value)">
                    <label class="custom-control-label" for="client_type2">Company</label>
                </div>
            </aside>

            <section id="client_info_company">
                <h4>Company information</h4>
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
                        <input type="text" class="form-control" pattern="[1-9]\d+" minlength="11" maxlength="15"
                            id="phone" name="company_phone" placeholder="Company Phone" required
                            value="{{old('company_phone')}}" />
                        @error('company_phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="company_email" name="company_email"
                            placeholder="Company Email" required value="{{old('company_email')}}" />
                        @error('company_email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </section>

            <section id="client_info_person">
                <hr />
                <h4>Primary contact</h4>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label text-right">Name</label>
                    <div class="col-sm-2">
                        <select class="form-control" name='title' id="title" required>
                            <option value="">--Title--</option>
                            @foreach( App\Models\UserExtra::getEnum('Titles') as $value)
                            <option value="{{ $value }}" {{ old('title')==$value?'selected':''}}>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required
                            value="{{old('name')}}" />
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label text-right">Email</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required
                            value="{{old('email')}}" />
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <label for="name" class="col-sm-2 col-form-label text-right">Phone</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required
                            value="{{old('phone')}}" />
                        <small class="form-text text-muted">
                            Minimum 10 digits. eg: 94112334455
                        </small>
                        @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </section>
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