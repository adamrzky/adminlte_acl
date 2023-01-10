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
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" >
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<style type="text/css">
    .left    { text-align: left;}
    .right   { text-align: right;}
    .center  { text-align: center;}
    .justify { text-align: justify;}
 </style>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Test HIT </h2>
        </div>
    </div>
</div>





{{-- @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
$(function() {
    $('#modalQr').modal('modalQr');
});
</script>
@endif --}}


<form action="{{ route('qris.hit') }}" method="POST">
    @csrf


     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>QR Type :</strong>
                <input type="number" id="qrType" class="form-control" value="1" >
            </div>
            <div class="form-group">
                <strong>MERCHANT_ID:</strong>
                <input type="number" id="MERCHANT_ID" class="form-control" value="1" >
            </div>
            <div class="form-group">
                <strong>AMOUNT:</strong>
                <input type="number" id="AMOUNT" class="form-control" value="1" >
            </div>
            <div class="form-group">
                <strong>TIP_INDICATOR:</strong>
                <input type="number" id="TIP_INDICATOR" class="form-control" >
            </div>
            <div class="form-group">
                <strong>FEE_AMOUNT:</strong>
                <input type="number" id="FEE_AMOUNT" class="form-control" >
            </div>
            <div class="form-group">
                <strong>FEE_AMOUNT_PERCENTAGE:</strong>
                <input type="number" id="FEE_AMOUNT_PERCENTAGE" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        
            {{-- <button type="submit" class="btn btn-primary"  >Submit</button> --}}
            {{-- <button type="button" class="btn btn-success" id="btn-qr" > modal Ajax </button> --}}
            <button type="button" class="btn btn-primary" id="store">Submit</button>
      
        </div>
    </div>

    


    <div class="modal" id="modalQr" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content center">
            <div class="modal-header">
              <h5 class="modal-title">Generate QR </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

             {{-- <div id="modal-body-isi">  --}}
                <div id="previewQr"></div>

                

                
                 
             
                      
                
             

          </div>
         
        </div>
      </div>
        
    <script>
        //button create post event
        // $('body').on('click', '#btn-qr', function () {
    
        //open modal
        // $('#modalQr').modal('show');
        //  });
   
    
        //action create post
        $('#store').click(function(e) {
            e.preventDefault();
    
            //define variable
            let qrType = $('#qrType').val();
            let MERCHANT_ID = $('#MERCHANT_ID').val();
            let AMOUNT = $('#AMOUNT').val();
            let TIP_INDICATOR = $('#TIP_INDICATOR').val();
            let FEE_AMOUNT = $('#FEE_AMOUNT').val();
            let FEE_AMOUNT_PERCENTAGE = $('#FEE_AMOUNT_PERCENTAGE').val();
            let token   = $("meta[name='csrf-token']").attr("content");
            
            //ajax
            $.ajax({
    
                url: `qris/hit`,
                type: "POST",
                cache: false,
                data: {
                    "qrType": qrType,
                    "MERCHANT_ID": MERCHANT_ID,
                    "AMOUNT": AMOUNT,
                    "FEE_AMOUNT": FEE_AMOUNT,
                    "FEE_AMOUNT_PERCENTAGE": FEE_AMOUNT_PERCENTAGE,
                    "_token": token
                },
                success:function(response){

                    // console.log(response.qr);
                    // $("#response").html(response);
                    $("#modalQr").modal('show');
                    // $('#modal-body-isi').html(response.qr);
                    $('#previewQr').html(`<img src="data:image/jpeg;base64,`+response.qr+`" \>`);
                    // $('#previewQr').attr("img_src", $(response.qr).val());
                    // $("#previewQr").attr('src',+response.qr+);
                    // $("#previewQr").html('<img src="' + response.qr + '" />');
                    // $("#previewQr").html('<img src="' + response.qr + '" />');
                    
                   
                  
                        
    
                    //show success message
                    // Swal.fire({
                    //     type: 'success',
                    //     icon: 'success',
                    //     title: `${response.data}`,
                    //     showConfirmButton: true,
                    //     // timer: 3000
                    // });
    
        
                   
                    

                    //data post
              
                    

                    
    
    
                    // //close modal
                    // $('#modal-create').modal('hide');
                    
    
                },
                error:function(error){
                console.log(error)    
                //     if(error.response.qr[0]) {
    
                //         //show alert
                //         $('#alert-title').removeClass('d-none');
                //         $('#alert-title').addClass('d-block');
    
                //         //add message to alert
                //         $('#alert-title').html(error.responseJSON.title[0]);
                //     } 
    
                //     if(error.responseJSON.content[0]) {
    
                //         //show alert
                //         $('#alert-content').removeClass('d-none');
                //         $('#alert-content').addClass('d-block');
    
                //         //add message to alert
                //         $('#alert-content').html(error.responseJSON.content[0]);
                //     } 
    
                }
    
            });

            // $.ajax({
			// 			type: 'GET',
			// 			data: {
            //             "title": title,
            //             "content": content,
            //             "qrType": qrType,
            //             "MERCHANT_ID": MERCHANT_ID,
            //             "AMOUNT": AMOUNT,
            //             "FEE_AMOUNT": FEE_AMOUNT,
            //             "FEE_AMOUNT_PERCENTAGE": FEE_AMOUNT_PERCENTAGE,
            //             "_token": token
            //         },
			// 			url: "{{url('qris/hit')}}",
			// 			success: function(data) {
			// 				$('#response').html(data.msg);
			// 			}
			// 		});
    
        });
    
    </script>



  
 


@endsection 