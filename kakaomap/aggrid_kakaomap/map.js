/**
 * 기본 카카오 지도 설정
 */

 let container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
 let options = { //지도를 생성할 때 필요한 기본 옵션
     center: new kakao.maps.LatLng(33.450701, 126.570667), //지도의 중심좌표.
     level: 2 //지도의 레벨(확대, 축소 정도)
 };
 let map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴
 
 let geocoder = new kakao.maps.services.Geocoder(); //주소-좌표 변환 객체 생성
 let zoomControl = new kakao.maps.ZoomControl(); //지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성
 
 /**
  * 주소를 받으면 좌표를 반환
  * parameter = {
  * address:주소
  *  }
  */
 function address_search(address){
     return new Promise(function(resolve){ //비동기 함수이기 때문에 promise를 통해 값을 받아옴.
         geocoder.addressSearch(address, function(result, status) {
             // status = 응답코드
             // kakao.maps.services.Status OK:검색 결과 있음, ZERO_RESULT:정상적으로 응답 받았으나 검색 결과는 없음, ERROR:서버 응답에 문제
             // 정상적으로 검색이 완료됐을때, 실행 
             if (status === kakao.maps.services.Status.OK) {
                 resolve({
                     latitude : result[0].y,
                     longitude : result[0].x
                 })
             // 주소가 존재하던 가맹점은 좌표가 들어가 있습니다. 가맹점의 주소를 비워줘도 좌표값은 그대로 남아있습니다.
             // 그래서 정상적인 주소가 아니여서 좌표값을 못 찾아오더라도, 위도와 경도에 빈 값을 넣어줘서 반환합니다.
             } else {
                 resolve({
                     latitude : "",
                     longitude : ""
                 })
             }
         })
     })
 }
 
 /**
  * 좌표를 통해 카카오 맵을 만듬
  * parameter = {
  * latitude:위도
  * longitude:경도
  * info_div:지도 좌측상단 위치 보여줄 div
  * personally_select:지도 클릭 값
  * input_detail_latitude:지도 클릭 위도
  * input_detail_longitude:지도 클릭 경도
  * btn_change_address:지도 변경 좌표 저장버튼
  * }
  */
 function map_draw(parameter){
     map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴
     let coords = new kakao.maps.LatLng(0, 0); //coordinates(좌표)
     coords = new kakao.maps.LatLng(Number(parameter.latitude), Number(parameter.longitude)); //coordinates(좌표)    
     let marker = new kakao.maps.Marker({
         map: map,
         position: coords
     });
     let infowindow = new kakao.maps.InfoWindow({
         content: '<div style="width:150px;text-align:center;padding:6px 0;">가맹점 현재위치</div>'
     });
     infowindow.open(map, marker);
     map.setCenter(coords); //마커를 중앙에두게 배치 
     map.relayout();//지도의 크기가 변동이 있을 경우 함수 호출
 
     parameter.btn_change_address.disabled = true; //주소를 수정할 수 있는 버튼을 비활성화 합니다
 
     marker = new kakao.maps.Marker(); // 클릭한 위치를 표시할 마커입니다
     infowindow = new kakao.maps.InfoWindow({zindex:1}); // 클릭한 위치에 대한 주소를 표시할 인포윈도우입니다
     // 지도를 클릭했을 때 클릭 위치 좌표에 대한 주소정보를 표시하도록 이벤트를 등록합니다
     kakao.maps.event.addListener(map, 'click', function (mouseEvent) {
         const data = {
             map,
             mouseEvent,
             marker,
             infowindow
         }
         map_click_set_marker(parameter, data)
     });
 
     display_address_info(parameter, map);
     map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT); //줌컨트롤
 
 }
 
 //map 클릭시 marker 보여줌
 function map_click_set_marker(parameter, data){
     searchDetailAddrFromCoords(data.mouseEvent.latLng, function(result, status) {
         if (status === kakao.maps.services.Status.OK) {
             let detailAddr = !!result[0].road_address ? `<div>도로명주소 : ${result[0].road_address.address_name}</div>` : "";
             detailAddr += `<div>지번 주소 : ${result[0].address.address_name}</div>`
             
             let content = `<div class="div_b_addr_cls"><span class="span_map_title_cls">주소정보</span> ${detailAddr} </div>`;
 
             // 마커를 클릭한 위치에 표시합니다 
             data.marker.setPosition(data.mouseEvent.latLng);
             data.marker.setMap(data.map);
             
             //맵 모달 상세입력 인풋 부분에 지번 주소를 넣어줍니다.
             parameter.input_detail_latitude.innerHTML = data.mouseEvent.latLng.Ma //위도
             parameter.input_detail_longitude.innerHTML = data.mouseEvent.latLng.La //경도
             parameter.personally_select.innerHTML = result[0].address.address_name; //주소입력
             parameter.btn_change_address.disabled = false; //주소를 수정할 수 있는 버튼을 활성화 합니다.
 
             // 인포윈도우에 클릭한 위치에 대한 상세 주소정보를 표시합니다
             data.infowindow.setContent(content);
             data.infowindow.open(data.map, data.marker);
         }   
     });
 
     // 클릭시 좌표를 받아 상세 주소 정보를 요청합니다
     function searchDetailAddrFromCoords(coords, callback) {
         geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
     }
 
 }
 
 //지도 좌측 상단 주소정보 표시
 function display_address_info(parameter, map) {
     searchAddrFromCoords(map.getCenter(), displayCenterInfo); //현재 지도 중심좌표로 주소를 검색해서, 지도 좌측 상단에 표시합니다.
 
     // 지도 좌측상단에 지도 중심좌표에 대한 주소정보를 표출하는 함수입니다
     function displayCenterInfo(result, status) {
         if (status === kakao.maps.services.Status.OK) {
 
             for(let i = 0; i < result.length; i++) {
                 // 행정동의 region_type 값은 'H' 이므로
                 if (result[i].region_type === 'H') {
                     parameter.info_div.innerHTML = result[i].address_name;
                     break;
                 }
             }
         }    
     }
 
     // 중심 좌표나 확대 수준이 변경됐을 때 지도 중심 좌표에 대한 주소 정보를 표시하도록 이벤트를 등록합니다
     kakao.maps.event.addListener(map, 'idle', function() {
         searchAddrFromCoords(map.getCenter(), displayCenterInfo);
     });
     // 좌표로 행정동 주소 정보를 요청합니다
     function searchAddrFromCoords(coords, callback) {
         geocoder.coord2RegionCode(coords.getLng(), coords.getLat(), callback);         
     }
 }
 