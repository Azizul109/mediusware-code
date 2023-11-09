<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposited Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Deposited Transactions</h2>

        <div class="row d-flex">
            <div class="col-md-6">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>

            <div class="col-md-3">
                <a href="{{ url('/deposit') }}" class="btn btn-primary">Make Deposit</a>
            </div>
            <div class="col-md-3">
                <a href="{{ url('/show-withdrawal') }}" class="btn btn-primary">Show Withdraw</a>
            </div>
        </div>

        <!-- Display Deposited Transactions -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deposits as $deposit)
                    <tr>
                        <td>{{ $deposit->id }}</td>
                        <td>{{ $deposit->user_id }}</td>
                        <td>{{ $deposit->amount }}</td>
                        <td>{{ $deposit->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
