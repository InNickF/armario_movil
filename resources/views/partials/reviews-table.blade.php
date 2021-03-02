<table class="table table-lightborder">
    <thead>
    <tr>
        <th>
            Customer
        </th>

        <th>
            Body
        </th>
        <th class="text-center">
            Rating
        </th>
        <th class="text-right">
            Date
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse ($item->reviews as $review)
        <tr>
            <td class="nowrap">
                <a href="{{url('/users/' . $review->user_id . '/edit')}}">
                    {{$review->user->full_name}}
                </a>
            </td>
            <td class="nowrap">
                {{ $review->body }}
            </td>
            {{ $review->rating }}
            </td>
            <td class="text-right">
                {{$review->created_at}}
            </td>
        </tr>

    @empty
        <tr>
            <td><p>No results</p></td>
        </tr>
    @endforelse


    </tbody>
</table>
