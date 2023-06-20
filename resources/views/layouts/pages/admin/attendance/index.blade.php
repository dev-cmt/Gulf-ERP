<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Attendance List</h4>
                    <div>
                        @can('Role create') 
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"></i><span class="btn-icon-add" data-bs-toggle="modal"></span>Set Fingerprint</a>                   
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg_form"><i class="fa fa-plus"></i><span class="btn-icon-add" data-bs-toggle="modal"></span>Manual Attendance</a>                   
                        @endcan
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row" id="filter-data">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Employee Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="user_id" id="user_id" class="form-control dropdwon_select">
                                        <option selected disabled>--Select--</option>
                                        @foreach($employee as $row)
                                            <option value="{{ $row->attendance_id}}">{{ $row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Start Date
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <input type="date" name="start_date" id="start_date" class="form-control"  value="{{ date('Y-m-01') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">End Date
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex justify-content-end">
                                <button id="reset" class="btn btn-sm btn-warning"><i class="ti-reload"></i><span class="btn-icon-add"></span>Reset</button>                   
                            </div>
                        </div>
                    </div>
                    <div id="attendance-list"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Attendances Application Modal -->
    <div class="modal fade bd-example-modal-lg_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                @if (session()->has('success'))
                    <strong class="text-success">{{session()->get('success')}}</strong>
                @endif
                <form class="form-valide" data-action="{{ route('manual_attendances.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Manual Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Employee Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <select class="form-control dropdwon_select" id="employeeName" name="employeeName" required>
                                        <option selected disabled>Select</option>
                                        @foreach ($employee as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <input type="hidden" name="finger_id" id="finger_id">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Employee Code</label>
                                <div class="col-lg-8">
                                    <label class="col-form-label" id="employeeCode">GULF-XXXXX</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Date
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date')}}">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Attendance Type
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <select class="form-control default-select @error('attendance_type') is-invalid @enderror" id="attendance_type" name="attendance_type" required>
                                        <option value="1" {{ old('attendance_type') == '1' ? 'selected' : '' }}>Present</option>
                                        <option value="0" {{ old('attendance_type') == '2' ? 'selected' : '' }}>Absent</option>
                                    </select>
                                    @error('attendance_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">In Time (hh:mm)
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <input type="time" class="form-control @error('in_time') is-invalid @enderror" id="in_time" name="in_time" value="09:00">
                                    @error('in_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Out Time (hh:mm)
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <input type="time" class="form-control @error('out_time') is-invalid @enderror" id="out_time" name="out_time" value="17:00">
                                    @error('out_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Location</label>
                                <div class="col-lg-8">
                                    <textarea  id="" cols="30" rows="2" class="form-control @error('location') is-invalid @enderror" name="location" placeholder="Please Write Something...">{{old('location')}}</textarea>
                                    @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Remarks</label>
                                <div class="col-lg-8">
                                    <textarea  id="" cols="30" rows="2" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Please Write Something...">{{old('description')}}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Set Up Finger on Softwer -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" data-action="{{ route('setup-attendance-store') }}" method="POST" enctype="multipart/form-data" id="add-user-attendacne-id">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Setup Fingerprint ID</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Employee Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <select class="form-control dropdwon_select" id="attendanceId" name="attendanceId" required>
                                        <option selected disabled>Select</option>
                                        @foreach ($employee as $row)
                                            <option value="{{$row->id}}">{{$row->name}} ({{$row->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Attendance ID</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control @error('attendance_id') is-invalid @enderror" id="attendance_id" name="attendance_id" value="{{old('attendance_id')}}">
                                    @error('attendance_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('script')
    <script>
        //---Save Manual Attendance Data
        var form = '#add-user-form';
        $(form).on('submit', function(event){
            event.preventDefault();

            var url = $(this).attr('data-action');
            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(response)
                {
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    $('.bd-example-modal-lg_form').modal('hide');
                },
                error: function (xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li style="color:red">' + value + '</li>';
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Required data missing?',
                        html: '<ul>' + errorHtml + '</ul>',
                    });
                }
            });
        });
        //---Save & Upgrate Attendacne ID 
        var form = '#add-user-attendacne-id';
        $(form).on('submit', function(event){
            event.preventDefault();
            var url = $(this).attr('data-action');
            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(response)
                {
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    $('#exampleModalCenter').modal('hide');
                },
                error: function (xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li style="color:red">' + value + '</li>';
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Required data missing?',
                        html: '<ul>' + errorHtml + '</ul>',
                    });
                }
            });
        });
        //--Get Employee List (Manual Attendance)
        var clearEmpId = $('#employeeName').html();
        $('#employeeName').change(function(){
            var userId = $(this).val();
            $.ajax({
                url:'{{ route('get_employee_code') }}',
                method:'GET',
                dataType:"JSON",
                data:{userId},
                success:function(response){
                    $('#employeeCode').html(response.employee_code);
                    $('#finger_id').val(response.attendance_id);
                    if(response.attendance_id == null){
                        Swal.fire(
                            'Invalid Attendaance ID',
                            'Please setup attendance ID!',
                            'question'
                        )
                        $('#employeeName').html(clearEmpId);
                        $('#employeeCode').html('GF-XXXXX');
                        $('#finger_id').val('');
                    }
                }
            });
        });
        //--Get Employee List (Set Attendance ID)
        $('#attendanceId').change(function(){
            var userId = $(this).val();
            $.ajax({
                url:'{{ route('get_employee_code') }}',
                method:'GET',
                dataType:"JSON",
                data:{userId},
                success:function(response){
                    $('#attendance_id').val(response.attendance_id);
                }
            });
        });
        //--Get Employee List (Set Attendance ID)
        $('#attendance_type').change(function(){
            var attendanceType = $(this).val();
            if(attendanceType == 0){
                $('#in_time').val('');
                $('#out_time').val('');
            }
        });
    </script>
    @endpush
</x-app-layout>

<script>
    $(document).ready(function(){
        fetch();
    });
    
    // Fetch records
    function fetch(user_id, start_date, end_date) {
        $.ajax({
            url: "{{ route('get-attendance-filter') }}",
            method:'GET',
            dataType:"html",
            data: {
                user_id: user_id,
                start_date: start_date,
                end_date: end_date
            },
            success:function(data){
                $('#attendance-list').html(data);
            },
            error: function(xhr, status, error) {
                swal("Error!", "Failed to fetch data!", "error");
            }
        });
    }
    // Filter
    $('#filter-data').on('input change', '#start_date, #end_date, #user_id', function() {
        var user_id = $("#user_id").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        
        fetch(user_id, start_date, end_date);
    });
    // Reset
    var clearDropdownHtml = $('#user_id').html();
    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();
    $(document).on("click", "#reset", function(e) {
        e.preventDefault();
        $('#user_id').html(clearDropdownHtml);
        $('#start_date').val(startDate);
        $('#end_date').val(endDate);
        fetch();
    });
</script>
