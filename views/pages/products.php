<!-- products.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <style>
        /* Ajoutez votre CSS pour le style des produits ici */
        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        h2, p {
            margin: 0;
        }

        p.price {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Products Page</h1>

    <?php foreach ($products as $product): ?>
        <div class="product">
            <h2><?= htmlspecialchars($product->getName()); ?></h2>
            <p><?= htmlspecialchars($product->getDescription()); ?></p>
            <p class="price">Price: $<?= htmlspecialchars($product->getPrice()); ?></p>
        </div>
    <?php endforeach; ?>

</body>

</html>
