<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><%@page
	language="java" contentType="text/html; charset=ISO-8859-1"
	pageEncoding="ISO-8859-1"%>
<%@taglib uri="/WEB-INF/struts-html.tld" prefix="html"%>
<%@taglib uri="/WEB-INF/struts-bean.tld" prefix="bean"%>
<%@taglib uri="/WEB-INF/struts-logic.tld" prefix="logic"%>
<html>
<head>
<link href="/MNAOProduct/tiny_mce/plugins/aspnetbrowser/css/aspnetbrowser.css" rel="stylesheet" type="text/css" />
<script src="/MNAOProduct/tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script src="/MNAOProduct/tiny_mce/tiny_mce_popup.js" type="text/javascript"></script>
<script src="/MNAOProduct/tiny_mce/plugins/aspnetbrowser/js/aspnetbrowser.js" type="text/javascript"></script>
<script type="text/javascript">
	function changeSelectButton(checkBox, file, title) {
		var selectButton = document.getElementById("SelectButton");
		var fnName = "AspNetBrowserDialog.insert('" + file + "','" + title
				+ "')";
		alert(fnName);
		selectButton.onclick = new Function(fnName);
	}
</script>
<title>imgmanager</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
	<div>

		<html:form action="/saveTinymceImg" enctype="multipart/form-data">
			<div>
				<html:file property="imageFile" name="tinymce"></html:file>
				<html:submit value="upload"></html:submit>
			</div>
			<div style="width:100%;overflow-x:hidden;overflow-y:auto;height:400px;">
				<table id="deviceListTbl">

					<logic:iterate id="tinyLine" property="tinyMCELineList"
						name="tinymce">
						<tr>
							<logic:iterate id="tinyImage" property="tinyMCEList"
								name="tinyLine">
								<td><bean:write name="tinyImage" property="imageHTML"
										filter="false" />
								</td>
							</logic:iterate>
						</tr>
					</logic:iterate>

				</table>
			</div>
			
		</html:form>
	</div>

</body>
</html>