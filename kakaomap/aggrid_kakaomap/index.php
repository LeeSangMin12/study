<style>
	.ag-bl-center-row.ag-bl-normal-center-row {
		height: 600px !important;
	}
	.ag-theme-balham .ag-header {
		color:black;
		font-weight:bold;
		font-size:12px;
	}
	/* Page Layout 좌,우 영역  */
	#div_left_area {
		width:100%;
		float:left;
		height: calc(100vh - 200px);
	}
	.div_order_select_cls {
		margin-bottom:5px;
		display:none;
		width:200px;
	}
	.div_header_cls {
		display: flex;
		gap:10px;
		padding:5px 12px;
		background-color:#fff;
		font-size:16px;
		height:40px;
	}
	.div_header_cls .div_header_title_cls {
		width:260px;
		padding-top:0px;
	}
	.div_header_cls .div_span_cls {
		font-size:15px;
		height: 30px;
		line-height: 30px;
		margin-left: auto;
	}
	.div_header_cls .div_span_cls span {
		color:#004dff;
		margin:0;
	}
	.btn_grid_update_cls {
		border: 1px solid #008136;
		color: #008136;
		padding: 2px 10px;
	}
	.div_modal_body_cls {
		padding:5px;
	}
	.table_modal_cls th {
		text-align: center
	}
	.input_used_num_cls {
		border: 2px solid red
	}
	#input_offer_biz_no{
		width: 72%;
		display: inline-block;
		vertical-align: middle;
	}
	.p_search_biz_cls{
		color: red;
		margin: 4px 0 0 0;
		display: none;
	}
	#input_offer_zipcode{
		width: 65%;
		display: inline-block;
		vertical-align: middle;
	}
	#textarea_offer_memo {
		width: 100%;
		resize: none;
	}
	#div_column_change th {
		text-align: left;
	}
	#div_column_change input[type=radio]{
		margin: auto 8px;
	}
	/* 카카오지도 모달 table */
	table {
		border:1px #d1d1d1; /* PNotify 를 사용할때 table border > 1px 보다 크고, solid 를 사용하면 느려진다 */
		width:100%;
	}
	td{
		border:1px solid #d1d1d1;
		padding:10px 5px;
	}
	.div_footer_title_cls{
		display: flex;
   		align-items: center;
		margin-bottom:10px;
	}
	.i_location_cls{
		background: url("/hebees/images/map/icn-location.svg") no-repeat;
		width: 20px;
    	height: 20px;
	}
	.span_footer_title_cls{
		font-size: 20px;
		font-weight: bold;
		margin-right:8px;
	}
	.span_fotter_phonenum_cls{
		font-size: 16px;
	}
	.tr_height_cls{
		height:50px;
	}
	.span_location_info_cls{
		font-size:14px;
		height:50px;
	}
	.td_change_coords_cls{
		display: none;
		/*display: flex;*/
		align-items: center;
		justify-content: center;
		height:50px;
	}
	.td_address_value_header_cls{
		font-size:13px;
		background-color:#f4f7ff;
		font-weight:bold;
		text-align:center;
	}
	.td_current_address_cls{
		font-size: 13px;
		font-weight: bold;
	}
	.td_personally_select_cls{
		font-weight:bold;
		color:#0a6cfc;
		font-size:13px;
	}
	.input_detail_coordinates_enter_cls{
		width:37%;
	}
	.span_map_slash_cls{
		margin-right: 10px;
		margin-left: 10px;
	}
	.btn_change_address_cls{
    	border: 1px solid #d1d1d1;
		background-color: #005abb;
    	color: white;
	}
	.btn_change_address_cls:hover{
		color:white;
	}
	.btn_change_address_cls:disabled{
		background-color: #e8e8e8;
	}
	.btn_map_modal_close_cls{
		background-color: white;
    	border: 1px solid #a3a3a3;
	}
	.div_map_modal_btn_cls{
		display: flex;
		align-items: baseline;
		justify-content: center;
		padding: 15px;
	}

	/* 카카오지도 */
    .span_map_title_cls {
		font-weight:bold;
		display:block;
	}
    .div_h_addr_cls {
		position:absolute;
		left:10px;
		top:65px;
		border-radius: 2px;
		background:#fff;
		background:rgba(255,255,255,0.8);
		z-index:1;
		padding:5px;
	}
    #span_center_addr {
		display:block;
		margin-top:2px;
		font-weight: normal;
	}
    .div_b_addr_cls {
		padding:5px;
		text-overflow: ellipsis;
		overflow: hidden; 
		white-space: nowrap;
	}
</style>
<div class="right_col col-md-10" role="main" style="min-height: 898px;">
	<div id="div_page_container">
		<div class="row">
			<div id="div_left_area">
				<!-- 가맹점 리스트 -->
				<div class="div_order_select_cls">
					<select id="select_order_group" class="form-control" data-live-search="true" data-size="7"></select>
				</div>
				<div class="div_header_cls">
<!--					<div class="div_span_cls">-->
<!--						( <span id="span_select_cnt">0</span> / <span id="span_list_cnt">0</span> )-->
<!--					</div>-->
					<button type="button" id="btn_add_new_opt" class="btn btn-sm btn-warning">+신규등록</button>
					<button type="button" id="btn_grid_size" class="btn btn-xs" data-type="full" style="font-size:13px; background-color:#A0A0A0">
						<i class="glyphicon glyphicon-triangle-left"></i>&nbsp;펼침&nbsp;<i class="glyphicon glyphicon-triangle-right"></i>
					</button>
					<button type="button" id="btn_excel" class="btn btn-xs btn-success" style="font-size:13px"><i class="glyphicon glyphicon-save" ></i>&nbsp;Excel</button>
					<div class="div_span_cls">
						( <span id="span_select_cnt">0</span> / <span id="span_list_cnt">0</span> )
					</div>
					<button type="button" id="btn_column_change_address" class="btn btn-sm" >위치 정보찾기</button>
					<button type="button" id="btn_column_change" class="btn btn-sm btn-warning">선택 일괄변경</button>
				</div>
				<div id="div_grid" class="ag-theme-balham" style="height: 100%; width: 100%;"></div>
			</div>
		</div>
	</div>
</div>

<!-- 가맹점 정보 수정 모달 -->
<div id="div_opt_info_modal" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-md modal-center">
		<!-- Modal content-->
		<div class="modal-content" style="width: 887px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div id="h4_modal_title" class="modal-title">가맹점 신규 등록</div>
			</div>
			<div class="div_modal_body_cls">
				<table class="table table-bordered table_modal_cls">
					<colgroup>
						<col style="width:15%">
						<col style="width:35%">
						<col style="width:15%">
						<col style="width:35%">
					</colgroup>
					<tbody>
					<input type="hidden" id="input_opt_no">
					<tr>
						<th style="color: red;font-weight: bold;">* 사업자번호</th>
						<td>
							<input type="text" id="input_offer_biz_no" class="form-control input_biz_valid_cls">
							<button type="button" class="btn btn-sm btn-primary btn_search_biz_cls">중복체크</button>
							<p class="p_search_biz_cls">※ 중복된 사업자번호가 있습니다.</p>
						</td>
						<th>상태</th>
						<td>
							<select id="select_offer_status" class="form-control">
								<option value="1">활성</option>
								<option value="0">비활성</option>
							</select>
						</td>
					</tr>
					<tr>
						<th style="color: red;font-weight: bold;">* 가맹점명</th>
						<td>
							<input type="text" id="input_offer_name" class="form-control" maxlength="25">
						</td>
						<th class="th_update_cls">레티나 안경원명</th>
						<td id="td_opt_name" style="font-size: 14px;vertical-align: middle;"></td>
					</tr>
					<tr>
						<th>그룹명</th>
						<td>
							<select id="select_offer_group" class="form-control selectpicker" data-live-search="true" data-size="7"></select>
						</td>
						<th>영업사원</th>
						<td>
							<select id="select_offer_admin" class="form-control selectpicker" data-live-search="true" data-size="7"></select>
						</td>
					</tr>
					<tr>
						<th style="color: red;font-weight: bold;">* 대표자</th>
						<td>
							<input type="text" id="input_offer_ceo_name" class="form-control" maxlength="25">
						</td>
						<th>대표자 연락처</th>
						<td>
							<input type="text" id="input_offer_ceo_tel" class="form-control input_phone_valid_cls">
						</td>
					</tr>
					<tr>
						<th>관리자</th>
						<td>
							<input type="text" id="input_offer_manager_name" class="form-control" maxlength="25">
						</td>
						<th>관리자 연락처</th>
						<td>
							<input type="text" id="input_offer_manager_tel" class="form-control input_phone_valid_cls">
						</td>
					</tr>
					<tr>
						<th>가맹점 연락처</th>
						<td>
							<input type="text" id="input_offer_company_tel" class="form-control input_phone_valid_cls">
						</td>
						<th>가맹점 팩스</th>
						<td>
							<input type="text" id="input_offer_company_fax" class="form-control input_phone_valid_cls">
						</td>
					</tr>
					<tr>
						<th>이메일</th>
						<td>
							<input type="text" id="input_offer_email" class="form-control" maxlength="50">
						</td>
						<th>배송사</th>
						<td>
							<select id="select_offer_ship" class="form-control selectpicker" data-live-search="true" data-size="7"></select>
						</td>
					</tr>
					<tr>
						<th>우편번호</th>
						<td>
							<input type="text" id="input_offer_zipcode" class="form-control" readonly>
							<button type="button" class="btn btn-sm btn-primary btn_search_zip_cls">우편번호 찾기</button>
						</td>
						<th>지역</th>
						<td>
							<select id="select_offer_region" class="form-control selectpicker" data-live-search="true" data-size="7"></select>
						</td>
					</tr>
					<tr>
						<th>주소</th>
						<td>
							<input type="text" id="input_offer_address1" class="form-control">
						</td>
						<th class="text-center">업종</th>
						<td>
							<input type="text" id="input_company_class" class="form-control" maxlength="50" placeholder="세금계산서 항목">
						</td>
					</tr>
					<tr>
						<th>상세주소</th>
						<td>
							<input type="text" id="input_offer_address2" class="form-control">
						</td>
						<th class="text-center">업태</th>
						<td>
							<input type="text" id="input_company_type" class="form-control" maxlength="50" placeholder="세금계산서 항목">
						</td>
					</tr>
					<tr>
						<th>메모</th>
						<td colspan="3">
							<textarea id="textarea_offer_memo" class="form-control" rows="4"></textarea>
						</td>
					</tr>
					</tbody>
				</table>
				<div class="modal-footer" style="border-top: none;">
					<div class="pull-left">
						<button type="button" id="btn_delete_opt" class="btn btn-danger btn_delete_opt_cls btn_style_cls tr_opt_update_cls">삭제</button>
					</div>
					<div class="pull-right">
						<button type="button" id="btn_new_opt" class="btn btn-primary btn_save_optician_cls btn_style_cls"><i class="glyphicon glyphicon-ok"></i>신규저장</button>
						<button type="button" id="btn_save_opt" class="btn btn-primary btn_save_optician_cls btn_style_cls tr_opt_update_cls"><i class="glyphicon glyphicon-ok"></i>수정하기</button>
						<button type="button" class="btn btn-default btn_style_cls btn_close_cls" data-dismiss="modal" aria-label="Close">닫기</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 선택 항목 일괄 변경 모달 -->
<div id="div_column_change" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-md modal-center">
		<!-- Modal content-->
		<div class="modal-content" style="width: 400px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div id="h4_modal_title" class="modal-title">선택 항목 일괄 변경</div>
			</div>
			<div class="div_modal_body_cls">
				<table class="table table-bordered table_modal_cls">
					<colgroup>
						<col style="width:30%">
						<col style="width:70%">
					</colgroup>
					<tbody>
					<tr>
						<td colspan="2" style="font-weight: bold;text-align: center;">
							일괄변경은 한번에 한개의 항목만 변경 가능합니다.
						</td>
					</tr>
					<tr>
						<th style="padding: 8px 16px;">
							선택된 가맹점
						</th>
						<td>
							<span id="span_select_count" style="color:red;">0</span>개의 가맹점이 선택되었습니다.
						</td>
					</tr>
					<tr>
						<th>
							<input type="radio" name="input_radio_column" data-name="STATUS"> <!-- 라디오버튼이라 name사용 -->
							상태
						</th>
						<td>
							<select id="select_status" class="form-control" data-name="STATUS">
								<option value="" selected disabled hidden>선택</option>
								<option value="1">활성</option>
								<option value="0">비활성</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<input type="radio" name="input_radio_column" data-name="OFFER_GROUP_NO">
							가맹점그룹
						</th>
						<td>
							<select id="select_offer_group_name" class="form-control selectpicker" data-name="OFFER_GROUP_NO" data-live-search="true" data-size="7"></select>
						</td>
					</tr>
					<tr>
						<th>
							<input type="radio" name="input_radio_column" data-name="ADMIN_NO">
							영업사원
						</th>
						<td>
							<select id="select_admin_name" class="form-control selectpicker" data-name="ADMIN_NO" data-live-search="true" data-size="7"></select>
						</td>
					</tr>
					<tr>
						<th>
							<input type="radio" name="input_radio_column" data-name="REGION_NO">
							지역
						</th>
						<td>
							<select id="select_region_name" class="form-control selectpicker" data-name="REGION_NO" data-live-search="true" data-size="7"></select>
						</td>
					</tr>
					<tr>
						<th>
							<input type="radio" name="input_radio_column" data-name="SHIP_NO">
							배송사
						</th>
						<td>
							<select id="select_ship_name" class="form-control selectpicker" data-name="SHIP_NO" data-live-search="true" data-size="7"></select>
						</td>
					</tr>
					<tr>
						<th>
							<input type="radio" name="input_radio_column" data-name="COMPANY_TYPE">
							업태
						</th>
						<td>
							<input type="text" id="input_tax_type" class="form-control" data-name="COMPANY_TYPE">
						</td>
					</tr>
					<tr>
						<th>
							<input type="radio" name="input_radio_column" data-name="COMPANY_CLASS">
							업종
						</th>
						<td>
							<input type="text" id="input_tax_class" class="form-control" data-name="COMPANY_CLASS">
						</td>
					</tr>
					</tbody>
				</table>
				<div class="modal-footer" style="border-top: none;">
					<div class="pull-right">
						<button type="button" id="btn_save_column" class="btn btn-primary btn_style_cls">변경하기</button>
						<button type="button" class="btn btn-default btn_style_cls btn_close_cls" data-dismiss="modal" aria-label="Close">닫기</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 안경원 지도 모달 -->
<div class="modal fade" id="map_modal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="margin-bottom:25px;">
				<button type="button" class="close" data-dismiss="modal" style="font-size: 25px; color: white; opacity: 10;">&times;</button>
				<h4 class="modal-title" style="font-size:14px; font-weight:bold; display:inline;">가맹점 위치보기&nbsp;<span id="modal-opt-name" style="color:#3763ff;"></span></h4>
				<span>
			</div>
			<div>
				<div id="map" class="modal-body" style="width:570px;height:300px;position:relative;overflow:hidden;margin:auto;"></div>
				<div class="div_h_addr_cls">
					<span class="span_map_title_cls">지도중심기준 행정동 주소정보</span>
					<span id="span_center_addr"></span>
				</div>
			</div>
			<div class="modal-footer">
				<div class="div_footer_title_cls pull-left" display="inline">
					<i class="i_location_cls"></i>
					<span id="span_footer_title" class="span_footer_title_cls"></span>
					<span id="span_footer_phonenum" class="span_fotter_phonenum_cls"><span>
				</div>
				<table>
					<tr class="tr_height_cls">
						<td class="td_address_value_header_cls" width="80">현재 주소</td>
						<td id="td_current_address" class="td_current_address_cls"></td>
					</tr>
					<tr class="tr_height_cls">
						<td class="td_address_value_header_cls" rowspan="2" width="80" >변경 위치</td>
						<td id="td_personally_select" class="td_personally_select_cls"></td>
					</tr>
					<tr>
						<td>
							<span class="span_location_info_cls">가맹점의 정확한 주소가 아닌, 위치값을 설정해 줍니다. <br/>근처 가맹점을 찾을 때 유용합니다.</span>
						</td>
						<!--변경할 위치를 확인하기 위해서 사용-->
						<td class="td_change_coords_cls">
								<span>위도:</span>
								<span id="input_detail_latitude_enter" class="input_detail_coordinates_enter_cls"></span>
								<span class="span_map_slash_cls">/</span>
								<span>경도:</span>
								<span id="input_detail_longitude_enter" class="input_detail_coordinates_enter_cls"></span>
						</td>
					</tr>
				</table>
				<div class="div_map_modal_btn_cls">
				<button type="button" class="btn_map_modal_close_cls btn modal-btn-style01 btn-close" data-dismiss="modal" style="margin-bottom:5px;">닫 기</button>
				<button type="button" id="btn_change_address" class="btn_change_address_cls btn modal-btn-style01" disabled>변경위치 저장</button>
				</div>
			</div>

		</div>
	</div>
</div>

<link rel="stylesheet" href="/hebees/libs/bootstrap-select/1.13.14/bootstrap-select.min.css">
<script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=ab52937d935697b6abfa3dc705e7ceb1&libraries=services"></script>
<script src="/hebees/libs/bootstrap-select/1.13.14/bootstrap-select.min.js"></script>
<script src="/hebees/libs/bootstrap-select/1.13.14/defaults-ko_KR.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script src="/hebees/js/kakao/map.js?timestamp=<?=time()?>"></script>
<script type="text/javascript">
	let I_OFFER_NO = OFFER_NO;
	let grid_options;

	$("#span_title").text("가맹점 관리");
	$(document).ready(function() {
		grid_options_init();
		phone_key_event(".input_phone_valid_cls"); // 전화번호
		business_license_key_event(".input_biz_valid_cls"); // 사업자번호

		offer_list(); //유통사 selectbox
		const region_list_array = PKG_RTN_OFFER_CONF_SP_L_OFFER_REGION();
		const admin_list_array = PKG_RTN_MENU_SP_L_ADMIN();
		const group_list_array = PKG_RTN_OFFER_GROUP_SP_L_OFFER_GROUP();
		const ship_list_array = PKG_RTN_OFFER_CONF_SP_L_OFFER_SHIP();

		selectbox_option_add(region_list_array, "REGION_NO", "REGION_NAME", "#select_offer_region", "선택"); //수정 or 신규 모달
		selectbox_option_add(region_list_array, "REGION_NO", "REGION_NAME", "#select_region_name", "선택"); //선택 일괄수정 모달
		selectbox_option_add(admin_list_array, "ADMIN_NO", "ADMIN_NAME", "#select_offer_admin", "선택"); //수정 or 신규 모달
		selectbox_option_add(admin_list_array, "ADMIN_NO", "ADMIN_NAME", "#select_admin_name", "선택"); //선택 일괄수정 모달
		selectbox_option_add(group_list_array, "OFFER_GROUP_NO", "OFFER_GROUP_NAME", "#select_offer_group", "선택"); //수정 or 신규 모달
		selectbox_option_add(group_list_array, "OFFER_GROUP_NO", "OFFER_GROUP_NAME", "#select_offer_group_name", "선택"); //선택 일괄수정 모달
		selectbox_option_add(ship_list_array, "SHIP_NO", "SHIP_NAME", "#select_offer_ship", "선택"); //수정 or 신규 모달
		selectbox_option_add(ship_list_array,"SHIP_NO", "SHIP_NAME", "#select_ship_name", "선택"); //선택 일괄수정

		if(OFFER_NO != 1) {
			PKG_RTN_OFFER_ADMIN_SP_L_OFFER_OPT_JOIN();
		}
	});

	//AG-GRID 칼럼 [맞춤] [펼침] 버튼
	$(document).off("click", "#btn_grid_size").on("click", "#btn_grid_size", function() {
		grid_column_autosize($(this), grid_options);
	});

	// 엑셀버튼을 누르면 엑셀로 다운로드
	$(document).on("click","#btn_excel",function() {
		grid_options.api.exportDataAsExcel({
			"fileName" : "주문시스템_가맹점리스트.xlsx",
			"sheetName" : "가맹점정보",
			"exportMode" : "xlsx"
		});
	});

	/**
	 * 선택일괄변경 모달 오픈시
	 */
	$(document).on("show.bs.modal", "#div_column_change", function(){
		$("input[name=input_radio_column]").prop("checked", false); // 라디오버튼 해제
		$("#div_column_change select").prop("disabled", true); // 모든 select box 비활성화
		$("#div_column_change select").val(""); // 모든 select box 초기화
		$("#div_column_change input[type=text]").prop("disabled", true); // text 타입의 input 비활성화
		$("#div_column_change input[type=text]").val(""); // text 타입의 input 초기화

		$("#select_admin_name").selectpicker("refresh"); // selectpicker 새로고침
		$("#select_region_name").selectpicker("refresh"); // selectpicker 새로고침
		$("#select_ship_name").selectpicker("refresh"); // selectpicker 새로고침
		$("#select_offer_group_name").selectpicker("refresh");

		$("#span_select_count").text(grid_options.api.getSelectedRows().length); // 가맹점 선택수
	});

	/**
	 * 선택 일괄변경 라디오버튼 선택시에 select box 활성화
	 */
	$(document).on("change", "input[name=input_radio_column]", function(){
		$("#div_column_change select").prop("disabled", true); // 모든 select box 비활성화
		$("#div_column_change select").val(""); // 모든 select box 초기화
		$("#div_column_change input[type=text]").prop("disabled", true); // text 타입의 input 비활성화
		$("#div_column_change input[type=text]").val(""); // text 타입의 input 초기화

		$("#select_offer_group_name").selectpicker("refresh");
		$("#select_admin_name").selectpicker("refresh"); // selectpicker 새로고침
		$("#select_region_name").selectpicker("refresh"); // selectpicker 새로고침
		$("#select_ship_name").selectpicker("refresh");
		
		switch ($(this).data("name")){
			case "STATUS":
				$("#select_status").prop("disabled", false);
				break;
			case "OFFER_GROUP_NO":
				$("#select_offer_group_name").prop("disabled", false);
				$("#select_offer_group_name").selectpicker("refresh");
				break;
			case "ADMIN_NO":
				$("#select_admin_name").prop("disabled", false);
				$("#select_admin_name").selectpicker("refresh"); // selectpicker 새로고침
				break;
			case "REGION_NO":
				$("#select_region_name").prop("disabled", false);
				$("#select_region_name").selectpicker("refresh"); // selectpicker
				break;
			case "SHIP_NO":
				$("#select_ship_name").prop("disabled", false);
				$("#select_ship_name").selectpicker("refresh"); // selectpicker 새로고침
				break;
			case "COMPANY_TYPE":
				$("#input_tax_type").prop("disabled", false);
				break;
			case "COMPANY_CLASS":
				$("#input_tax_class").prop("disabled", false);
				break;
		}
	});

	// 위치 정보찾기 클릭시
	$(document).on("click", "#btn_column_change_address", function(){
		const selected_rows = grid_options.api.getSelectedRows();
		if(selected_rows.length === 0){
			alert("가맹점을 선택해주세요.","error","에러");
			return;
		}
		g_loading_show();
		const map_loop = async _ => {
			const array = selected_rows.map(async (value, idx) => {
				const coordinates =  await address_search(value.ADDRESS1);
				coordinates.OPT_NO = selected_rows[idx].OPT_NO;
				PKG_RTN_OFFER_ADMIN_SP_U_OFFER_OPT_COORDINATE(coordinates);
				return coordinates;
			})
			//함수에서 주소갱신이 전부 일어난 후, 조회프로시저를 실행해야합니다.
			//그래서 반복문을 돌리는데, 자바스크립트에서 foreach는 promise를 인지하지 못합니다.
			//map을 이용해서 반복을 해야하는데, map은 항상 promise를 반환해서 배열을 푸는 과정이 필요합니다.
			//Promise.all(array)를 통해 배열을 풀고, 조회하는 프로시저를 실행 시킵니다.
			await Promise.all(array);
			PKG_RTN_OFFER_ADMIN_SP_L_OFFER_OPT_JOIN();
			g_loading_hide();
			alert("위치가 변경되었습니다.");
		}
		map_loop();

	});

	/**
	 * 선택일괄변경 클릭시
	 */
	$(document).on("click", "#btn_column_change", function(){
		const selected_rows = grid_options.api.getSelectedRows();
		if(selected_rows.length === 0){
			alert("가맹점을 선택해주세요.","error","에러");
			return;
		}
		$("#div_column_change").modal("show");
	});

	/**
	 * 선택일괄변경 모달의 변경하기 클릭시
	 */
	$(document).on("click", "#btn_save_column", function(){
		if($("input[name=input_radio_column]").is(":checked")){ // 버튼 체크되어있는지 확인

			const I_NAME = $("input[name=input_radio_column]:checked").data("name"); // 선택된 라디오의 data-name 가져오기
			let I_VALUE = "";
			const select_data = grid_options.api.getSelectedNodes();

			//COMPANY_TYPE = 업태, COMPANY_TYPE = 업종
			if(I_NAME == "COMPANY_TYPE" || I_NAME == "COMPANY_CLASS"){
				I_VALUE = $("input[type=text][data-name='"+ I_NAME +"']").val(); // 선택된 값 찾기
				PKG_RTN_OFFER_OPT_ADMIN_SP_U_OFFER_OPT_JOIN_STR(I_NAME, I_VALUE, select_data);
			}else{
				I_VALUE = $("select[data-name='"+ I_NAME +"']").val(); // 선택된 값 찾기
				PKG_RTN_OFFER_OPT_ADMIN_SP_U_OFFER_OPT_JOIN_COLUMN(I_NAME, I_VALUE, select_data);
			}

		}else{
			alert("변경할 항목을 선택해주세요.");
		}
	});

	//위치 출력
	$(document).on("click",".load_map",function(){
		$("#map_modal").modal("show");
	});
	$("#map_modal").on("shown.bs.modal", function () {
		const selected_rows = grid_options.api.getSelectedRows()[0];
		const parameter = {
			latitude : selected_rows.LATITUDE, 
			longitude : selected_rows.LONGITUDE, 
			info_div : document.getElementById("span_center_addr"),

			personally_select: document.getElementById("td_personally_select"), 
			input_detail_latitude: document.getElementById("input_detail_latitude_enter"),
			input_detail_longitude: document.getElementById("input_detail_longitude_enter"),
			btn_change_address : document.getElementById("btn_change_address")
		}
		input_initialize(parameter, selected_rows)
		map_draw(parameter);
		document.getElementById("td_current_address").innerHTML = selected_rows.ADDRESS1
	});

	//지도보기에있는 주소변경버튼 클릭시
	$(document).on("click", "#btn_change_address", function() {
		const selected_rows = grid_options.api.getSelectedRows()[0];
		const coordinates = {
			latitude: document.getElementById("input_detail_latitude_enter").innerText,
			longitude: document.getElementById("input_detail_longitude_enter").innerText,
			OPT_NO: selected_rows.OPT_NO
		}
		PKG_RTN_OFFER_ADMIN_SP_U_OFFER_OPT_COORDINATE(coordinates);
		PKG_RTN_OFFER_ADMIN_SP_L_OFFER_OPT_JOIN(); 

		$("#map_modal").modal("hide");
		alert("저장되었습니다.");
	});

	//카카오 지도 modal 열때 input값 초기화
	function input_initialize(parameter, selected_rows) {
		parameter.input_detail_latitude.innerHTML ="";
		parameter.input_detail_longitude.innerHTML ="";
		parameter.personally_select.innerHTML = "※ 변경할 위치를 지도에서 직접 선택해주세요.";
		
		document.getElementById("span_footer_title").innerHTML = selected_rows.OPT_NAME;
		selected_rows.CEO_PHONE?
		document.getElementById("span_footer_phonenum").innerHTML = `(${selected_rows.CEO_PHONE})` : "";
	}

	//가맹점 신규등록 버튼 클릭
	$(document).on("click","#btn_add_new_opt",function() {
		$("#h4_modal_title").text("가맹점 신규 등록");

		$(".tr_opt_update_cls").hide();
		$("#btn_new_opt").show();
		$(".p_search_biz_cls").hide();
		$(".btn_search_biz_cls").removeClass("success_num_cls");
		$("#input_offer_biz_no").removeClass("success_num_cls");
		$("#input_offer_biz_no").removeClass("input_used_num_cls");

		$("#div_opt_info_modal").modal("show");
	});

	//수정하기 버튼 클릭
	$(document).on("click",".btn_save_optician_cls",function(){
		if(!$("#input_offer_biz_no").val() || $("#input_offer_biz_no").val().length != 12){
			$("#input_offer_biz_no").focus();
			return alert("사업자번호를 다시 확인해주세요");
		}

		if(!$("#input_offer_name").val()){
			$("#input_offer_name").focus();
			return alert("가맹점명을 다시 확인해주세요");
		}

		if(!$("#input_offer_ceo_name").val()){
			$("#input_offer_ceo_name").focus();
			return alert("대표자명을 다시 확인해주세요");
		}

		PKG_RTN_OFFER_ADMIN_SP_M_OFFER_OPT_JOIN();
	});

	//가맹점 삭제 버튼 클릭
	$(document).on("click",".btn_delete_opt_cls",function(){
		confirm("가맹점를 삭제 하시겠습니까?").get().on("pnotify.confirm", function () {
			$(this).find("button").prop("disabled", true);
			PKG_RTN_OFFER_ADMIN_SP_U_OFFER_OPT_JOIN();
		});
	});

	//수정버튼 클릭시 모달 오픈
	$(document).on("click",".btn_grid_update_cls",function (){
		const data = grid_options.api.getRowNode($(this).data("id")).data;
		$("#h4_modal_title").text("가맹점 수정");  //가맹점 모달 제목 수정
		$("#input_opt_no").text(data.OPT_NO);
		$("#input_offer_biz_no").val(data.BUSINESS_LICENSE);
		$("#input_offer_biz_no").removeClass("input_used_num_cls");
		if(data.BUSINESS_LICENSE){
			$("#input_offer_biz_no").addClass("success_num_cls");
			$("#input_offer_biz_no").removeClass("input_used_num_cls");
		}else{
			$("#input_offer_biz_no").removeClass("success_num_cls");
		}
		$("#td_opt_name").text(g_nvl(data.RETINA_OPT_NAME,"임의등록 가맹점"));
		$("#input_offer_name").val(data.OFFER_OPT_NAME);
		$("#select_offer_status").val(data.STATUS);
		$("#select_offer_group").selectpicker("val", g_nvl(data.OFFER_GROUP_NO),"");
		$("#input_offer_ceo_name").val(data.CEO_NAME);
		$("#input_offer_ceo_tel").val(data.CEO_PHONE);
		$("#input_offer_manager_name").val(data.MANAGER_NAME);
		$("#input_offer_manager_tel").val(data.MANAGER_PHONE);
		$("#input_offer_company_tel").val(data.COMPANY_TEL);
		$("#input_offer_company_fax").val(data.COMPANY_FAX);
		$("#input_offer_address1").val(data.ADDRESS1);
		$("#input_offer_address2").val(data.ADDRESS2);
		$("#input_offer_zipcode").val(data.ZIPCODE);
		$("#select_offer_region").selectpicker("val", g_nvl(data.REGION_NO),"");
		$("#select_offer_admin").selectpicker("val", g_nvl(data.ADMIN_NO),"");
		$("#select_offer_ship").val(data.SHIP_NO).selectpicker("val", g_nvl(data.SHIP_NO), ""); // 배송사
		$("#input_offer_email").val(g_nvl(data.COMPANY_EMAIL,"")); // 이메일
		$("#input_company_class").val(g_nvl(data.COMPANY_CLASS)); // 업종
		$("#input_company_type").val(g_nvl(data.COMPANY_TYPE)); // 업태
		$("#textarea_offer_memo").val(g_nvl(data.MEMO,"")); // 메모

		$("#btn_new_opt").hide();
		$(".tr_opt_update_cls").show();
		$(".th_update_cls").text("레티나 안경원명");
		$(".p_search_biz_cls").hide();

		$("#div_opt_info_modal").modal("show");
	});

	//사업자번호 중복체크
	$(document).on("click",".btn_search_biz_cls",function(){
		const hi = PKG_RTN_OFFER_LOGIN_SP_S_OFFER_OPT_LICENSE(OFFER_NO);
	});
	//사업자 번호 사용가능할때
	function use_license (){
		alert("사용가능한 사업자 번호입니다.");
		$("#input_offer_biz_no").removeClass("input_used_num_cls");
		$("#input_offer_biz_no").addClass("success_num_cls");
		$(".p_search_biz_cls").hide();
	}
	//사업자번호 중복일때
	function overlap_license(){
		alert("이미 사용중인 사업자번호입니다. <br>중복된 사업자 번호를 사용하실 경우, <br>문제가 발생할 수 있습니다.");
		$("#input_offer_biz_no").addClass("input_used_num_cls");
		$("#input_offer_biz_no").removeClass("success_num_cls");
		$(".p_search_biz_cls").show();
	}

	//우편번호 검색
	$(document).on("click",".btn_search_zip_cls",function(){
		exec_daum_post_code();
	});

	$(document).on("click", "#input_offer_zipcode", function(){
		alert("우편번호 찾기를 클릭해주세요.");
	});

	function show_columns(value1){
		grid_options.columnApi.setColumnsVisible ([
			"USER_ID"
		], value1);
	}

	function exec_daum_post_code() {
		new daum.Postcode({
			oncomplete: function (data) {
				let addr;
				if (data.userSelectedType === "R") { // 사용자가 도로명 주소를 선택했을 경우
					addr = data.roadAddress;
				} else { // 사용자가 지번 주소를 선택했을 경우(J)
					addr = data.jibunAddress;
				}
				$("#input_offer_zipcode").val(data.zonecode);
				$("#input_offer_address1").val(addr);

				if(data.sido.indexOf("제주") > -1) {
					$("#select_offer_region").val($("#select_offer_region option:contains('제주')").val());
				}else if(data.sido.indexOf("세종") > -1){
					$("#select_offer_region").val($("#select_offer_region option:contains('세종')").val());
				}else{
					$("#select_offer_region").val($("#select_offer_region option:contains("+data.sido+")").val());
				}
			}
		}).open();
	}

	/**
	 * 가맹점 수정 모달 닫을때 비워주기
	 */
	$(document).on("hide.bs.modal", "#div_opt_info_modal", function (){
		$("#div_opt_info_modal input").val(""); // input 전체 지워주기

		$("#input_opt_no").text("");
		$("#td_opt_name").text("");

		$("#select_offer_status").val(1);
		$("#select_offer_group").val("");
		$("#select_offer_ship").val("");

		$("#textarea_offer_memo").val("");
		$(".th_update_cls").text("");
	});

	//유통사 selectbox change event
	$(document).on("change","#select_order_group",function() {
		if(OFFER_NO == 1) {
			I_OFFER_NO = $("#select_order_group").val(); // OFFER_NO 변경
			PKG_RTN_OFFER_ADMIN_SP_L_OFFER_OPT_JOIN();
		}
	});

	//유통사 리스트 조회
	function offer_list() {
		if(OFFER_NO == 1){
			//가맹점을 통해 ag-gird를 조회할 때, selectbox를 통해 OFFER_NO 확인
			const offer_list_array = PKG_RTN_OFFER_ADMIN_SP_L_OFFER();
			selectbox_option_add(offer_list_array, "OFFER_NO", "OFFER_NAME", "#select_order_group", "선택");
			$("#select_order_group").selectpicker();
			$(".div_order_select_cls").show();
		} else {
			$("#div_order_select_cls").hide();
		}
	}

	/** OFFER SELECTBOX */
	function PKG_RTN_OFFER_ADMIN_SP_L_OFFER() {
		const result = exec_procedure_post({
			p_nm:"PKG_RTN_OFFER_ADMIN.SP_L_OFFER",
			out1: "cursor",
			out2: "num"
		});
		if(result.out2 == 0){
			return result.out1;
		}
    }

	/**
	 * 가맹점 위치값 저장
	 */
	function PKG_RTN_OFFER_ADMIN_SP_U_OFFER_OPT_COORDINATE(coordinates) {
		const I_OPT_NO = coordinates.OPT_NO;
		const I_LATITUDE = coordinates.latitude;
		const I_LONGITUDE = coordinates.longitude;

		const result = exec_procedure_post({
			p_nm: "PKG_RTN_OFFER_ADMIN.SP_U_OFFER_OPT_COORDINATE",
			in1: I_OFFER_NO,
			in2: I_OPT_NO,
			in3: I_LATITUDE,
			in4: I_LONGITUDE,
			out1: "num",
			out2: "num"
		});

		if(result.out2 == 0){
			return result.out1;
		} else {
			return [];
		}
	}

	/**
	 * 가맹점리스트 조회
	 */
	function PKG_RTN_OFFER_ADMIN_SP_L_OFFER_OPT_JOIN() {
		const result = exec_procedure_post({
			p_nm:"PKG_RTN_OFFER_ADMIN.SP_L_OFFER_OPT_JOIN",
			in1: I_OFFER_NO,
			out1: "cursor",
			out2: "num"
		});
		$("#span_list_cnt").text(result.out1.length);
		$("#span_select_cnt").text("0");

		grid_options.api.setRowData(result.out1);
	}

	/**
	 * 제조,유통사 가맹점 입력, 수정
	 */
	function PKG_RTN_OFFER_ADMIN_SP_M_OFFER_OPT_JOIN() {

		const I_OPT_NO = $("#input_opt_no").text();
		const I_OFFER_OPT_NAME = $("#input_offer_name").val();
		const I_BUSINESS_LICENSE = $("#input_offer_biz_no").val();
		const I_ADMIN_NO = $("#select_offer_admin").val();
		const I_REGION_NO = $("#select_offer_region").val();
		const I_OFFER_GROUP_NO = $("#select_offer_group").val();
		const I_CEO_NAME = $("#input_offer_ceo_name").val();
		const I_CEO_PHONE = $("#input_offer_ceo_tel").val();
		const I_COMPANY_TEL = $("#input_offer_company_tel").val();
		const I_COMPANY_FAX = $("#input_offer_company_fax").val();
		const I_COMPANY_EMAIL = $("#input_offer_email").val();
		const I_COMPANY_CLASS = $("#input_company_class").val();
		const I_COMPANY_TYPE = $("#input_company_type").val();
		const I_ADDRESS1 = $("#input_offer_address1").val();
		const I_ADDRESS2 = $("#input_offer_address2").val();
		const I_ZIPCODE = $("#input_offer_zipcode").val();
		const I_MANAGER_NAME = $("#input_offer_manager_name").val();
		const I_MANAGER_PHONE = $("#input_offer_manager_tel").val();
		const I_MEMO = $("#textarea_offer_memo").val();
		const I_STATUS = $("#select_offer_status").val();
		const I_COMPANY_NAME = I_OFFER_OPT_NAME;
		const I_SHIP_NO = $("#select_offer_ship").val();

		const result = exec_procedure_post({
			p_nm:"PKG_RTN_OFFER_ADMIN.SP_M_OFFER_OPT_JOIN",
			in1: I_OFFER_NO, // 유통사번호
			in2: I_OPT_NO, // 가맹점번호
			in3: I_OFFER_OPT_NAME,
			in4: I_BUSINESS_LICENSE,
			in5: I_ADMIN_NO,
			in6: I_REGION_NO,
			in7: I_OFFER_GROUP_NO,
			in8: I_CEO_NAME,
			in9: I_CEO_PHONE,
			in10: I_COMPANY_NAME,
			in11: I_COMPANY_TEL,
			in12: I_COMPANY_FAX, //fax
			in13: I_COMPANY_EMAIL,
			in14: I_COMPANY_CLASS, // 업종
			in15: I_COMPANY_TYPE, // 업태
			in16: I_ADDRESS1,
			in17: I_ADDRESS2,
			in18: I_ZIPCODE,
			in19: I_MANAGER_NAME, //manager_name
			in20: I_MANAGER_PHONE, //manager_phone
			in21: I_MEMO,
			in22: I_SHIP_NO, //
			in23: I_STATUS,
			out1: "num",
			out2: "num"
		});

		if(result.out2 == 0 && result.out1 > 0) {
			alert("가맹점 정보가 변경되었습니다.");
			PKG_RTN_OFFER_ADMIN_SP_L_OFFER_OPT_JOIN();
			$("#div_opt_info_modal").modal("hide");
		}else{
			alert("가맹점 정보를 변경할 수 없습니다.");
		}
	}

	/**
	 * 가맹점 삭제
	 * RTN_OFFER_OPT_JOIN에서 상태값을 -1로 변경한다.
	 */
	function PKG_RTN_OFFER_ADMIN_SP_U_OFFER_OPT_JOIN() {
		const I_OPT_NO = $("#input_opt_no").text();
		const I_ERP_OPT_CODE = "";
		const I_STATUS = -1;
		const result = exec_procedure_post({
			p_nm:"PKG_RTN_OFFER_ADMIN.SP_U_OFFER_OPT_JOIN",
			in1: I_OFFER_NO,
			in2: I_OPT_NO,
			in3: I_ERP_OPT_CODE,
			in4: I_STATUS,
			out1: "num",
			out2: "num"
		});
		if(result.out2 == 0 && result.out1 > 0) {
			alert("가맹점가 삭제 되었습니다.");
			PKG_RTN_OFFER_ADMIN_SP_L_OFFER_OPT_JOIN();
			$("#div_opt_info_modal").modal("hide");
		}else{
			alert("가맹점를 삭제 할 수 없습니다.");
		}
	}

	/**
	 * 계정 생성
	 */
	function PKG_RTN_OFFER_LOGIN_SP_U_OFFER_OPT_JOIN(I_COLUMN_NAME, I_VALUE) {
		const I_OPT_NO = $("#input_opt_no").text();
		const result = exec_procedure_post({
			p_nm:"PKG_RTN_OFFER_LOGIN.SP_U_OFFER_OPT_JOIN",
			in1: I_OFFER_NO,
			in2: I_OPT_NO,
			in3: I_COLUMN_NAME,
			in4: I_VALUE,
			out1: "num",
			out2: "num"
		});
		return result;
	}

	/**
	 * 지역 selectbox 조회
	 */
	function PKG_RTN_OFFER_CONF_SP_L_OFFER_REGION() {
		const result = exec_procedure_post({
			p_nm:"PKG_RTN_OFFER_CONF.SP_L_OFFER_REGION",
			in1: I_OFFER_NO,
			out1: "cursor",
			out2: "num"
		});

		if(result.out2 == 0) {
			return result.out1;
		}
	}

	/**
	 * 배송사 selectbox 조회
	 */
	function PKG_RTN_OFFER_CONF_SP_L_OFFER_SHIP() {
		const result = exec_procedure_post({
			p_nm:"PKG_RTN_OFFER_CONF.SP_L_OFFER_SHIP",
			in1: I_OFFER_NO,
			out1: "cursor",
			out2: "num"
		});

		if(result.out2 == 0) {
			return result.out1;
		}
	}

	/**
	 * 영업사원 조회
	 */
	function PKG_RTN_MENU_SP_L_ADMIN() {
		const I_MENU_GROUP_NO = "";
		const I_IS_MASTER = 0;
		const result =  exec_procedure_post({
			p_nm:"PKG_RTN_MENU.SP_L_ADMIN",
			in1: I_OFFER_NO,
			in2: I_MENU_GROUP_NO,
			in3: I_IS_MASTER,
			out1: "cursor",
			out2: "num"
		});
		if(result.out2 == 0) {
			return result.out1;
		}
	}

	/**
	 * 그룹리스트 조회
	 */
	function PKG_RTN_OFFER_GROUP_SP_L_OFFER_GROUP() {
		const result =  exec_procedure_post({
			p_nm:"PKG_RTN_OFFER_GROUP.SP_L_OFFER_GROUP",
			in1: I_OFFER_NO,
			out1: "cursor",
			out2: "num"
		});

		if(result.out2 == 0) {
			return result.out1;
		}else{
			alert("그룹 리스트를 호출할 수 없습니다.");
		}
	}

	/**
	 * 사업자 중복체크
	 */
	function PKG_RTN_OFFER_LOGIN_SP_S_OFFER_OPT_LICENSE() {
		const I_BUSINESS_LICENSE = $("#input_offer_biz_no").val();
		const result = exec_procedure_post({
			p_nm:"PKG_RTN_OFFER_LOGIN.SP_S_OFFER_OPT_LICENSE",
			in1: I_OFFER_NO,
			in2: I_BUSINESS_LICENSE,
			out1: "cursor",
			out2: "num",
			out3: "num"
		});

		if(result.out2 == 0) {
			use_license();
			return result.out1;
		}else{
			overlap_license();
		}
	}

	/**
	 * 선택한 가맹점 항목 일괄변경
	 * @param I_NAME 항목명 : STATUS, OFFER_GROUP_NO, ADMIN_NO, REGION_NO, SHIP_NO
	 * @param I_VALUE 항목의 값
	 */
	function PKG_RTN_OFFER_OPT_ADMIN_SP_U_OFFER_OPT_JOIN_COLUMN(I_NAME, I_VALUE, select_data){
		let data_array = [];

		select_data.forEach(function(node){
			const I_OPT_NO = node.data.OPT_NO;

			data_array.push({
				p_nm: "PKG_RTN_OFFER_OPT_ADMIN.SP_U_OFFER_OPT_JOIN_COLUMN",
				in1: I_OFFER_NO,
				in2: I_OPT_NO,
				in3: I_NAME,
				in4: I_VALUE,
				out2: "num",
				out3: "num"
			}); 
		});

		const save_result = exec_request_array({"data_array":data_array});

		if(save_result.result == "success"){
			alert("변경완료");
		}else{
			alert("변경실패. 고객센터에 확인 부탁드립니다.");
		}

		$("#div_column_change").modal("hide");
		PKG_RTN_OFFER_ADMIN_SP_L_OFFER_OPT_JOIN();
	}

	/**
	 * 가맹접의 업태 업종 일괄 설정
	 * @param I_NAME 변경할 컬럼명
	 * @param I_VALUE 변경될 값
	 */
	function PKG_RTN_OFFER_OPT_ADMIN_SP_U_OFFER_OPT_JOIN_STR(I_NAME, I_VALUE, select_data){
		let data_array = [];

		select_data.forEach(function(node){
			const I_OPT_NO = node.data.OPT_NO;

			data_array.push({
				p_nm: "PKG_RTN_OFFER_OPT_ADMIN.SP_U_OFFER_OPT_JOIN_STR",
				in1: I_OFFER_NO,
				in2: I_OPT_NO,
				in3: I_NAME,
				in4: I_VALUE,
				out2: "num",
				out3: "num"
			}) ;
		});

		const save_result = exec_request_array({"data_array":data_array});

		if(save_result.result == "success"){
			alert("변경완료");
		}else{
			alert("변경실패. 고객센터에 확인 부탁드립니다.");
		}

		$("#div_column_change").modal("hide");
		PKG_RTN_OFFER_ADMIN_SP_L_OFFER_OPT_JOIN();
	}

	function grid_options_init(){
		const column_defs = [
			{
				headerName: "수정",
				width: 90,
				cellClass: "text-center",
				cellRenderer: function(params){
					return `<button class="btn btn-sm btn_grid_update_cls" data-id="${params.node.id}">수정</button>`
					
				}
			},
			{
				headerName: "OPT_NO",
				field: "OPT_NO",
				width: 100,
				cellClass: "stringType"
			},
			{
				headerName: "가맹점명",
				field: "OFFER_OPT_NAME",
				width: 250,
				cellClass: "stringType",
				checkboxSelection:true,
				headerCheckboxSelection: true,
				headerCheckboxSelectionFilteredOnly: true
			},
			{
				headerName: "레티나 안경원명",
				field: "RETINA_OPT_NAME",
				width: 200,
				cellClass: "stringType"
			},
			{
				headerName: "그룹명",
				field: "OFFER_GROUP_NAME",
				enableRowGroup: true,
				cellClass: "stringType"
			},
			{
				headerName: "사업자번호",
				field: "BUSINESS_LICENSE",
				width: 110,
				cellClass: "stringType"
			},
			{
				headerName: "영업사원",
				field: "ADMIN_NAME",
				width: 110,
				enableRowGroup: true,
				cellClass: "stringType"
			},
			{
				headerName: "지역",
				field: "REGION_NAME",
				width: 80,
				cellClass: "stringType",
				enableRowGroup: true
			},
			{
				headerName: "배송사",
				field: "SHIP_NAME",
				width: 120,
				cellClass: "text-center",
				enableRowGroup: true,
			},
			{
				headerName: "대표자",
				field: "CEO_NAME",
				width: 110,
				cellClass: "stringType"
			},
			{
				headerName: "대표자TEL",
				field: "CEO_PHONE",
				width: 110,
				cellClass: "stringType"
			},
			{
				headerName: "연락처TEL",
				field: "COMPANY_TEL",
				width: 110,
				cellClass: "stringType"
			},
			{
				headerName: "연락처FAX",
				field: "COMPANY_FAX",
				width: 110,
				hide: true,
				cellClass: "stringType"
			},
			{
				headerName: "이메일",
				field: "COMPANY_EMAIL",
				cellClass: "stringType"
			},
			{
				headerName: "주소",
				field: "ADDRESS1",
				width: 250,
				cellClass: "stringType"
			},
			{
				headerName: "상세주소",
				field: "ADDRESS2",
				width: 250,
				cellClass: "stringType"
			},
			{
				headerName: "ID",
				field: "USER_ID",
				cellClass: "text-center",

			},
			{
				headerName: "메모",
				field: "MEMO",
				width: 120,
				hide: true,
				cellRenderer: function(params){
					if(params.value != null){
						return "메모";
					}
					return "";
				}
			},

			{
				headerName : "위치",
				// field : "MAP",
				width:80,
				cellRenderer : function(params){
					if(params.data.LATITUDE){
						return "<button class='btn btn-xs btn-default load_map' data-id='"+params.node.id+"'>위치</button>";
					}
				},
			},
			{
				headerName: "상태",
				width: 80,
				valueGetter: function(params){
					if(params.data.STATUS == 1) {
						return "활성";
					}else {
						return "비활성";
					}
				},

				cellClass: "stringType"
			},
		];

		grid_options = {
			columnDefs: column_defs,
			animateRows: true,
			rowSelection: "multiple",
			rowGroupPanelShow: "always", 
			suppressDragLeaveHidesColumns: true,
			detailRowHeight: 200,
			overlayLoadingTemplate: '<div  id="loader-1" class="loader div_loading_img" style="position: absolute; z-index: 999; left: 50%; top:50%; transform: translate(-50%, -50%); display: block" ><span style="margin: 0px; padding:0px; font-size: 15px; font-weight: bold"></br></br></br></br></br>loading ...&nbsp;&nbsp;</span></div>',
			overlayNoRowsTemplate: '<span class="ag-overlay-loading-center">검색결과가 없습니다.</span>',
			defaultColDef: {
				cellStyle : function(params) {
					return {"border-right": "1px solid #d9dcde"}
				},
				sortable: true,
				resizable: true,
				enableRowGroup: false, // 그룹핑 설정
				floatingFilter: true,
				filter: "agTextColumnFilter",
				filterParams:{
					filterOptions:["contains"]
				},
			},
			rowClassRules : {
				"ag_gray_cls": function(params) {
					if(params.data !== undefined){
						return params.data.STATUS == 0;
					}
				}
			},
			onRowSelected: function(){
				$("#span_select_cnt").text(grid_options.api.getSelectedRows().length);
			},
			excelStyles:excel_styles
		}

		const grid_div = document.querySelector("#div_grid");
		new agGrid.Grid(grid_div, grid_options);
		grid_options.api.setRowData([]);
	}
</script>
</body>
</html>
