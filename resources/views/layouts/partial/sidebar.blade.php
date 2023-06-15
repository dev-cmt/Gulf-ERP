    <!--**********************************
                Sidebar start
    ***********************************-->
    <div class="deznav scrollbar">
        {{-- <div class=""> --}}
            <div class="main-profile">
                <div class="image-bx">
                    <img src="{{asset('public')}}/images/profile/{{ Auth::user()->profile_photo_path }}" alt="">
                    <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
                </div>
                <h5 class="name">{{ Auth::user()->name }}</h5>
                <p class="email"><a href="mailto:<nowiki>{{ Auth::user()->email }}">[{{ Auth::user()->email }}]</a></p>
            </div>
            <ul class="metismenu" id="menu">
                <li class="nav-label first">Main Menu</li>
                <li><a href="{{route('dashboard')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-144-layout"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-152-followers"></i>
                        <span class="nav-text">HR & Admin</span>
                    </a>
                    <ul aria-expanded="false">
                        {{-- <li><a href="{{route('info_employee.index')}}">Employee Registration </a></li> --}}
                        {{-- <li><a href="{{route('info_personal.create')}}">Personal Details</a></li> --}}
                        {{-- <li><a href="{{route('info_related.index')}}">Related Information</a></li> --}}
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Employee</a>
                            <ul aria-expanded="false">
                                <li><a href="{{route('info_employee.list')}}">Employee List</a></li>
                                <li><a href="{{route('employee_register.create')}}">Employee Register</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Leave</a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('leave_self.create') }}">Self Leave</a></li>
                                <li><a href="{{ route('emergency_leave.create') }}">Emergency Leave</a></li>
                                <li><a href="{{ route('dept_approve_list.create') }}">Dept. Approve</a></li>
                                <li><a href="{{ route('hr_approve_list.create') }}">HR Approve</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Attendance</a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('manual_attendances.index') }}">Attendance List</a></li>
                                <li><a href="{{ route('manual_attendances.create') }}">Manual Attendance</a></li>
                                <li><a href="{{ route('attendance_approve.create') }}">Attendance Approve</a></li>
                                <li><a href="{{route('attendance.import')}}">Upload Attendance</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Salary</a>
                            <ul aria-expanded="false">
                                <li><a href="#">Process Salary</a></li>
                                <li><a href="#">Pay Slip</a></li>
                                <li><a href="#">Salary Sheet</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Data Setting</a>
                            <ul aria-expanded="false">
                                <li><a href="{{route('mast_department.index')}}">Depertment</a></li>
                                <li><a href="{{route('mast_designation.index')}}">Desgination</a></li>
                                <li><a href="{{route('mast_leave.index')}}">Leave Type</a></li>
                                <li><a href="{{route('must_employee_category.index')}}">Employee Category</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-home"></i>
                        <span class="nav-text">Inventory</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('inv_purchase_grn')}}">GRN (Warehouse)</a></li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Purchase</a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('inv_purchase.index',['cat_id' => 1])}}">AC</a></li>
                                <li><a href="{{ route('inv_purchase.index',['cat_id' => 2])}}">AC Spare Parts</a></li>
                                <li><a href="{{ route('inv_purchase.index',['cat_id' => 3])}}">Car Spare Parts</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Sales Delivery</a></li>
                        <li><a href="#">Stock Update</a></li>
                        <li><a href="#">Stock Possition</a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Data Setting</a>
                            <ul aria-expanded="false">
                                <li><a href="{{route('mast_item_category.index')}}">Item Category</a></li>
                                <li><a href="{{route('mast_item_group.index')}}">Parts Register</a></li>
                                <li><a href="{{route('mast_item_register.index')}}">Item Register</a></li>
                                <li><a href="{{route('mast_unit.index')}}">Units Setting</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-layer-1"></i>
                        <span class="nav-text">Sales</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Sales</a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('sales.index',['cat_id' => 1]) }}">AC Sales</a></li>
                                <li><a href="{{ route('sales.index',['cat_id' => 2]) }}">AC Spare Parts</a></li>
                                <li><a href="{{ route('sales.index',['cat_id' => 3]) }}">Car Spare Parts</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Sales Return</a></li>
                        <li><a href="#">Sales Receive</a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Data Setting</a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('customer.index',['cat_id' => 1]) }}">Corporate Details</a></li>
                                <li><a href="{{ route('customer.index',['cat_id' => 2]) }}">Distributer Details</a></li>
                                <li><a href="{{ route('customer.index',['cat_id' => 3]) }}">Retailer Details</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-149-diagram"></i>
                        <span class="nav-text">Warrenty & Service</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">Complaint / Issue</a></li>
                        <li><a href="#">Prepare Job Card</a></li>
                        <li><a href="#">Tachnician Movement</a></li>
                        <li><a href="#">Spare Parts Requsition</a></li>
                        <li><a href="#">Tools Requsition</a></li>
                        <li><a href="#">Tools Requsition</a></li>
                    </ul>
                </li>
                <li class="nav-label">Apps</li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-077-menu-1"></i>
                        <span class="nav-text">Apps</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">Profile</a></li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Shop</a>
                            <ul aria-expanded="false">
                                <li><a href="#">Product Grid</a></li>
                                <li><a href="#">Product List</a></li>
                                <li><a href="#">Product Details</a></li>
                            </ul>
                        </li>
                    </ul>
                    {{-- <ul aria-expanded="false">
                        <li><a href="{{route('sales_quoation.index')}}">Sales Quotation</a></li>
                        <li><a href="{{route('sales.index')}}" >Sales</a></li>
                        <li><a href="{{route('sales_cashmemo.index')}}">Cash Memo Sales</a></li>
                        <li><a href="{{route('sales_requisition.index')}}">Item Requisition</a></li>
                        <li><a href="{{route('sales_installation.index')}}">Installation</a></li>
                        <li><a href="{{route('sales_payment_receive.index')}}">Payment Receive</a></li>
                        <li><a href="{{route('sales_cheque_return.index')}}">Cheque Return</a></li>
                        <li><a href="{{route('sales_product_return.index')}}" >Product Return</a></li>
                        <li><a href="{{route('coming_soon')}}">Stock Position</a></li>
                        <li><a href="{{route('coming_soon')}}">Conveyance</a></li>
                        <li><a href="{{route('coming_soon')}}">Verify Conveyance</a></li>
                        <li><a href="{{route('mast_item.index')}}">Item Catalogue</a></li>
                        <li><a href="{{route('mast_client.index')}}">Client Details</a></li>
                        <li><a href="{{route('mast_grade.index')}}">Grade Code</a></li>
                        <li><a href="{{route('mast_supplier.index')}}">Supplier Details</a></li>
                        <li><a href="{{route('mast_employee.index')}}">Employee Category</a></li>
                        <li><a href="{{route('mast_designation.index')}}">Designation</a></li>
                        <li><a href="{{route('mast_department.index')}}">Department</a></li>
                        <li><a href="{{route('mast_leaveType.index')}}">Leave type</a></li>
                        <li><a href="{{route('mast_package.index')}}">Package Type</a></li>
                        <li><a href="{{route('mast_salary.index')}}">Salary structure</a></li>
                        <li><a href="{{route('mast_store.index')}}">Store Detials</a></li>
                        <li><a href="{{route('mast_unit.index')}}">Unit Details</a></li>
                    </ul> --}}
                </li>
                @canany('Setting access')
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-settings-2"></i>
                        <span class="nav-text">Setting</span>
                    </a>
                    <ul aria-expanded="false">
                        @canany('Role access','Role add','Role edit','Role delete')
                            <li><a href="{{ route('roles.index') }}">Role</a></li>
                        @endcanany

                        @canany('User access','User add','User edit','User delete')
                        <li><a href="{{ Route('users.index')}}">User</a></li>
                        @endcanany
                    </ul>
                </li>
                @endcanany
            </ul>
            <div class="copyright">
                <p><strong>Gulf ERP Admin Dashboard</strong> © 2023 All Rights Reserved</p>
                <p class="fs-12">Made with <span class="heart"></span> by Icon ISL</p>
            </div>
        {{-- </div> --}}
    </div>
    <!--**********************************
                Sidebar end
    ***********************************-->