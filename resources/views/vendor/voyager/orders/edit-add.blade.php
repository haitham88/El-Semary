@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            text-align: center;
            padding: 15px;
        }

        td {
            color: black;

        }

    </style>
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>

    @include('voyager::multilingual.language-selector')
@stop

@section('content')

    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if($edit)
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}
                    @if($add)
                        <div class="panel-body">
{{--                                    <table id="field">--}}
{{--                                         <tbody>--}}

{{--                                          <tr id="row1" class="row">--}}
{{--                                                 <td> <span class='num'>1</span></td>--}}
{{--                                                 <td><input name="fn[]" type="text" /></td>--}}
{{--                                                 <td><select name="name[]" class="myDropDownLisTId">--}}
{{--                                                 </select></td>--}}
{{--                                                 <td>--}}
{{--                                                     <input type="submit"></input>--}}
{{--                                                 </td>--}}
{{--                                             </tr>    </tbody>--}}
{{--                                        </table>--}}
{{--                            <button type="button" id="addField">Add Field</button>--}}
{{--                            <button type="button" id="deleteField">Delete Field</button>--}}
                            <button type="button" class="btn btn-primary add" ONCLICK="ShowAndHide()" btn-add-new>اضافة
                                عميل
                            </button>

                            <div ID="SectionName" style="display: none">
                                <div style="margin-left: 20px">
                                    <label>الاسم الاول</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"/>
                                </div>
                                <div style="margin-left: 20px">
                                    <label>الاسم الاوسط</label>
                                    <input type="text" name="middle_name" id="middle_name" class="form-control"/>
                                </div>
                                <div style="margin-left: 20px">
                                    <label>الاسم الاخير</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"/>
                                </div>
                                <div style="margin-left: 20px">
                                    <label>العنوان</label>
                                    <input type="text" name="address" id="address" class="form-control"/>
                                </div>
                                <div style="margin-left: 20px">
                                    <label>رقم التليفون</label>
                                    <input type="number" name="mobile" id="mobile" class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" style="margin-right: 20px">
                            <h4 style="color: blue;">اضافة المنتجات </h4>

                            <table style="width:98%">
                                <tr>
                                    <td>القسم</td>
                                    <td>المنتج</td>
                                    <td>المواصفات</td>
                                    <td>كود القماش</td>
                                    <td>لون الدهان</td>
                                    <td>السعر</td>
{{--                                    <td>الصور</td>--}}
                                    <td>حذف/اضافة</td>
                                </tr>
                                <tr>
                                    <td><select id="category" style="width: 100%" name="category[]" required>
{{--                                            <option value=0>None</option>--}}
                                        @foreach($categories as $category)

                                                <option value={{$category->id}}>{{$category->name}}</option>
                                            @endforeach
                                        </select></td>
                                    <td><select id="sub_category" style="width: 100%" name="sub_category[]" required>
                                                <option value=0>other</option>
                                            @foreach($subCategories as $subCategory)
                                                <option value={{$subCategory->id}}>{{$subCategory->name}}</option>
                                            @endforeach
                                        </select></td>
                                    <td><textarea style="width: 275px; height: 99px;" name="specs[]"></textarea></td>
                                    <td><input style="width: 100%" type='number' name="material_codes[]" ></td>
                                    <td><input style="width: 100%" type='text' name="color_codes[]" ></td>
                                    <td><input style="width: 100%" type='number' name="price[]" required></td>

{{--                                    <td><input style="width: 100%" type="file" name="Image[]" multiple="multiple"--}}
{{--                                               accept="image/*"></td>--}}
                                    <td><input type='button' class='AddNew' value='Add new item'></td>
                                </tr>
                            </table>
                        </div>

                        <br>

                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    <!-- Adding / Editing -->
                        @php
                            $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                        @endphp


                        @foreach($dataTypeRows as $row)
                        <!-- GET THE DISPLAY OPTIONS -->
                            @php
                                $display_options = $row->details->display ?? NULL;
                                if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                    $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                }
                            @endphp
                            @if (isset($row->details->legend) && isset($row->details->legend->text))
                                <legend class="text-{{ $row->details->legend->align ?? 'center' }}"
                                        style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                            @endif

                            <div
                                class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                {{ $row->slugify }}
                                @if($row->display_name == "العميل" or $row->display_name == "customer")

                                    <div id="customer_label" style="display:block; ">
                                        <label class="control-label"
                                               for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                   @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    </div>
                                @else
                                    <label class="control-label"
                                           for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                @endif
                                {{--                        <label class="control-label"--}}
                                {{--                               for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>--}}
                                {{--                        @include('voyager::multilingual.input-hidden-bread-edit-add')--}}
                                @if (isset($row->details->view))
                                    @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'), 'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
                                @elseif ($row->type == 'relationship')
                                    @if($row->display_name == "العميل" or $row->display_name == "customer")
                                        <div id="customer" style="display:block">
                                            @include('voyager::formfields.relationship', ['options' => $row->details])

                                        </div>
                                    @else
                                        @include('voyager::formfields.relationship', ['options' => $row->details])
                                    @endif
                                @else
                                    {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                @endif

                                @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                    {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                @endforeach
                                @if ($errors->has($row->field))
                                    @foreach ($errors->get($row->field) as $error)
                                        <span class="help-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                        <div>
                            {{--                                    <button type="button" class="btn btn-primary add" ONCLICK="ShowAndHide()" btn-add-new>add customer</button>--}}
                            <br>


                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit"
                                        class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}
                    </h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'
                    </h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger"
                            id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script src="/custom_js/order.js"></script>
    <script>
        $("#category").change(function() {
            console.log($(this).val())
            // $("#second-choice").load("textdata/" + $(this).val() + ".txt");
        });

        // $('.AddNew').click(function () {
        //     var row = $(this).closest('tr').clone();
        //     row.find('input').val('');
        //     $(this).closest('tr').after(row);
        //     $('input[type="button"]', row).removeClass('AddNew')
        //         .addClass('RemoveRow').val('Remove item');
        // });
        //
        // $('table').on('click', '.RemoveRow', function () {
        //     $(this).closest('tr').remove();
        // });
        // document.getElementById("newsectionbtn").onclick = function() {
        //     var container = document.getElementById("container");
        //     var section = document.getElementById("mainsection");
        //     container.appendChild(section.cloneNode(true));
        // }
        function ShowAndHide() {
            var x = document.getElementById('SectionName');
            var c = document.getElementById('customer');
            var cl = document.getElementById('customer_label');
            var fn = document.getElementById('first_name');
            var mn = document.getElementById('middle_name');
            var ln = document.getElementById('last_name');
            var add = document.getElementById('address');
            var mob = document.getElementById('mobile');

            if (x.style.display == 'none') {
                fn.required = true;
                mn.required = true;
                ln.required = true;
                add.required = true;
                mob.required = true;
                x.style.display = 'block';
                c.style.display = 'none';
                cl.style.display = 'none';
            } else {
                fn.required = false;
                mn.required = false;
                ln.required = false;
                add.required = false;
                mob.required = false;
                x.style.display = 'none';
                c.style.display = 'block';
                cl.style.display = 'block';
            }
        }

        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
            return function () {
                $file = $(this).siblings(tag);

                params = {
                    slug: '{{ $dataType->slug }}',
                    filename: $file.data('file-name'),
                    id: $file.data('id'),
                    field: $file.parent().data('field-name'),
                    multi: isMulti,
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text(params.filename);
                $('#confirm_delete_modal').modal('show');
            };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: ['YYYY-MM-DD']
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function (i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function () {
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if (response
                        && response.data
                        && response.data.status
                        && response.data.status == 200) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function () {
                            $(this).remove();
                        })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
