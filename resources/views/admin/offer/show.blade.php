@extends('admin.layouts.app')
@section('content')
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
            <div class="d-flex flex-column">
                <h3>Offer</h3>
                <nav aria-label="breadcrumb" class="d-flex justify-content-between pb-3">
                    <ol class="breadcrumb -0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.offer.index') }}"
                                class="breadcrumb-link">Offer</a></li>

                        <li aria-current="page" class="breadcrumb-item active text-capitalize">
                            {{ $offer->name }}
                        </li>
                    </ol>
                    <div>
                        <!---->
                    </div>
                </nav>
            </div>
            <a href="{{ route('admin.offer.create') }}" class="btn btn-info">
                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4"
                        d="M5.89155 8.94037C5.89155 8.94037 9.06324 4.5 13.8208 4.5C15.9237 4.5 17.9406 5.3354 19.4276 6.82242C20.9146 8.30943 21.75 10.3263 21.75 12.4292C21.75 14.5322 20.9146 16.549 19.4276 18.036C17.9406 19.5231 15.9237 20.3585 13.8208 20.3585C11.0646 20.3585 8.63701 18.851 7.21609 16.9429"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path
                        d="M4.01239 12.7139C4.09736 12.7198 4.18269 12.7029 4.25979 12.6639L9.27776 10.0921C9.41563 10.0211 9.50597 9.88782 9.51635 9.73793C9.52673 9.58804 9.45563 9.44359 9.32886 9.35425L4.71338 6.11519C4.57901 6.02124 4.40214 6.00373 4.25173 6.07095C4.10075 6.13755 4.00082 6.27715 3.98984 6.43576L3.58736 12.2466C3.57637 12.4053 3.6561 12.5573 3.79645 12.6441C3.8625 12.6854 3.93712 12.7087 4.01239 12.7139"
                        fill="currentColor"></path>
                </svg>
                Go Back</a>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Offers Details</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><strong>Offer Name : </strong>{{ $offer->name }}</p>
                        <p><strong>Advertiser : </strong>{{ $offer->advertiser_id }}</p>
                        <p><strong>Category : </strong>{{ $offer->category_id }}</p>
                        <p><strong>Preview Url : </strong>{{ $offer->preview }}</p>
                        <p><strong>Daily Cap : </strong>{{ $offer->daily_cap }}</p>
                        <p><strong>Payout : </strong>{{ $offer->name }}</p>
                        <p><strong>Expire Date : </strong><span
                                class="badge badge-info">{{ $offer->expiration_date }}</span></p>
                        <p><strong>Description : </strong>{!! $offer->description !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Traking Link</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">

                                <input type="hidden" value="{{ $offer->id }}" name="offer_id">
                                <div class="d-flex justify-content-between">
                                    <div class="form-group w-100 ps-3 pe-3">
                                        <label class="form-label">Affiliate</label>
                                        <select class="form-select mb-3 shadow-none" name="user_id" id="affiliate_id">
                                            <option selected="">Select a Affiliate</option>
                                            @foreach ($affiliates as $affiliate)
                                                <option value="{{ $affiliate->id }}">
                                                    {{ $affiliate->first_name . $affiliate->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="form-group w-100 ps-3 pe-3">
                                        <label class="form-label" for="email1101">Create New Link</label>
                                        <input type="text" class="form-control" id="new_link" name="revenue">
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <div class="form-check d-block">
                                        <input type="checkbox" id="flexCheckChecked11" value="1"
                                            class="form-check-input"> <label for="flexCheckChecked11"
                                            class="form-check-label">
                                            Add Extra Params/SUBID (Helpful for advance tracking)
                                        </label>
                                    </div>
                                </div>
                                <div style="display:none" class="extra_params">
                                    <div class="d-flex justify-content-between ">
                                        <div class="form-group w-100 ps-3 pe-3">
                                            <label class="form-label" for="aff_click_id">Click Id</label>
                                            <input type="text" class="form-control" id="aff_click_id"
                                                name="aff_click_id">
                                        </div>
                                        <div class="form-group w-100 ps-3 pe-3">
                                            <label class="form-label" for="aff_sub_1">Sub 1</label>
                                            <input type="text" class="form-control" id="aff_sub_1" name="aff_sub_1">
                                        </div>
                                        <div class="form-group w-100 ps-3 pe-3">
                                            <label class="form-label" for="aff_sub_2">Sub 2</label>
                                            <input type="text" class="form-control" id="aff_sub_2" name="aff_sub_2">
                                        </div>
                                        <div class="form-group w-100 ps-3 pe-3">
                                            <label class="form-label" for="aff_sub_3">Sub 3</label>
                                            <input type="payout" class="form-control" id="aff_sub_3" name="aff_sub_3">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let aff_id = '';
        let domain = "{{ url('/') }}";
        let aff_click_id = '';
        let aff_sub_1 = '';
        let aff_sub_2 = '';
        let aff_sub_3 = '';
        let offer_id = '';
        $(document).ready(function() {
            offer_id = '&offer_id={{ $offer->id }}';
        });

        $('#affiliate_id').change(function() {
            aff_id = $(this).val();
            aff_id = (aff_id == '') ? '' : '/redirect?aff_id=' + aff_id;
            $('input#new_link').val(domain + aff_id + offer_id + aff_click_id + aff_sub_1 + aff_sub_2 +
                aff_sub_3);
        })

        $('#domain').on('change', function() {
            domain = $(this).val();
            $('input#new_link').val(domain + aff_id + offer_id + aff_sub_1 + aff_sub_2 + aff_sub_3);
        });

        $('#aff_click_id').on('keyup', function() {
            aff_click_id = $(this).val();
            aff_click_id = aff_click_id == '' ? '' : '&aff_click_id=' + aff_click_id;
            $('input#new_link').val(domain + aff_id + offer_id + aff_click_id + aff_sub_1 + aff_sub_2 +
                aff_sub_3);
        });


        $('#aff_sub_1').on('keyup', function() {
            aff_sub_1 = $(this).val();
            aff_sub_1 = (aff_sub_1 == '') ? '' : '&aff_sub_1=' + aff_sub_1;
            $('input#new_link').val(domain + aff_id + offer_id + aff_click_id + aff_sub_1 + aff_sub_2 +
                aff_sub_3);

        });

        $('#aff_sub_2').on('keyup', function() {
            aff_sub_2 = $(this).val();
            aff_sub_2 = aff_sub_2 == '' ? '' : '&aff_sub_2=' + aff_sub_2;
            $('input#new_link').val(domain + aff_id + offer_id + aff_click_id + aff_sub_1 + aff_sub_2 +
                aff_sub_3);
        });


        $('#aff_sub_3').on('keyup', function() {
            aff_sub_3 = $(this).val();
            aff_sub_3 = aff_sub_3 == '' ? '' : '&aff_sub_3=' + aff_sub_3;
            $('input#new_link').val(domain + aff_id + offer_id + aff_click_id + aff_sub_1 + aff_sub_2 +
                aff_sub_3);
        });
        $('#flexCheckChecked11').click(function() {
            if ($(this).is(':checked')) {
                $('.extra_params').slideDown();
            } else {
                $('.extra_params').slideUp();
            }
        });
    </script>
@endsection
