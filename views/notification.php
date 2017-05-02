 <!-- Reminder this is need to change that only 1 query should be done every page is refreshed --> 
  


  <ul class="nav nav-tabs" style="margin: 1px;margin-top: 19px !important;margin-left: 71px;" >

    <!-- <a data-toggle="tab" href="#home">Home</a></li> --> 
    <li  class="active"  id="ump-menu-bge"   >
        <a data-toggle="tab" href="#menu11"   >
            Emails
        </a>
    </li> 
    <li id="ump-menu-bge" >
        <a data-toggle="tab" href="#menu1"   >
            <span id="ump-menu-badge-bge" ><span class='badge'>..</span></span> 
            <span id="ump-menu-loader-bge"> </span>
            Business Growth Executive
        </a>
    </li>
    <li  id="ump-menu-um" >
        <a data-toggle="tab" href="#menu2"  >
            <span id="ump-menu-badge-um" ><span class='badge'>..</span></span> 
            <span id="ump-menu-loader-um"></span>
            Umbrella Messages
        </a>
     </li>
    <li  id="ump-menu-up" >
        <a data-toggle="tab" href="#menu3"  >
            <span id="ump-menu-badge-up" ><span  class='badge'>..</span></span> 
            <span id="ump-menu-loader-up"></span>
            Umbrella Partners
        </a>
    </li>
</ul>     
  <div class="tab-content" style="width: 92%;"> 

      <div id="menu11" class="tab-pane fade  in  active" style="background-color: white;padding: 0px;margin: 0px;width: 108%;" >
          <div id="ump-message">      
            <?php
            $isOnline = true;
            if($isOnline == true) {   ?> 
                <iframe src="https://testing.umbrellasupport.co.uk/rainloop-community/index.php" height="780px" width="100%"> </iframe> 
             <?php } else  { ?>
                <iframe src="http://localhost/richard/email-client/rainloop/community/index.php" height="780px" width="100%"> </iframe> 
              <?php } ?>
            </div>
      </div>

      <div id="menu1" class="tab-pane fade"> 
        <div id="ump-content-bge" class="ump-content-bge" >
        </div>
        <div id="ump-content-bge-loading" > </div>
        <center>
            <div id="ump-footer-bge">
            </div>
            <div id="ump-footer-bge-loading" > </div>
        </center> 
    </div> 

      <div id="menu2" class="tab-pane fade">

        <div id="ump-content-um" class="ump-content-um" >
        </div>
        <div id="ump-content-um-loading" > </div>
        <center>
            <div id="ump-footer-um">
            </div>
            <div id="ump-footer-bge-loading" > </div>
        </center>
    </div> 

      <div id="menu3" class="tab-pane fade">
        <div id="ump-content-up" class="ump-content-up" style="font-size: 23px;text-align: center;padding-top: 36px;" >
        </div>
        <div id="ump-content-up-loading" > </div>
        <center>
            <div id="ump-footer-up">
            </div>
            <div id="ump-footer-up-loading" > </div>
        </center>
    </div> 
  </div>
 