<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  @include('UI.common/main_head_scripts')   
<!-- Smart chat boot

<link rel="stylesheet" href="https://s3.amazonaws.com/smatbot/files/smatbot.css.gz"><script type="text/javascript">var otherPulseDiv=document.createElement("DIV");otherPulseDiv.id="pulse_smatbot_unique";var mainDiv=document.createElement("DIV");otherPulseDiv.appendChild(mainDiv);mainDiv.id="closed";var img=document.createElement("Img");img.id="main_icon_smatest";img.src="https://s3.ap-south-1.amazonaws.com/custpostimages/sb_images/chat-loading.gif";var imgLogo=document.createElement("Img");imgLogo.id="logo-smatest";imgLogo.classList.add("logo-smatest");mainDiv.appendChild(img);mainDiv.classList.add("pointer");mainDiv.classList.add("smat-div-before");img.classList.add("smat-main-btn-before");otherPulseDiv.classList.add("pulse-div-before");document.addEventListener("DOMContentLoaded",function(event){document.body.appendChild(otherPulseDiv)});</script><script type="text/javascript">!function(t,e){"use strict";var r=function(t){try{var r=e.head||e.getElementsByTagName("head")[0],a=e.createElement("script"),b=document.getElementsByTagName("script")[0];a.setAttribute("type","text/javascript"),a.setAttribute("src",t),a.async=!0,r.insertBefore(a,b)}catch(t){}};t.chatbot_id=4630,r("https://s3.amazonaws.com/smatbot/files/smatbot_plugin.js.gz")}(window,document);</script><script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/1.5.1/fingerprint2.min.js"></script> -->


@toastr_css
<style>
      input::-ms-reveal,
      input::-ms-clear {
        display: none;
      }
    </style>
</head> 
<body>
  <!-- site -->
  <div class="site"> 
    <!-- site__header -->
      @include('UI.common/main_header') 
      
    <!-- site__header / end --> 
    <!-- site__body -->
    <div class="site__body"> 
      @yield('main_content')
    </div>
    <!-- site__body / end --> 

    <!-- site__footer --> 
      @include('UI.common/main_footer')  
    <!-- site__footer / end -->
  </div> 
  <!-- site / end -->
  <!-- mobile-menu --> 

  <!-- mobile-menu / end --> 
  <!-- scripts -->
    @include('UI.common/main_foot_scripts')  
    @toastr_js
    @toastr_render
</body>
</html>