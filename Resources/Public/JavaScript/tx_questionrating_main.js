  function toggle(id,imgTag,openimg,closeimg) {
    table = document.getElementById(id);
    if(table.style.display != 'none') {
      imgTag.src = closeimg;
      table.style.display = 'none';
    }
    else {
      imgTag.src = openimg;
      table.style.display = '';      
    }
  }

 
  function showHideCorrectAnswer(correctIds,buttonObj) {
    idArray = correctIds.split(",");
    for(var id in idArray) {
      if (document.getElementById("answer_" + idArray[id]).className != 'highlight') {        
        buttonObj.value = "HIDE CORRECT ANSWER";
        document.getElementById("answer_" + idArray[id]).className = 'highlight';

      }
      else {
        buttonObj.value = "SHOW CORRECT ANSWER";
        document.getElementById("answer_" + idArray[id]).className = '';
      }
    }
    
  }
