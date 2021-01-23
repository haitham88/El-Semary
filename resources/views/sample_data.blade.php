<html>
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />


    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>



    <css src="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"></css>
    <css src="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></css>
</head>
<body>
<div class="container">
    <br />
    <h3 align="center">How to Delete or Remove Data From Mysql in Laravel 6 using Ajax</h3>
    <br />
    <div class="row input-daterange id=daterange">
        <div class="col-md-4">
            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
        </div>
        <div class="col-md-4">
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
        </div>
        <div class="col-md-4">
            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
        </div>
    </div>
    <div align="right">
        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
    </div>
    <br />
    <div class="table-responsive">
        <table id="customers" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="15%">First Name</th>
                <th width="15%">Second Name</th>
                <th width="15%">Last Name</th>
                <th width="15%">Mobile</th>
                <th width="15%">Address</th>
                <th width="15%">Code</th>
                <th width="15%">date</th>
            </tr>
            </thead>
        </table>
    </div>
    <br />
    <br />
</div>
</body>
</html>

{{--<div id="formModal" class="modal fade" role="dialog">--}}
{{--    <div class="modal-dialog">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                <h4 class="modal-title">Add New Record</h4>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <span id="form_result"></span>--}}
{{--                <form method="post" id="sample_form" class="form-horizontal">--}}
{{--                    @csrf--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="control-label col-md-4" >First Name : </label>--}}
{{--                        <div class="col-md-8">--}}
{{--                            <input type="text" name="first_name" id="first_name" class="form-control" />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="control-label col-md-4">Last Name : </label>--}}
{{--                        <div class="col-md-8">--}}
{{--                            <input type="text" name="last_name" id="last_name" class="form-control" />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br />--}}
{{--                    <div class="form-group" align="center">--}}
{{--                        <input type="hidden" name="action" id="action" value="Add" />--}}
{{--                        <input type="hidden" name="hidden_id" id="hidden_id" />--}}
{{--                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div id="confirmModal" class="modal fade" role="dialog">--}}
{{--    <div class="modal-dialog">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                <h2 class="modal-title">Confirmation</h2>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>--}}
{{--                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--<script>--}}
{{--    $(document).ready(function(){--}}

{{--        $('#user_table').DataTable({--}}
{{--            processing: true,--}}
{{--            serverSide: true,--}}
{{--            ajax: {--}}
{{--                url: "{{ route('sample.index') }}",--}}
{{--            },--}}
{{--            columns: [--}}
{{--                {--}}
{{--                    data: 'first_name',--}}
{{--                    name: 'first_name'--}}
{{--                },--}}
{{--                {--}}
{{--                    data: 'second_name',--}}
{{--                    name: 'second_name'--}}
{{--                },--}}
{{--                {--}}
{{--                    data: 'last_name',--}}
{{--                    name: 'last_name'--}}
{{--                },--}}
{{--                {--}}
{{--                    data: 'mobile',--}}
{{--                    name: 'mobile'--}}
{{--                },--}}
{{--                {--}}
{{--                    data: 'address',--}}
{{--                    name: 'address'--}}
{{--                },--}}
{{--                {--}}
{{--                    data: 'code',--}}
{{--                    name: 'code'--}}
{{--                },--}}
{{--                {--}}
{{--                    data: 'action',--}}
{{--                    name: 'action',--}}
{{--                    orderable: false--}}
{{--                }--}}
{{--            ]--}}
{{--        });--}}

{{--        --}}{{--        $('#create_record').click(function(){--}}
{{--        --}}{{--            $('.modal-title').text('Add New Record');--}}
{{--        --}}{{--            $('#action_button').val('Add');--}}
{{--        --}}{{--            $('#action').val('Add');--}}
{{--        --}}{{--            $('#form_result').html('');--}}

{{--        --}}{{--            $('#formModal').modal('show');--}}
{{--        --}}{{--        });--}}

{{--        --}}{{--        $('#sample_form').on('submit', function(event){--}}
{{--        --}}{{--            event.preventDefault();--}}
{{--        --}}{{--            var action_url = '';--}}

{{--        --}}{{--            if($('#action').val() == 'Add')--}}
{{--        --}}{{--            {--}}
{{--        --}}{{--                action_url = "{{ route('sample.store') }}";--}}
{{--        --}}{{--            }--}}

{{--        --}}{{--            if($('#action').val() == 'Edit')--}}
{{--        --}}{{--            {--}}
{{--        --}}{{--                action_url = "{{ route('sample.update') }}";--}}
{{--        --}}{{--            }--}}

{{--        --}}{{--            $.ajax({--}}
{{--        --}}{{--                url: action_url,--}}
{{--        --}}{{--                method:"POST",--}}
{{--        --}}{{--                data:$(this).serialize(),--}}
{{--        --}}{{--                dataType:"json",--}}
{{--        --}}{{--                success:function(data)--}}
{{--        --}}{{--                {--}}
{{--        --}}{{--                    var html = '';--}}
{{--        --}}{{--                    if(data.errors)--}}
{{--        --}}{{--                    {--}}
{{--        --}}{{--                        html = '<div class="alert alert-danger">';--}}
{{--        --}}{{--                        for(var count = 0; count < data.errors.length; count++)--}}
{{--        --}}{{--                        {--}}
{{--        --}}{{--                            html += '<p>' + data.errors[count] + '</p>';--}}
{{--        --}}{{--                        }--}}
{{--        --}}{{--                        html += '</div>';--}}
{{--        --}}{{--                    }--}}
{{--        --}}{{--                    if(data.success)--}}
{{--        --}}{{--                    {--}}
{{--        --}}{{--                        html = '<div class="alert alert-success">' + data.success + '</div>';--}}
{{--        --}}{{--                        $('#sample_form')[0].reset();--}}
{{--        --}}{{--                        $('#user_table').DataTable().ajax.reload();--}}
{{--        --}}{{--                    }--}}
{{--        --}}{{--                    $('#form_result').html(html);--}}
{{--        --}}{{--                }--}}
{{--        --}}{{--            });--}}
{{--        --}}{{--        });--}}

{{--        --}}{{--        $(document).on('click', '.edit', function(){--}}
{{--        --}}{{--            var id = $(this).attr('id');--}}
{{--        --}}{{--            $('#form_result').html('');--}}
{{--        --}}{{--            $.ajax({--}}
{{--        --}}{{--                url :"/sample/"+id+"/edit",--}}
{{--        --}}{{--                dataType:"json",--}}
{{--        --}}{{--                success:function(data)--}}
{{--        --}}{{--                {--}}
{{--        --}}{{--                    $('#first_name').val(data.result.first_name);--}}
{{--        --}}{{--                    $('#last_name').val(data.result.last_name);--}}
{{--        --}}{{--                    $('#hidden_id').val(id);--}}
{{--        --}}{{--                    $('.modal-title').text('Edit Record');--}}
{{--        --}}{{--                    $('#action_button').val('Edit');--}}
{{--        --}}{{--                    $('#action').val('Edit');--}}
{{--        --}}{{--                    $('#formModal').modal('show');--}}
{{--        --}}{{--                }--}}
{{--        --}}{{--            })--}}
{{--        --}}{{--        });--}}

{{--        --}}{{--        var user_id;--}}

{{--        --}}{{--        $(document).on('click', '.delete', function(){--}}
{{--        --}}{{--            user_id = $(this).attr('id');--}}
{{--        --}}{{--            $('#confirmModal').modal('show');--}}
{{--        --}}{{--        });--}}

{{--        --}}{{--        $('#ok_button').click(function(){--}}
{{--        --}}{{--            $.ajax({--}}
{{--        --}}{{--                url:"sample/destroy/"+user_id,--}}
{{--        --}}{{--                beforeSend:function(){--}}
{{--        --}}{{--                    $('#ok_button').text('Deleting...');--}}
{{--        --}}{{--                },--}}
{{--        --}}{{--                success:function(data)--}}
{{--        --}}{{--                {--}}
{{--        --}}{{--                    setTimeout(function(){--}}
{{--        --}}{{--                        $('#confirmModal').modal('hide');--}}
{{--        --}}{{--                        $('#user_table').DataTable().ajax.reload();--}}
{{--        --}}{{--                        alert('Data Deleted');--}}
{{--        --}}{{--                    }, 2000);--}}
{{--        --}}{{--                }--}}
{{--        --}}{{--            })--}}
{{--        --}}{{--        });--}}

{{--    });--}}
{{--</script>--}}
<script>
    $(document).ready(function(){
        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });
        load_data();

        function load_data(from_date = '', to_date = '')
        {
            $('#customers').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'excel'
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{{ route("sample.index") }}',
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'second_name',
                        name: 'second_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    }
                ]
            });
        }

        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
            {
                $('#customers').DataTable().destroy();
                load_data(from_date, to_date);
            }
            else
            {
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#customers').DataTable().destroy();
            load_data();
        });

    });
</script>
