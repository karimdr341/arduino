// let value = 0;

const pageLoad = (r) => {
  let output = {
    api_key: "QZWC6S82D87Z1Z2A",
    action: "read",
  };
  fetch("./api.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(output),
  })
    .then((response) => response.json())
    .then((result) => {
      let button1 = document.getElementsByClassName("led-button")[0];
      let button2 = document.getElementsByClassName("led-button")[1];
      if (result.status) {
        let LEDval1 = result.data[0].led1;
        button1.setAttribute("dbvalue", LEDval1);
        if (LEDval1 == 0) {
          button1.innerHTML = "Turn OFF LED1";
          button1.nextElementSibling.innerHTML = "Inactive";
          button1.nextElementSibling.style.background = "red";
        } else if (LEDval1 == 1) {
          button1.innerHTML = "Turn ON LED1";
          button1.nextElementSibling.innerHTML = "Active";
          button1.nextElementSibling.style.background = "green";
        }

        let LEDval2 = result.data[0].led2;
        button2.setAttribute("dbvalue", LEDval2);
        if (LEDval2 == 0) {
          button2.innerHTML = "Turn OFF LED2";
          button2.nextElementSibling.innerHTML = "Inactive";
          button2.nextElementSibling.style.background = "red";
        } else if (LEDval2 == 1) {
          button2.innerHTML = "Turn ON LED2";
          button2.nextElementSibling.innerHTML = "Active";
          button2.nextElementSibling.style.background = "green";
        }
      }
    })
    .catch((err) => {
      console.log(err);
    });
};

const updater = (elm) => {
  let data = elm.getAttribute("data");
  const dbval = elm.getAttribute("dbvalue");
  let output;
  let fieldval;
  //   let update_field;

  if (dbval == "1") {
    fieldval = 0;
  } else if (dbval == "0") {
    fieldval = 1;
  }

  if (data == "led1") {
    output = {
      api_key: "QZWC6S82D87Z1Z2A",
      action: "update",
      update_field: "led1",
      update_value: fieldval,
    };
  } else if (data == "led2") {
    output = {
      api_key: "QZWC6S82D87Z1Z2A",
      action: "update",
      update_field: "led2",
      update_value: fieldval,
    };
  }
  //   console.log(output);
  //   pageLoad();

  fetch("./api.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(output),
  })
    .then((response) => response.json())
    .then((result) => {
      if (result.status == "success") {
        pageLoad();
      }
    })
    .catch((err) => {
      console.log(err);
    });
};
