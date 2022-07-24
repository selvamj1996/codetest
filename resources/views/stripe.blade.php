@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-5 mb-5">
    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <span>Payment Method</span>
                <div class="card">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <input type="text" class="form-control" placeholder="Paypal email">
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header p-0">
                                <h2 class="mb-0">
                                    <button class="btn btn-light btn-block text-left p-3 rounded-0"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>Credit card</span>
                                            <div class="icons">
                                                <img alt="" src="https://i.imgur.com/2ISgYja.png" width="30">
                                                <img alt="" src="https://i.imgur.com/W1vtnOV.png" width="30">
                                                <img alt="" src="https://i.imgur.com/35tC99g.png" width="30">
                                                <img alt="" src="https://i.imgur.com/2ISgYja.png" width="30">
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body payment-card-body">
                                    <input type="hidden" name="amount" value="{{ $product->price }}">
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Name on Card</label> <input
                                                class='form-control' size='4' type='text'>
                                        </div>
                                    </div>
              
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group card required'>
                                            <label class='control-label'>Card Number</label> <input
                                                autocomplete='off' class='form-control card-number' size='20'
                                                type='text'>
                                        </div>
                                    </div>
              
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group cvc required'>
                                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                                class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-6 form-group expiration required'>
                                            <label class='control-label'>Expir Month</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-6 form-group expiration required'>
                                            <label class='control-label'>Expir Year</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                type='text'>
                                        </div>
                                    </div>
              
                                    <div class='form-row row'>
                                        <div class='col-md-12 error form-group d-none'>
                                            <div class='alert-danger alert'>Please correct the errors and try again.</div>
                                        </div>
                                    </div>
                                    
                                    <span class="text-muted certificate-text"><em class="fa fa-lock"></em> Your
                                        transaction is secured with ssl certificate</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-6">
                <span>Summary</span>

                <div class="card">
                    <div class="d-flex justify-content-between p-3">
                        <div class="d-flex flex-column">
                            <span>Billed Amount <em class="fa fa-caret-down"></em></span>
                        </div>

                        <div class="mt-1">
                            <sup class="super-price">₹ {{ $product->price }}</sup>
                        </div>
                    </div>

                    <hr class="mt-0 line">

                    <div class="p-3 d-flex justify-content-between">
                        <div class="d-flex flex-column">
                            <span>Today you pay</span>
                            <small>₹ {{ $product->price }}</small>
                        </div>
                        <span>₹ {{ $product->price }}</span>
                    </div>
                    <div class="p-3">
                        <button class="btn btn-primary btn-block free-button">Pay (₹ {{ $product->price }})</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function() {
   
    var $form = $(".require-validation");
   
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('d-none');
  
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('d-none');
            e.preventDefault();
          }
        });
   
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
  
  });
  
  function stripeResponseHandler(status, response) {
    console.log(response, status);
        if (response.error) {
            $('.error')
                .removeClass('d-none')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
               
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
   
});
</script>
@endsection