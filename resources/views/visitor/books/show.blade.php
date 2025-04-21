@if(auth()->user()->role == 'visitor')
    <div class="card mt-4">
        <div class="card-body">
            <h5>Berikan Ulasan</h5>
            <form action="{{ route('books.review.store', $book->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating:</label>
                    <select name="rating" id="rating" class="form-select" required>
                        <option value="5">⭐⭐⭐⭐⭐ - Sangat Baik</option>
                        <option value="4">⭐⭐⭐⭐ - Baik</option>
                        <option value="3">⭐⭐⭐ - Cukup</option>
                        <option value="2">⭐⭐ - Kurang</option>
                        <option value="1">⭐ - Buruk</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="review" class="form-label">Ulasan:</label>
                    <textarea name="review" id="review" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
            </form>
        </div>
    </div>
@endif

@if($book->reviews->count() > 0)
    <div class="card mt-4">
        <div class="card-body">
            <h5>Ulasan Buku</h5>
            @foreach ($book->reviews as $review)
                <div class="border p-2 mb-2">
                    <strong>{{ $review->user->name }}</strong>
                    <span class="text-warning">({{ str_repeat('⭐', $review->rating) }})</span>
                    <p>{{ $review->review }}</p>
                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    </div>
@endif
