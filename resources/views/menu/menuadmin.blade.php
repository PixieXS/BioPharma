<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Farmacia BioPharma</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: #f4f7f8;
      margin: 0;
      height: 100vh;
      overflow: hidden;
    }
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 260px;
      height: 100%;
      background: linear-gradient(135deg, #283c86, #45a247);
      color: #fff;
      padding: 20px;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    .sidebar h2 {
      text-align: center;
      letter-spacing: 1px;
      margin-bottom: 30px;
      font-weight: 700;
    }
    .sidebar a {
      display: block;
      color: #e0e0e0;
      text-decoration: none;
      margin: 15px 0;
      padding: 12px 20px;
      border-radius: 4px;
      transition: background 0.3s;
    }
    .sidebar a:hover {
      background: rgba(255,255,255,0.2);
    }
    .navbar-top {
      margin-left: 260px;
      height: 60px;
      background: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
    }
    .navbar-top .user-info {
      font-size: 16px;
      color: #333;
    }
    .navbar-top .logout {
      color: #fff;
      background: #d9534f;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      text-decoration: none;
      transition: background 0.3s;
    }
    .navbar-top .logout:hover {
      background: #c9302c;
    }
    .main-content {
      margin-left: 260px;
      margin-top: 60px;
      padding: 20px;
      height: calc(100% - 60px);
      overflow-y: auto;
      background: #f4f7f8;
    }
    .main-title {
      font-size: 32px;
      text-align: center;
      margin-top: 10px;
      margin-bottom: 30px;
      color: #333;
    }
    .dashboard-cards {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 40px;
    }
    .dashboard-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 20px;
      text-align: center;
      flex: 1;
      min-width: 220px;
    }
    .dashboard-card h5 {
      margin-bottom: 10px;
      color: #666;
    }
    .dashboard-card p {
      font-size: 28px;
      font-weight: bold;
      margin: 0;
    }
    .chart-container {
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      margin-bottom: 40px;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h2>BioPharma</h2>
    <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="#"><i class="fas fa-users"></i> Usuarios</a>
    <a href="#"><i class="fas fa-pills"></i> Medicamentos</a>
    <a href="#"><i class="fas fa-arrow-circle-down"></i> Entradas</a>
    <a href="#"><i class="fas fa-arrow-circle-up"></i> Salidas</a>
    <a href="#"><i class="fas fa-shopping-cart"></i> Ventas</a>
    <a href="#"><i class="fas fa-undo"></i> Devoluciones</a>
  </div>
  
  <div class="navbar-top">
    <div class="user-info">Bienvenido, <strong>Carlos</strong> (Admin)</div>
    <div>
      <a href="#" class="logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
    </div>
  </div>
  
  <div class="main-content">
    <h1 class="main-title">Dashboard</h1>
    
    <div class="dashboard-cards">
      <div class="dashboard-card">
        <h5>Total Usuarios</h5>
        <p>12</p>
      </div>
      <div class="dashboard-card">
        <h5>Ventas del Mes</h5>
        <p>$1,350.00</p>
      </div>
      <div class="dashboard-card">
        <h5>Inventario Total</h5>
        <p>452 u</p>
      </div>
      <div class="dashboard-card">
        <h5>Entradas</h5>
        <p>87</p>
      </div>
      <div class="dashboard-card">
        <h5>Salidas</h5>
        <p>63</p>
      </div>
      <div class="dashboard-card">
        <h5>Devoluciones</h5>
        <p>14</p>
      </div>
    </div>

    <div class="chart-container mt-4">
      <canvas id="dashboardChart" height="100"></canvas>
    </div>
  </div>

  <script>
    const ventasMes = 1350;
    const entradasMes = 87;
    const salidasMes = 63;
    const devolucionesMes = 14;

    const ctx = document.getElementById('dashboardChart').getContext('2d');
    const dashboardChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Ventas', 'Entradas', 'Salidas', 'Devoluciones'],
        datasets: [{
          label: 'Indicadores del Mes',
          data: [ventasMes, entradasMes, salidasMes, devolucionesMes],
          backgroundColor: [
            'rgba(75, 192, 192, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(255, 99, 132, 0.6)'
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(255, 99, 132, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: { precision: 0 }
          }
        },
        responsive: true,
        plugins: {
          legend: { display: false }
        }
      }
    });
  </script>
</body>
</html>
