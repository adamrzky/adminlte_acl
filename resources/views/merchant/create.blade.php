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
		        <div class="form-group">
                    {{-- <div class="form-group">
                        <strong>Merchant ID : </strong>
                        <input type="text" name="MERCHANT_ID" class="form-control col-3" placeholder="Name">
                    </div> --}}
		            <strong>Nomor Rekening : </strong>
		            <input type="text" name="REKENING_NUMBER" class="form-control col-3 " placeholder="Name">
		        </div>
		        <div class="form-group">
		            <strong>Nama Merchant :</strong>
		            <input type="text" name="MERCHANT_NAME" class="form-control col-3" placeholder="Name">
		        </div>
		        <div class="form-group">
		            <strong>Alamat Merchant : </strong>
		            <input type="text" name="MERCHANT_ADDRESS" class="form-control col-3" placeholder="Name">
		        </div>
		        <div class="form-group">
		            <strong>Kategori : </strong>
		            <input type="text" name="CATEGORY" class="form-control col-3" placeholder="Name">
		        </div>
		        <div class="form-group">
		            <strong>Kriteria : </strong>
		            <input type="text" name="CRITERIA" class="form-control col-3" placeholder="Name">
		        </div>
		        <div class="form-group">
		            <strong>Country Code  : </strong>
		            <input type="text" name="MERCHANT_CURRENCY_CODE" class="form-control col-3" placeholder="Name" value="360" >
		        </div>
                <div> 
                    <strong>Status  : </strong>
                    <select class="form-control col-3" name="STATUS">
                        <option selected> 1 </option>
                        <option> 0 </option>
                    </select>
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