@extends('home.layouts.app')

@section('content')
    <!-- contact section -->

    <section class="contact_section ">
        <div class="container px-0">
            <div class="heading_container ">
                <h2 class="">
                    Contact Us
                </h2>
            </div>
        </div>
        <div class="container container-bg">
            <div class="row">
                <div class="col-lg-7 col-md-6 px-0">
                    <div class="map_container">
                        <div class="map-responsive">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6764.35106588162!2d89.25949596553357!3d25.74895078976455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1734422460775!5m2!1sen!2sbd"
                                width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%"
                                allowfullscreen></iframe>
                            {{--  <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6764.35106588162!2d89.25949596553357!3d25.74895078976455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1734422460775!5m2!1sen!2sbd"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>  --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 px-0">
                    <form action="{{route('contactform.submit')}}" method="POST">
                        @csrf
                        <div>
                            <input type="text" name="name" placeholder="Name" />
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Email" />
                        </div>
                        <div>
                            <input type="text" name="phone" placeholder="Phone" />
                        </div>
                        <div>
                            <input type="text" name="message" class="message-box" placeholder="Message" />
                        </div>
                        <div class="d-flex ">
                            <button type="submit">
                                SEND
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <br><br><br>
    <!-- end contact section -->
@endsection
