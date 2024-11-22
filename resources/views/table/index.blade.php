<x-app-layout>
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">

  <div class="layout">
    <div class="sidebar">
      <a href="#" class="title">Espacios</a>
      <hr>
      <a href="#" class="space-name">Space name</a>
      <a href="#" class="create-space">+ Crear espacio</a>
      <br>
      <hr>
      <a href="#" class="projects">Proyectos</a>
      <hr>
      <a href="#" class="project-name">Project name</a>
      <a href="#" class="create-project">+ Crear proyecto</a>
      <a href="#" class="configuration">Configuración</a>
      <a href="#" class="profile" style="display: inline-flex; align-items: center; text-decoration: none; color: white;">
        <img src="images/user.png" alt="profile" style="width: 20px; height: 20px; margin-right: 8px;">
        Dante
      </a>
    </div>

    <div class="main-content">
      <div class="container">
        <div class="table-wrap">
          <table class="table" id="dynamicTable">
            <thead>
              <tr>
                <th>Issues Found</th>
                <th>Assignee</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Stage</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Update contractor agreement</td>
                <td><img src="https://via.placeholder.com/30" alt="assignee"></td>
                <td><span class="far fa-calendar-alt text-muted">21 Nov</span></td>
                <td><span class="btn btn-low" onclick="changePriority(this)">Low</span></td>
                <td><span class="btn btn-low" onclick="changeStage(this)">Not Started</span></td>
              </tr>
            </tbody>
          </table>
          <button class="btn btn-primary" onclick="addRow()">Agregar Fila</button>
          <button class="btn btn-primary" onclick="addColumn()">Agregar Columna</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function addRow() {
      const table = document.getElementById('dynamicTable');
      const newRow = table.insertRow(-1);
      const columns = table.rows[0].cells.length;

      for (let i = 0; i < columns; i++) {
        const newCell = newRow.insertCell(i);
        newCell.textContent = `Col ${i + 1}`;
      }
    }

    function addColumn() {
      const table = document.getElementById('dynamicTable');
      for (let i = 0; i < table.rows.length; i++) {
      const newCell = table.rows[i].insertCell(-1);
      if (i === 0) {
        newCell.textContent = 'New Col';
        newCell.className = 'table-header'; 
        newCell.style.backgroundColor = '#3498db'; 
        newCell.style.color = 'white';
      } else {
      newCell.textContent = `Data ${i}`;
    }
  }
}
    function changePriority(button) {
      const priorities = [
        { class: 'btn-low', text: 'Low' },
        { class: 'btn-medium', text: 'Medium' },
        { class: 'btn-high', text: 'High' },
        { class: 'btn-very-high', text: 'Very High' }
      ];

      const currentClass = button.classList.contains('btn-medium') ? 'btn-medium'
                        : button.classList.contains('btn-high') ? 'btn-high'
                        : button.classList.contains('btn-very-high') ? 'btn-very-high'
                        : 'btn-low';

      const currentIndex = priorities.findIndex(priority => priority.class === currentClass);
      const nextIndex = (currentIndex + 1) % priorities.length;
      const nextPriority = priorities[nextIndex];

      button.className = `btn btn-stage2 ${nextPriority.class}`;
      button.textContent = nextPriority.text;
    }

    function changeStage(button) {
      const stages = [
        { class: 'btn-low2', text: 'Not Started' },
        { class: 'btn-medium2', text: 'In Progress' },
        { class: 'btn-high2', text: 'Completed' },
        { class: 'btn-very-high2', text: 'Stuck' }
      ];

      const currentClass = button.classList.contains('btn-medium2') ? 'btn-medium2'
                        : button.classList.contains('btn-high2') ? 'btn-high2'
                        : button.classList.contains('btn-very-high2') ? 'btn-very-high2'
                        : 'btn-low2';

      const currentIndex = stages.findIndex(stage => stage.class === currentClass);
      const nextIndex = (currentIndex + 1) % stages.length;
      const nextStage = stages[nextIndex];

      button.className = `btn btn-stage2 ${nextStage.class}`;
      button.textContent = nextStage.text;
    }
  </script>
</x-app-layout>
