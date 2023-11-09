<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawal Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Withdrawal Transactions</h2>

        <div class="row d-flex">
            <div class="col-md-6">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>

            <div class="col-md-3">
                <a href="{{ url('/show-deposit') }}" class="btn btn-primary">Show Deposit</a>
            </div>
            <div class="col-md-3">
                <a href="{{ url('/withdraw') }}" class="btn btn-primary">Make Withdraw</a>
            </div>
        </div>

        <!-- Display Withdrawal Transactions -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Amount</th>
                    <th>Fee</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($withdrawals as $withdrawal)
                    <tr>
                        <td>{{ $withdrawal->id }}</td>
                        <td>{{ $withdrawal->user_id }}</td>
                        <td>{{ $withdrawal->amount }}</td>
                        <td>{{ $withdrawal->fee }}</td>
                        <td>{{ $withdrawal->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
