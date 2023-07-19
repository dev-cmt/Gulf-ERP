<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Return List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Invoice Info.</th>
                                    <th>Customer Info.</th>
                                    <th>Category</th>
                                    <th>Deli. Type</th>
                                    <th class="text-center">Item</th>
                                    <th>Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $keys=> $row)
                                    @php
                                        $total = 0;
                                        $item = 0;
                                        foreach ($row->salesDetails as $key=> $value) {
                                            $total += $value->qty * $value->price;
                                            $item += 1;
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{++$keys}}</td>
                                        <td><strong>No: </strong>{{$row->inv_no}}<br><strong>Date: </strong>{{date("j F, Y", strtotime($row->inv_date))}}</td>
                                        <td><strong>Name: </strong>{{$row->mastCustomer->name ?? 'NULL'}}<br><strong>Phone: </strong>{{$row->mastCustomer->phone ?? 'NULL'}}</td>
                                        <td>{{$row->mastItemCategory->cat_name ?? 'NULL'}}</td>
                                        <td>@if($row->is_parsial == 0)
                                            <span class="badge light badge-success">
                                                <i class="fa fa-circle text-success mr-1"></i>Complete
                                            </span>
                                            @elseif($row->is_parsial == 1)
                                            <span class="badge light badge-warning">
                                                <i class="fa fa-circle text-warning mr-1"></i>Parsial
                                            </span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{$item}}</td>
                                        <td class="text-right">{{$total}}</td>
                                        <td class="text-right">
                                            <button id="details_data" data-id="{{ $row->id }}" class="btn btn-secondary p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Return</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!--============//Show Modal Data//================-->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sales Return</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form class="form-valide" data-action="{{ route('sales-return.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                            @csrf
                            <div class="card-body pt-2">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong> Invoice No :</strong></label>
                                            <label class="col-6 col-form-label" id="inv_no"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Invoice Date :</strong></label>
                                            <label class="col-6 col-form-label" id="inv_date"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Customer Name :</strong></label>
                                            <label class="col-6 col-form-label" id="mast_customers"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Store Name :</strong></label>
                                            <label class="col-6 col-form-label" id="store_name"></label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table id="items-table" class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="5%"></th>
                                                <th width="15%">Type</th>
                                                <th width="20%">Group</th>
                                                <th width="15%">Part No.</th>
                                                <th width="10%">Price</th>
                                                <th width="5%">Qty</th>
                                                <th width="15%">Rec. Qty</th>
                                                <th width="15%">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body"></tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-2">
                                        <div class="float-right">
                                            <h6>Total <span style="border: 1px solid #2222;padding: 10px 40px;margin-left:10px" id="total">0.00</span></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <label class="col-md-2 col-form-label"><strong>Remarks</strong></label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="height:50px">
                                <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>

<script>
    /*=======//View Details Add Modal//=========*/
    $(document).on('click', '#details_data', function() {
        var id = $(this).data('id');
        $('#table-body').empty();
        $.ajax({
            url: '{{ route('get_sales_delivery_details')}}',
            method: 'GET',
            dataType: "JSON",
            data: {'id': id},
            success: function(response) {
                var dataMast = response.sales;

                $('#inv_no').html(dataMast.inv_no);
                $("#inv_date").html(dataMast.inv_date);
                $("#mast_customers").html(dataMast.name);
                $("#store_name").html(response.store);
                // $('#remarks').html(response.remarks);

                var dataDetails = response.data;
                var i = 0;
                var total = 0;
                $.each(dataDetails, function(index, item) {
                    var subtotal = item.deli_qty * item.price;
                    var row = '<tr>';
                    row += '<input type="hidden" name="sales_id" value="' + dataMast.id + '">';
                    row += '<input type="hidden" name="moreFile[' + i + '][price]" value="' + item.price + '">';
                    row += '<input type="hidden" name="moreFile[' + i + '][mast_item_register_id]" value="' + item.mast_item_register_id + '">';
                    // row += '<td>' + (index + 1) + '</td>';
                    row += '<td><input type="checkbox" name="" class="checkbox-enable-disable" value="1"></td>';
                    row += '<td>' + item.cat_name + '</td>';
                    row += '<td>' + item.part_name + '</td>';
                    row += '<td>' + item.part_no + '</td>';
                    row += '<td>' + item.price + '</td>';
                    row += '<td id="deli_qty">' + item.deli_qty + '</td>';
                    row += '<td><input type="number" name="moreFile[' + i + '][qty]" class="form-control checkbox-qty" value="' + item.deli_qty + '" disabled></td>';
                    row += '<td>' + subtotal + '</td>';
                    row += '</tr>';

                    ++i;
                    $('#table-body').append(row);
                    total += subtotal;
                });

                $(".checkbox-enable-disable").on("change", function() {
                    var quantityInput = $(this).closest("tr").find("input[name^='moreFile'][name$='[qty]']");

                    if ($(this).is(":checked")) {
                        quantityInput.prop("disabled", false);
                    } else {
                        quantityInput.prop("disabled", true);
                        // Reset the quantity input value when disabling
                        quantityInput.val(parseFloat(quantityInput.data('original-value')));
                        quantityInput.removeClass('text-danger');
                    }
                });

                $(".checkbox-qty").on("change", function() {
                    var quantityInput = $(this);
                    var deliQtyCell = quantityInput.closest("tr").find("#deli_qty");
                    var deliQty = parseFloat(deliQtyCell.text());
                    var enteredQty = parseFloat(quantityInput.val());

                    if (enteredQty > deliQty) {
                        quantityInput.addClass('text-danger');
                        $(".submit_btn").prop("disabled", true);
                    } else {
                        quantityInput.removeClass('text-danger');
                        $(".submit_btn").prop("disabled", false);
                    }
                });

                $('#total').html(total.toFixed(2));
            },
            error: function(response) {
                swal("Error!", "All input values are not null or empty.", "error");
            }
        });
        $(".bd-example-modal-lg").modal('show');
    });

    /*===========// Save Data//===========*/
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
                $(".bd-example-modal-lg").modal('hide');
                swal("Your data save successfully", "Well done, you pressed a button", "success");
                // .then(function() {
                //     location.reload();
                // });
            },
            error: function(response) {
                swal({
                    title: "No Data Found",
                    text: "There are no details available for this item.",
                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                });
            }
        });
    });

</script>
