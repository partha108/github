(function(e){e.fn.wTimeline=function(t){var n={},r=e.extend(n,t);return this.each(function(){function h(){e(r).css({width:t.innerWidth()-l-2+"px"}),o=r.length*(t.innerWidth()-2);var n=-c*(t.innerWidth()-2);a.css({width:o+"px",left:n}),u.css({width:t.innerWidth()-2+"px",height:e(r[c]).outerHeight()+"px"})}var t=e(this),n=t.find(".w-timeline-item"),r=t.find(".w-timeline-section"),i=e(r[0]).outerWidth()-e(r[0]).width(),s=!1,o=r.length*(t.innerWidth()-2),u=t.find(".w-timeline-sections").css({width:t.innerWidth()-2+"px",height:e(r[0]).outerHeight()+"px",overflow:"hidden",position:"relative"}),a=e("<div></div>",{id:"section_container"}).css({width:o+"px",height:e(r[0]).outerHeight()+"px",position:"relative"}),f=null,l=e(r[0]).innerWidth()-e(r[0]).width(),c=0;e(r).css({display:"block","float":"left",width:e(r[0]).width()+"px"}),e(r).each(function(e,t){a.append(t)}),u.append(a),e(window).resize(function(){window.clearTimeout(f),f=window.setTimeout(function(){h()},50)}),r.each(function(i,o){var f=e(o),l=e(n[i]),h=f.find(".w-timeline-section-content");l&&l.click(function(){if(!f.hasClass("active")&&!s){s=!0,n.each(function(){e(this).hasClass("active")&&e(this).removeClass("active")}),l&&l.addClass("active");var o=-i*(t.innerWidth()-2);u.animate({height:f.outerHeight()},300),a.animate({left:o},300,function(){r.each(function(){e(this).hasClass("active")&&e(this).removeClass("active")}),f.addClass("active"),c=i,s=!1})}})})})}})(jQuery),jQuery(document).ready(function(){jQuery(".w-timeline").wTimeline()});