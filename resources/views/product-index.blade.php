<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Products</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/product-index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/price-range.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/price-range.js') }}"></script>
</head>
<body>
<div class="container-fluid py-4 grey lighten-5">
    <div class="row gutters-6" id="containerSticky">
        <div class="col-md-3 col-lg-3 col-xl-2 d-md-block">
            <div id="sidebar" class="sidebar">
                <div class="sidebar__inner">
                    <div class="card p-2 mb-3">
                        <p class="pr-3 font-weight-bold m-0">
                            Search Product
                        </p>
                        <div class="pt-0 sid-cat">
                            <hr class="my-2">
                            <form action="{{ route('product.index') }}" method="GET">
                                <div class="md-form md-outline">
                                    <input name="search" type="search" id="searchText" class="form-control"
                                           autocomplete="off" value="{{ Request::input('search') }}">
                                    <label for="searchText">Search Here...</label>
                                </div>
                                <div class="md-form md-outline">
                                    <input type="checkbox" class="form-check-input" id="priceCheck" @if(!empty(Request::input('price'))) checked @endif>
                                    <label class="form-check-label" for="priceCheck">Use Price Filter</label>
                                    <div class="wrapper @if(empty(Request::input('price'))) d-none @endif" id="priceDiv" style="padding:20px;">
                                        <div class="range-slider">
                                            <input @if(!empty(Request::input('price'))) name="price" @endif id="priceInput" type="text" class="js-range-slider" value=""/>
                                        </div>
                                        <hr>
                                        <div class="extra-controls form-inline">
                                            <p>From:</p>
                                            <div class="form-group">
                                                <input type="text" class="js-input-from form-control" value=""/>
                                            </div>
                                            <p>To:</p>
                                            <div class="form-group">
                                                <input type="text" class="js-input-to form-control" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-lg-9 col-xl-10" id="item-content">
            @if(! (count($products) > 0))
                <div class="card p-3" style="height: 300px">
                    <div class="alert alert-warning m-0">
                        <p class="fs-1 m-0">
                            <i class="fas fa-exclamation-triangle"></i>
                            Not Found
                        </p>
                    </div>
                </div>
        @endif
        <!-- Loader -->
            <div class="loader-wraper hide loader-top on-content bg-white">
                <div class="preloader-wrapper active">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->
            <div class="row gutters-6">
            @foreach($products as $product)

                <!-- Col -->
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4">
                        <!-- Card -->
                        <div class="card item-card z-depth-1 hoverable">
                            <!-- Card image -->
                            <div class="view overlay text-center">
                                <img class="item-img rounded" src='{{ asset("img/no-logo.jpg") }}'
                                     alt="{{ $product->name }}"/>
                                <a href="{{ route('product' , $product) }}">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!--/ Card image -->

                            <!-- Card content -->
                            <div class="card-body p-2">
                                <!-- Title -->
                                <p class="card-title text-center lh-text">{{ $product->name }}</p>
                                <div class="item-index-price-section text-center">
                                    @if(count($product->colors) > 0)
                                        @foreach($product->colors as $color)
                                            <p class="mb-2">
                                                <span class="fs-0">{{ $color->name }}</span>
                                                <span
                                                    class="font-weight-bold">{{ number_format($color->pivot->price) }}</span>
                                                <span class="fs-0">Rials</span>
                                            </p>
                                        @endforeach
                                    @else
                                        <span class="fs-0">No Price</span>
                                    @endif
                                </div>
                            </div>
                            <!--/ Card  -->
                        </div>
                        <!--/ Col -->
                    </div>

            @endforeach
            <!--/ Row -->
            </div>
            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center pg-blue">
                    {!! $products->appends(['search' => request('search') , 'price' => request('price')])->links() !!}
                </ul>
            </nav>
        </div>
    </div>
</div>
<script>
    $(function () {

        var $range = $(".js-range-slider"),
            $inputFrom = $(".js-input-from"),
            $inputTo = $(".js-input-to"),
            instance,
            min = 0,
            max = {{ $max }},
            from = 0,
            to = 0;

        $range.ionRangeSlider({
            type: "double",
            min: min,
            max: max,
            from: @if(!empty(Request::input('price'))) {{ explode(';',Request::input('price'))[0] }} @else 0 @endif,
            to: @if(!empty(Request::input('price'))) {{ explode(';',Request::input('price'))[1] }} @else {{ $max }} @endif ,
            prefix: 'Rials.',
            onStart: updateInputs,
            onChange: updateInputs,
            step: 500,
            prettify_enabled: true,
            prettify_separator: ".",
            values_separator: " - ",
            force_edges: true


        });

        instance = $range.data("ionRangeSlider");

        function updateInputs(data) {
            from = data.from;
            to = data.to;

            $inputFrom.prop("value", from);
            $inputTo.prop("value", to);
        }

        $inputFrom.on("input", function () {
            var val = $(this).prop("value");

            // validate
            if (val < min) {
                val = min;
            } else if (val > to) {
                val = to;
            }

            instance.update({
                from: val
            });
        });

        $inputTo.on("input", function () {
            var val = $(this).prop("value");

            // validate
            if (val < from) {
                val = from;
            } else if (val > max) {
                val = max;
            }

            instance.update({
                to: val
            });
        });

    });
</script>
<script>
    $("#priceCheck").change(function() {
        if(this.checked) {
            $("#priceInput").attr("name","price");
        } else {
            $("#priceInput").removeAttr("name");
        }
        if($("#priceDiv").hasClass('d-none')) {
            $("#priceDiv").removeClass('d-none');
        } else {
            $("#priceDiv").addClass('d-none');
        }
    });
</script>
</body>
</html>
