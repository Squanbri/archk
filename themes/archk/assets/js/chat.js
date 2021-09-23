// var conn = new WebSocket('ws://rab.archksakhalin.ru:8200');
// conn.omopen = function(e) {
//   console.log("Connection estabilished!");
// }

// conn.onmessage = function(e) {
//   console.log(e.data)
// }

var conn = new WebSocket('wss://92.255.77.110:8200');
  conn.onopen = function(e) {
      console.log("Connection established!");
  };

  conn.onmessage = function(e) {
      console.log(e.data);
  };