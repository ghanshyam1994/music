@if($action == 'reset_password')
<div>
    Hi, {{ $name }} Your password has been changed.<br>
    Your password is: {{ $password }}
</div>
@elseif($action == 'user_registration')
<div>
    Hi, {{ $name }} Your account has been created with FAWRUN.<br>
    Thanks to Join Us.
</div>
@elseif($action == 'order_placed')
<div>
    Hi, {{ $name }} Your order has been confirmed.<br>
    your order Id : 'FAWRUN' {{  $order_id }} <br>
    Enjoy and stay connected with FAWRUN.
</div>
@endif
