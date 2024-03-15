<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ruleta de Juegos</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
  .container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.wheel {
  border-radius: 50%;
}

#canvas {
  border-radius: 50%;
}

#spin {
  margin-top: 20px;
}
</style>
</head>
<body>

<div class="container text-center">
  <h1>Sorteo de Temas - <button id="spin" class="btn btn-warning">Girar </button></h1>
  <div class="wheel">
    <canvas id="canvas" width="500" height="500"></canvas>
  </div>
  
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  var canvas = document.getElementById('canvas');
  var ctx = canvas.getContext('2d');
  var temas = <?php echo json_encode($temas); ?>;
  var startAngle = 0;
  var arc = Math.PI / (temas.length / 2);
  var spinTimeout = null;

  
  function drawWheel() {
    var angle = startAngle;
    var outsideRadius = 200;
    var textRadius = 160;

    ctx.clearRect(0, 0, 500, 500);

    temas.forEach(function(tema, index) {
      var color = index % 2 === 0 ? '#17a2b8' : '#28a745'; 
      ctx.fillStyle = color;

      ctx.beginPath();
      ctx.arc(250, 250, outsideRadius, angle, angle + arc, false);
      ctx.arc(250, 250, 0, angle + arc, angle, true);
      ctx.fill();

      ctx.save();
      ctx.fillStyle = "black";
      ctx.translate(250 + Math.cos(angle + arc / 2) * textRadius, 
                     250 + Math.sin(angle + arc / 2) * textRadius);
      ctx.rotate(angle + arc / 2 + Math.PI / 2);
      ctx.fillText(tema.nombre, -ctx.measureText(tema.nombre).width / 2, 0);
      ctx.restore();

      angle += arc;
    });


    ctx.fillStyle = "white";
    ctx.beginPath();
    ctx.arc(250, 250, 50, 0, 2 * Math.PI);
    ctx.fill();
  }

 
  function spin() {
    var spinAngleStart = Math.random() * 10 + 10;
    var spinTime = 0;
    var spinTimeTotal = Math.random() * 3 + 4 * 1000;

    function rotateWheel() {
      spinTime += 30;
      if (spinTime >= spinTimeTotal) {
        stopRotateWheel();
        return;
      }

      var spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
      startAngle += (spinAngle * Math.PI / 180);
      drawWheel();
      spinTimeout = setTimeout(rotateWheel, 30);
    }

    function stopRotateWheel() {
      clearTimeout(spinTimeout);
      var degrees = startAngle * 180 / Math.PI + 90;
      var arcd = arc * 180 / Math.PI;
      var index = Math.floor((360 - degrees % 360) / arcd);
      showPopup(temas[index]);
    }

    function easeOut(t, b, c, d) {
      var ts = (t /= d) * t;
      var tc = ts * t;
      return b + c * (tc + -3 * ts + 3 * t);
    }

    rotateWheel();
  }


  function showPopup(selectedTema) {
    alert("El tema seleccionado es: " + selectedTema.nombre + " --> "+selectedTema.descripcion);
  }

  drawWheel();
  $('#spin').on('click', spin);
});


</script>
</body>
</html>
