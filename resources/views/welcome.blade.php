<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="Move+" content="MSLVN">

    <title>Move+</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset("theme/css/bootstrap.min.css")}}" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="{{asset("theme/css/animate.css")}}" rel="stylesheet">
    <link href="{{asset("theme/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset("theme/css/style.css")}}" rel="stylesheet">
    <link href="{{asset("theme/css/welcome.css")}}" rel="stylesheet">
    <link href="{{asset("theme/css/plugins/select2/select2.min.css")}}" rel="stylesheet">
</head>
<body id="page-top" class="landing-page">
<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top navbar-scroll" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <div class="dropdown">
                    <img class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" src="{{asset("theme/img/landing/button_menu.png")}}"></img>
                    <img src="{{asset("theme/img/landing/logo_menu.png")}}" id="logo_menu"></img>
                    <ul class="dropdown-menu">
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Về chúng tôi</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Trợ giúp</a></li>
                        <li><a href="#">Chính sách</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Tin tức</a></li>
                    </ul>
                </div>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div class="nav navbar-nav navbar-right">
                    <button type="button" class="btn btn-link">Trợ giúp</button>
                    <a type="button" class="btn btn-link" href="/register">Đăng kí</a>
                    <button type="button" class="btn btn-sm btn-success-outline">Trở thành tài xế</button>
                    <select id="select_destination" class="select2"><option>Hà Nội</option></select>
                </div>
            </div>
        </div>
    </nav>
</div>
<div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#inSlider" data-slide-to="0" class="active"></li>
        <li data-target="#inSlider" data-slide-to="1"></li>
        <li data-target="#inSlider" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner col-lg-12 col-md-6 col-sm-4 col-xs-4" role="listbox">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption">
                    <h1><br/>MOVE PLUS<br/>
                        NỀN TẢNG GIAO - NHẬN THÔNG MINH<br/></h1>
                    <h3>TẢI CHỈ VỚI 1 CLICK<br/></h3>
                    <p>
                        <a class="btn btn-lg btn-primary" href="#" role="button">TẢI NGAY</a>
                    </p>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back one"></div>
        </div>
        <div class="item">
            <div class="container">
                <div class="carousel-caption">
                    <h1><br/>TRỞ THÀNH ĐỐI TÁC<br/>
                        LÁI XE CÙNG MOVE+<br/></h1>
                    <h3>HÃY GIA NHẬP MOVE+ NGAY HÔM NAY<br/></h3>
                    <p>
                        <a class="btn btn-lg btn-primary" href="#" role="button">ĐĂNG KÍ</a>
                    </p>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back two"></div>
        </div>
        <div class="item">
            <div class="container">
                <div class="carousel-caption">
                    <h1><br/>CÂU CHUYỆN CỦA CHÚNG TÔI<br/></h1>
                    <h3>HÃY LẮNG NGHE MOVE+ NÓI!<br/></h3>
                    <p>
                        <a class="btn btn-lg btn-primary" href="#" role="button">XEM THÊM</a>
                    </p>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back three"></div>
        </div>
    </div>
    <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

    
<section class="container features">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 text-center">
            <br><br><br><br><h1><b>Bạn đang muốn tối ưu dịch vụ giao hàng của mình? Hãy trải nghiệm dịch vụ của chúng tôi.</b></h1><br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-xs-12 text-center wow fadeInLeft">
            <div id="top_left_phone" class="text_iphone">
                <h2><b>Trải nghiệm ứng dụng</b></h2>
                <p>Đặt đơn hàng chỉ với 3 bước đơn giản. Bạn hãy điền đầy đủ thông tin đơn hàng để tài xế Move+ phục vụ bạn tốt nhất!</p>
            </div>
            <div id="bot_left_phone" class="m-t-md text_iphone">
                <h2><b>Cá nhân hóa trải nghiệm</b></h2>
                <p>Sẽ là tuyệt vời khi bạn có thể dõi theo đơn hàng bất kỳ lúc nào bạn muốn!</p>
            </div>
        </div>
        <div class="col-lg-6 col-md-4 col-xs-12 m-t-md m-b-md text-center wow zoomIn">
            <img id="iphone" src="{{asset("theme/img/landing/perspective.png")}}" alt="dashboard" class="img-responsive">
        </div>
        <div class="col-lg-3 col-md-4 col-xs-12 text-center wow fadeInRight">
            <div id="top_right_phone" class="text_iphone">
                <h2><b>Sẵn sàng đáp ứng</b></h2>
                <p>Move+ luôn sẵn sàng đáp ứng tất cả đơn hàng của bạn và kết nối bạn với những tài xế thân thiện nhất.</p>
            </div>
            <div id="bot_right_phone" class="m-t-md text_iphone">
                <h2><b>Hãy phản hồi cho chúng tôi!</b></h2>
                <p>Đánh giá tài xế để giúp chúng tôi hoàn thiện công việc. Trải nghiệm của bạn sẽ tạo thêm động lực cho chúng tôi. Cảm ơn bạn!</p>
            </div>
        </div>
    </div>
<!----------------------------------------------------------------------------------------------------------------->
    <div class="row features-block">
        <div class="col-lg-6 col-md-6 col-sm-6 features-text wow fadeInLeft">
            <div class="col-lg-12 col-md-12 col-xs-12 wow fadeInLeft">
                <h2><b>Phía sau hành trình</b></h2><br>
                <p style="font-size: 15px">Phía sau sự hài lòng của bạn và người mua hàng chính là sự chăm chỉ, nhiệt huyết với công việc của các tài xế Move+.
                   Họ có thể là bất kì ai từ bạn bè, học sinh, sinh viên hay những người làm công việc đời thường như giáo viên, bác sĩ ... 
                   hoặc những người đang làm cha, làm mẹ. Các đối tác của Move+ luôn nỗ lực hết mình để hoàn thành những đơn hàng của bạn, 
                   kiếm thêm thu nhập cho bản thân và đó cũng chính là lý do họ gia nhập đội ngũ Move+. TẠI SAO NÊN GIA NHẬP MOVE+</p>
                <br><br>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 wow fadeInLeft">
                <img src="{{asset("theme/img/landing/button_join_moveplus.png")}}" class="img-responsive">
            </div>
            <br>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 m-t-md text-center wow fadeInRight">
            <img src="{{asset("theme/img/landing/img_behind_journey.png")}}" class="img-responsive pull-right">
        </div>
    </div>
<!----------------------------------------------------------------------------------------------------------------->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <br><h1><b>Move+ luôn là dịch vụ bạn mong muốn</b></h1>
                <br><br>
            </div>
        </div>
        <div class="row col-lg-12 col-md-6 col-sm-6 col-xs-12">
            <div class="col-lg-6 features-text wow fadeInLeft">
                <h2><b>AN TÂM KHI GIAO ĐƠN HÀNG</b></h2>
                <div class="pull-right"><img src="{{asset("theme/img/landing/ic-assurance.png")}}" class="img-responsive"></img></div>
                <p>Sau khi tài xế nhận đơn hàng của bạn trên hệ thống, tài xế sẽ ứng tiền hàng cho bạn. 
                Bạn có thể dõi theo từng chuyển động của tài xế mọi lúc mọi nơi thông qua hệ thống định vị GPS của Move+. quên ghi rõ số nhà bạn nhé!).</p>
            </div>
            <div class="col-lg-6 features-text wow fadeInLeft">
                <h2><b>GIÁ DỊCH VỤ RÕ RÀNG, MINH BẠCH</b></h2>
                <div class="pull-right"><img src="{{asset("theme/img/landing/ic-price.png")}}" class="img-responsive"></img></div>
                <p>Hệ thống Move+ sẽ tối ưu quãng đường, cước dịch vụ sẽ được hiển thị sau khi bạn điền đầy đủ thông tin cho điểm đi, 
                   điểm đến (Đừng quên ghi rõ số nhà bạn nhé!). </p>
            </div>
        </div>
        <div class="row col-lg-12 col-md-6 col-sm-6 col-xs-12">
            <div class="col-lg-6 features-text wow fadeInRight">
                <h2><b>SỰ HÀI LÒNG CỦA NGƯỜI MUA HÀNG</b></h2>
                <div class="pull-right"><img src="{{asset("theme/img/landing/ic-satisfied.png")}}" class="img-responsive"></img></div>
                <p>Tùy vào nhu cầu thực tế của người mua hàng, tài xế Move+ sẽ giao hàng chính xác thời gian mà người mua hàng muốn.</p>
            </div>
            <div class="col-lg-6 features-text wow fadeInRight">
                <h2><b>DỊCH VỤ GIAO HÀNG “THẦN TỐC”</b></h2>
                <div class="pull-right"><img src="{{asset("theme/img/landing/ic-fast.png")}}" class="img-responsive"></img></div>
                <p>Tài xế của Move+ sẽ lao đến, lao đi như một cơn lốc ngay sau khi nhận hàng để đảm bảo quá trình giao nhận diễn ra <45’.</p>
            </div>
        </div>
    </div>
<!----------------------------------------------------------------------------------------------------------------->
    <div class="row features-block">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 m-b-md text-left wow fadeInLeft">
            <img src="{{asset("theme/img/landing/img_benefit.png")}}" class="img-responsive pull-left" style="padding-bottom: 10px;">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 features-text wow fadeInRight">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <h2><b>Vì lợi ích của tất cả</b></h2><br>
                <p style="font-size: 15px">Nền tảng Move+ sẽ giúp tạo việc làm cho nhiều người hơn 
                    và góp phần giải quyết một trong những nút thắt quan trọng nhất của trị trường thương mại điện tử.</p>
                <br><br>
                <div class="col-lg-6 col-md-8 col-sm-10 wow fadeInRight">
                    <img src="{{asset("theme/img/landing/button_destiny.png")}}" class="img-responsive">
                </div>
                <br>
            </div>
        </div>
    </div>
<!----------------------------------------------------------------------------------------------------------------->
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <h1><b>Khách hàng</b></h2>
                <h2><b>Nói gì về chúng tôi?</b></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 m-t-md wow fadeInLeft">
                <div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img src="{{asset("theme/img/landing/feedback1.png")}}" class="img-responsive">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p>“Mình có rất nhiều đơn hàng 1 ngày, và với Move+ mình đã làm hài lòng tất cả Khách hàng của mình. Cảm ơn Move+”.</p>
                        <h4><span class="navy">Nguyễn Thị Mẹt</span></h4>
                        <h4><span class="orange">Khách hàng quận Đống Đa</span></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 m-t-md wow zoomIn">
                <div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img src="{{asset("theme/img/landing/feedback2.png")}}" class="img-responsive">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-b-lg">
                        <p>“Tôi rất sợ bị trễ đơn hàng với khách, bời vì điều đó có thể làm thay đổi quyết định mua hàng của họ”..</p>
                        <h4><span class="navy">Nguyễn Văn Tèo</span></h4>
                        <h4><span class="orange">Khách hàng quận Hoàn Kiếm</span></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 m-t-md wow fadeInRight">
                <div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img src="{{asset("theme/img/landing/feedback3.png")}}" class="img-responsive">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-b-lg">
                        <p>“Tôi rất lo ngại việc tính toán tiền, và dịch vụ tương tác của Move+ giúp tôi an tâm vì điều đó”.</p>
                        <h4><span class="navy">Nguyễn Thị Nở</span></h4>
                        <h4><span class="orange">Khách hàng quận Ba Đình</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!----------------------------------------------------------------------------------------------------------------->
    <div class="row features-block">
        <div class="col-lg-6 col-md-6 col-sm-6 wow fadeInLeft">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <h1><b>Move+ đề cao sự an toàn</b></h1>
                <p class="features-text" style="font-size: 15px">Trong bất cứ hoàn cảnh nào trải nghiệm của Move+ đều hướng tới sự an toàn và tính bảo mật.</p>
                <div class="col-lg-6 col-md-8 col-sm-10 m-t-md wow fadeInLeft">
                    <img src="{{asset("theme/img/landing/safety_shop.png")}}" class="img-responsive">
                </div>
                <div class="col-lg-6 col-md-8 col-sm-10 m-t-md wow fadeInLeft">
                    <img src="{{asset("theme/img/landing/safety_shipper.png")}}" class="img-responsive">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 m-t-md text-left wow fadeInRight">
            <img src="{{asset("theme/img/landing/img_safety.png")}}" class="img-responsive pull-right">
        </div>
    </div>
<!----------------------------------------------------------------------------------------------------------------->
    <div class="row features-block">
        <div class="col-lg-12 m-b-md text-center">
            <h1><b>Tin tức mới nhất</b></h1>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 m-t-md wow fadeInLeft">
            <img src="{{asset("theme/img/landing/news1.png")}}" class="img-responsive pull-right" style="height:300px">
        </div>
        <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 m-t-md wow fadeInRight">
            <img src="{{asset("theme/img/landing/news2.png")}}" class="img-responsive pull-right" style="height:300px">
        </div>
    </div>
</section>
    

<section class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <br><br><br>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <address>
                    <strong><h3><span class="navy">Move+</span></h3></strong><br/>
                    8/68 Nghi Tàm, Tây Hồ, Hà Nội<br/>
                    Hotline: (04) 85 822 228<br/>
                    <abbr title="Email">Email:</abbr> Contact@move.plus
                </address>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <address>
                    <strong><h3><span class="navy">Công ty</span></h3></strong><br/>
                    <a href="#">Về chúng tôi</a><br/>
                    <a href="#">Truyền thông</a><br/>
                    <a href="#">Tuyển dụng</a><br/>
                    <a href="#">Tin tức</a>
                </address>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <address>
                    <strong><h3><span class="navy">Dịch vụ</span></h3></strong><br/>
                    <a href="#">Move+ Express</a>
                </address>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <address>
                    <strong><h3><span class="navy">Nhận thông báo từ Move+</span></h3></strong><br/>
                    Hãy là người đầu tiên cập nhật những tin tức mới nhất từ Move+.
                </address>
                <div class="list-inline col-lg-12 col-md-12 col-sm-6">
                    <input class="col-lg-8 col-md-8 col-sm-12 col-xs-6"placeholder=" Nhập Email...">
                    <a href="#"><i id="mail_icon" class="fa fa-2x fa-envelope"></i></a>
                </div>
                <br><br>
                <ul class="list-inline social-icon">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="download_area">
    <div class="container">
        <div class="m-b-lg"></div>
        <div  class="col-lg-12 col-sm-12 col-xs-12 text-center row">
            <img class="m-t-md" src="{{asset("theme/img/landing/google_store.png")}}">
            <img class="m-t-md" src="{{asset("theme/img/landing/qr_code.png")}}" style="padding-left: 10px; padding-right: 10px;">
            <img class="m-t-md" src="{{asset("theme/img/landing/apple_store.png")}}">
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center m-t-lg">
                <p><strong>&copy; 2016 Moveplus</strong><br/> </p>
            </div>
        </div>
    </div>
</section>
    
<!-- Mainly scripts -->
<script src="{{asset("theme/js/jquery-2.1.1.js")}}"></script>
<script src="{{asset("theme/js/bootstrap.min.js")}}"></script>
<script src="{{asset("theme/js/plugins/metisMenu/jquery.metisMenu.js")}}"></script>
<script src="{{asset("theme/js/plugins/slimscroll/jquery.slimscroll.min.js")}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset("theme/js/inspinia.js")}}"></script>
<script src="{{asset("theme/js/plugins/pace/pace.min.js")}}"></script>
<script src="{{asset("theme/js/plugins/wow/wow.min.js")}}"></script>
<script src="{{asset("theme/js/plugins/select2/select2.full.min.js")}}"></script>

<script>

    $(document).ready(function () {

        $('body').scrollspy({
            target: '.navbar-fixed-top',
            offset: 80
        });

        // Page scrolling feature
        $('a.page-scroll').bind('click', function(event) {
            var link = $(this);
            $('html, body').stop().animate({
                scrollTop: $(link.attr('href')).offset().top - 50
            }, 500);
            event.preventDefault();
            $("#navbar").collapse('hide');
        });
        
        $('#select_destination').select2({
            minimumResultsForSearch: -1
        });
        $("#top_left_phone").hover(function(){
            $("#iphone").attr("src",'{{asset("theme/img/landing/header_two.jpg")}}');
            $("#top_left_phone").css("box-shadow","0 0 20px 20px rgba(221, 227, 239, 0.7)");
            $("#bot_right_phone").css("box-shadow","none");
            $("#top_right_phone").css("box-shadow","none");
            $("#bot_left_phone").css("box-shadow","none");
        });
        $("#bot_left_phone").hover(function(){
            $("#iphone").attr("src",'{{asset("theme/img/landing/laptop.png")}}');
            $("#bot_left_phone").css("box-shadow","0 0 20px 20px rgba(221, 227, 239, 0.7)");
            $("#top_left_phone").css("box-shadow","none");
            $("#bot_right_phone").css("box-shadow","none");
            $("#top_right_phone").css("box-shadow","none");
        });
        $("#top_right_phone").hover(function(){
            $("#iphone").attr("src",'{{asset("theme/img/landing/avatar_all.png")}}');
            $("#top_right_phone").css("box-shadow","0 0 20px 20px rgba(221, 227, 239, 0.7)");
            $("#top_left_phone").css("box-shadow","none");
            $("#bot_right_phone").css("box-shadow","none");
            $("#bot_left_phone").css("box-shadow","none");
        });
        $("#bot_right_phone").hover(function(){
            $("#iphone").attr("src",'{{asset("theme/img/landing/dashboard.png")}}');
            $("#bot_right_phone").css("box-shadow","0 0 20px 20px rgba(221, 227, 239, 0.7)");
            $("#top_left_phone").css("box-shadow","none");
            $("#top_right_phone").css("box-shadow","none");
            $("#bot_left_phone").css("box-shadow","none");
        });
    });

    // Activate WOW.js plugin for animation on scrol
    new WOW().init();

</script>

</body>
</html>
