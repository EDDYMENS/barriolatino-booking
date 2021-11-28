<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Barrio Latino</title>
        <link rel="stylesheet" href="/assets/bootstrap.css">
        <link rel="stylesheet" href="/assets/style.css">
    </head>
    <body class="antialiased">
        <div class="container mt-5 ">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 description">
                    @if(session()->get( 'status' ) == 'success')
                    <span class="alert alert-success center-text">Booking completed successfully</span>
                    @endif
                    @if(session()->get( 'status' ) == 'failed')
                    <span class="alert alert-success center-text">Booking could not be made :(</span>
                    @endif
                    <h3></h3>
                    <span id="description-pan" @if($isAdmin) contenteditable="true" @endif>{{(!isset($description->description) && $isAdmin)?'Click to change description':''}}{!! optional($description)->description !!}</span>
                    @if($isAdmin)
                     @include('description')
                    @endif
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                {!! $calendar !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        
        @include('reserve')
    </body>
</html>
