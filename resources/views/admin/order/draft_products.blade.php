@extends('admin.layouts.master')
@section('content')
@php
  $business_info = DB::table('settings')->first();
@endphp

<style>
  p {
    line-height: .8 !important;
  }
</style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="mb-0 fw-bold">Draft Order Information</h1>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h4>
                  <img class="bg-dark p-2 rounded shadow" src="{{ asset('images/website/'.optional($business_info)->header_logo.'') }}" width="100" alt="Company Logo">
                </h4>
                <address>
                  <strong>Name:</strong> {{ optional($order)->name }}<br>
                  <strong>Phone:</strong> {{ optional($order)->phone }}<br>
                  <strong>Shipping Address:</strong> {{ optional($order)->shipping_address }}
                </address>
              </div>
              <div class="col-md-6 text-right">
                <address>
                  <strong>Date:</strong> {{ \Carbon\Carbon::parse(optional($order)->created_at)->format('d M, Y g:iA') }}
                </address>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.N</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach(optional($order)->products as $product)
                      <?php
                          $variation_info = '';
                          if($product->variations <> 0) {
                              $stock_info = variation_stock_info($product->variations);
                              if(!is_null($stock_info)) {
                                    if($stock_info->sku <> null){
                                        $product_code = '<b>Code: </b>'.optional($stock_info)->sku.', ';
                                    }
                                    else {
                                        $product_code = '';
                                    }

                                  if($stock_info->color <> null){
                                      $color_attribute_info = color_info($stock_info->color);
                                      $color_info = '<b>Color: </b>'.optional($color_attribute_info)->name.', ';
                                  }
                                  else {
                                      $color_info = '';
                                  }

                                  if($stock_info->variant <> null){
                                      $variant_attribute_info = variation_info($stock_info->variant);
                                      $attribute_info = '<b>'.optional($variant_attribute_info)->title.': </b>'.optional($stock_info)->variant_output.'';
                                  }
                                  else {
                                      $attribute_info = '';
                                  }
                                  $variation_info = $product_code.$color_info.$attribute_info;
                              }
                          }

                      ?>
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $product->product->title }}<br><span class="cart__content--variant">{!! $variation_info !!}</span></td>
                        <td>{{ env('CURRENCY') }}{{ $product->price }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ env('CURRENCY') }}{{ $product->price * $product->qty }}</td>
                      </tr>
                    @endforeach
                    <tr>
                      <td colspan="4" align="right">Subtotal:</td>
                      <td>{{ env('CURRENCY') }}{{ $order->price??0 }}</td>
                    </tr>
                   
                    <tr>
                      <td colspan="4" align="right">Delivery Charge:</td>
                      
                      <td>{{ env('CURRENCY') }}{{ optional($order)->delivery_charge??0}}</td>
                      
                    </tr>
                    <tr>
                      <td colspan="4" align="right">Total:</td>
                      <td>{{ env('CURRENCY') }}{{ optional($order)->price + optional($order)->delivery_charge }} </td> 
                    </tr>
                  </tbody>
                </table>
                <p><strong>Order note:</strong> {{ optional($order)->note }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  function changeCourierType() {
    let courierType = $('#courier_type').val();
    
    $.ajax({
          type: 'get',
          url: "{{route('order.getZoneInfoFromCourierType')}}",
          data: {
              'courierType': courierType,
          },
          beforeSend: function() {
              $('#cityZoneAreaBody').html('<div class="text-center col-md-12"><div class="spinner-border text-dark mb-5" role="status"><span class="sr-only">Loading...</span></div></div>');
          },
          success: function (data) {
              $('#cityZoneAreaBody').html(data);
          }
      });
  }
</script>

@endsection
