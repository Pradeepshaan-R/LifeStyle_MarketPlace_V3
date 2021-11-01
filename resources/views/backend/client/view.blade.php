@extends('backend.layouts.app')
@section('title', 'Client view')
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

<x-forms.patch :action="route('admin.client.update',$client)" class="was-validated" id="myForm">
    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title">
                        Client <small class="text-muted mode_label">View</small>
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

            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label text-right">Company name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="company_name" name="company_name" readonly="readonly" required
                        @if(old('company_name')) value="{{old('company_name')}}" @else value="{{$client->company_name}}"
                        @endif />
                    @error('company_name') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="contact" class="col-sm-2 col-form-label text-right">Phone</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" pattern="[1-9]\d+" minlength="11" maxlength="15"
                        id="company_phone" name="company_phone" placeholder="company_phone" required
                        value="{{$client->company_phone}}" readonly="readonly" />
                    @error('company_phone') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Email"
                        required value="{{$client->company_email}}" readonly="readonly" />
                    @error('company_email') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>


        </section>
        <!--card-body-->
        <section class="card-footer">
            <div class=" row">
                <div class="col-sm-6">
                    @can('CLIENT_DELETE')
                    <button type="button" url="{{ route('admin.client.destroy', $client->id) }}"
                        return_url="{{ route('admin.client.index')}}" class="btn btn-danger btn_delete">Delete</button>
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
        <strong>@lang('Last Updated'):</strong> @displayDate($client->updated_at)
        ({{ $client->updated_at->diffForHumans() }})
    </small>
    </x-forms.post>

    @endsection