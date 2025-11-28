<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                {{-- Grid container for all products --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    {{-- Loop through each product or show an empty message --}}
                    @forelse ($products as $product)
                        <div class="border rounded-lg p-4 flex flex-col">

                            <img src="{{ asset('product_images/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-md h-48 w-full object-cover mb-4">
                            <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                            <p class="text-gray-600">${{ number_format($product->price, 2) }}</p>
                            <p class="text-sm text-gray-500 flex-grow mt-2">{{ $product->desc }}</p>

                            {{-- Action Buttons --}}
                            <div class="mt-4 flex items-center space-x-2">
                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="w-1/2">
                                    @csrf
                                    <button type="submit" class="w-full bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300 transition">
                                        ♡ Wishlist
                                    </button>
                                </form>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-1/2">
                                    @csrf
                                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-gray-500">
                            <p>{{ __('No products have been added yet.') }}</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination links --}}
                <div class="mt-6">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>