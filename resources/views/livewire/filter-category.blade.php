<div>
    <section class="ftco-section">
        <div class="container mt-3">
            <div class="row">
                @foreach($foods as $food)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="menu-wrap">
                            <div class="menus d-flex ftco-animate">
                                <div class="menu-img img"
                                     style="background-image: url({{ asset('storage/' . $food->image) }});"></div>
                                <div class="text">
                                    <div class="d-flex">
                                        <div class="one-half">
                                            <h3>{{ $food->name }}</h3>
                                        </div>
                                        <div class="one-forth">
                                            <span class="price">{{ $food->price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $foods->links() }}
            </div>
        </div>
    </section>
</div>

