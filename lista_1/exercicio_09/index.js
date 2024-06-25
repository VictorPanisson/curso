const showTimeNow = () =>{

      const clockTag = document.querySelector('time');

      let dateNow = new Date();

      let hh = dateNow.getHours();
      let mm = dateNow.getMinutes();
      let ss = dateNow.getSeconds();
      

      hh = hh < 10 ? '0'+ hh : hh; 
      mm = mm < 10 ? '0'+ mm : mm; 
      ss = ss < 10 ? '0'+ ss : ss; 
       

      clockTag.innerText = hh +':'+ mm +':'+ ss;
    }

    showTimeNow()
    setInterval(showTimeNow, 1000);