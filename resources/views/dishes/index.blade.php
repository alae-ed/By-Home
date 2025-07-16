@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- شريط البحث -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('client.dishes.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                           placeholder="ابحث عن أطباق..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- عرض الأطباق -->
    <div class="row">
        @forelse ($dishes as $dish)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($dish->image)
                        <img src="{{ asset('storage/'.$dish->image) }}" 
                             class="card-img-top dish-image" 
                             alt="{{ $dish->name }}"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="placeholder-image bg-light d-flex align-items-center justify-content-center"
                             style="height: 200px;">
                            <i class="fas fa-utensils fa-3x text-muted"></i>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $dish->name }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($dish->description, 100) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if($dish->cook)
                                    <span class="badge bg-info">
                                        <i class="fas fa-user-chef"></i> {{ $dish->cook->name }}
                                    </span>
                                @endif
                                <span class="ms-2 badge bg-success">
                                    {{ $dish->price }} درهم
                                </span>
                            </div>
                            <a href="{{ route('client.orders.create', ['cook' => $dish->cook_id, 'dish' => $dish->id]) }}" 
                               class="btn btn-sm btn-primary">
                               <i class="fas fa-shopping-cart"></i> طلب
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>لا توجد أطباق متاحة حالياً</h4>
                    <p>يمكنك المحاولة بتعديل كلمات البحث</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- التقسيم الصفحي -->
    <div class="d-flex justify-content-center mt-4">
        {{ $dishes->links() }}
    </div>
</div>
@endsection