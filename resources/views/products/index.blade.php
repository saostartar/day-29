<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .form-inline .form-control {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4 display-4">Product Management</h1>
    
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('products.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Create Product
            </a>
            <form method="GET" action="{{ route('products.index') }}" class="form-inline">
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ request('name') }}">
                <input type="number" class="form-control" name="price" placeholder="Price" value="{{ request('price') }}">
                <input type="number" class="form-control" name="stock" placeholder="Stock" value="{{ request('stock') }}">
    
                <select class="form-control" name="sort_by">
                    <option value="">Sort by</option>
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Price</option>
                    <option value="stock" {{ request('sort_by') == 'stock' ? 'selected' : '' }}>Stock</option>
                </select>
    
                <select class="form-control" name="sort_order">
                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
    
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-filter"></i> Apply
                </button>
            </form>
        </div>
    
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            <strong>Price:</strong> ${{ $product->price }} <br>
                            <strong>Stock:</strong> {{ $product->stock }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>