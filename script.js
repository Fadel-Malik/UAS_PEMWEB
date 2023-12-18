function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }
  
  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) === " ") c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }
  
  function eraseCookie(name) {
    document.cookie = name + "=; Max-Age=-99999999;";
  }
  
  function saveUserDataToStorage(name, email, suka, jenis_kelamin) {
    var userData = {
      name: name,
      email: email,
      suka: suka,
      jenis_kelamin: jenis_kelamin,
    };
    localStorage.setItem("user_data", JSON.stringify(userData));
  }
  
  function getUserDataFromStorage() {
    var userData = localStorage.getItem("user_data");
    return userData ? JSON.parse(userData) : null;
  }
  
  function clearUserDataFromStorage() {
    localStorage.removeItem("user_data");
  }
  
  function clearUserDataFromSession() {
    fetch("clearSession.php", {
      method: "POST",
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data);
      })
      .catch((error) => console.error("Error:", error));
  }
  
  function submitForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var suka = document.getElementById("suka").checked;
    var jenis_kelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
  
    if (name === "" || email === "" || jenis_kelamin === null) {
      alert("Please fill in all required fields.");
      return;
    }
  
    fetch("submitData.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        name: name,
        email: email,
        suka: suka,
        jenis_kelamin: jenis_kelamin.value,
      }),
    })
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("result").innerHTML = data;
  
        if (data.includes("successfully")) {
          saveUserDataToStorage(name, email, suka, jenis_kelamin.value);
          setCookie("user_name", name, 7);
  
          window.location.href = "tampilData.php";
        }
      })
      .catch((error) => console.error("Error:", error));
  }
  
  function fillFormWithUserData() {
    var userData = getUserDataFromStorage();
  
    if (userData) {
      document.getElementById("name").value = userData.name;
      document.getElementById("email").value = userData.email;
      document.getElementById("suka").checked = userData.suka;
      document.getElementById(userData.jenis_kelamin).checked = true;
    } else {
      var userName = getCookie("user_name");
      if (userName) {
        document.getElementById("name").value = userName;
      }
    }
  }
  
  fillFormWithUserData();