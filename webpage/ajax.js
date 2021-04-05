function getData(str) {
    if (str == "") {
      document.getElementById("ovdje").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("ovdje").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","update_values.php?q="+str,true);
      xmlhttp.send();
    }
  }
  