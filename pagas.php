<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$basededatos = "panaderia";

// Conexión a la base de datos
$enlace = mysqli_connect($servidor, $usuario, $clave, $basededatos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panadería Marcianas - Pago</title>
  <link rel="stylesheet" href="estyle.css">
</head>
<body>
  <h1>Panadería Marcianas - Detalles de Pago</h1>
  <div class="container">
    <form id="paymentForm"  method="POST">
      <h2>Información del Cliente</h2>
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>
      <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
      </div>
      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" required>
      </div>
      <div class="form-group">
        <label for="domicilio">Domicilio:</label>
        <input type="text" id="domicilio" name="domicilio" required>
      </div>
      <div class="form-group">
        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>
      </div>
      <div class="form-group">
        <label for="codigoPostal">Código Postal:</label>
        <input type="text" id="codigoPostal" name="codigoPostal" required>
      </div>
      <div class="form-group">
        <label for="colonia">Colonia:</label>
        <input type="text" id="colonia" name="colonia" required>
      </div>
      <div class="form-group">
        <label for="calle">Calle:</label>
        <input type="text" id="calle" name="calle" required>
      </div>

      <h2>Detalles de Pago</h2>
      <div class="form-group">
        <label for="titular">Titular de la Tarjeta:</label>
        <input type="text" id="titular" name="titular" required>
      </div>
      <div class="form-group">
        <label for="cvv">CVV:</label>
        <input type="password" id="cvv" name="cvv" maxlength="3" required>
      </div>
      <div class="form-group">
        <label for="monto">Monto Total:</label>
        <input type="text" id="monto" name="monto" readonly>
      </div>

      <input type="hidden" id="orderDetails" name="orderDetails">

    </form>
  </div>

  <script>
    // Recupera los detalles de la orden desde localStorage
    const orderDetails = JSON.parse(localStorage.getItem('orderDetails'));

    if (!orderDetails) {
      alert('No hay detalles de la compra. Regresa al carrito.');
      window.location.href = 'menu.html'; // Redirigir al carrito si no hay detalles
    } else {
      // Mostrar el monto total y detalles de la orden
      document.getElementById('monto').value = `$${orderDetails.total.toFixed(2)}`;
      document.getElementById('orderDetails').value = JSON.stringify(orderDetails);
    }

    // Validación adicional opcional antes de enviar el formulario
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
      const nombre = document.getElementById('nombre').value.trim();
      const apellido = document.getElementById('apellido').value.trim();

      if (!nombre || !apellido) {
        event.preventDefault();
        alert('Por favor, completa todos los campos requeridos.');
      }
    });
  </script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Programar Entrega</title>
  <link rel="stylesheet" href="estyle.css">
</head>
<body>
  <h1>Panadería Marcianas - Entrega</h1>
  <div class="container">
    <div id="orderSummary" class="summary"></div>
    <form id="deliveryForm" action="confirmacionn.html" method="POST">
      <div class="form-group">
        <label for="fecha">Fecha de Entrega:</label>
        <input type="date" id="fecha" name="fecha" required>
      </div>
      <div class="form-group">
        <label for="hora">Hora de Entrega:</label>
        <select id="hora" name="hora" required>
          <option value="1:00pm">1:00pm</option>
          <option value="2:00pm">2:00pm</option>
          <option value="3:00pm">3:00pm</option>
          <option value="4:00pm">4:00pm</option>
          <option value="5:00pm">5:00pm</option>
          <option value="6:00pm">6:00pm</option>
          <option value="7:00pm">7:00pm</option>
        </select>
      </div>
      <input type="hidden" id="orderDetails" name="orderDetails">
      <button type="submit" class="purchase-button">Confirmar Entrega</button>
    </form>
  </div>

  <script>
  document.getElementById("deliveryForm").addEventListener("submit", (e) => {
  e.preventDefault(); // Prevenir el envío inmediato del formulario

  // Obtener valores de fecha y hora
  const fechaEntrega = document.getElementById("fecha").value;
  const horaEntrega = document.getElementById("hora").value;

  // Validar que se hayan seleccionado
  if (!fechaEntrega || !horaEntrega) {
    alert("Por favor selecciona una fecha y hora de entrega.");
    return;
  }

  // Guardar fecha y hora en localStorage
  localStorage.setItem("deliveryDate", fechaEntrega);
  localStorage.setItem("deliveryTime", horaEntrega);

  // Redirigir a la página de confirmación
  window.location.href = "confirmacionn.html";
});
</script>

</body>
</html>
<?php
if (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $domicilio = $_POST['domicilio'];
    $correo = $_POST['correo'];
    $codigopostal = $_POST['codigopostal'];
    $colonia = $_POST['colonia'];
    $calle = $_POST['calle'];
    $titular = $_POST['titular'];
    $monto = $_POST['monto'];

    $insertar = "INSERT INTO venta VALUES('','$nombre', '$apellido', '$telefono', '$domicilio', '$correo', '$codigopostal', '$colonia', '$calle', '$titular', '$monto')";

    $ejecutar = mysqli_query($enlace, $insertar);

  
}
?>
  