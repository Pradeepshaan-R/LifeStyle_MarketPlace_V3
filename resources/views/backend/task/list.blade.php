@extends('backend.layouts.app')
@section('content')
@section('scripts')
@include('backend.includes.azmeer.btn_delete')
<script>
// // $.noConflict();
// $(document).ready(function(e) {

// $('table').DataTable({
//     'paging': false,
//     'searching': false,
//     "info": false
// });
// });
</script>
@endsection


<div class="card">
    <div class="card-body">
        <section class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Task <small class="text-muted">List</small>
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                @can('TASK_CREATE')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.task.create') }}" class="btn btn-success ml-1" data-toggle="tooltip"
                        title="Add New"><i class="fas fa-plus-circle"></i></a>
                </div>
                @endcan
                <!--btn-toolbar-->
            </div>
            <!--col-->
        </section>
        <!--row-->
        <!--form-->
        <section class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dtable">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Task Number</th>
                                <th>Amount</th>
                                <th>Note</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($task_list as $one)
                            <tr>
                                <td>{{ $one->type }}</td>
                                <td>{{ $one->no }}</td>
                                <td>{{ $one->amount }}</td>
                                <td>{{ $one->note }}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group" aria-label="user_actions">
                                        <a href="{{ url('admin/task') }}/{{$one->id}}" data-toggle="tooltip"
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
                    {{-- {{ $task_list->total() }} {{ Str::plural('Task', $task_list->total()) }} --}}
                </div>
            </div>
            <!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {!! $task_list->render() !!} --}}
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