<div class="d-flex align-items-center my-1">
        <div class="img-fluid mr-3 bg-gradient rounded-circle p-006rem">
            <div class="">
            <img class="img-fluid rounded-circle avatar-sm-md border-white border-2px bg-white" src="{{ $user->avatar_image }}">
        </div>
        </div>
        <div class="mt-2">
            <div class="text-primary font-weight-bold text-sm">{{ $user->full_name }}</div>
            {{-- <div class="mb-2">{{ $user['name'] }}</div> --}}
            <image-rating src="{{asset('/images/rating/bag-1.png')}}"  :rating="{{ (int)$review->rating }}" :read-only="true" :show-rating="false" :item-size="18"></image-rating>
            <div class="mt-2 text-primary-transparency"><strong>{{ $review->body }} </strong></div>
        </div>
    </div>