<!DOCTYPE html>
<html>
<head>
    <title>Hold Product</title>
</head>
<body>
    <h1>Hold Product</h1>

    <form action="/api/holds" method="POST">
        @csrf

        <div>
            <label for="product_id">Product ID:</label>
            <input type="number" id="product_id" name="product_id">
        </div>

        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity">
        </div>

        <button type="submit">Hold Product</button>
    </form>

</body>
</html>
