function print_order_details()
{
	var order_id = $("#selected_order_id").val();
	
	$.ajax({  
			  type: "GET",
			  dataType:'json',  
			  url:base_url+"index.php/order/getorderdetails/"+order_id,  
			  async: false,  
			  success: function(data) {
				 
				  printTable(data.orderdetails_list)
				
			}  
	});
	
	
}

function printTable(oData) {
    var printable = $("<div></div>");
    printable.addClass("printable");

    var header = $("<div></div>");
    header.html("<b>Invoice Details</b>");
	
	  printable.append(header);	
    var logo = $("<div class=''></div>");
    logo.html("<img src='"+oData[0].base_url+"'images/logo.png'/>");
    printable.append(logo);

    var address = $("<div></div>");
    address.html("<b>Showroom Address:</b><br><p>Atghara, Chinarpark<br>24 Parganas(N)<br> Kolkata 70059</p>");
	
    printable.append(address);
	
    
   var blankDiv = $("<div></div>");
    printable.append(blankDiv);

    var table = $('<table></table>');
    table.addClass("borderTable");
	
	
		var thead = $('<tbody></tbody>');
		table.append(thead);
		
		var trow = $('<tr></tr>');
		thead.append(trow);
		
		
		
		var column = $('<td colspan="2"></td>').text("Invoice Number:"+"-"+oData[0].invoice_num);
		column.css("font-family", "Arial Narrow");
        column.css("font-size", "12px");
		trow.append(column);
		
		
		
		var column = $('<td></td>').text("Amount:"+"-"+oData[0].amount);
		column.css("font-family", "Arial Narrow");
        column.css("font-size", "12px");
		trow.append(column);
		
		var column = $('<td></td>');
		trow.append(column);
		
		var column = $('<td></td>').text("Date:"+"-"+oData[0].date_time);
		column.css("font-family", "Arial Narrow");
        column.css("font-size", "12px");
		trow.append(column);
		
		var trow = $('<tr></tr>');
		thead.append(trow);
		var trow = $('<tr></tr>');
		thead.append(trow);

    var row = $('<tr></tr>');
    table.append(row);

  	column = $('<th></th>').text("Item Name");
    column.css("font-family", "Arial Narrow");
    column.css("font-size", "12px");
	column.css("float", "left");
    row.append(column);

    column = $('<th></th>').text("Product Description");
    column.css("font-family", "Arial Narrow");
    column.css("font-size", "12px");
    row.append(column);

    column = $('<th></th>').text("Quantity");
    column.css("font-family", "Arial Narrow");
    column.css("font-size", "12px");
    row.append(column);

   

    column = $('<th></th>').text("Price");
    column.css("font-family", "Arial Narrow");
    column.css("font-size", "12px");
    row.append(column);

    

    for (var r = 0; r < oData.length; r++) {
        var data = oData[r];
        row = $('<tr></tr>');
        table.append(row);

        column = $('<td></td>').text(data.item_name);
        column.css("font-family", "Arial Narrow");
        column.css("font-size", "10px");
        row.append(column);

        column = $('<td></td>').text(data.item_desc);
        column.css("font-family", "Arial Narrow");
        column.css("font-size", "10px");
        row.append(column);

     

        column = $('<td></td>').text(data.quantity);
        column.css("font-family", "Arial Narrow");
        column.css("font-size", "10px");
		column.css("float","left");
		column.css("padding-left","20px");
        row.append(column);

        column = $('<td></td>').text(data.price);
        column.css("font-family", "Arial Narrow");
        column.css("font-size", "10px");
        row.append(column);

    }

    printable.append(table);
    printable.print();
}
//END-CODE FOR PRINT 