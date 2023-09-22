    @foreach ($featuredApartPhotos as $apartPhoto)
        <div class="col-3 col-6-medium col-12-small">
            <section>
                <a href="/apart/{{$apartPhoto->apart->id}}" class="bordered-feature-image"><img src="/storage/{{$apartPhoto->image}}" alt="" /></a>
                <h2>{{$apartPhoto->apart->title}}</h2>
                <p>

                </p>
            </section>
        </div>
    @endforeach
