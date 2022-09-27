/**
 * 목적 : ag-grid 내에 셀 이벤트 처리
 * 함수
 *  init() 
    : rendering 되기 전에 초기화, 속성정의, CSS변경, event_function 호출
    : 필수값
 *  event_function() 또는 handler()
    : init() 함수에 필요시 호출
    : 화면처리 등 상황에 따라 생략도 가능.
 *  refresh()
    : event_function를 통해 값이 변경되면 refresh가 실행되어, cell의 값이 변경됨에 따라 event를 줄 수 있다.
    : 필수값
 *  getGui()
    : init() 에서 선언한 eGui 를 event_function() 동작에 따라서 화면에 적용시킨다.
    : 필수값
 * [참고] 새로고침
    (방법1) rowNode.setDataValue : 값 설정을 직접 변경하여 보여줌
    (방법2) refresh : 데이타 변경시 다른 내용을 호출하기 위해서 사용
 * [비고]
 * toggle 등 CSS 관련된 내용은 /hebees/css/grid/grid_class.css 에 기본값 적용  
 */

/**
 * 이벤트 : ag-grid 안에서 체크 버튼 on/off
 * 참고 : https://www.notion.so/eternalglee/cellRenderer-HTML-class-prototype-41e36ee14bfc49b6a3697c1cb3b07522#028b2f36728e41cfa64c6ee95769da09
 */
 class aggrid_checkbox {
    init(params) {
        // ag-grid에 선택된 정보
        this.params = params;

        // 해당 셀을 선언 및 스타일 적용
        this.eGui = document.createElement("input");
        this.eGui.type = "checkbox";
        this.eGui.checked = Number(params.value == 1);
        this.eGui.setAttribute("style", "width:1.5rem; height:1.5rem border-color:#bdc3c7")

        // 체크박스 이벤트 처리
        this.checked_handler = this.checked_handler.bind(this); // bind를 통해 checked_handler와 연결해줍니다.
        this.eGui.addEventListener("click", this.checked_handler); // click 이벤트 적용
    }

    // 체크박스 클릭시 호출되는 method
    checked_handler(e) {
        const checked = e.target.checked ? 1 : 0;
        const col_id = this.params.column.colId;
        this.params.node.setDataValue(col_id, checked); // col_id 값에 checked 값을 넣어준다.
    }
    refresh() {
        return true;
    }
    getGui() {
        return this.eGui;
    }
}

/**
 * 이벤트 : CSS를 이용하여 사용/미사용 toggle button 구현 (토클버튼에 글자포함)
 * 참고 :  https://www.notion.so/eternalglee/cellRenderer-HTML-class-prototype-41e36ee14bfc49b6a3697c1cb3b07522#028b2f36728e41cfa64c6ee95769da09
 */
 class aggrid_toggle_with_text { 
    init(params) {
        this.params = params;

        this.eGui = document.createElement("div");
        //input type이 checkbox일땐 정상적으로 checkbox handler가 되지 않는다
        this.eGui.innerHTML = `
            <input type="button" class="input_toggle_with_text_cls"/>
                <label for="input_toggle_with_text_cls"></label>
        `;

        this.select_toggle = this.eGui.querySelector(".input_toggle_with_text_cls"); 
        // params.value 은 toggle의 값 (1:사용,0:미사용)
        params.value == 1 ? this.select_toggle.classList.add("active") : null;

        this.checked_handler = this.checked_handler.bind(this); // bind를 통해 checked_handler와 연결    
        this.eGui.addEventListener("click", this.checked_handler); // click 이벤트 적용
    }

    checked_handler() {
        let on_off = this.params.value; // 값을 on_off 에 담아둔다.
        let change_on_off = (on_off==1) ? 0 : 1 ; // toggle에 따라서 값을 반대로 변경해준다.

        this.select_toggle.classList.toggle("active"); // toggle 에 class 를 변경해준다.

        let col_id = this.params.column.colId;
        this.params.node.setDataValue(col_id, change_on_off); // col_id 값에 on_off 값을 넣어준다.
    }
    refresh() {
        return true;
    }
    getGui() {
        return this.eGui;
    }
}

/**
 * 이벤트 : 컬럼 항목 앞에 이미지 추가하기 (현재는 TREE 구현시 사용)
 * 참고 :  https://www.ag-grid.com/javascript-data-grid/component-cell-renderer/
 */
class aggrid_tree_icon {
    init(params) {
        const temp_div = document.createElement('div');
        const value = params.value;
        const icon = this.tree_depth_icon(params.data.TREE_DEPTH);
        const span_html = `<span> <i class="${icon}"></i>&nbsp; <span class="filename"></span>${value}</span>`;
        temp_div.innerHTML = icon ? span_html :value;
        this.eGui = temp_div.firstChild;
    }

    // [TREE] Depth 에 따라서 이미지 선택하는 함수
    tree_depth_icon(depth) {
        if (depth == '1') { // BRAND
            return 'glyphicon glyphicon-folder-close';
        } else if (depth == '2') { // PRODUCT
            return 'glyphicon glyphicon-file';
        }
    }
    refresh() {
        return true;
    }
    getGui() {
        return this.eGui;
    }

}

/**
 * 이벤트 : ag-grid 안에서 input box 라인 구현 (UI/UX 개선작업)
 * 참고 :   https://www.notion.so/eternalglee/cellRenderer-HTML-class-prototype-41e36ee14bfc49b6a3697c1cb3b07522#028b2f36728e41cfa64c6ee95769da09
 */
 class aggrid_input_text_box {
    init(params) {
        this.params = params;

        this.eGui = document.createElement("input");
        this.eGui.type = "text";
        this.eGui.style.cssText= `width: 90%; height:80%; border:1px solid #bdc3c7;`;

        this.checked_handler = this.checked_handler.bind(this); //bind를 통해 checked_handler와 연결해줍니다.
        this.eGui.addEventListener("change", this.checked_handler);
    }

    checked_handler() {
        let col_id = this.params.column.colId;
        this.params.node.setDataValue(col_id, this.eGui.value);
    }
    refresh() {
        return true;
    }
    getGui() {
        return this.eGui;
    }
}

/**
 * 이벤트 : ag-grid 안에서 숫자 input box 라인 구현 (UI/UX 개선작업)
 * 참고 :  https://www.notion.so/eternalglee/cellRenderer-HTML-class-prototype-41e36ee14bfc49b6a3697c1cb3b07522#028b2f36728e41cfa64c6ee95769da09
 */
class aggrid_input_number_box {
    init(params) {
        this.params = params;

        this.eGui = document.createElement("input");
        this.eGui.type = "text";
        this.eGui.style.cssText= `width: 90%; height:80%; border:1px solid #bdc3c7;`;
        
        this.checked_handler = this.checked_handler.bind(this); // bind를 통해 checked_handler와 연결해줍니다.
        this.eGui.addEventListener("change", this.checked_handler);

        // 숫자만 입력하게 해주는 이벤트
        // keyCode ( 95 ~ 106 ) : 0 ~ 9(Num Lock)
        // keyCode ( 47 ~ 58 ) : 0 ~ 9
        // keyCode 8 : Backspace
        // keyCode 9 : Tab
        this.eGui.onkeydown = function(e) {
            if(!((e.keyCode > 95 && e.keyCode < 106)
                || (e.keyCode > 47 && e.keyCode < 58) 
                || e.keyCode == 8 || e.keyCode == 9)) {
                return false;
            }
        }
    }

    checked_handler() {
        let col_id = this.params.column.colId;
        this.params.node.setDataValue(col_id, this.eGui.value);
    }
    refresh() {
        return true;
    }
    getGui() {
        return this.eGui;
    }
}

/**
 * 이벤트 : ag-grid 안에서 selectbox 구현 (ag-grid 기본으로 제공하는 selectbox 는 값변화 인식 등 이슈가 있음)
 * 참고 : https://www.notion.so/eternalglee/cellRenderer-HTML-class-prototype-41e36ee14bfc49b6a3697c1cb3b07522#028b2f36728e41cfa64c6ee95769da09
 */
 class aggrid_selectbox {
    init(params) {
        this.params = params;

        this.eGui = document.createElement("div");
        this.eGui.innerHTML = params.selectbox_value; // selectbox 를 그리는 html
        this.eGui.style.cssText= `width: 90%;`;

        this.selectbox = this.eGui.querySelector(params.selectbox_id); // selectbox 선언된 id
        this.selectbox.value = params.value;

        this.checked_handler = this.checked_handler.bind(this); //bind를 통해 checked_handler와 연결해줍니다.
        this.eGui.addEventListener("change", this.checked_handler);
    }

    checked_handler() {
        let col_id = this.params.column.colId;
        this.params.node.setDataValue(col_id, this.selectbox.value);
    }
    refresh() {
        return true;
    }
    getGui() {
        return this.eGui;
    }
}
