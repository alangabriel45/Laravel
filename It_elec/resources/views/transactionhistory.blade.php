@include('templates.header')

<x-navbar />

<div class="container my-5">
    <h1 class="mb-4">Transaction History</h1>

    @if($transactions->isEmpty())
        <div class="alert alert-info">
            You have no transactions.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Transaction ID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Payment</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->product->name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>${{ number_format($transaction->payment, 2) }}</td>
                        <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@include('templates.footer')