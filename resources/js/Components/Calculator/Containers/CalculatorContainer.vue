
<template>
    <calculator-presenter
    @update-length="updateLength"
    @update-principal="updatePrincipal"
    @update-rate="updateRate"
    @submit-data="submitData"
    @clear-data="clearData"
    :calculation-history="this.history"
    :current-data="currentData"
    >

    </calculator-presenter>
</template>

<script>
export default {

  data() {
      return {
          rate : 0,
          length : 0,
          principal : 0,
          currentData : '',
          history : [],
      }
  },
  methods : {
      updateLength(value) {
          this.length = value;
      },

      updateRate(value) {
          this.rate = value;
      },

      updatePrincipal(value) {
          this.principal = value;
      },

      validateField() {
          if(this.rate >= .01 && this.length >= 1 && this.principal >= 1) {
              return true;
          }
          alert('Please fill out the form before submitting!')
          return false;
      },

      submitData() {
        if(this.validateField()){
            let data = {
                "rate" : this.rate,
                "length" : this.length,
                "principal" : this.principal
            };
            axios.post('/api/calculate', data)
              .then(response => { 
                this.history.push(response.data);
                this.currentData = response.data;
            })
              .catch(error => {
                console.error(error)
            })
        }
      },
      clearData() {
            let ids = this.history.map(a => a.id);
            let data = {
                "ids" : ids,
            };
            axios.delete('/api/calculations', { data : data })
              .then(response => { 
                this.history = [];
                this.currentData = '';
            })
              .catch(error => {
                console.error(error)
            })   
      },
      getHistory() {
        axios.get('/api/calculations')
          .then(response => { 
              this.history = response.data;
          })
          .catch(error => {
              console.error(error)
          })
      }
  },
  mounted() {
      this.getHistory();
  },
};
</script>
