var whmcs = false;/* For preview only */

var themes = ["org","purple","darkblue","green","grey"];
var mainColors = ["0a5dd3","756de7","142745","00b869","3d3d3d"];
var setCssColors = "";
var setDivs = "";
for(var i=0;i<=themes.length-1;i++){
    setCssColors += '.switches-holder .switch'+Number(i+1)+'{background-color: #'+mainColors[i]+';} ';
    setDivs += '<div class="switch switch'+Number(i+1)+'" data-num="'+i+'"></div>';
}

$('body').append('<style>#theme-switcher{display: inline-block; position: fixed; top: 80px; left: 10px;z-index: 9999;} #btn-theme{padding:7px 10px;background-color:rgba(255,255,255,0.2);border-radius:7px;margin-bottom:5px;cursor:pointer;box-shadow: 0 0 10px rgba(0,0,0,0.3);}#btn-theme .fa{color:#ffffff;text-shadow: 0 0 5px rgba(0,0,0,0.7);}#btn-theme:hover{background-color:rgba(255,255,255,0.4)}.switches-holder{transform-origin:center top;transform:scaleY(0);opacity:0;padding: 7px 7px;background-color: rgba(255,255,255,0.9);border-radius: 7px;width: 34px;font-size: 0;transition: all 0.3s cubic-bezier(0.34, 1.61, 0.7, 1);box-shadow: 0 0 10px rgba(0,0,0,0.3);}.switches-holder.active{transform:scaleY(1);opacity:1;}.switches-holder .switch{display:inline-block;width:20px;height:20px;margin-bottom:5px;border-radius:4px;cursor:pointer;}.switches-holder .switch.active{box-shadow:inset 0 0 2px 2px rgba(0,0,0,0.3)} '+setCssColors+'.switches-holder div:last-child{margin-bottom:0;}</style><div id="theme-switcher"><div id="btn-theme"><i class="fa fa-paint-brush" aria-hidden="true"></i></div><div class="switches-holder">'+setDivs+'</div></div>');

if(whmcs){
    $('head').append('<link id="custom-css2" rel="stylesheet" type="text/css" href="">');
}
$('head').append('<link id="custom-css1" rel="stylesheet" type="text/css" href="">');


var btnTheme=$('#btn-theme','#theme-switcher');

var switchesHolder=$('.switches-holder','#theme-switcher');

var themeSelected = getCookie("hostifythemeSet");

for (var i=0;i<=themes.length-1;i++){
    if(themeSelected==themes[i]){
        if(themeSelected=="org"){
            if(whmcs){ 
                $('head #custom-css1').attr('href',"");
                $('head #custom-css2').attr('href',"");
            }else{
                $('head #custom-css1').attr('href',"");
            }
        }else{
            if(whmcs){ 
                $('head #custom-css1').attr('href',"templates/hostify/css/style-"+themes[i]+".css");
                $('head #custom-css2').attr('href',"templates/hostify/css/styles-modified-"+themes[i]+".css");
            }else{
                $('head #custom-css1').attr('href',"css/style-"+themes[i]+".css");
            }
        }
        $('.switch',switchesHolder).removeClass('active');
        $('.switch[data-num='+i+']').addClass('active');
    }
}
for (var i=0;i<=themes.length-1;i++){
    if(Number(i+1)==1){
        $('.switches-holder .switch'+Number(i+1),'#theme-switcher').on('click',function(){
            if(whmcs){ 
                $('head #custom-css1').attr('href',"");
                $('head #custom-css2').attr('href',"");
            }else{
                $('head #custom-css1').attr('href',"");
            }
            document.cookie = "hostifythemeSet="+themes[Number($(this).data("num"))];
            setCookie("hostifythemeSet", themes[Number($(this).data("num"))], 1);
        });
    }else{
        $('.switches-holder .switch'+Number(i+1),'#theme-switcher').on('click',function(){
            if(whmcs){ 
                $('head #custom-css1').attr('href',"templates/hostify/css/style-"+themes[Number($(this).data("num"))]+".css");
                $('head #custom-css2').attr('href',"templates/hostify/css/styles-modified-"+themes[Number($(this).data("num"))]+".css");
            }else{
                $('head #custom-css1').attr('href',"css/style-"+themes[Number($(this).data("num"))]+".css");
            }
            document.cookie = "hostifythemeSet="+themes[Number($(this).data("num"))];
            setCookie("hostifythemeSet", themes[Number($(this).data("num"))], 1);
        });
    }
}

btnTheme.on('click',function(){
    switchesHolder.toggleClass('active');
});
$(".switch",switchesHolder).on('click',function(){
    $('.switch',switchesHolder).removeClass('active');
    $(this).addClass('active');
});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
/* for preview end */
"use strict";

// Add Slider functionality to the top of home page in #top-content section.
var mainSlider = $("#main-slider","#top-content");
mainSlider.slick({
    dots: true,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: false,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1
});
// Adding animation to the #main-slider
mainSlider.on('afterChange', function(event, slick, currentSlide, nextSlide){
    $('.slide > div:nth-child(1)','#main-slider').removeClass("animated");
    $('.slide > div:nth-child(2)','#main-slider').removeClass("animated animation-delay1");
 
    $('.slick-active > div:nth-child(1)','#main-slider').addClass("animated");
    $('.slick-active > div:nth-child(2)','#main-slider').addClass("animated animation-delay1");
});
// Add Slider functionality to the #testimonials section in the home page.
var testimonialsSlider = $("#testimonials-slider","#testimonials");
testimonialsSlider.slick({
    dots: false,
    arrows: true,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1
});
// Add Slider functionality to the testimonials in the "Sign in" and "Sign out" pages.
var miniTestimonialsSlider = $(".mini-testimonials-slider","#form-section");
miniTestimonialsSlider.slick({
    dots: true,
    arrows: false,
    infinite: false,
    autoplay: true,
    speed: 200
});
// Add Slider functionality to the info-slider in the about page.
var infoSlider = $(".info-slider","#page-head");
infoSlider.slick({
    dots: true,
    arrows: false,
    infinite: false,
    autoplay: true,
    speed: 200
});
$(window).on("load", function() {
    // Adding animation to the #main-slider
    $('.slick-active > div:nth-child(1)','#main-slider').addClass("animated");
    $('.slick-active > div:nth-child(2)','#main-slider').addClass("animated animation-delay1");
    // Counter slider functions in "CUSTOM HOSTING PLAN" section on the homepage
    var cPlan = $('#c-plan');
    cPlan.slider({
        tooltip: 'always'
    });
    cPlan.on("slide", function(e) {
        $('.slider .tooltip-up','#custom-plan').text(e.value/20);
        $('.price','#custom-plan').text($(this).data("currency") + e.value/20);
        $('.feature1 span','#custom-plan').text(e.value);
        $('.feature2 span','#custom-plan').text(e.value*98);
    });
    cPlan.value = cPlan.data("slider-value");
    $('.slider .tooltip','#custom-plan').append('<div class="tooltip-up"></div>');
    $('.slider .tooltip-up','#custom-plan').text(cPlan.value/20);
    $('.slider .tooltip-inner','#custom-plan').attr("data-unit",cPlan.data("unit"));
    $('.slider .tooltip-up','#custom-plan').attr("data-currency",cPlan.data("currency"));
    
    $('.price','#custom-plan').text(cPlan.data("currency") + cPlan.value/20);
    $('.feature1 span','#custom-plan').text(cPlan.value);
    $('.feature2 span','#custom-plan').text(cPlan.value*98);

    // Features Section click function
    var featureIconHolder = $(".feature-icon-holder", "#features-links-holder");
    
    featureIconHolder.on("click",function(){
        featureIconHolder.removeClass("opened");
        $(this).addClass("opened");
        $(".show-details","#features-holder").removeClass("show-details");
        $(".feature-d"+$(this).data("id"), "#features-holder").addClass("show-details");
    });
    
    // Fix #features-holder height in features section
    var featuresHolder = $("#features-holder");
    var featuresLinksHolder = $("#features-links-holder");
    var featureBox = $(".show-details","#features-holder");
    
    featuresHolder.css("height",featureBox.height()+120);
    featuresLinksHolder.css("height",featureBox.height()+120);

    // Fix #features-holder height in features section
    $(window).on("resize",function() {
        featuresHolder.css("height",featureBox.height()+120);
        featuresLinksHolder.css("height",featureBox.height()+120);
        return false;
    });
    
    // Apps Section hover function
    var appHolder = $(".app-icon-holder", "#apps");
    
    appHolder.on("mouseover",function(){
        appHolder.removeClass("opened");
        $(this).addClass("opened");
        $(".show-details", "#apps").removeClass("show-details");
        $(".app-details"+$(this).data("id"), "#apps").addClass("show-details");
    });
    
    // More Info Section hover function
    var infoLink = $(".info-link", "#more-info");
    
    infoLink.on("mouseover",function(){
        infoLink.removeClass("opened");
        $(this).addClass("opened");
        $(".show-details", "#more-info").removeClass("show-details");
        $(".info-d"+$(this).data("id"), "#more-info").addClass("show-details");
    });
    
    // Servers Marker Location in our servers page
    var locationsList = [["California",97,48,"r"],["Costa Rika",212,31,"l"],["Vancouver",136,161,"r"],["Brazil",303,233,"r"],["Alexandria",149,349,"l"],["Dubai",174,469,"l"],["Delhi",204,605,"r"],["Munech",91,417,"r"],["Barcelona",112,279,"l"],["Moscow",41,554,"r"],["Hong Kong",151,663,"r"],["Melborne",356,688,"l"],["Pulau Ujong",265,578,"l"]];
    
    var serversLocationHolder = $('.servers-location-holder','#serversmap.st');
    for(var i=0;i<=locationsList.length-1;i++){
        var sMarkerDir = locationsList[i][3];
        var leftText = "";
        var rightText = "";
        if(sMarkerDir=="r"){
            leftText = "";
            rightText = locationsList[i][0];
        }else if(sMarkerDir=="l"){
            leftText = locationsList[i][0];
            rightText = "";
        }
        serversLocationHolder.append('<div class="server-marker" style="top:'+locationsList[i][1]+'px;left:'+locationsList[i][2]+'px;"><span class="left-text">'+leftText+'</span><span class="marker-icon"></span><span class="right-text">'+rightText+'</span></div>');
    }
    
});