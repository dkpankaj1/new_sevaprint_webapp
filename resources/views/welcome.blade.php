<x-web-layout>


    <style>
        .main-banner::before {
            background-image: url({{ $homepage->image }});
        }
    </style>

    <div class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="owl-carousel owl-banner">
                                @foreach ($sliders as $slides)
                                    <div class="item header-text">
                                        <h6>{{ $slides->sub_title }}</h6>
                                        <h2>{{ $slides->title }}</h2>
                                        {!! $slides->description !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="our-services section">
        <div class="services-right-dec">
            <img src="{{ asset('assets/images/services-right-dec.png') }}" alt="">
        </div>
        <div class="container">
            <div class="services-left-dec">
                <img src="{{ asset('assets/images/services-left-dec.png') }}" alt="">
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>We <em>Provide</em> The Best Service With <span>Our Tools</span></h2>
                        <span>Our Services</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-services">
                        @foreach ($services as $service)
                            <div class="item">
                                <h4>{{ $service->title }}</h4>
                                <div class="icon"><img src="{{ $service->icon }}" alt=""></div>
                                <p>{{ $service->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="left-image">
                        <img src="{{$aboutUs->image}}" alt="about_us">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>{{$aboutUs->title}}</h2>
                        <p>{{$aboutUs->description}}</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="fact-item">
                                    <div class="count-area-content">
                                        <div class="icon">
                                            <img src="{{$aboutUs->achievements_one_icon}}" alt="">
                                        </div>
                                        <div class="count-digit">{{$aboutUs->achievements_one_count}}</div>
                                        <div class="count-title">{{$aboutUs->achievements_one_title}}</div>
                                        <p>{{$aboutUs->achievements_one_description}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="fact-item">
                                    <div class="count-area-content">
                                        <div class="icon">
                                            <img src="{{$aboutUs->achievements_two_icon}}" alt="">
                                        </div>
                                        <div class="count-digit">{{$aboutUs->achievements_two_count}}</div>
                                        <div class="count-title">{{$aboutUs->achievements_two_title}}</div>
                                        <p>{{$aboutUs->achievements_two_description}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="fact-item">
                                    <div class="count-area-content">
                                        <div class="icon">
                                            <img src="{{$aboutUs->achievements_three_icon}}" alt="">
                                        </div>
                                        <div class="count-digit">{{$aboutUs->achievements_three_count}}</div>
                                        <div class="count-title">{{$aboutUs->achievements_three_title}}</div>
                                        <p>{{$aboutUs->achievements_three_description}}</p>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="video" class="our-videos section mt-5">
        <div class="videos-left-dec">
            <img src="{{ asset('assets/images/videos-left-dec.png') }}" alt="">
        </div>
        <div class="videos-right-dec">
            <img src="{{ asset('assets/images/videos-right-dec.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="naccs">
                        <div class="grid">
                            <div class="row">
                                <div class="col-lg-8">
                                    <ul class="nacc">

                                        @foreach ($videos as $key => $video)
                                            <li class="{{ $key == 0 ? 'active' : '' }}">
                                                <div>
                                                    <div class="thumb">
                                                        @php
                                                            preg_match(
                                                                '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w-]{11})/',
                                                                $video->url,
                                                                $matches,
                                                            );
                                                        @endphp
                                                        <iframe width="100%" height="auto"
                                                            src="https://www.youtube.com/embed/{{ $matches[1] }}"
                                                            title="YouTube video player" frameborder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen></iframe>
                                                        <div class="overlay-effect">
                                                            <a href="#">
                                                                <h4>Project One</h4>
                                                            </a>
                                                            <span>SEO &amp; Marketing</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="col-lg-4">
                                    <div class="menu">

                                        @foreach ($videos as $key => $video)
                                            <div class="{{ $key == 0 ? 'active' : '' }}">
                                                <div class="thumb">
                                                    <img src="{{ asset('assets/images/video-thumb-01.png') }}"
                                                        alt="">
                                                    <div class="inner-content">
                                                        <h4>{{ $video->title }}</h4>
                                                        <span>{{ $video->sub_title }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="section-heading">
                        <h2>Feel free to <em>Contact</em> us</h2>
                        <div class="info">
                            <span><i class="fa fa-phone"></i> <a
                                    href="#">{{$brandSetting->contact_phone}}</a></span>
                            <span><i class="fa fa-envelope"></i> <a
                                    href="#">{{$brandSetting->contact_email}}</a></span>
                        </div>

                    </div>
                </div>
                <div class="col-lg-5 align-self-center">
                    <form id="contact" action="{{route('home')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset>
                                    <input type="name" name="name" id="name" placeholder="Name" value="{{old('name')}}"
                                        autocomplete="on" required>
                                </fieldset>
                                @error('name')
                                    <span class="invalid-feedback text-danger d-block">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <input type="text" name="phone" id="phone" placeholder="Enter phone number" value="{{old('phone')}}"
                                        autocomplete="on" required>
                                </fieldset>
                                @error('phone')
                                    <span class="invalid-feedback text-danger d-block">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" value="{{old('email')}}"
                                        placeholder="Your Email" required="">
                                </fieldset>
                                @error('email')
                                    <span class="invalid-feedback text-danger d-block">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <input type="text" name="message" id="message" value="{{old('message')}}"
                                        placeholder="Your message" required="">
                                </fieldset>
                                @error('message')
                                    <span class="invalid-feedback text-danger d-block">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-button">Submit
                                        Request</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="contact-dec">
            <img src="{{ asset('assets/images/contact-dec.png') }}" alt="">
        </div>
        <div class="contact-left-dec">
            <img src="{{ asset('assets/images/contact-left-dec.png') }}" alt="">
        </div>
    </div>
</x-web-layout>
