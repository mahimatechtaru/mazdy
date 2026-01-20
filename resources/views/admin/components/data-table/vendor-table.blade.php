<table class="custom-table user-search-table">
    <thead>
        <tr>
            <th></th>
            <th>{{ __("username") }}</th>
            <th>{{__("Email")}}</th>
            <th>{{__("Phone")}}</th>
            <th>{{__("Status")}}</th>
            <th>{{__("Action")}}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users ?? [] as $key => $item)
            <tr>
                <td>
                    <ul class="user-list">
                        <li><img src="{{ $item->userImage }}" alt="user"></li>
                    </ul>
                </td>
                <td><span>{{ $item->username }}</span><br>
                    <span class="badge badge--info text-capitalize">
                        {{ $item->vendor->vendor_type }}
                    </span>
                </td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->mobile  ?? "N/A" }}</td>
                <td>
                    @if (Route::currentRouteName() == "admin.vendors.kyc.unverified")
                        <span class="{{ $item->kycStringStatus->class }}">{{ $item->kycStringStatus->value }}</span>
                    @else
                        <span class="{{ $item->stringStatus->class }}">{{ $item->stringStatus->value }}</span>
                    @endif
                </td>
                <td>
                    @if (Route::currentRouteName() == "admin.vendors.kyc.unverified")
                        @include('admin.components.link.info-default',[
                            'href'          => setRoute('admin.vendors.kyc.details', $item->username),
                            'permission'    => "admin.vendors.kyc.details",
                        ])
                    @else
                        @include('admin.components.link.info-default',[
                            'href'          => setRoute('admin.vendors.details', $item->username),
                            'permission'    => "admin.vendors.details",
                        ])
                    @endif
                </td>
            </tr>
        @empty
            @include('admin.components.alerts.empty',['colspan' => 7])
        @endforelse
    </tbody>
</table>
