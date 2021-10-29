@extends('backend.layouts.app')
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

<x-forms.patch :action="route('admin.task.update',$task)" class="was-validated" id="myForm">
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
                        <a href="{{ route('admin.task.index') }}" title="Close" class="btn btn-light btn-sm"><i
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
                <label for="contact" class="col-sm-2 col-form-label text-right">Task Number</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="no" name="no" placeholder="Task Number"
                        required value="{{$task->no}}" readonly="readonly" />
                    @error('no') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="contact" class="col-sm-2 col-form-label text-right">Task Amount</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Task Amount"
                        required value="{{$task->amount}}" readonly="readonly" />
                    @error('amount') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>


        </section>
        <!--card-body-->
        <section class="card-footer">
            <div class=" row">
                <div class="col-sm-6">
                    @can('TASK_DELETE')
                    <button type="button" url="{{ route('admin.task.destroy', $task->id) }}"
                        return_url="{{ route('admin.task.index')}}" class="btn btn-danger btn_delete">Delete</button>
                    @endcan
                </div>
                <div class="col-sm-6 text-right">
                    @can('TASK_EDIT')
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
        <strong>@lang('Last Updated'):</strong> @displayDate($task->updated_at)
        ({{ $task->updated_at->diffForHumans() }})
    </small>
    </x-forms.post>

    @endsection