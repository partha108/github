jQuery(document).ready(function(){jQuery(".w-nav-list.layout_hor.level_1").navToSelect({select:".w-nav-select-h",list:".w-nav-list",item:".w-nav-item"}),jQuery.magnificPopup&&jQuery(".w-gallery-tnails-h").magnificPopup({type:"image",delegate:"a",gallery:{enabled:!0,navigateByImgClick:!0,preload:[0,1]},removalDelay:300,mainClass:"mfp-fade",fixedContentPos:!1}),jQuery().carousello&&jQuery(".w-listing.type_carousel, .w-clients.type_carousel, .w-portfolio.type_carousel").carousello();if(jQuery().isotope){var e=jQuery(".w-portfolio.type_sortable .w-portfolio-list-h");e&&(e.imagesLoaded(function(){e.isotope({itemSelector:".w-portfolio-item",layoutMode:"fitRows"})}),jQuery(".w-filters-item").each(function(){var t=jQuery(this),n=t.find(".w-filters-item-link");n.click(function(){if(!t.hasClass("active")){jQuery(".w-filters-item").removeClass("active"),t.addClass("active");var n=jQuery(this).attr("data-filter");return e.isotope({filter:n}),!1}})}),jQuery(".w-portfolio-item-meta-tags a").each(function(){jQuery(this).click(function(){var t=jQuery(this).attr("data-filter"),n=jQuery('a[class="w-filters-item-link"][data-filter="'+t+'"]'),r=n.parent(".w-filters-item");if(!r.hasClass("active"))return jQuery(".w-filters-item").removeClass("active"),r.addClass("active"),e.isotope({filter:t}),!1})}));var t=jQuery(".w-blog.type_masonry .w-blog-list");if(t.length){t.imagesLoaded(function(){t.isotope({itemSelector:".w-blog-entry",layoutMode:"masonry"})});var n;$(window).resize(function(){window.clearTimeout(n),n=window.setTimeout(function(){t.isotope("reLayout")},50)})}var r=jQuery(".w-gallery.type_masonry .w-gallery-tnails-h");if(r.length){r.imagesLoaded(function(){r.isotope({layoutMode:"masonry"})});var i;$(window).resize(function(){window.clearTimeout(i),i=window.setTimeout(function(){r.isotope("reLayout")},50)})}}jQuery().revolution&&(jQuery.fn.cssOriginal!=undefined&&(jQuery.fn.css=jQuery.fn.cssOriginal),jQuery(".fullwidthbanner").revolution({delay:9e3,startwidth:1024,startheight:600,soloArrowLeftHOffset:0,soloArrowLeftVOffset:0,soloArrowRightHOffset:0,soloArrowRightVOffset:0,onHoverStop:"on",fullWidth:"on",hideThumbs:!1,shadow:0})),$("iframe").each(function(){var e=jQuery(this).attr("src"),t="?";if(e.indexOf("?")!=-1)var t="&";jQuery(this).attr("src",e+t+"wmode=transparent")}),jQuery(".w-twitter-tweets").tweet({join_text:"auto",username:"envato",avatar_size:48,count:2,template:"<i class='icon-twitter'></i><span>{text}</span> <small>{time}</small>",loading_text:"loading tweets..."}),jQuery().waypoint&&jQuery("body").imagesLoaded(function(){jQuery(".animate_afc, .animate_afl, .animate_afr, .animate_aft, .animate_afb, .animate_wfc, .animate_hfc, .animate_rfc, .animate_rfl, .animate_rfr").waypoint(function(){if(!jQuery(this).hasClass("animate_start")){var e=jQuery(this);setTimeout(function(){e.addClass("animate_start")},20)}},{offset:"85%",triggerOnce:!0})})});