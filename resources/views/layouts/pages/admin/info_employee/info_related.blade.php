<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Related Information ({{$user->name}})</h4>
                    <a href="{{route('info_employee.index')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Skip</a>
                </div>

                <div class="card-body">
                    <div id="accordion-eleven" class="accordion accordion-rounded-stylish accordion-bordered">
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <form class="form-valide" data-action="{{ route('info_employee_related.store', $user_id) }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                            @csrf
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--primary collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseOne" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Educational Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseOne" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                    <!--Educational Information-->
                                    <div class="row accordion__body--text">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="qualification">Qualification
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <select class="dropdwon_select" name="qualification">
                                                        <option value="0" selected>Please select</option>
                                                        <option value="1">SSC</option>
                                                        <option value="2">HSC</option>
                                                    </select>                                                    
                                                    @error('qualification')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Passing Year</label>
                                                <div class="col-lg-7">
                                                    <input type="date" class="form-control @error('passing_year') is-invalid @enderror" id="passing_year" name="passing_year" placeholder="" value="{{old('passing_year')}}"/>                         
                                                    @error('passing_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Institute Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('institute_name') is-invalid @enderror" id="institute_name" name="institute_name" placeholder="" value="{{old('institute_name')}}">                                     
                                                    @error('institute_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Grade</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade" placeholder="" value="{{old('grade')}}">                                     
                                                    @error('grade')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12" id="educational">
                                            @if (count($educational) > 0)
                                            <table class="table table-bordered mt-3">
                                                <thead class="bg-dark text-white">
                                                    <th>Qualification</th>
                                                    <th>Institute Name</th>
                                                    <th>Grade</th>
                                                    <th>Passing Year</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="list_todo">
                                                    @foreach($educational as $row)
                                                        <tr id="row_todo_{{ $row->id}}">
                                                            <td>
                                                                @if ($row->qualification == 1) SSC @else HSC  @endif
                                                            </td>
                                                            <td>{{ $row->institute_name}}</td>
                                                            <td>{{ $row->grade}}</td>
                                                            <td>{{ $row->passing_year}}</td>
                                                            <td width="90">
                                                                <button type="button" id="delete_todo" data-id="{{ $row->id }}" class="btn btn-sm btn-danger ml-1">Delete</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--info collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseTwo" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Work experience</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseTwo" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                    <!--Work experience-->
                                    <div class="row accordion__body--text">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Company Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" placeholder="" value="{{old('company_name')}}"/>                         
                                                    @error('company_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Designation</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" placeholder="" value="{{old('designation')}}"/>                         
                                                    @error('designation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Start Date
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" placeholder="" value="{{old('start_date')}}">                                     
                                                    @error('start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">End Date
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" placeholder="" value="{{old('end_date')}}">                                     
                                                    @error('end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Job Description</label>
                                                <div class="col-lg-7">
                                                    <textarea class="form-control @error('job_description') is-invalid @enderror" rows="1" id="job_description" name="job_description" placeholder="" spellcheck="false">{{old('job_description')}}</textarea>                                                    
                                                    @error('job_description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-xl-12" id="work_experience">
                                            @if (count($work_experience) > 0)
                                            <table class="table table-bordered mt-3">
                                                <thead class="bg-dark text-white">
                                                    <th>Company Name</th>
                                                    <th>Designation</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="list_work">
                                                    @foreach($work_experience as $row)
                                                      <tr id="row_work_experience_{{ $row->id}}">
                                                          <td>{{ $row->company_name}}</td>
                                                          <td>{{ $row->designation}}</td>
                                                          <td width="150">
                                                          <button type="button" id="delete_todo" data-id="{{ $row->id }}" class="btn btn-sm btn-danger ml-1">Delete</button>                        </td>
                                                      </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--success collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseThree" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Banking Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseThree" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                    <!--Banking Information-->
                                    <div class="row accordion__body--text">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Bank Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" placeholder="" value="{{old('bank_name')}}"/>                         
                                                    @error('bank_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Branch Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('brance_name') is-invalid @enderror" id="brance_name" name="brance_name" placeholder="" value="{{old('brance_name')}}"/>                         
                                                    @error('brance_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Account Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('acount_name') is-invalid @enderror" id="acount_name" name="acount_name" placeholder="" value="{{old('acount_name')}}"/>                         
                                                    @error('acount_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Account No.</label>
                                                <div class="col-lg-7">
                                                    <input type="number" class="form-control @error('acount_no') is-invalid @enderror" id="acount_no" name="acount_no" placeholder="" value="{{old('acount_no')}}"/>                         
                                                    @error('acount_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Account Type</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('acount_type') is-invalid @enderror" id="acount_type" name="acount_type" placeholder="" value="{{old('acount_type')}}"/>                         
                                                    @error('acount_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Office Account</p>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Bank Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('bank_name_office') is-invalid @enderror" id="bank_name_office" name="bank_name_office" placeholder="" value="{{old('bank_name_office')}}"/>                         
                                                    @error('bank_name_office')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Branch Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('brance_name_office') is-invalid @enderror" id="brance_name_office" name="brance_name_office" placeholder="" value="{{old('brance_name_office')}}"/>                         
                                                    @error('brance_name_office')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Account Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('acount_name_office') is-invalid @enderror" id="acount_name_office" name="acount_name_office" placeholder="" value="{{old('acount_name_office')}}"/>                         
                                                    @error('acount_name_office')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Account No.</label>
                                                <div class="col-lg-7">
                                                    <input type="number" class="form-control @error('acount_no_office') is-invalid @enderror" id="acount_no_office" name="acount_no_office" placeholder="" value="{{old('acount_no_office')}}"/>                         
                                                    @error('acount_no_office')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Account Type</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('acount_type_office') is-invalid @enderror" id="acount_type_office" name="acount_type_office" placeholder="" value="{{old('acount_type_office')}}"/>                         
                                                    @error('acount_type_office')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--success collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseFour" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Nominee Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseFour" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                    <!--Nominee Information-->
                                    <div class="row accordion__body--text">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Full Name</label>
                                                <div class="col-lg-7">
                                                    <input type="date" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" placeholder="" value="{{old('full_name')}}"/>                         
                                                    @error('full_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">NID</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('nid_no') is-invalid @enderror" id="nid_no" name="nid_no" placeholder="" value="{{old('nid_no')}}"/>                         
                                                    @error('nid_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Relation
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('relation') is-invalid @enderror" id="relation" name="relation" placeholder="" value="{{old('relation')}}">                                     
                                                    @error('relation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Mobile No.
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" placeholder="" value="{{old('mobile_no')}}">                                     
                                                    @error('mobile_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Nominee Percentage
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('nominee_percentage') is-invalid @enderror" id="nominee_percentage" name="nominee_percentage" placeholder="" value="{{old('nominee_percentage')}}">                                     
                                                    @error('nominee_percentage')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Upload Picture
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="profile_image" name="profile_image" placeholder="" value="{{old('profile_image')}}">                                     
                                                    @error('profile_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


<script>
    $(document).ready(function(){
        //---Save Data
        var form = '#add-user-form';
        $(form).on('submit', function(event){
            event.preventDefault();

            var url = $(this).attr('data-action');
            var src = $('#redirect').attr('redirect-action');
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
                    $(form).trigger("reset");
                    // alert(response.success);
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    // window.location.href = src;


                    if(response.institute_name){
                        var row = '<tr id="row_todo_'+ response.id + '">';
                        row += '<td> @if('+response.qualification == 1 +') SSC @elseif ('+ response.qualification == 2+') HSC @endif' + '</td>';
                        row += '<td>' + response.institute_name + '</td>';
                        row += '<td>' + response.grade + '</td>';
                        row += '<td>' + response.passing_year + '</td>';
                        row += '<td width="90">' + '<button type="button" id="delete_todo" data-id="' + response.id +'" class="btn btn-danger btn-sm">Delete</button>' + '</td>';

                        if($("#id").val()){
                            $("#row_todo_" + response.id).replaceWith(row);
                        }else{
                            $("#list_todo").prepend(row);
                        }
                        $("#form_todo").trigger('reset');
                        $("#educational").load(" #educational");
                        $("#form_todo").load(" #form_todo");
                    }
                    // if(response.company_name){
                    //     var row = '<tr id="row_work_experience_'+ response.id + '">';
                    //     row += '<td width="20">' + response.id + '</td>';
                    //     row += '<td>' + response.company_name + '</td>';
                    //     row += '<td width="150">' + '<button type="button" id="delete_todo" data-id="' + response.id +'" class="btn btn-danger btn-sm">Delete</button>'+'</td>';

                    //     if($("#id").val()){
                    //         $("#row_work_experience_" + response.id).replaceWith(row);
                    //     }else{
                    //         $("#list_work").prepend(row);
                    //     }
                    //     $("#form_todo").trigger('reset');
                    //     $("#work_experience").load(" #work_experience");
                    // }


                },
                error: function(response) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        // footer: '<a href="">Why do I have this issue?</a>'
                    })
                }
            });
        });
    });

    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    // Delete Todo 
    // $("body").on('click','#delete_todo',function(){
    //     var id = $(this).data('id');
    //     // confirm('Are you sure want to delete !');
    //     alert(id);
    //     $.ajax({
    //         type:'DELETE',
    //         url: "info_employee/" + id
    //     }).done(function(res){
    //         $("#row_todo_" + id).remove();
    //     });
    // });

$("body").on("click","#delete_todo", function(){
    var id = $(this).data('id');
    //alert(user_id);

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
    })




    $.ajax({
        url: "{{ url('info_related/education/destroy')}}" + '/' + id,
        method: 'DELETE',
        type: 'DELETE',
        success: function(response) {
            Swal.fire(
                'The Internet?',
                'That thing is still around?',
                'question'
            )
            $("#row_todo_" + id).remove();
            $("#educational").load(" #educational");
        },
        error: function(response) {
            alert("Fail");
        }
    });
});



</script>

</x-app-layout>