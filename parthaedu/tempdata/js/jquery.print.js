// Create a jquery plugin that prints the given element.
jQuery.fn.print = function (options) {


    //CODE FOR CHECKING BROWSER
    var check = function (r) {
        return r.test(ua);
    };
    var ua = navigator.userAgent.toLowerCase();
    var isOpera = check(/opera/);
    var isChrome = check(/chrome/);
    var isWebKit = check(/webkit/);
    var isSafari = !isChrome && check(/safari/);
    var isIE = !isOpera && check(/msie/);
    //END-CODE FOR CHECKING BROWSER


    var jStyleDiv = $("<div>").append(
		    $("style").clone()
	 );

    var WinPrint = window.open('', '', 'left=-700,top=0,width=1,height=1,toolbar=0,scrollbars=0,status=0');
    $(WinPrint).hide();
    var objDoc = WinPrint.document;
    objDoc.write(jStyleDiv.html());
    if (isIE)
        objDoc.write("<OBJECT ID=\"WebBrowser1\" WIDTH=\"0\" HEIGHT=\"0\" CLASSID=\"CLSID:8856F961-340A-11D0-A96B-00C04FD705A2\"></OBJECT>");
    objDoc.write(this.html());
    if (isIE) {
        objDoc.write('<script>');
        objDoc.write('try{ WebBrowser1.ExecWB(6, 2);');
        objDoc.write('WebBrowser1.outerHTML = "";}catch(e){window.print();}');
        objDoc.write('</script>');
       
        WinPrint.document.close();
        WinPrint.close();
    }
    else {
        WinPrint.print();
        WinPrint.document.close();
        WinPrint.close();
    }


}

