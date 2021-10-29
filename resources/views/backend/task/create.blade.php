@extends('backend.layouts.app')
@section('content')


<x-forms.post :action="route('admin.task.store')" class="was-validated" id="myForm">

    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title">
                        Task <small class="text-muted mode_label">Create</small>
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
            <p>Dummy text here</p>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-right">Task Number</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="task_no" name="task_no" placeholder="Task Number"
                        required value="{{old('task_no')}}" />
                    @error('task_no') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-right">Task Amount</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="task_no" name="task_amount" placeholder="Task Amount"
                        required value="{{old('task_amount')}}" />
                    @error('task_amount') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-right">Task Note</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="task_note" name="task_note" placeholder="Task Note"
                        required value="{{old('task_note')}}" />
                    @error('task_note') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>


        </section>
        <!--card-body-->

        <section class="card-footer">
            <div class=" row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6 text-right">
                    @can('TASK_CREATE')
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