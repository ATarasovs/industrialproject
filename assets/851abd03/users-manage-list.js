$(document).ready(function() {
    console.log("Connected");
    initButtons();
    addContent();
});

function initButtons() {
    
}

function addContent() {
    $("#content").load(usersListReqUrl);
}

//$(document).ready(function () {
//
//	initFilterValues();
//	initButtons();
//	initKeyPress();
//	initEvents();
//	initPreloader();
//	getListXmlReq(userdevicesListReqUrl, formUserdevicesListData(pageNr, 10), userdevicesListParser);
//
//});
//
//function initEvents(){
//	$(document).on("user-search-popup-choose", function(e, d){
//		var value = d.idlist;
//		console.log(d.idlist);
//		$("#filterByUserId").val(value);
//	});
//}
//
//function initFilterValues(){
//	if(pageNr == ""){
//		pageNr = 1;
//	}
//	
//	if(searchParamUserId.charAt(0) == '*' && searchParamUserId.charAt(searchParamUserId.length - 1) == '*'){
//		searchParamUserId = searchParamUserId.substring(1, searchParamUserId.length - 1);
//	}
//	$("#filterByUserId").val(searchParamUserId);
////	$("#filterByStatus").val(searchParamStatus);
//}
//
//function initButtons() {
//	$(document).on("click", ".openUserSearchPopupBtn", function(){
//		tableRowIndex = $(this).parents("tr").index();
//		$("#usPopup1_filterByNameInput").val("");		
//		$("#usPopup1_modalInfoMessage div").remove();
//		$("#usPopup1_userTable tbody").empty();
//
//		$("#user-search-popup-1").removeClass("hide").dialog({
//			resizable: false,
//			width: "90%",
//			modal: true,
//			title: userSearchText,
//			title_html: true,
//			buttons: [{
//				html: "<i class=\'ace-icon fa fa-check bigger-110\'></i> " + chooseText,
//				"class": "btn btn-primary btn-sm",
//				click: function(){
//					var selectedUsers = usPopup1_collectSelected();
//					var selectedIds = usPopup1_collectIdsOfSelected();
//					var selectedNames = usPopup1_collectNamesOfSelected();
//
//					if(selectedIds == null){
//						$("#usPopup1_modalInfoMessage").append(
//							'<div class="alert alert-danger">' +
//								'<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' +
//								noUserSelectedText +
//							'</div>'
//						);
//					}else{
//						$(document).trigger("user-search-popup-choose", {"userlist": selectedUsers, "idlist": selectedIds, "namelist": selectedNames});
//						$(this).dialog("close");
//					}
//				}
//			},{
//				html: "<i class=\'ace-icon fa fa-close bigger-110\'></i> " + closeText,
//				"class": "btn btn-sm",
//				click: function(){
//					$(this).dialog("close");
//				}
//			}]
//		});
//
//		getListXmlReq(usPopup1_userSearchReqUrl, usPopup1_formUsersSearchData("search", "", "", "external", 10, 1, "FRONT", "en"), usPopup1_userSearchParser);
//
//	});
//
//	$('#srchBtn').click(function(){
//		$("#userdevicesList tbody").empty();
//		searchBtnLadda.start();
//		initPreloader();
//		getListXmlReq(userdevicesListReqUrl, formUserdevicesListData(1, 10), userdevicesListParser);
//	});
//
////	$("#userdevicesList").on('click', 'a.edit-userdevices', function(){
////		var userdeviceId = $(this).attr('data-userdevices-id');
////		location.href = userdevicesEditUrl + '?userdevicesid=' + encodeURIComponent(userdeviceId);
////	});
//	
//	$("#userdevicesList").on('click', 'a.view-userdevices', function() {
//		var userdeviceId = $(this).data('userdevices-id');
//		var redirectObj = {
//			url: "/userdevices/userdevices/list",
//		}
//		var redirectString = JSON.stringify(redirectObj);
//		
//		location.href = userdevicesViewUrl + '?id=' + encodeURIComponent(userdeviceId) + '&redirectData=' + redirectString;
//	});
//
//	$("#userdevicesPagination").on("click", "li", function (){
//		if((!$(this).hasClass("active")) && (!$(this).hasClass("disabled"))){
//			$("#userdevicesList tbody").empty();
//			initPreloader();
//			getListXmlReq(userdevicesListReqUrl, formUserdevicesListData($(this).attr("page"), 10), userdevicesListParser);
//		}
//	});
//
//	$("#userdevicesList").on('click', 'a.delete-userdevices', function(e) {
//		e.preventDefault();
//		var userdevicesId = $(this).attr('data-userdevices-id');
//
//		$("#dialog-confirm").removeClass('hide').dialog({
//			resizable: false,
//			modal: true,
//			title: deleteUserdevicesText + "?",
//			title_html: true,
//			buttons: [{
//				html: "<i class='ace-icon fa fa-trash-o bigger-110'></i> " + deleteText,
//				"class": "btn btn-danger btn-sm",
//				click: function () {
//					var redirectObj = {
//						url: "/userdevices/userdevices/list",
//					}
//					var redirectString = JSON.stringify(redirectObj);
//					location.href = userdevicesDeleteReqUrl + '?id=' + encodeURIComponent(userdevicesId) + '&redirectData=' + redirectString;
//					$(this).dialog("close");
//				}
//			},{
//				html: "<i class='ace-icon fa fa-times bigger-110'></i> " + closeText,
//				"class": "btn btn-primary btn-sm",
//				click: function () {
//					$(this).dialog("close");
//				}
//			}]
//		});
//	});
//
////	$("#addUserdevicesBtn").on("click", function () {
////		location.href = userdevicesEditUrl;
////	});
//}
//
//function initKeyPress(){
//	$('#filterByUserId').keyup(function(e){
//		if(e.keyCode == 13){
//			initPreloader();
//			getListXmlReq(userdevicesListReqUrl, formUserdevicesListData(1, 10), userdevicesListParser);
//		}
//		
//		//Input field is empty, we are showing everything
//		if((e.keyCode == 8 || e.keyCode == 46) && ($(this).val().length < 1)){
//			initPreloader();
//			getListXmlReq(userdevicesListReqUrl, formUserdevicesListData(1, 10), userdevicesListParser);
//		}
//	});
//}
//
////function initDropDown(){
////	$("#filterByStatus").on("change", function(e) {
////		initPreloader();
////		getListXmlReq(userdevicesListReqUrl, formUserdevicesListData(1, 10), userdevicesListParser);
////	});
////}
//
//function initPreloader(){
//	
//	$("#spinner-preloader").show();
//	$("#userdevicesPagination").hide();
//	
//	var opts = {
//		lines: 13, // The number of lines to draw
//		length: 7, // The length of each line
//		width: 4, // The line thickness
//		radius: 10, // The radius of the inner circle
//		corners: 1, // Corner roundness (0..1)
//		rotate: 0, // The rotation offset
//		color: '#000', // #rgb or #rrggbb
//		speed: 1, // Rounds per second
//		trail: 60, // Afterglow percentage
//		shadow: false, // Whether to render a shadow
//		hwaccel: false, // Whether to use hardware acceleration
//		className: 'spinner', // The CSS class to assign to the spinner
//		zIndex: 2e9, // The z-index (defaults to 2000000000)
//		top: 'auto', // Top position relative to parent in px
//		left: 'auto' // Left position relative to parent in px
//	};
//		
//	var target = document.getElementById("spinner-preloader");
//	spinnerPreloader = new Spinner(opts).spin(target);
//}
//
//
//function formUserdevicesListData(current, size){
//	var outObj = {};
//	
//	outObj["userId"] =  $("#filterByUserId").val();
////	outObj["linkStatus"] = $("#filterByStatus").val();
//	outObj["current"] = current;
//	outObj["size"] = size;
//	outObj["addUserInfo"] = "1";
//	return JSON.stringify(outObj);
//}
//
//function userdevicesListParser(xml){
//	$("#infoMessage div").remove();
//	//it can be some parallel requests because of keyup event. so there is second table emptying
//	$("#userdevicesList tbody").empty();
//	$("#spinner-preloader").hide();
//	spinnerPreloader.stop();
//	searchBtnLadda.stop();
//	
//	var xmlError = $(xml).find("error").text();
//	
//	if(xmlError.length){
//		$("#infoMessage div").remove();
//		$("#infoMessage").append('<div class="alert alert-danger alert-dismissable">'+
//			'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
//			xmlError +
//			'</div>');
//	}
//	else {
//		if($(xml).find("userdevice").length > 0){
//			$(xml).find("userdevice").each(function(){
//				
//				var userNameHtml = "";
//				if($(this).find("userId").text() != ""){
//					userNameHtml = '<a href="' + userViewUrl + '?id='+ $(this).find("userId").text() +'">' +
//								$(this).find("username").text() + ' <small>(ID: ' + $(this).find("userId").text() + ')</small>' +
//							'</a>';
//				}
//				
//				var userdevicesUserId = $(this).find('userId').text();
//				if(userdevicesUserId == ""){
//					$(this).find('userId').each(function(){
//						if($(this).text() != ""){
//							userdevicesUserId = $(this).text();
//							return false;
//						}
//					});
//				}
//				if(userdevicesUserId == ""){
//					userdevicesUserId = titleNotSetText;
//				}
//		
//				$('#userdevicesList tbody').append(
//					'<tr data-userdevices-id="' + $(this).find('deviceLinkId').text() + '">' +
////						'<td class="center">' +
////							'<label class="pos-rel"><input type="checkbox" class="ace" name="selectedItems" value="' + $(this).find("deviceLinkId").text() + '"/><span class="lbl"></span>' +
////							'</label>' +
////						'</td>' +
//						'<td>' +
//							$(this).find("deviceLinkId").text() +
//						'</td>' +
//						'<td>' +
//							userNameHtml +
//						'</td>' +
//						'<td>' +
//							$(this).find("linkstatus").text() +
//						'</td>' +
//						'<td>' +
////							'<a class="btn btn-primary btn-sm edit-userdevices" data-userdevices-id="' +  $(this).find("id").text() + '">' +
////								'<i class="ace-icon fa fa-pencil"></i> ' + editText + 
////							'</a> ' +
//							'<a class="btn btn-primary btn-sm view-userdevices" data-userdevices-id="' +  $(this).find("deviceLinkId").text() + '">' +
//								'<i class="ace-icon fa fa-eye"></i> ' + viewText + 
//							'</a> ' +
//							'<a class="btn btn-danger btn-sm delete-userdevices" data-userdevices-id="' +  $(this).find("deviceLinkId").text() + '">' +
//								'<i class="ace-icon fa fa-close"></i> ' + deleteText +
//							'</a>' +
//						'</td>' +
//					'</tr>'
//				);
//			});
//			
//			var pages = parseInt($(xml).find("count").text());
//			var pageNr = parseInt($(xml).find("current").text());
//		
//			var maxSize = 10;
//			var limit = 10;
//			
//			if(pages > 1){
//				$("#userdevicesPagination").show();
//				tunePagination("userdevicesPagination", pages, pageNr, maxSize, limit);
//			}else{
//				$("#userdevicesPagination").hide();
//			}
//			
//		}else{
//			$("#infoMessage div").remove();
//			$("#infoMessage").append('<div class="alert alert-danger alert-dismissable">'+
//				'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
//				userdevicesNotFoundText +
//			'</div>');
//		}
//	}
//}
