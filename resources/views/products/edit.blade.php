<h1>Edit Product</h1>

<form method="POST" action="/update-product/{{ $product->id }}">
    @csrf

    <input type="text" name="name" value="{{ $product->name }}"><br><br>

    <textarea name="description">{{ $product->description }}</textarea><br><br>

    <input type="number" name="price" value="{{ $product->price }}"><br><br>

    <input type="text" name="image" value="{{ $product->image }}"><br><br>

    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Update</button>
</form>