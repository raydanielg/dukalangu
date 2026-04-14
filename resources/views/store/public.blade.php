<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $store->name }} - {{ config('app.name') }} Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #dc2626;
            --primary-dark: #b91c1c;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }

        .store-header {
            background: white;
            padding: 40px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .store-logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #f3f4f6;
        }

        .store-name {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
        }

        .store-description {
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .contact-btn.phone {
            background: #dcfce7;
            color: #16a34a;
        }

        .contact-btn.whatsapp {
            background: #d1fae5;
            color: #059669;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f3f4f6;
        }

        .product-info {
            padding: 16px;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
        }

        .order-btn {
            width: 100%;
            padding: 10px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .order-btn:hover {
            background: var(--primary-dark);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .footer {
            background: white;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- Store Header -->
    <header class="store-header">
        <div class="container text-center">
            @if($store->logo)
                <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="store-logo mb-3">
            @else
                <div class="store-logo d-inline-flex align-items-center justify-content-center bg-light mb-3">
                    <i data-lucide="store" style="width: 40px; height: 40px; color: #9ca3af;"></i>
                </div>
            @endif
            <h1 class="store-name">{{ $store->name }}</h1>
            <p class="store-description">{{ $store->description }}</p>
            
            <div class="mt-4 d-flex justify-content-center gap-3">
                <a href="tel:+255{{ $store->phone }}" class="contact-btn phone">
                    <i data-lucide="phone"></i>
                    Call +255 {{ $store->phone }}
                </a>
                @if($store->whatsapp)
                <a href="https://wa.me/255{{ $store->whatsapp }}" target="_blank" class="contact-btn whatsapp">
                    <i data-lucide="message-circle"></i>
                    WhatsApp
                </a>
                @endif
            </div>
        </div>
    </header>

    <!-- Products -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Products</h2>
            
            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="product-card">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                            @else
                                <div class="product-image d-flex align-items-center justify-content-center bg-light">
                                    <i data-lucide="package" style="width: 40px; height: 40px; color: #9ca3af;"></i>
                                </div>
                            @endif
                            <div class="product-info">
                                <h5 class="product-name">{{ $product->name }}</h5>
                                <p class="text-muted small mb-2">{{ Str::limit($product->description, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="product-price">TSh {{ number_format($product->price, 0) }}</span>
                                    <span class="badge bg-success">{{ $product->stock_quantity }} in stock</span>
                                </div>
                                <a href="https://wa.me/255{{ $store->whatsapp ?? $store->phone }}?text=Hi, I'm interested in buying {{ $product->name }} for TSh {{ number_format($product->price, 0) }}" target="_blank" class="order-btn d-inline-flex align-items-center justify-content-center gap-2 text-decoration-none">
                                    <i data-lucide="shopping-cart" style="width: 18px; height: 18px;"></i>
                                    Order Now
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i data-lucide="package-x" style="width: 64px; height: 64px; color: #9ca3af;"></i>
                    <h4 class="mt-3 text-muted">No products yet</h4>
                    <p class="text-muted">Check back later for new products!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p class="mb-0 text-muted">
            Powered by <a href="{{ url('/') }}" class="text-decoration-none" style="color: var(--primary);">{{ config('app.name') }}</a>
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
