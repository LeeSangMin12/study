class MedalCellRenderer {
    // init method gets the details of the cell to be renderer
    init(params) {
      this.eGui = document.createElement('span');
      this.eGui.innerHTML = Array(Number(params.value)).fill("#").join("");
    //   this.eGui.innerHTML = new Array(params.value).fill('#').join('');
    }
  
    refresh(params) {
        console.log(params);
      return true;
    }
    getGui() {
        return this.eGui;
      }
  }