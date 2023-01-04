@extends('adminlte::page')

@section('title', 'Dashboard')


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!'); 
</script>
@stop


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Merchant</h2>
            </div>
            <div class="pull-right">
               
            </div>
        </div>
    </div>
    
	
	
	



    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('merchant.store') }}" method="POST">
    	@csrf

		
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group" >
					<strong>Merchant ID : </strong>
					<input type="text" name="MERCHANT_ID" class="form-control col-3" value={{ $custom_id }} placeholder="Name" readonly>
				</div>
				<div class="form-group">
		            <strong>Nomor Rekening : </strong>
		            <input type="text" name="REKENING_NUMBER" class="form-control col-3 " placeholder="Name">
		        </div>
		        <div class="form-group">
		            <strong>Merchant Name :</strong>
		            <input type="text" name="MERCHANT_NAME" class="form-control col-3" placeholder="Name">
		        </div>
		        <div class="form-group">
		            <strong>Merchant City :</strong>
		            <input type="text" name="MERCHANT_CITY" class="form-control col-3" placeholder="Name">
		        </div>
		        <div class="form-group">
		            <strong>Merchant Address : </strong>
		            <input type="text" name="MERCHANT_ADDRESS" class="form-control col-3" placeholder="Name">
		        </div>
				
		        <div class="form-group">
		            <strong>Category : </strong>
		            <input type="text" name="CATEGORY" class="form-control col-3" placeholder="Name">
		        </div>
				<div class="form-group"> 
                    <strong>Merchant Type  : </strong>
                    <select class="form-control col-3" name="MERCHANT_TYPE">
						<option selected >  Select --- </option>
						@foreach ($getMcc as $dropdown)
                        <option >  {{ $dropdown->CODE_MCC }} </option>
						@endforeach
                    </select>
                </div>
				
				<div class="form-group"> 
                    <strong>QR Type  : </strong>
                    <select class="form-control col-3" name="TYPE_QR">
						<option selected> Select -- </option>
                        <option> Statis </option>
                        <option> Dynamic </option>
                    </select>

                </div>
		        <div class="form-group">
		            <strong>Postal Code : </strong>
		            <input type="text" name="POSTAL_CODE" class="form-control col-3" placeholder="Name">
		        </div>
		        <div class="form-group">
		            <strong>Criteria  : </strong>
                    <select class="form-control col-3" name="CRITERIA">
                        <option selected> Select -- </option>
                        <option> UMI </option>
                        <option> UKE </option>
                        <option> UME </option>
                        <option> UBE </option>
                    </select>
		        </div>
				<div class="form-group"> 
					<strong>Status  : </strong>
					<select class="form-control col-3" name="STATUS">
						<option selected value="1" > Active </option>
						<option value='0'> Non Active </option>
					</select>
				</div>
		        <div class="form-group" hidden >
		            <strong>TERMINAL_LABEL  : </strong>
		            <input type="text" name="TERMINAL_LABEL" class="form-control col-3" placeholder="Name" value="360" readonly >
		        </div>
		        <div class="form-group" hidden>
		            <strong>MERCHANT_CURRENCY_CODE  : </strong>
		            <input type="text" name="MERCHANT_CURRENCY_CODE" class="form-control col-3" placeholder="Name" value="360" readonly >
		        </div>
		        <div class="form-group" hidden >
		            <strong>QRIS_MERCHANT_DOMESTIC_ID  : </strong>
		            <input type="text" name="QRIS_MERCHANT_DOMESTIC_ID" class="form-control col-3" placeholder="Name" value="360" readonly >
		        </div>
		        <div class="form-group" hidden >
		            <strong>MERCHANT_COUNTRY  : </strong>
		            <input type="text" name="MERCHANT_COUNTRY" class="form-control col-3" placeholder="Name" value="ID" readonly >
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        {{-- <div class="form-group">
		            <strong>Detail:</strong>
		            <textarea class="form-control col-3" style="height:150px" name="detail" placeholder="Detail"></textarea>
		        </div> --}}
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-primary" href="{{ route('merchant.index') }}"> Back</a>
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


@endsection