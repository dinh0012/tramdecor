
<head>
  <div class="top_head_charm">
    <div class="container">
      <div class="menu_th_r">
        <ul >
          <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-skype" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-vimeo-square" aria-hidden="true"></i></a></li>
          <li class="fb_menu_s">
            <a href="javascript:void(0)" class="a_search"><i class="fa fa-search" aria-hidden="true"></i></a>
            <div class="form_menu_th_search">
              <form id="" name="" method="POST" action="#">
                  <div class="input-group"> 
                      <input name=" " id="" type="text" class="form-control text_search" placeholder="Search" value="">
                      <span class="input-group-btn">
                          <button id="" name="" type="submit" class="btn" value=""><i class="fa fa-search"></i></button>
                      </span>
                  </div>
              </form>
            </div>
          </li>
          
        </ul>
        
      </div>
    </div>
  </div>
  <div class="mid_head_charm" style="background-image: url('img/sli_i.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-3 ">
          <div class="logo_head_m">
            <a href=""><img class="img-responsive" src="img/logo.png"></a>
          </div>
        </div>
        <div class="col-md-9 col-sm-9 ">
          <div class="menu_head_m">
            <nav class="navbar menu-navar ">
              <div class="container-fluid item">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                  </div>
                  <div id="navbar" class="navbar-collapse collapse">
                      <ul class="nav navbar-nav" id="mmenu">
                          <li><a href="index.php"><span>HOME</span></a></li>
                          <li><a href="service.php"><span>SERVICES</span> </a></li>
                          <li><a href="team.php"><span>TEAM</span></a></li>
                          <li><a href="blog.php"><span>BLOG</span></a></li>
                          <li><a href=""><span>TRAINING</span></a></li>
                          <li><a href=""><span>MEMBERS</span></a></li>
                          <li><a href="contact.php"><span>CONTACT US</span></a></li>
                      </ul>
                  </div>
              </div>
          </nav>
          </div>
        </div>
      </div>
    </div>  
    <div class="slo_sli">
        <div class="text_slo">
          <span class="font_opensan">
          <?php $seg = $_SERVER['REQUEST_URI']; 
          if($seg == "/charm/contact.php"){
            echo "Contact";
          }else if($seg == "/charm/team.php"){
            echo "Team";
          }else if($seg == "/charm/blog.php"){
            echo "Blog";
          }else if($seg == "/charm/d_blog.php"){
            echo "Blog";
          }else if($seg == "/charm/contact.php"){
            echo "Contact";
          }else if($seg == "/charm/service.php"){
            echo "Services";
          }
          ?>
          </span>
        </div>
    </div>
  </div>
</head>
