<?php 
if($userlevel == "" || empty($userlevel)){
	$userlevel = "affiliate";
}

if(isset($myReport)){
	$mdlClass = "mdlReportFields";
if($myReport == "Commission"){
	$hiddenCols  = $set->adminCommissionHiddenCols;
	$location = "commission";
}
elseif($myReport == "Quick Summary"){
	$hiddenCols  = $set->adminQuickSummaryHiddenCols;
	$location = "quickSummary";
}
elseif($myReport == "Affiliates"){
	$hiddenCols  = $set->adminAffiliatesHiddenCols;
	$location = "affiliates";
}
elseif($myReport == "Clicks"){
	$hiddenCols  = $set->adminClicksHiddenCols;
	$location = "clicks";
}
elseif($myReport == "Active Creatives Stats"){
	$hiddenCols  = $set->adminActiveCreativesStatsHiddenCols;
	$location = "activeCreativesStats";
}
elseif($myReport == "Country"){
	$hiddenCols  = $set->adminCountryHiddenCols;
	$location = "country";
}
elseif($myReport == "Creatives"){
	$hiddenCols  = $set->adminCreativesHiddenCols;
	$location = "creatives";
}
elseif($myReport == "Landing Pages"){
	$hiddenCols  = $set->adminLandingPagesHiddenCols;
	$location = "landingPages";
}
elseif($myReport == "Trader"){
	$hiddenCols  = $set->adminTraderHiddenCols;
	$location = "trader";
}
elseif($myReport == "Transactions"){
	$hiddenCols  = $set->adminTransactionsHiddenCols;
	$location = "transactions";
}
elseif($myReport == "Group"){
	$hiddenCols  = $set->adminGroupHiddenCols;
	$location = "group";
}
elseif($myReport == "Profile"){
	$hiddenCols  = $set->adminProfileHiddenCols;
	$location = "profile";
}
elseif($myReport == "Sub"){
	$hiddenCols  = $set->adminSubHiddenCols;
	$location = "sub";
}
elseif($myReport == "Referral"){
	$hiddenCols  = $set->adminTrafficHiddenCols;
	$location = "traffic";
}
elseif($myReport == "Sub Traders"){
	$hiddenCols  = $set->adminSubTradersHiddenCols;
	$location = "subTraders";
}
elseif($myReport == "Affiliate List"){
	$hiddenCols  =$set->AffiliateListHiddenCols;
	$location = "affiliateList";
}
elseif($myReport == "Product Accounts"){
	$hiddenCols  =$set->productAccountHiddenCols;
	$location = "productAccount";
}
elseif($myReport == "Product Affiliates"){
	$hiddenCols  =$set->productAffiliateHiddenCols;
	$location = "productAffiliate";
}
elseif($myReport == "Product Quick Summary"){
	$hiddenCols  =$set->productQuickHiddenCols;
	$location = "productQuick";
}
elseif($myReport == "Product Traffic"){
	$hiddenCols  =$set->productTrafficHiddenCols;
	$location = "productTraffic";
}
}
else{
	$mdlClass = "mdlReportFields_db";
	if($dashboardReport == "Products Place"){
		$mdlClass = "mdlReportFields_prd";
		$hiddenCols  = $set->DashboardProductsPlaceHiddenCols;
		$location = "productsPlace";
		$myReport = $dashboardReport;
	}	
}

$dashStatHiddenCols = $set->DashboardDashStatHiddenCols;
$dashStatLocation = "dashStatCols";
$dashStatReport = lang("Data");


$set->content .= '
	<style>
	.pageTitle{
		padding-left:0px !important;
	}
	.reportFields{
			/* -webkit-column-count: 3;
			-moz-column-count: 3;
			column-count: 3; */
			max-height:300px;
			overflow-y :scroll;
	}
	</style>
<!-- The Modal -->
<div id="myModal" class="modal" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
 <div class="modal-dialog" style="width:50%; max-width: 50% !important;" role="document">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel17">'. lang('Manage Field On Report') .  ' - <span class="report_name">'. $myReport .'</span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
		<p class="err"></p>
      <p>'. lang('Please activate the fields you want to display on that report:') .'</p>
	  <p class="reportFields"></p>
      <p>
	  <a href="javascript:void(0)" name="select_all" id="select_all">'. lang('Select All') .'</a>&nbsp;&nbsp;
	  <a href="javascript:void(0)" name="unselect_all" id="unselect_all">'. lang('Unselect All') .'</a>
	  <input style="float:right" type="button" id="saveData" name="saveData" value="'. lang('Save') . '">&nbsp;&nbsp;
	  </p>
    </div>
  </div>
  </div>

</div>

<script>

//Code for displaying the modal on all reports to display/hide fields
	
	// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
if(typeof span != "undefined"){
	span.onclick = function() {
		modal.style.display = "none";
	}
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
	    modal.style.display = "none";
    }
}

$(document).ready(function(){

var t = [];

$(".'. $mdlClass .' thead tr th").each(function(e,col){
	t.push($(this).text());		
});



var hiddenColIds = []; 
var userHiddenCols = "'. $hiddenCols .'";
arrUserHiddenCols = userHiddenCols.split("|");

$.each(arrUserHiddenCols,function(k,hiddenCol){
		$.each($(".'. $mdlClass .' thead tr th"),function(k1,col){
			if(hiddenCol == $(this).text()){
				hideColumns(k1);
			}
		});
		
});

function hideColumns(id){
			id = id+1;
			var lastColHeader = Array.prototype.slice.call(document.querySelectorAll(".'. $mdlClass .' th:nth-child("+ id +")", ".'. $mdlClass .'"), 0); // get the header cell
			
			var lastColCells = Array.prototype.slice.call(document.querySelectorAll(".'. $mdlClass .' td:nth-child("+ id +")", ".'. $mdlClass .'"), 0).concat(lastColHeader); // get the column cells, and add header
			lastColCells.forEach(function(cell) { // iterate and hide
				cell.style.display = "none";
			});
			
			//HIDDEN TABLE
			var lastColHeaderH = Array.prototype.slice.call(document.querySelectorAll(".mdlReportFieldsData th:nth-child("+ id +")", ".mdlReportFieldsData"), 0); // get the header cell
			var lastColCellsH = Array.prototype.slice.call(document.querySelectorAll(".mdlReportFieldsData td:nth-child("+ id +")", ".mdlReportFieldsData"), 0).concat(lastColHeaderH); // get the column cells, and add header
			
			lastColCellsH.forEach(function(cell) { // iterate and hide
				cell.style.display = "none";
			});
}




$("#saveData").on("click",function(){
		
		dashStat = $(this).data("dashstat");
		if(typeof dashStat != "undefined" && dashStat == true){
			
			var user_id = "'. $set->userInfo['id'] . '";
			var user_level = "'. $userlevel . '";
			var location = user_level + "->'. $dashStatLocation .'";
			
		}
		else{
			var user_id = "'. $set->userInfo['id'] . '";
			var user_level = "'. $userlevel . '";
			var location = user_level + "->'. $location .'Report";
		
		}
		var hiddenCols = "";
		$("input:checkbox[name=\"reports\"]:not(:checked)").each(function(e,col){
			if(hiddenCols == "")
				hiddenCols = $(col).val();
			else
				hiddenCols += "|" + $(col).val();
		});
		
		
		var objParams = { 
                removed_fields   :hiddenCols,
                user_id: user_id,
                userlevel: user_level,
                location: location,
            };
            
            $.post("'.$set->SSLprefix.'ajax/saveReportsHiddenFields.php", objParams, function(res) {
					if(res == 1){
						modal.style.display = "none";
						window.location.href = window.location.href ;
					}
					else{
						$("p.err").css("color","red").html("'. lang("Error in saving data.") .'");
					}
            });
            return false;
		
	}); 
	
	$("[name=\"select_all\"]").on("click",function(){
		$("input:checkbox[name=\"reports\"]").prop("checked",true);
	});
	$("[name=unselect_all]").on("click",function(){
		$("input:checkbox[name=\"reports\"]").removeAttr("checked");
	});

$(".imgReportFieldsSettings").on("click",function(){
	$(".modal-header span.report_name").html("'. $myReport .'");
	var allCols = "";
	colcnt = 0;
	$.each($(".'. $mdlClass .' thead tr th"),function(e,col){
		colText = $(this).text();
		var chkInArray = false;
		chk = jQuery.inArray(colText, arrUserHiddenCols);
		if(chk > -1){
			allCols += "<div width=\"200px\"><div style=\"float:left\"><label class=\"switch\"><input type=\"checkbox\" name=\"reports\" class=\"reports\" value=\""+ colText +"\"><div class=\"slider round\"></div></label></div>";
		}
		else{
			allCols += "<div width=\"200px\"><div style=\"float:left\"><label class=\"switch\"><input type=\"checkbox\" name=\"reports\" class=\"reports\" value=\""+ colText +"\" checked><div class=\"slider round\"></div></label></div>";
		}
		allCols += "<div style=\"float:left;padding-top:5px;min-width:145px\">"+ colText +"</div></div>";
		colcnt++;
		if(colcnt ==3){
			allCols += "<div style=\"clear:both\"></div>";
			colcnt = 0;
		}
		
		
	});

	$(".reportFields").html(allCols);
	modal.style.display = "flex";
	
	$("#saveData").attr("data-dashStat",false);
	
});	


//DASHBOARD DASHSTAT
var dashStatHiddenCols = "'. $dashStatHiddenCols .'";
arrDashStatHiddenCols = dashStatHiddenCols.split("|");

$.each(arrDashStatHiddenCols,function(k,hiddenCol){
		$.each($("table.dashStatFields tr td.dashStat"),function(k1,col){
			colText = $(this)
			.clone()    //clone the element
			.children() //select all the children
			.remove()   //remove all the children
			.end()  //again go back to selected element
			.text();
			colText = $.trim(colText);
			if(hiddenCol == colText){
			$(col).hide();
			}
		});
		
});

var dashStat_t = [];
$("table.dashStatFields tr td.dashStat").each(function(e,col){
	colText = $(this)
    .clone()    //clone the element
    .children() //select all the children
    .remove()   //remove all the children
    .end()  //again go back to selected element
    .text();
	colText = $.trim(colText);
	dashStat_t.push(colText);		
});

$(".imgReportFieldsSettings_dashstat").on("click",function(){
	$(".modal-header span.report_name").html("'. $dashStatReport .'");
	var allCols = "";
	colcnt = 0;
	$.each($("table.dashStatFields tr td.dashStat"),function(e,col){
		//colText = $(this).text();
		colText = $(this)
		.clone()    //clone the element
		.children() //select all the children
		.remove()   //remove all the children
		.end()  //again go back to selected element
		.text();
		colText = $.trim(colText);
	 	var chkInArray = false;
		chk = jQuery.inArray(colText, arrDashStatHiddenCols);
		if(chk > -1){ 
			allCols += "<div width=\"200px\"><div style=\"float:left\"><label class=\"switch\"><input type=\"checkbox\" name=\"reports\" class=\"reports\" value=\""+ colText +"\"><div class=\"slider round\"></div></label></div>";
		}
		else{
			allCols += "<div width=\"200px\"><div style=\"float:left\"><label class=\"switch\"><input type=\"checkbox\" name=\"reports\" class=\"reports\" value=\""+ colText +"\" checked><div class=\"slider round\"></div></label></div>";
		}
		allCols += "<div style=\"float:left;padding-top:5px;min-width:145px\">"+ colText +"</div></div>";
		colcnt++;
		if(colcnt ==3){
			allCols += "<div style=\"clear:both\"></div>";
			colcnt = 0;
		}
		
		});
		$(".reportFields").html(allCols);
		modal.style.display = "flex";
		
		$("#saveData").attr("data-dashStat",true);
});

});


</script>
';
?>