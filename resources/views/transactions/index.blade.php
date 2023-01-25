@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
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

<div class="card-body">
   <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
         <tr>
            <th>NO</th>
            <th>MERCHANT_ID</th>
            <th>AMOUNT_TIP_PERCENTAGE</th>
            <th>AMOUNT</th>
            <th>EXPIRE_DATE_TIME</th>
            <th>CREATED_AT</th>
            {{-- <th>UPDATED_AT</th> --}}
            <th>TRANSACTION_ID</th>
            {{-- <th>DESCRIPTION</th> --}}
            {{-- <th>TRANSACTION_TYPE</th> --}}
            {{-- <th>QRIS</th> --}}
            <th>TIP_INDICATOR</th>
            <th>FEE_AMOUNT</th>
            {{-- <th>STATUS</th> --}}
            <th>STATUS_TRANSFER</th>
            {{-- <th>POSTAL_CODE</th> --}}
            <th>AMOUNT_REFUND</th>
            <th>RETRIEVAL_REFERENCE_NUMBER</th>
            {{-- <th>Action</th> --}}
         </tr>
      </thead>
      <tbody>

      </tbody>
   </table>
</div>


@endsection

@section('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
      $('#tbl_list').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{ route('transactions.data') }}",
         columns: [{
               render: function(data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
               },
            },
            {
               data: 'MERCHANT_ID'
            },
            {
               data: 'AMOUNT_TIP_PERCENTAGE'
            },
            {
               data: 'AMOUNT'
            },
            {
               data: 'EXPIRE_DATE_TIME'
            },
            {
               data: 'CREATED_AT'
            },
            // {
            //    data: 'UPDATED_AT'
            // },
            {
               data: 'TRANSACTION_ID'
            },
            // {
            //    data: 'DESCRIPTION'
            // },
            // {
            //    data: 'TRANSACTION_TYPE'
            // },
            // {
            //    data: 'QRIS'
            // },
            {
               data: 'TIP_INDICATOR'
            },
            {
               data: 'FEE_AMOUNT'
            },
            // {
            //    data: 'STATUS'
            // },
            {
               data: 'STATUS_TRANSFER'
            },
            // {
            //    data: 'POSTAL_CODE'
            // },
            {
               data: 'AMOUNT_REFUND'
            },
            {
               data: 'RETRIEVAL_REFERENCE_NUMBER'
            },
            // {
            //    render: function(data, type, row) {
            //       return '<button class="btn btn-primary btn-sm" onclick="terima(' + row.id + ')">Lihat</button>'
            //    }
            // }
         ],
      });
   });
</script>
@endsection