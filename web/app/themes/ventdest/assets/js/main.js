var currentTime = new Date()
var year = currentTime.getFullYear();

var toggleAffix = function (affixElement, scrollElement, wrapper) {
    var height = affixElement.outerHeight(),
        top = wrapper
        .offset()
        .top;
    
    wrapper.height(height);
    if (scrollElement.scrollTop() > (top + 100)) {
        // if (scrollElement.scrollTop() > top) {
            affixElement.addClass("affix");
        // }
        
    } else {
        affixElement.removeClass("affix");
        // wrapper.height('auto');
    }
};

function showSearchBar() {
    var x = document.getElementById("search-input");
    if (x.style.visibility === "hidden") {
        x.style.visibility = "visible";
    } else {
        x.style.visibility = "hidden";
    }
}

function changeCardCollapseClass(id) {
    var x = document.getElementById(id);

    if (x.classList.contains("fa-plus-circle")) {
        x.classList.remove("fas");
        x.classList.remove("fa-plus-circle");
        x.classList.add("far");
        x.classList.add("fa-times-circle");
    } else {
        x.classList.remove("far");
        x.classList.remove("fa-times-circle");
        x.classList.add("fas");
        x.classList.add("fa-plus-circle");
    }
}

function changeNewsTableCollapseClass(id) {
    var x = document.getElementById(id);

    if (x.classList.contains("fa-angle-down")) {
        x.classList.remove("fas");
        x.classList.remove("fa-angle-down");
        x.classList.add("fas");
        x.classList.add("fa-angle-up");
    } else {
        x.classList.remove("fas");
        x.classList.remove("fa-angle-up");
        x.classList.add("fas");
        x.classList.add("fa-angle-down");
    }
}

function displayAnotherSearchTab(id) {
    var newSearchTab = document.getElementById(id);
    var searchTabs = document.getElementsByClassName('table-search-exposants');
    var idNumber = id.replace( /^\D+/g, ''); 

    for (var i = 0; i < searchTabs[0].children.length; i++) {
        if(searchTabs[0].children[i].classList.contains("active")) {
            searchTabs[0].children[i].classList.remove('active');

            var oldIdNumber = searchTabs[0].children[i].id.replace( /^\D+/g, ''); 

            var oldTab = document.getElementById('tabSearchExposantsOptions' + oldIdNumber);
            oldTab.classList.add('d-none');
        }
    }

    newSearchTab.classList.add('active');

    var newTab = document.getElementById('tabSearchExposantsOptions' + idNumber);
    newTab.classList.remove('d-none');
}

function initMap() {
    var foireLibramont = {lat: 49.912874, lng: 5.372295};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: foireLibramont
    });
    var marker = new google.maps.Marker({
        position: foireLibramont,
        map: map
    });
}

function changeFixedTopPosition () {

    if(jQuery( window ).width() < 620) {
        var header = document.getElementsByClassName('fixed-top');
        header[0].style.top = '0px';
    }
}

changeFixedTopPosition();

jQuery(function ($) {
    
    // Clone navigation for mobile menu and add subnavigation buttons
    function cloneMenu(id){
        // Cloning and adding responsive class for mobile layout
        clone = $(id).clone().addClass('responsive').removeClass('bg-light');

        // Check if each menu-item has a dropdown submenu 
        $(clone).find('.menu-item').each(function(){
            if($(this).hasClass('dropdown')){
                // Add arrow to navigate to submenu
                $(this).append('<button type="button" class="deploy-dropdown"><i class="fas fa-arrow-right text-white"></i></button>');
            }
        });

        // Add dismiss button and title from parent item to each dropdown submenu 
        $(clone).find('.dropdown-menu').each(function(){
            var itemTitle = $(this).prev().children().html();
            if($(this).prev().hasClass('dropdown-toggle')){
                itemTitle = $(this).prev().html();
            }
            // Avoid adding in languade dropdown 
            if($(this).parents().hasClass('language-dropdown') != true){
                $(this).prepend('<li class="dropdown-title">'+itemTitle+'</li>');
                $(this).append('<button type="button" class="dismiss"><i class="fas fa-times text-white"></i></button>');
            }
        });

        // Add cloned navigation to the header
        $(id).parent().append(clone);
    }

    cloneMenu('#main_nav');

    var searchBar = document.getElementById('exhibitor_search');

    if(searchBar){
        searchBar.oninput = autoComplete;
        searchBar.onpropertychange = searchBar.oninput;

        var awesomplete = new Awesomplete(document.querySelector("#exhibitor_search"),{
            minChars: 2
        });

        function autoComplete() {
            var keyword = $(this).val();
            $.post(
                ajaxurl,
                {
                    'action': 'autocompleteAjax',
                    'query': keyword,
                    'lang': util.wpml_current_language
                },
                function(response){
                    var list = JSON.parse(response).map(function(i) { return i.label; });
                    console.log(list);
                    awesomplete.list = list;
                    awesomplete.evaluate();
                }
            );
        }
    }
    
    $('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        gutter: 10,
        horizontalOrder: true,
        percentPosition: true
    });

    $('[data-toggle="tooltip"]').tooltip();

    /* use toggleAffix on any data-toggle="affix" elements */
    $('[data-toggle="affix"]').each(function () {
        var ele = $(this),
            wrapper = $('<div></div>');

        ele.before(wrapper);
        $(window).on('scroll resize', function () {
            toggleAffix(ele, $(this), wrapper);
        });

        // init
        toggleAffix(ele, $(window), wrapper);
    });

    $(window).scroll(function () {
        /* affix after scrolling 50px */
        if ($(document).scrollTop() > 50) {
            $('.navbar').addClass('affix');
            var header = document.getElementsByClassName('fixed-top');
                header[0].style.top = '0px';
        } else {
            $('.navbar').removeClass('affix');
            var header = document.getElementsByClassName('fixed-top');
            var topBanner = document.getElementById('above-header');      
            var topBannerHeight = $(topBanner).height();

            topBanner.style.height = '40px';
            header[0].style.top = '40px';
        }
    });
    $('.navbar').removeClass('affix');

    /* CLIENTS SLIDER */

    $('.customer-logos').slick({
        slidesToShow: 8,
        slidesToScroll: 8,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        dots: false,
        pauseOnHover: true,
        responsive: [{
            breakpoint: 769,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            }
        }]
    });

    $('.other-activities-slider').slick({
        slidesToShow: 6,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        dots: false,
        pauseOnHover: true,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
            }
        }]
    });


    $('.home-page-main-slider').slick({
        rows: 0,
        speed: 300,
        adaptiveHeight: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        cssEase: 'linear',
        variableHeight: true
    });

    // $("#sidebar").mCustomScrollbar({
    //     theme: "minimal"
    // });

    // when opening the responsive menu
    $('#sidebarCollapse').on('click', function () {
        // open responsive menu
        $('.navbar.responsive').addClass('active');
        // fade in the overlay
        $('.overlay').fadeIn();
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    // if dismiss is clicked
    $('.dismiss').on('click', function () {
        // Hide menu or submenu based on .dismiss button location
        if($(this).parent().hasClass('dropdown-menu')){
            $(this).parent().removeClass('active');
        }else{
            $('.navbar.responsive').removeClass('active');
            // fade out the overlay
            $('.overlay').fadeOut();
        }
    });

    // if deploy-dropdown is clicked
    $('.deploy-dropdown').on('click', function () {
        // Display submenu placed before deploy-dropdown button
        if($(this).prev().hasClass('dropdown-menu')){
            $(this).prev().addClass('active');
        }
    });

    $('.overlay').on('click', function () {
        // hide the menu
        $('.navbar.responsive').removeClass('active');
        $('.dropdown-menu').removeClass('active');
        // fade out the overlay
        $('.overlay').fadeOut();
    });

    // $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
    //     var $el = $(this);
    //     var $parent = $(this).offsetParent(".dropdown-menu");
    //     if (!$(this).next().hasClass('show')) {
    //         $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    //     }
    //     var $subMenu = $(this).next(".dropdown-menu");
    //     $subMenu.toggleClass('show');

    //     $(this).parent("li").toggleClass('show');

    //     $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
    //         $('.dropdown-menu .show').removeClass("show");
    //     });

    //     if (!$parent.parent().hasClass('navbar-nav')) {
    //         $el.next().css({
    //             "top": $el[0].offsetTop,
    //             "left": $parent.outerWidth() - 4
    //         });
    //     }

    //     return false;
    // });

});
