@extends('backend.layouts.app')
@section('title', 'Tenant view')
@section('content')

@section('scripts')
@include('backend.includes.azmeer.btn_delete')
<script>
//multi function edit/update button with input:readyonly control
$(function() {
    var isEditable = false;
    $('.btn_edit').on('click', function() {
        isEditable = true;
        $('.btn_edit').hide();
        $('.btn_update').show();
        $('.mode_label').text('Update');
        $('form input, form select, form textarea, form select option').each(
            function(index) {
                $(this).removeAttr('readonly');
                $(this).removeAttr('disabled');
            }
        );
    });
});
</script>
@endsection

<x-forms.patch :action="route('admin.tenant.update',$tenant)" class="was-validated" id="myForm">
    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title">
                        Tenant <small class="text-muted mode_label">View</small>
                    </h4>
                </div>
                <!--col-->

                <div class="col-sm-7">
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

        <section class="card-body">

            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label text-right">Tenant Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tenant_name" name="tenant_name" readonly="readonly"
                        required @if(old('tenant_name')) value="{{old('tenant_name')}}" @else
                        value="{{$tenant->tenant_name}}" @endif />
                    @error('tenant_name') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label text-right">Address</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required
                        value="{{$tenant->address}}" readonly="readonly" />
                    @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" required
                        value="{{$tenant->city}}" readonly="readonly" />
                    @error('city') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label text-right">Email</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required
                        value="{{$tenant->email}}" readonly="readonly" />
                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <label for="phone" class="col-sm-1 col-form-label text-right">Phone</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" pattern="[1-9]\d+" minlength="11" maxlength="15" id="phone"
                        name="phone" placeholder="Phone" required value="{{$tenant->phone}}" readonly="readonly" />
                    @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="url" class="col-sm-2 col-form-label text-right">URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="url" name="url" placeholder="URL" required
                        value="{{$tenant->url}}" readonly="readonly" />
                    @error('url') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>


        </section>
        <!--card-body-->
        <section class="card-footer">
            <div class=" row">
                <div class="col-sm-6">
                    @can('CLIENT_DELETE')
                    <button type="button" url="{{ route('admin.tenant.destroy', $tenant->id) }}"
                        return_url="{{ route('admin.tenant.index')}}" class="btn btn-danger btn_delete">Delete</button>
                    @endcan
                </div>
                <div class="col-sm-6 text-right">
                    @can('CLIENT_EDIT')
                    <button type="submit" class="btn btn-success btn_update" style="display: none;">Update</button>
                    <button type="button" class="btn btn-primary btn_edit">Edit</button>
                    @endcan
                </div>
            </div>
        </section>
        <!--card-footer-->
    </article>
    <!--card-->
    <small class="float-right text-muted">
        <strong>@lang('Last Updated'):</strong> @displayDate($tenant->updated_at)
        ({{ $tenant->updated_at->diffForHumans() }})
    </small>
    </x-forms.post>

    @endsection