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
            <h2>Merchants</h2>
        </div>
        <div class="pull-right">
            @can('merchant-create')
            <a class="btn btn-success" href="{{ route('merchant.create') }}"> Create New Merchant</a>
            @endcan
        </div>
    </div>
</div>
<br>



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            {{-- <th>No</th> --}}
            <th>No</th>
            <th>Merchant Name</th>
            <th>Merchant City</th>
            <th width="280px">Action</th>
        </tr>

        
	    @foreach ($merchant as $row)
	    <tr>
            {{-- {{ dd($row->ID) }} --}}
	        {{-- <td>{{ ++$i }}</td> --}}
	        <td>{{ $row->ID }}</td>
	        <td>{{ $row->MERCHANT_NAME }}</td>
	        <td>{{ $row->MERCHANT_CITY }}</td>
	        <td>
                <form method="POST">
                    <a class="btn btn-info" href="{{ route('merchant.show', ($row->ID) ) }}">Detail</a>
                    
                    @can('merchant-edit')
                    <a class="btn btn-primary" href="{{ route('merchant.edit',($row->ID) ) }}">Edit</a>
                    @endcan

                   
                    @csrf
                  
            <td>
	    </tr>
	    @endforeach
    </table>


    {!! $merchant->links() !!}



@endsection