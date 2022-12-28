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
            <h2>Test HIT </h2>
        </div>
        {{-- <div class="pull-right">
            @can('product-create')
            <a class="btn btn-success" href="{{ route('products.create') }}"> New </a>
            @endcan
        </div> --}}
    </div>
</div>


<form action="{{ route('qris.hit') }}" method="POST">
    @csrf


     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>QR Type :</strong>
                <input type="number" name="qrType" class="form-control" >
            </div>
            <div class="form-group">
                <strong>MERCHANT_ID:</strong>
                <input type="number" name="MERCHANT_ID" class="form-control" >
            </div>
            <div class="form-group">
                <strong>AMOUNT:</strong>
                <input type="number" name="AMOUNT" class="form-control" >
            </div>
            <div class="form-group">
                <strong>TIP_INDICATOR:</strong>
                <input type="number" name="TIP_INDICATOR" class="form-control" >
            </div>
            <div class="form-group">
                <strong>FEE_AMOUNT:</strong>
                <input type="number" name="FEE_AMOUNT" class="form-control" >
            </div>
            <div class="form-group">
                <strong>FEE_AMOUNT_PERCENTAGE:</strong>
                <input type="number" name="FEE_AMOUNT_PERCENTAGE" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>


</form>



@endsection