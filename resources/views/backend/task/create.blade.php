@extends('backend.layouts.app')
@section('title', 'Task create')
@section('content')

<x-forms.post :action="route('admin.task.store')" class="was-validated" id="myForm">

    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">
                        Task <small class="text-muted mode_label">Create</small>
                    </h4>
                </div>
                <!--col-->

                <div class="col-2">
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
                    <input type="text" class="form-control" id="no" name="no" placeholder="Task Number"
                        required value="{{old('no')}}" />
                    @error('no') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-right">Task Amount</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Task Amount"
                        required value="{{old('amount')}}" />
                    @error('amount') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-right">Task Note</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="note" name="note" placeholder="Task Note"
                        required value="{{old('note')}}" />
                    @error('note') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>


        </section>
        <!--card-body-->

        <section class="card-footer">
            <div class=" row">
                <div class="col-sm-6">
                    <small>Red boxes are mandatory. Green boxes are optional.</small>
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