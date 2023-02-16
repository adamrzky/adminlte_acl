@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop



@section('content')


<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1> Refund </h1>
			</div>
		</div>
	</div>
</section>

@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
@if ($message = Session::get('errors'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
@endif

	{{-- @if ($errors->any())
	<div class="alert alert-danger">
		<label>Whoops!</label> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif --}}


<div class="row">
	<div class="col-md-12">
		<div class="card card-default">
			<form action="{{ route('refund.hit') }}" method="POST">
				@csrf
				<div class="card-body">
                    <div class="row">
						<div class="form-group col-7">
							<label>Select RNN </label>
							<select class="form-control" name="RRN" id="RRN" required>
                                <option value="">Select RRN</option>
								@foreach ($data as $dropdown)
                                <option value="{{ $dropdown['RETRIEVAL_REFERENCE_NUMBER'] }}" data-fetch="{{ $dropdown['AMOUNT'] }}" > {{ $dropdown['RETRIEVAL_REFERENCE_NUMBER'] }}  </option>
								@endforeach
							</select>
						</div>
                        <div class="form-group col-7">
                            <label>Transaction Amount:</label>                        
                            <input type="number" id="AMOUNTS" name="AMOUNTS" class="form-control"readonly>
                        </div>
                        <div class="form-group col-7">
                            <label>Input Amount:</label>
							@foreach ($data as $dropdown)
							{{-- {{ dd($dropdown['AMOUNT'])}} --}}
								@if(is_int($dropdown['AMOUNT']) && $dropdown['AMOUNT']  > 0)
									<input type="number" id="AMOUNT" name="AMOUNT" class="form-control" min="1" max="{{$dropdown['AMOUNT']}}"  required>
								@else
									<p>"Error: Data received is not an integer or number or its bigger than amount"</p>
								@endif
								@break
							@endforeach
                        
                        </div>

                          
                          
                          
                          <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
					</div>
				</div>
 

				<div class="card-footer">
					<a class="btn btn-info" href="{{ route('merchant.index') }}">Back</a>
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
				</div>
			</form>
		</div>
	</div>
</div>

     <!-- Script -->
     <script>

      $(document).ready(function() {
        $('#RRN').on('change', function() {
          const selected = $(this).find('option:selected');
          const out = selected.data('fetch'); 

          $("#AMOUNTS").val(out);
        });
      });
    </script>

@endsection