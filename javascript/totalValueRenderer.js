class TotalValueRenderer {
    init(params) {
      // create the cell
      this.eGui = document.createElement('div');
      this.eGui.innerHTML = `
            <span>
                <span class="my-value"></span>
                <button class="btn-simple">Push For Total</button>
            </span>
         `;
  
      // get references to the elements we want
      this.eValue = this.eGui.querySelector('.my-value');
      this.eButton = this.eGui.querySelector('.btn-simple');
  
      // set value into cell
      this.cellValue = params.value;
      this.eValue.innerHTML = this.cellValue;
  
      // add event listener to button
      this.eventListener = () => alert(`${this.cellValue} medals won!`);
      this.eButton.addEventListener('click', this.eventListener);
    }
  
    getGui() {
      return this.eGui;
    }
  
    // gets called whenever the cell refreshes
    refresh(params) {
      // set value into cell again
      this.cellValue = "10";
      this.eValue.innerHTML = this.cellValue;
  
      // return true to tell the grid we refreshed successfully
      return true;
    }
  
    destroy() {
        console.log("hi");
        console.log(this.eButton)
      if (this.eButton) {
        // check that the button element exists as destroy() can be called before getGui()
        this.eButton.removeEventListener('click', this.eventListener);
      }
    }
  
    getValueToDisplay(params) {
      return params.valueFormatted ? params.valueFormatted : params.value;
    }
  }

