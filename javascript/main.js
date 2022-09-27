<script src="./map.js"></script>
$(document).on("click", "#btn_column_change_address", function(){
  const selected_rows = grid_options.api.getSelectedRows();
  selected_rows.forEach(async (v, idx) => {
      let coordinates = await address_search(v.ADDRESS1);
      //좌표값을 저장하는 프로시져
      PKG_RTN_OFFER_ADMIN_SP_U_OFFER_OPT_COORDINATE(coordinates, selected_rows[idx].OPT_NO);
  })
})

function address_search(address){
  return new Promise(function(resolve){ //비동기 함수이기 때문에 promise를 통해 값을 받아옴.
      geocoder.addressSearch(address, function(result, status) {
          // 정상적으로 검색이 완료됐을때, 실행 
          if (status === kakao.maps.services.Status.OK) {
              resolve({
                  latitude : result[0].y,
                  longitude : result[0].x
              })
          } 
      })
  })
}