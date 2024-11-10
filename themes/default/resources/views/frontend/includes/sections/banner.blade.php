@php

    // echo json_encode($properties);
    
@endphp

<style>
    
/* home banner section css start*/
section.home-banner {
  background-image: url("https://stagingmockup.agency/zenithblox/assets/images/homebanner.png");
  background-position: center center;
  background-size: 100% 100%;
  background-repeat: no-repeat;
  display: flex;
  justify-content: center;
  padding: 100px 0px;
}
.vertial-center-items {
  display: flex;
  align-items: flex-start;
  justify-content: center;
  flex-direction: column;
  padding: 0px 20px;
}
.vertial-center-items p {
  width: 65%;
  font-family: var(--font-family);
  font-weight: 400;
  color: #ffffff;
  font-size: 20px;
  line-height: 35px;
  margin-bottom: 50px;
}
.vertial-center-items h3 {
  font-family: var(--font-family);
  font-weight: 400;
  color: #fefefe;
  font-size: 20px;
  line-height: 30px;
  margin-bottom: 30px;
}
.vertial-center-items h1 {
  font-family: var(--font-family);
  font-weight: 700;
  color: white;
  font-size: 90px;
  line-height: 100px;
  margin-bottom: 20px;
  margin-top: 0px;
}
/* home banner section css end*/

</style>



<section class="home-banner">
  <div class="container">
    <div class="vertial-center-items">
      
      @if($properties['subheading'])
      <h3>
        {{ $properties['subheading'] }}
      </h3>
      @endif
      
      @if($properties['heading'])
      <h1>
        {{ $properties['heading'] }}
      </h1>
      @endif
      
      @if($properties['paragraph'])
      <p>
        {{ $properties['paragraph'] }}
      </p>
      @endif
      
      @if($properties['btn_title'])
      <button><a class="btn btn-custom" href="{{ $properties['btn_link'] }}">{{ $properties['btn_title'] }}</a></button>
      @endif
      
      
    </div>
  </div>
</section>

