
@extends('layouts.client')

@section('content')
  
<div class="block-31" style="margin-top: -20%; position: relative;">
  <div class="owl-carousel loop-block-31 ">
      <div class="block-30 item" style="background-image: url('css/client/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-md-10">
                      <span class="subheading-sm">Welcome</span>
                      <h2 class="heading">Enjoy a Luxury Experience</h2>
                  </div>
              </div>
          </div>
      </div>
      <div class="block-30 item" style="background-image: url('css/client/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-md-10">
                      <span class="subheading-sm">Welcome</span>
                      <h2 class="heading">Simple &amp; Elegant</h2>
                  </div>
              </div>
          </div>
      </div>
      <div class="block-30 item" style="background-image: url('css/client/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-md-10">
                      <span class="subheading-sm">Welcome</span>
                      <h2 class="heading">Food &amp; Drinks</h2>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


<div class="container">
    <div class="row mb-5">
        <div class="col-md-12">

            <div style="border-radius:5px;" class="block-32">
                <form action="all_available_rooms_by_date" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                            <label for="checkin">Check In</label>
                            <div class="field-icon-wrap">
                                <div class="icon"><span class="icon-calendar"></span></div>
                                <input type="text" name="checkin_date" class="form-control" id="checkin_date" class="" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                            <label for="checkin">Check Out</label>
                            <div class="field-icon-wrap">
                                <div class="icon"><span class="icon-calendar"></span></div>
                                <input type="text" name="checkout_date" class="form-control" id="checkout_date" class="" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                          <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                              <label for="checkin">Rooms</label>
                              <div class="field-icon-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="number_of_rooms" id="" class="form-control">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4+</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0">
                              <label for="checkin">Guest</label>
                              <div class="field-icon-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="number_of_guests" id="" class="form-control">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4+</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-3 align-self-end">
                            <button type="submit" class="btn btn-primary btn-block">Check Availabilty</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<div class="site-section">
  <div style="background-color: white; border-radius:5px;" class="container">
    <div class="site-section">
        <div style="margin-top:-70px;" class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-5">
                  <img src="/css/client/images/img_4.jpg" alt="Image placeholder" class="img-fluid img-shadow mb-4">
                  <h4>Even the all-powerful Pointing</h4>
                  <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
                </div>
                <div class="col-md-6 col-lg-4 mb-5">
                  <img src="/css/client/images/img_2.jpg" alt="Image placeholder" class="img-fluid img-shadow mb-4">
                  <h4>Blind texts it is an almost</h4>
                  <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
                </div>
                <div class="col-md-6 col-lg-4 mb-5">
                  <img src="/css/client/images/img_7.jpg" alt="Image placeholder" class="img-fluid img-shadow mb-4">
                  <h4>Pointing has no control about</h4>
                  <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
                </div>
            </div>
        </div>
    </div>


    {{--  --}}


    {{-- <div class="block-31" style="margin-top: -10%; position: relative;">
      <div class="owl-carousel loop-block-31 ">
              <div style="height:400px; background-image: url('/css/client/images/bg_1.jpg');" class="container">
                  <div class="row align-items-center">
                      <div class="col-md-10">
                          <span class="subheading-sm">Welcome</span>
                          <h2 class="heading">Enjoy a Luxury Experience</h2>
                      </div>
                  </div>
              </div>
              <div style="height:400px; background-image: url('/css/client/images/bg_2.jpg');" class="container">
                  <div class="row align-items-center">
                      <div class="col-md-10">
                          <span class="subheading-sm">Welcome</span>
                          <h2 class="heading">Simple &amp; Elegant</h2>
                      </div>
                  </div>
              </div>
              <div style="height:400px; background-image: url('/css/client/images/bg_3.jpg');" class="container">
                  <div class="row align-items-center">
                      <div class="col-md-10">
                          <span class="subheading-sm">Welcome</span>
                          <h2 class="heading">Food &amp; Drinks</h2>
                      </div>
                  </div>
              </div>
      </div>
    </div> --}}

    <div class="site-section">
      <displayrooms />
    </div>


    {{--  --}}


    <div style="padding:20px;" class="row site-section">
      <div class="col-md-12">
        <div class="row mb-5">
          <div class="col-md-7 section-heading">
            <span class="subheading-sm">Services</span>
            <h2 class="heading">Facilities &amp; Services</h2>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="media block-6">
          <div class="icon"><span class="flaticon-double-bed"></span></div>
          <div class="media-body">
            <h3 class="heading">Swimming Pool</h3>
            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
          </div>
        </div>      
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="media block-6">
          <div class="icon"><span class="flaticon-wifi"></span></div>
          <div class="media-body">
            <h3 class="heading">Fast &amp; Free Wifi</h3>
            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="media block-6">
          <div class="icon"><span class="flaticon-customer-service"></span></div>
          <div class="media-body">
            <h3 class="heading">Call Us 24/7</h3>
            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="media block-6">
          <div class="icon"><span class="flaticon-taxi"></span></div>
          <div class="media-body">
            <h3 class="heading">Travel Accomodation</h3>
            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
          </div>
        </div>      
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="media block-6">
          <div class="icon"><span class="flaticon-credit-card"></span></div>
          <div class="media-body">
            <h3 class="heading">Accepts Credit Card</h3>
            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="media block-6">
          <div class="icon"><span class="flaticon-dinner"></span></div>
          <div class="media-body">
            <h3 class="heading">Canteen/Cafetria</h3>
            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
          </div>
        </div>
      </div>

    </div>

    



  </div>
</div>



  
@endsection