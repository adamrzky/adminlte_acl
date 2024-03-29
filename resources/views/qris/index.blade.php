@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style type="text/css">
        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Generate QRIS </h1>
                </div>
            </div>
        </div>
    </section>

    @if (!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <script>
            $(function() {
                $('#modalQr').modal('modalQr');
            });
        </script>
    @endif


    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form action="{{ route('qris.hit') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            {{-- <div class="form-group col-6">
                            <label>QR Type :</label>
                            <select class="form-control" name="qrType" id="qrType" required>
                                @foreach ($qrType as $dropdown)
                                    <option value="{{ $dropdown['id'] }}"> {{ $dropdown['id'] }}  -  {{ $dropdown['desc'] }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                            <div class="form-group col-6">
                                <label>Merchant Code:</label>
                                <select class="form-control" name="MERCHANT_ID" id="MERCHANT_ID" required>
                                    @foreach ($merchant as $dropdown)
                                        <option value="{{ $dropdown['ID'] }}"> {{ $dropdown['MERCHANT_CODE'] }} -
                                            {{ $dropdown['MERCHANT_NAME'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>AMOUNT:</label>
                                <input type="number" id="AMOUNT" name="AMOUNT" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label>TIP_INDICATOR:</label>
                                <input type="number" id="TIP_INDICATOR" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label>FEE_AMOUNT:</label>
                                <input type="number" id="FEE_AMOUNT" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label>FEE_AMOUNT_PERCENTAGE:</label>
                                <input type="number" id="FEE_AMOUNT_PERCENTAGE" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center card-footer">
                        <button type="button" class="btn btn-success" id="store">Submit</button>
                        {{-- <button type="submit" class="btn btn-danger">Submit</button> --}}
                    </div>
            </div>
            </form>
        </div>
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
                    <div id="previewQr"></div>
                    <br>
                    <div>
                        <h5 id="errorResp"> </h5>
                    </div>
                </div>
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

            // define variable
            let qrType = $('#qrType').val();
            let MERCHANT_ID = $('#MERCHANT_ID').val();
            let AMOUNT = $('#AMOUNT').val();
            let TIP_INDICATOR = $('#TIP_INDICATOR').val();
            let FEE_AMOUNT = $('#FEE_AMOUNT').val();
            let FEE_AMOUNT_PERCENTAGE = $('#FEE_AMOUNT_PERCENTAGE').val();
            let token = $("meta[name='csrf-token']").attr("content");

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
                success: function(response) {

                    // console.log(response.qr);
                    // console.log(response.qr);
                    // $("#response").html(response);
                    $("#modalQr").modal('show');
                    // $('#modal-body-isi').html(response.qr);
                    $('#previewQr').html(`<img src="data:image/png;base64,` + response.qr + `" \>`);
                    $('#errorResp').html(JSON.stringify(response.error));
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
                error: function(error) {
                    // console.log(error)


                    // if(error.response.qr[0]) {
                    $("#modalQr").modal('show');
                    //     //show alert
                    //     $('#alert-title').removeClass('d-none');
                    //     $('#alert-title').addClass('d-block');

                    //     //add message to alert
                    //     $('#alert-title').html(error.responseJSON.title[0]);
                    // } 

                    // if(error.responseJSON.content[0]) {

                    //     //show alert
                    //     $('#alert-content').removeClass('d-none');
                    //     $('#alert-content').addClass('d-block');

                    //     //add message to alert
                    //     $('#alert-content').html(error.responseJSON.content[0]);
                    // } 

                }

            });
        });
    </script>

@endsection
