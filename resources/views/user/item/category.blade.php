@extends('app')

@section('css')
<style>
    .category-section {
        padding: 2rem 1rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #222;
        margin-bottom: 0.8rem;
    }

    .section-description {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.6;
        max-width: 700px;
        margin: 0 auto;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        padding: 0 1rem;
    }

    .category-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .category-image-container {
        height: 180px;
        position: relative;
        overflow: hidden;
    }

    .category-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .category-card:hover .category-image {
        transform: scale(1.03);
    }

    .category-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .category-name {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
        color: #222;
    }

    .category-description {
        color: #666;
        line-height: 1.5;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .explore-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.7rem 1.5rem;
        background-color: #4a6cf7;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        width: fit-content;
        margin-top: auto;
    }

    .explore-link:hover {
        background-color: #3a5ce4;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .explore-link i {
        margin-left: 8px;
        transition: transform 0.2s ease;
    }

    .explore-link:hover i {
        transform: translateX(3px);
    }

    @media (max-width: 768px) {
        .category-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 0;
        }

        .category-image-container {
            height: 160px;
        }

        .category-content {
            padding: 1.2rem;
        }

        .section-title {
            font-size: 1.6rem;
        }

        .section-description {
            font-size: 1rem;
            padding: 0 1rem;
        }
    }
</style>
@endsection

@section('content')
    <div class="category-section">
        <div class="section-header">
            <h2 class="section-title">Pilih Kategori Sesuai Kebutuhanmu</h2>
            <p class="section-description">
                Kami melayani berbagai kebutuhan cetak Anda, baik untuk keperluan indoor maupun outdoor,
                dengan kualitas terbaik dan harga bersaing.
            </p>
        </div>

        <div class="category-grid">
            @foreach($categories as $category)
            <div class="category-card">
                <a href="{{ route('user.items.index', ['category' => $category->id]) }}" class="category-image-container">
                    <img src="{{ asset($category->image ? 'assets/img/' . $category->image : 'assets/img/noimage.jpg') }}"
                         alt="{{ $category->name }}"
                         class="category-image">
                </a>
                <div class="category-content">
                    <h3 class="category-name">{{ $category->name }}</h3>
                    <p class="category-description">
                        {{ $category->description ?? 'Discover our curated selection of products in this category.' }}
                    </p>
                    <a href="{{ route('user.items.kategori', $category->id) }}" class="explore-link">
                        Explore <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
