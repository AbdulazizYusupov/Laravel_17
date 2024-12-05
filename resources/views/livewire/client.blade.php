<div>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Specialties</span>
                    <h2 class="mb-4">Our Menu</h2>
                </div>
            </div>
            <div class="row">
                @foreach($categories as $category)
                    @foreach($foods->where('category_id',$category->id) as $food)
                        <div class="col-md-6 col-lg-4">
                            <div class="menu-wrap">
                                <div class="heading-menu text-center ftco-animate">
                                    <h3>{{$food->category->name}}</h3>
                                </div>
                                <div class="menus d-flex ftco-animate">
                                    <div class="menu-img img" style="background-image: url({{ asset('storage/' . $food->image) }});"></div>
                                    <div class="text">
                                        <div class="d-flex">
                                            <div class="one-half">
                                                <h3>{{$food->name}}</h3>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">{{$food->price}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

    </section>
</div>
