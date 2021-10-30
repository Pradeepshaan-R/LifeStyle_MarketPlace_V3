@extends('backend.layouts.app')
@section('content')

@push('after-scripts')
<script>
    $(document).ready(function(e) {
        $('table').DataTable({
            'columnDefs': [
                { orderable: false, targets: -1 }
            ],
            'paging' : false,
            'searching' : false,
            "info": false
        });
    });

</script>
@endpush

<div class="card">
    <div class="card-body">
        <section class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Client <small class="text-muted">List</small>
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                @can('CLIENT_CREATE')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.client.create') }}" class="btn btn-success ml-1" data-toggle="tooltip"
                        title="Add New"><i class="fas fa-plus-circle"></i></a>
                </div>
                @endcan
                <!--btn-toolbar-->
            </div>
            <!--col-->
        </section>
        <!--row-->

        <x-forms.get :action="route('admin.client.index')" autocomplete="off">
            @csrf
            <aside class="row">
                <div class="col-md-6">
                    <input type="search" name="client_name" class="form-control" placeholder="Search by Client" />
                </div>
                <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
            </aside>
        </x-forms.get>

        <!--form-->
        <section class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dtable">
                        <thead>
                            <tr>
                                <th>Company name</th>
                                <th>Contacts</th>
                                <th>Address</th>
                                <th>Country</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client_list as $one)
                            <tr>
                                <td>{{ $one->company_name }}</td>
                                <td> <a href="tel:{{ $one->company_phone }}">{{ $one->company_phone }}</a> <br />
                                    <a href="mailto:{{ $one->company_email }}">{{ $one->company_email }}</a>
                                </td>
                                <td>{{ $one->company_city }}, {{ $one->company_address }}</td>
                                <td>{{ $one->country->country }}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group" aria-label="user_actions">
                                        <a href="{{ url('admin/client') }}/{{$one->id}}" data-toggle="tooltip"
                                            data-placement="top" title="View" class="btn btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!--col-->
        </section>
        <!--row-->
        <section class="row">
            <div class="col-7">
                <div class="float-left">
                    {{ $client_list->total() }} {{ Str::plural('Client', $client_list->total()) }}
                </div>
            </div>
            <!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $client_list->render() !!}
                </div>
            </div>
            <!--col-->
        </section>
        <!--row-->
    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection