<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="editManufacturerLabel">{{ trans('labels.EditAddress') }}</h4>
</div>

{!! Form::open(array('url' =>'admin/customers/updateAddress', 'name'=>'editAddressFrom', 'id'=>'editAddressFrom', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
{!! Form::hidden('user_id', $data['user_id'], array('class'=>'form-control')) !!}
{!! Form::hidden('address_book_id', $data['customer_addresses'][0]->address_book_id, array('class'=>'form-control')) !!}
<div class="modal-body">
    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Company') }}</label>
        <div class="col-sm-10 col-md-8">
            {!! Form::text('entry_company', $data['customer_addresses'][0]->entry_company, array('class'=>'form-control', 'id'=>'entry_company')) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FirstName') }}*</label>
        <div class="col-sm-10 col-md-8">
            {!! Form::text('entry_firstname', $data['customer_addresses'][0]->entry_firstname, array('class'=>'form-control field-validate', 'id'=>'entry_firstname')) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.LastName') }}*</label>
        <div class="col-sm-10 col-md-8">
            {!! Form::text('entry_lastname', $data['customer_addresses'][0]->entry_lastname, array('class'=>'form-control field-validate', 'id'=>'entry_lastname')) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.StreetAddress') }}*</label>
        <div class="col-sm-10 col-md-8">
            {!! Form::text('entry_street_address', $data['customer_addresses'][0]->entry_street_address, array('class'=>'form-control field-validate', 'id'=>'entry_street_address')) !!}
        </div>
    </div>
    {{--<div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Suburb') }}</label>
        <div class="col-sm-10 col-md-8">
            {!! Form::text('entry_suburb', $data['customer_addresses'][0]->entry_suburb, array('class'=>'form-control field-validate', 'id'=>'entry_suburb')) !!}
        </div>
    </div>--}}

    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.City') }}*</label>
        <div class="col-sm-10 col-md-8">
            <select id="entry_city_edit" class="form-control field-validate" name="entry_city">
                <option value="">Select City</option>
                @foreach($data['cities'] as $city_data)
                    <option value="{{ $city_data->cities_id }}" <?php echo $data['customer_addresses'][0]->entry_city==$city_data->cities_id?"selected":""; ?> >{{ $city_data->cities_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Postcode') }}*</label>
        <div class="col-sm-10 col-md-8">
            <select id="entry_postcode_edit" class="form-control field-validate" name="entry_postcode">
                <option value="">Select Postcode</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Country') }}</label>
        <div class="col-sm-10 col-md-8">
            <select id="entry_country_id" class="form-control" name="entry_country_id">
                <option value="99">India</option>
                {{--@foreach($data['countries'] as $countries_data)
                <option @if($data['customer_addresses'][0]->entry_country_id == $countries_data->countries_id )
                    selected
                    @endif
                    value="{{ $countries_data->countries_id }}">{{ $countries_data->countries_name }}</option>
                @endforeach--}}
            </select>
        </div>
    </div>

    {{--<div class="form-group selectstate" @if(!is_numeric($data['customer_addresses'][0]->entry_state)) style="display: none" @endif>
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.State') }}*</label>
        <div class="col-sm-10 col-md-8">
            <select class="form-control zoneContent" name="entry_state_box">
                @foreach($data['zones'] as $zones_data)
                <option @if($data['customer_addresses'][0]->entry_zone_id == $zones_data->zone_id )
                    selected
                    @endif
                    value="{{ $zones_data->zone_id }}">{{ $zones_data->zone_name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>--}}

    <div class="form-group otherstate">
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.State') }}*</label>
        <div class="col-sm-10 col-md-8">
            {!! Form::text('entry_state', $data['customer_addresses'][0]->entry_state, array('class'=>'form-control entry_state', 'id'=>'entry_state')) !!}
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.DefaultShippingAddress') }}</label>
        <div class="col-sm-10 col-md-8">
            <select id="is_default" class="form-control" name="is_default">
                <option @if($data['customers'][0]->is_default == 0 )
                    selected
                    @endif
                    value="0">No</option>
                <option @if($data['customers'][0]->is_default == 1 )
                    selected
                    @endif
                    value="1">Yes</option>
            </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
    <button type="button" class="btn btn-primary form-validate" id="updateAddress">{{ trans('labels.Submit') }}</button>
</div>
{!! Form::close() !!}


<script type="text/javascript">

    $(document).ready(function(){

        

        <?php if(isset($data['customer_addresses'])){ ?>
            var entry_city = '<?php echo $data['customer_addresses'][0]->entry_city; ?>';

            if(entry_city==''){
                $('#entry_postcode_edit').val('');
                $('#entry_postcode_edit').html('');
                $('#entry_postcode_edit').append( $('<option></option>').val("").html("Select Postcode") );
            }else{
                $('#entry_postcode_edit').val('');

                $.ajax({
                    type:'POST',
                    url:'{{ url('admin/customers/selectPincodeById') }}',
                    data:{"_token": "{{ csrf_token() }}",entry_city:entry_city},
                    success:function(data){
                        //console.log(data);
                        $('#entry_postcode_edit').html('');
                        $('#entry_postcode_edit').append( $('<option></option>').val("").html("Select Postcode") );
                        $.each(data.pincode_list, function(val, text) {
                            $('#entry_postcode_edit').append( $('<option></option>').val(text.pincodes_id).html(text.pincodes_val) );
                            $('#entry_postcode_edit').val('<?php echo $data['customer_addresses'][0]->entry_postcode; ?>');
                        });
                    }
                });
            }

            $("#entry_city_edit").change(function(){
                var entry_city = $("#entry_city_edit").val();  
                if(entry_city==''){
                    $('#entry_postcode_edit').val('');
                    $('#entry_postcode_edit').html('');
                    $('#entry_postcode_edit').append( $('<option></option>').val("").html("Select Postcode") );
                }else{
                    $('#entry_postcode_edit').val('');

                    $.ajax({
                        type:'POST',
                        url:'{{ url('admin/customers/selectPincodeById') }}',
                        data:{"_token": "{{ csrf_token() }}",entry_city:entry_city},
                        success:function(data){
                            //console.log(data);
                            $('#entry_postcode_edit').html('');
                            $('#entry_postcode_edit').append( $('<option></option>').val("").html("Select Postcode") );
                            $.each(data.pincode_list, function(val, text) {
                                $('#entry_postcode_edit').append( $('<option></option>').val(text.pincodes_id).html(text.pincodes_val) )
                            });
                        }
                    });
                }
            });
        <?php } ?>




    });
    
</script>
