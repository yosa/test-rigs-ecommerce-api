<div class="container">
    <div class="card-columns">
        @foreach($products->records as $product)
        <div class="card">
            <img class="card-img-top" data-src="holder.js/100px180/?random=yes" alt="Image product" />
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <small class="text-muted stock">{{ $product->stock }} on stock</small>
                <p class="card-text">{{ $faker->text }}</p>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-success">
                    <i class="fas fa-shopping-cart"></i> Buy
                    
                </a>
                <a href="#" class="btn btn-error text-right like">
                    <i class="fas fa-heart"></i> {{ $product->likes }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
