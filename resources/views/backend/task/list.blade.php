@extends('backend.layouts.app')
@section('content')

@push('after-scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
    $(function() {
    
        var start = moment().subtract(29, 'days');
        var end = moment();
    
        function cb(start, end) {
            $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    
        $('#daterange').daterangepicker({
            locale: { format: 'YYYY-MM-DD' },
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
    
        cb(start, end);
    
    });
</script>

<script>
    $(document).ready(function(e) {
        $('table').DataTable({
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
            <div class="col-5">
                <h4 class="card-title mb-4">
                    Task <small class="text-muted">List</small>
                </h4>
            </div>
            <!--col-->

            <div class="col-7">
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

        <x-forms.get :action="route('admin.task.index')" autocomplete="off">
            @csrf
            <aside class="row">
                <div class="col-5">
                    <input type="search" name="task_name" class="form-control" placeholder="Search by task" />
                </div>
                <div class="col-5">
                    <input type="text" class="form-control" name="daterange" id="daterange" />
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