  jQuery(function($) {
 
                $(".topopup_lightbox").click(function(e) {
                                               
												//var item_id = $(this).metadata().ItemID;
                                                var item_id = $(this).attr('data');
                                                //alert(item_id);
                                                $("#selected_item").text("Selected Item: "+item_id);
                                                $("#toPopup").css("left",e.clientX);
                                                $("#toPopup").css("top",e.clientY);
                                                //alert(e.clientX );
                                                //alert(e.clientY);
               
                                                setTimeout(function(){ // then show popup, deley in .5 second
                                                                loadPopup(); // function show popup
                                                }, 100); // .5 second
                                                return false;
                });
 
                /* event for close the popup */
                $("div.close").hover(
                                function() {
                                                $('span.ecs_tooltip').show();
                                },
                                function () {
                                                $('span.ecs_tooltip').hide();
                                }
                );
 
                $("div.close").click(function() {
                                disablePopup();  // function close pop up
                });
 
                $(this).keyup(function(event) {
                                if (event.which == 27) { // 27 is 'Ecs' in the keyboard
                                                disablePopup();  // function close pop up
                                }
                });
 
                $('a.livebox').click(function() {
                                alert('Hello World!');
                return false;
                });
 
                 /************** start: functions. **************/
               
                var popupStatus = 0; // set value
 
                function loadPopup() {
                                if(popupStatus == 0) { // if value is 0, show popup
                                                $("#toPopup").fadeIn("normal"); // fadein popup div
                                                popupStatus = 1; // and set value to 1
                                }
                }
 
                function disablePopup() {
                                if(popupStatus == 1) { // if value is 1, close popup
                                                $("#toPopup").fadeOut("normal");
                                                //$("#backgroundPopup").fadeOut("normal");
                                                popupStatus = 0;  // and set value to 0
                                }
                }
                /************** end: functions. **************/
}); // jQuery End