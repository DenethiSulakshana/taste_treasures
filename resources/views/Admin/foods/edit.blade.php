<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Edit Food</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.foods.update', $food->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="name" value="{{ $food->name }}" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Category</label>
                <select name="category" class="w-full p-2 border rounded">
                    <option value="Bins" {{ $food->category == 'Snacks' ? 'selected' : '' }}>Snacks</option>
                    <option value="Compost Bins" {{ $food->category == 'Main meals' ? 'selected' : '' }}>Main meals</option>
                    <option value="Compost & Fertilizer" {{ $food->category == 'Beverages' ? 'selected' : '' }}>Beverages</option>
                    <option value="Other foods" {{ $food->category == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" class="w-full p-2 border rounded">{{ $food->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Price</label>
                <input type="text" name="price" value="{{ $food->price }}" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Stock Level</label>
                <input type="number" name="stock_level" value="{{ $food->stock_level }}" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Image</label>
                <input type="file" name="image" class="w-full p-2 border rounded">
                @if ($food->image_path)
                    <img src="{{ Storage::url($food->image_path) }}" alt="{{ $food->name }}" class="w-32 mt-2">
                @endif
            </div>

            <div>
                <button type="submit" class="bg-green-500 text-white p-2 rounded">Update Food</button>
            </div>
        </form>
    </div>
</body>
</html>
