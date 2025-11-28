<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-green-500 text-green-700 border-l-4 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if($cartItems->isEmpty())
                    <p class="text-center text-gray-500">Your cart is empty.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->product->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($item->product->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 text-center border-gray-300 rounded-md">
                                            <button type="submit" class="ml-2 text-xs text-blue-500 hover:underline">Update</button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:underline">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right mt-6">
                        <h3 class="text-xl font-bold">Grand Total: ${{ number_format($total, 2) }}</h3>
                        <a href="#" class="inline-block mt-4 px-6 py-3 bg-green-500 text-white font-bold rounded-lg hover:bg-green-600">
                            Proceed to Checkout
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>