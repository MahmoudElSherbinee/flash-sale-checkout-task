<!DOCTYPE html>
<html>
<head>
    <title>Hold Product</title>
</head>
<body>
    <h1>Hold Product</h1>

    <form action="/api/orders" method="POST">
        @csrf

        <div>
            <label for="hold_id">Hold ID:</label>
            <input type="number" id="hold_id" name="hold_id">
        </div>


        <button type="submit">Hold Product</button>
    </form>

</body>
</html>
