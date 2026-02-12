const taskInput = document.getElementById('task-input');
const addButton = document.getElementById('btn-add');
const taskList = document.getElementById('task-list');
const autoButton = document.getElementById('btn-auto');
const sortButton = document.getElementById('btn-sort');
const themeButton = document.getElementById('btn-theme');

let tasks = [];
let darkMode = false;

const suggestions = [
  'Répondre aux emails',
  'Planifier la semaine',
  'Préparer le portfolio',
  'Faire une pause café',
  'Relire le code',
  'Envoyer un message client',
];

function renderTasks() {
  taskList.innerHTML = '';
  tasks.forEach((task, index) => {
    const li = document.createElement('li');
    li.className = 'flex items-center justify-between rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm';

    const left = document.createElement('div');
    left.className = 'flex items-center gap-3';

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.className = 'h-4 w-4 accent-blue-600';
    checkbox.checked = task.done;

    const text = document.createElement('span');
    text.textContent = task.label;
    if (task.done) {
      text.className = 'line-through text-slate-400';
    }

    checkbox.addEventListener('change', () => {
      tasks[index].done = checkbox.checked;
      renderTasks();
    });

    left.appendChild(checkbox);
    left.appendChild(text);

    const removeBtn = document.createElement('button');
    removeBtn.textContent = 'Supprimer';
    removeBtn.className = 'text-xs font-semibold text-red-500 hover:text-red-600';
    removeBtn.addEventListener('click', () => {
      tasks.splice(index, 1);
      renderTasks();
    });

    li.appendChild(left);
    li.appendChild(removeBtn);
    taskList.appendChild(li);
  });
}

function addTask() {
  const value = taskInput.value.trim();
  if (!value || value.length < 3) {
    alert('Ajoute une tâche plus précise.');
    return;
  }
  tasks.push({ label: value, done: false });
  taskInput.value = '';
  renderTasks();
}

addButton.addEventListener('click', addTask);

if (taskInput) {
  taskInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
      addTask();
    }
  });
}

autoButton.addEventListener('click', () => {
  taskInput.value = suggestions[Math.floor(Math.random() * suggestions.length)];
  taskInput.focus();
});

sortButton.addEventListener('click', () => {
  tasks.sort((a, b) => a.label.localeCompare(b.label));
  renderTasks();
});

themeButton.addEventListener('click', () => {
  darkMode = !darkMode;
  document.body.style.background = darkMode
    ? '#0f172a'
    : 'radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.15), transparent 40%), radial-gradient(circle at 80% 0%, rgba(14, 165, 233, 0.2), transparent 45%), #f8fafc';
  document.body.style.color = darkMode ? '#e2e8f0' : '#0f172a';
  themeButton.textContent = darkMode ? 'Mode Jour' : 'Mode Nuit';
});

renderTasks();
