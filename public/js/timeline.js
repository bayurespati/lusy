jQuery(document).ready(function(e){var t=e(".cd-horizontal-timeline"),n=60;function r(e,t,i){var r=f(e.eventsWrapper),a=Number(e.timelineWrapper.css("width").replace("px",""));"next"==i?l(e,r-a+n,a-t):l(e,r+a-n)}function a(e,t,n){var i,r,a,d,v,c,m,u,g=e.eventsContent.find(".selected");if(("next"==n?g.next():g.prev()).length>0){var h=e.eventsWrapper.find(".selected"),w="next"==n?h.parent("li").next("li").children("a"):h.parent("li").prev("li").children("a");s(w,e.fillingLine,t),o(w,e.eventsContent),w.addClass("selected"),h.removeClass("selected"),p(w),i=n,r=w,a=e,d=t,v=window.getComputedStyle(r.get(0),null),c=Number(v.getPropertyValue("left").replace("px","")),m=Number(a.timelineWrapper.css("width").replace("px","")),d=Number(a.eventsWrapper.css("width").replace("px","")),u=f(a.eventsWrapper),("next"==i&&c>m-u||"prev"==i&&c<-u)&&l(a,m/2-c,m-d)}}function l(e,t,n){var i=e.eventsWrapper.get(0);t=t>0?0:t,d(i,"translateX",(t=void 0!==n&&t<n?n:t)+"px"),0==t?e.timelineNavigation.find(".prev").addClass("inactive"):e.timelineNavigation.find(".prev").removeClass("inactive"),t==n?e.timelineNavigation.find(".next").addClass("inactive"):e.timelineNavigation.find(".next").removeClass("inactive")}function s(e,t,n){var i=window.getComputedStyle(e.get(0),null),r=i.getPropertyValue("left"),a=i.getPropertyValue("width"),l=(r=Number(r.replace("px",""))+Number(a.replace("px",""))/2)/n;d(t.get(0),"scaleX",l)}function o(e,t){var n=e.data("date"),i=t.find(".selected"),r=t.find('[data-date="'+n+'"]'),a=r.height();if(r.index()>i.index())var l="selected enter-right",s="leave-left";else l="selected enter-left",s="leave-right";r.attr("class",l),i.attr("class",s).one("webkitAnimationEnd oanimationend msAnimationEnd animationend",function(){i.removeClass("leave-right leave-left"),r.removeClass("enter-left enter-right")}),t.css("height",a+"px")}function p(e){e.parent("li").prevAll("li").children("a").addClass("older-event").end().end().nextAll("li").children("a").removeClass("older-event")}function f(e){var t=window.getComputedStyle(e.get(0),null);if((n=t.getPropertyValue("-webkit-transform")||t.getPropertyValue("-moz-transform")||t.getPropertyValue("-ms-transform")||t.getPropertyValue("-o-transform")||t.getPropertyValue("transform")).indexOf("(")>=0)var n,i=(n=(n=(n=n.split("(")[1]).split(")")[0]).split(","))[4];else i=0;return Number(i)}function d(e,t,n){e.style["-webkit-transform"]=t+"("+n+")",e.style["-moz-transform"]=t+"("+n+")",e.style["-ms-transform"]=t+"("+n+")",e.style["-o-transform"]=t+"("+n+")",e.style.transform=t+"("+n+")"}function v(e,t){return Math.round(t-e)}function c(e){for(var t=e.offsetTop,n=e.offsetLeft,i=e.offsetWidth,r=e.offsetHeight;e.offsetParent;)t+=(e=e.offsetParent).offsetTop,n+=e.offsetLeft;return t<window.pageYOffset+window.innerHeight&&n<window.pageXOffset+window.innerWidth&&t+r>window.pageYOffset&&n+i>window.pageXOffset}function m(){return window.getComputedStyle(document.querySelector(".cd-horizontal-timeline"),"::before").getPropertyValue("content").replace(/'/g,"").replace(/"/g,"")}t.length>0&&t.each(function(){var t,l,f=e(this),d={};d.timelineWrapper=f.find(".events-wrapper"),d.eventsWrapper=d.timelineWrapper.children(".events"),d.fillingLine=d.eventsWrapper.children(".filling-line"),d.timelineEvents=d.eventsWrapper.find("a"),d.timelineEventsYear=d.eventsWrapper.find("p"),d.timelineDates=(t=d.timelineEvents,l=[],t.each(function(){var t=e(this).data("date").split("/"),n=new Date(t[2],t[1]-1,t[0]);l.push(n)}),l),d.eventsMinLapse=function(e){var t=[];for(i=1;i<e.length;i++){var n=v(e[i-1],e[i]);t.push(n)}return Math.min.apply(null,t)}(d.timelineDates),d.timelineNavigation=f.find(".cd-timeline-navigation"),d.eventsContent=f.children(".events-content"),function(e,t){for(i=0;i<e.timelineDates.length;i++){var n=v(e.timelineDates[0],e.timelineDates[i]),r=Math.round(n/e.eventsMinLapse)+2;e.timelineEvents.eq(i).css("left",r*t+"px"),e.timelineEventsYear.eq(i).css("left",r*t+"px")}}(d,n);var u,g,h,w,x=(g=n,h=v((u=d).timelineDates[0],u.timelineDates[u.timelineDates.length-1])/u.eventsMinLapse,w=(h=Math.round(h)+4)*g,u.eventsWrapper.css("width",w+"px"),s(u.timelineEvents.eq(0),u.fillingLine,w),w);f.addClass("loaded"),d.timelineNavigation.on("click",".next",function(e){e.preventDefault(),r(d,x,"next")}),d.timelineNavigation.on("click",".prev",function(e){e.preventDefault(),r(d,x,"prev")}),d.eventsWrapper.on("click","a",function(t){t.preventDefault(),d.timelineEvents.removeClass("selected"),e(this).addClass("selected"),p(e(this)),s(e(this),d.fillingLine,x),o(e(this),d.eventsContent)}),d.eventsContent.on("swipeleft",function(){var e=m();"mobile"==e&&a(d,x,"next")}),d.eventsContent.on("swiperight",function(){var e=m();"mobile"==e&&a(d,x,"prev")}),e(document).keyup(function(e){"37"==e.which&&c(f.get(0))?a(d,x,"prev"):"39"==e.which&&c(f.get(0))&&a(d,x,"next")})})});