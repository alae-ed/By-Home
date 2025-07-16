@extends('layouts.client')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('أطباقي المفضلة ❤️') }}</h2>

        @if ($dishes->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($dishes as $dish)
                    <div class="bg-white shadow-md rounded-xl overflow-hidden flex flex-col justify-between">
                        <!-- صورة الطبق -->
                        <img src="{{ asset('storage/' . $dish->image) }}" class="h-48 w-full object-cover" alt="{{ $dish->name }}">

                        <!-- محتوى البطاقة -->
                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $dish->name }}</h3>
                            <p class="text-sm text-gray-500 mb-2 line-clamp-2">{{ $dish->description }}</p>

                            <div class="text-orange-600 font-bold mb-4 mt-auto">
                                {{ number_format($dish->price, 2) }} {{ __('درهم') }}
                            </div>
                            <a href="{{ route('client.orders.create', ['cook' => $dish->cook_id, 'dish' => $dish->id]) }}" 
                                   class="w-full inline-flex justify-center items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-medium text-white hover:bg-orange-600 transition duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    {{ __('اطلب الآن') }}
                                </a>

                            <!-- زر الإزالة -->
                            <button type="button"
                                class="remove-favorite-btn text-sm text-red-500 hover:text-red-600 flex items-center gap-1 self-start"
                                data-dish-id="{{ $dish->id }}">
                                <i class="fas fa-heart-broken"></i>
                                {{ __('إزالة من المفضلة') }}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ترقيم الصفحات -->
            <div class="mt-8">
                {{ $dishes->links() }}
            </div>
        @else
            <div class="text-center py-12 text-gray-500">
                <i class="fas fa-heart text-4xl mb-4"></i>
                <p>{{ __('لم تُضف أي طبق إلى المفضلة بعد') }}</p>
                <a href="{{ route('client.dishes.index') }}"
                   class="mt-4 inline-block px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">
                    {{ __('تصفح الأطباق') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js "></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.remove-favorite-btn').forEach(button => {
        button.addEventListener('click', function () {
            const dishId = this.dataset.dishId;
            const card = this.closest('.bg-white');

            if (!dishId || !card) return;

            axios.post("{{ route('client.favorites.toggle') }}", {
                dish_id: dishId
            }, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.data.status === 'removed') {
                    // تأثير لطيف قبل الإزالة
                    card.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        card.remove();
                    }, 300);
                }
            })
            .catch(error => {
                console.error('{{ __('حدث خطأ أثناء الإزالة:') }}', error);
                alert('{{ __('تعذر إزالة الطبق من المفضلة') }}');
            });
        });
    });
});
</script>
@endpush