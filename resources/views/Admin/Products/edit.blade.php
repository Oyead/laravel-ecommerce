@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>تعديل المنتج</h2>

        <form action="{{ url('updateProduct/' . $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>اسم المنتج</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
            </div>

            <div class="form-group">
                <label>الوصف</label>
                <textarea name="desc" class="form-control">{{ $product->desc }}</textarea>
            </div>

            <div class="form-group">
                <label>السعر</label>
                <input type="number" name="price" value="{{ $product->price }}" class="form-control">
            </div>

            <div class="form-group">
                <label>الكمية</label>
                <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control">
            </div>

            <div class="form-group">
                <label>الصورة الحالية</label><br>
                <img src="{{ asset('storage/' . $product->image) }}" width="100" alt="">
                <input type="file" name="image" class="form-control mt-2">
            </div>

            <button type="submit" class="btn btn-primary mt-3">تحديث</button>
        </form>
    </div>
@endsection
