<x-app-layout>

    <div class="row">

        <div class="col-12">

            <div class="card">

                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Department Edit</h4>
                    <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span
                            class="btn-icon-add"></span>Back</a>
                </div>

                <!-- card body -->
                <div class="card-body">

                    <div class="form-validation">

                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                        <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form action="{{route('mast_department.update', $data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-xl-6">

                                    <!-- this is for deptartment name -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Department Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="text" id="dept_name"
                                                class="form-control @error('dep_name') is-invalid @enderror" name="dept_name" placeholder="" value="{{$data->dept_name}}">

                                            @error('dept_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <!-- this is for description -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Description
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="" value="{{$data->description}}">

                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                </div>



                                <div class="col-xl-6">

                                    <!-- this is for department head -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Department Head
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="text" id="dept_head"
                                                class="form-control @error('dept_head') is-invalid @enderror"
                                                name="dept_head" placeholder="" value="{{$data->dept_head}}">

                                            @error('dept_head')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- this is for status -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label" for="status">Status
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <select class="form-control" id="status" name="status" value="">
                                                <option value="1" {{ $data->status == 1? 'selected': '' }}>Active</option>
                                                <option value="0" {{ $data->status == 0? 'selected': '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <!-- submit button -->
                                <div class="col-lg">
                                    <button type="submit"
                                        class="btn btn-success btn-sm float-right mr-3">Update</button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>