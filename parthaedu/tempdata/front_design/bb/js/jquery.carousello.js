/**
 * Carousello
 *
 * @version 1.0
 *
 * Copyright 2013, UpSolution
 */!function(e){var t=function(t,n){var r=this;this.container=e(t),n=e.extend({},e.fn.carousello.defaults,typeof n=="object"&&n),this.options=n,this.widgetName=this.container.attr("class").split(" ")[0],this.btnPrev=this.container.find("."+this.widgetName+"-nav.to_prev"),this.btnNext=this.container.find("."+this.widgetName+"-nav.to_next"),this.list=this.container.find("."+this.widgetName+"-list"),this.listH=this.container.find("."+this.widgetName+"-list-h"),this.items=this.container.find("."+this.widgetName+"-item"),this.count=this.items.length,this.itemWidth=e(this.items).outerWidth(),this.itemOffset=parseInt(e(this.items).css("margin-right")),this.options.use3d&&(this.cssPrefix=this._get3DPrefix(),this.cssPrefix===!1&&(this.options.use3d=!1)),this.position=0,this.btnPrev.click(function(){r.slidePrev()}),this.btnNext.click(function(){r.slideNext()}),e(window).resize(function(){clearTimeout(r._resizeTimer),r._resizeTimer=setTimeout(function(){r.handleResize()},r.options.resizeDelay)}),this.options.use3d?this.container.imagesLoaded(function(){r.list.height(r.items.outerHeight()),r.handleResize()}):this.handleResize()};t.prototype={_get3DPrefix:function(){var e=document.createElement("div"),t=!1,n=["perspectiveProperty","WebkitPerspective"],r=["","-o-","-moz-","-webkit-"];for(var i=n.length-1;i>=0;i--)t=t?t:e.style[n[i]]!=undefined;if(t){var s=document.createElement("style");document.getElementsByTagName("head")[0].appendChild(s),e.id="test3d",document.body.appendChild(e);for(var o in r){s.textContent="@media ("+r[o]+"transform-3d){#test3d{height:3px}}";if(e.offsetHeight===3){t=r[o];break}}s.parentNode.removeChild(s),e.parentNode.removeChild(e)}return t===!0&&(t="-webkit-"),t},slidePrev:function(){var e=Math.max(0,this.position-this.perRow);this.slideTo(e)},slideNext:function(){var e=Math.min(this.count-this.perRow,this.position+this.perRow);this.options.use3d&&(e=this.position+this.perRow),this.slideTo(e)},slideTo:function(e){if(e==this.position)return;if(this.options.use3d){var t=Math.min(Math.floor(e/this.perRow),this.groups.length-1),n=this;e=t*this.perRow,this.listH.animate({angle:-1*this.baseAngle*t},{duration:this.options.duration,easing:this.options.easing,step:function(e){e=parseInt(e*100)/100,n.listH.css(n.cssPrefix+"transform","translateZ(-"+n.translateZ+"px) rotateY("+e+"deg)")},queue:!1})}else this.listH.animate({left:-1*e*(this.itemWidth+this.itemOffset)},{duration:this.options.duration,easing:this.options.easing,queue:!1});this.btnPrev[e==0?"addClass":"removeClass"]("disabled"),this.btnNext[e>=this.count-this.perRow?"addClass":"removeClass"]("disabled"),this.position=e},handleResize:function(){var t=this.container.width(),n=this.perRow,r=this;this.perRow=Math.max(1,Math.floor((t+this.itemOffset)/(this.itemWidth+this.itemOffset)));var i=this.perRow*(this.itemWidth+this.itemOffset)-this.itemOffset;this.list.width(i);if(this.options.use3d&&(n==undefined||this.perRow!=n)){this.listH.append(this.items),this.listH.children("."+this.widgetName+"-itemgroup").remove();for(var s=0,o=Math.ceil(this.count/this.perRow);s<o;s++){var u=e("<div/>",{"class":this.widgetName+"-itemgroup"}).appendTo(this.listH);for(var a=0;a<this.perRow;a++){if(this.items[s*this.perRow+a]==undefined)break;u.append(this.items[s*this.perRow+a])}}this.groups=this.container.find("."+this.widgetName+"-itemgroup"),this.baseAngle=Math.min(120,360/this.groups.length),this.translateZ=Math.round(.5*i/Math.tan(Math.PI/Math.max(3,this.groups.length))),this.list.css({position:"relative","overflow-x":this.groups.length<5?"visible":"hidden"}).css(this.cssPrefix+"perspective","800px"),this.listH.css({position:"absolute",height:"100%",width:"100%"}).css(this.cssPrefix+"transform","rotateY(0deg) translateZ(-"+this.translateZ+"px)").css(this.cssPrefix+"transform-style","preserve-3d").css(this.cssPrefix+"perspective-origin","50% 100px"),this.list.height(this.items.outerHeight()),this.groups.css({position:"absolute",left:0,width:"100%",height:"100%"}),e.each(this.groups,function(t,n){e(n).css(r.cssPrefix+"transform","rotateY("+r.baseAngle*t+"deg) translateZ("+r.translateZ+"px)")})}n!=undefined&&this.perRow!=n&&(this.position>this.count-this.perRow&&this.slideTo(this.count-this.perRow),this.btnNext[this.position>=this.count-this.perRow?"addClass":"removeClass"]("disabled")),this.perRow>=this.count?(this.btnPrev.hide(),this.btnNext.hide()):(this.btnPrev.show(),this.btnNext.show())}},e.easing.easeOutBack==undefined&&(e.easing.easeOutBack=function(e,t,n,r,i,s){return s==undefined&&(s=1.70158),r*((t=t/i-1)*t*((s+1)*t+s)+1)+n}),e.easing.easeInOutExpo==undefined&&(e.easing.easeInOutExpo=function(e,t,n,r,i){return t==0?n:t==i?n+r:(t/=i/2)<1?r/2*Math.pow(2,10*(t-1))+n:r/2*(-Math.pow(2,-10*--t)+2)+n}),e.fn.carousello=function(n){return this.each(function(){var r=e(this),i=r.data("carousello");i||r.data("carousello",i=new t(this,n))})},e.fn.carousello.defaults={use3d:!0,duration:500,easing:"easeInOutExpo",resizeDelay:50},e.fn.carousello.Constructor=t}(jQuery);