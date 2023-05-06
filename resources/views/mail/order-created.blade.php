<x-mail::message>
# Hello {{ $notifiable->name }}

A new Order Was created <a href="{{ route('my-account.orders.show',$order) }}">#{{ $order->id }}</a>

<x-mail::table>
| Product       | Qty  | Price |
| :------------ |:----:| -----:|
@foreach ($order->products as $product)
| {{ \Illuminate\Support\Str::limit($product->title, 100, $end='...')    }} | {{ $product->pivot->quantity }} | {{ $product->selling_price }} |
@endforeach

</x-mail::table>

<p style='text-align: right;'><b>Order Total: </b>{{$order->order_total}}</p>

<x-mail::panel>
Please Clear the payment within 3 days @if (!$order->isPaid) <a href="{{ route('my-account.orders.show',$order) }}">Pay now</a> @endif
</x-mail::panel>

<x-mail::button :url="route('my-account.orders.show',$order)">
View Order
</x-mail::button>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>