let tasks = JSON.parse(localStorage.getItem("tasks")) || [];

function saveTasks() {
    localStorage.setItem("tasks", JSON.stringify(tasks));
}

function renderTasks() {
    const list = document.getElementById("taskList");
    list.innerHTML = "";

    tasks.forEach((task, index) => {
        list.innerHTML += `
            <li>
                ${task}
                <div class="actions">
                    <button onclick="editTask(${index})">Edit</button>
                    <button onclick="deleteTask(${index})">Hapus</button>
                </div>
            </li>
        `;
    });
}

function addTask() {
    const input = document.getElementById("taskInput");
    if (input.value === "") return alert("Tugas tidak boleh kosong");

    tasks.push(input.value);
    input.value = "";
    saveTasks();
    renderTasks();
}

function editTask(index) {
    const newTask = prompt("Edit tugas:", tasks[index]);
    if (newTask !== null && newTask !== "") {
        tasks[index] = newTask;
        saveTasks();
        renderTasks();
    }
}

function deleteTask(index) {
    if (confirm("Hapus tugas ini?")) {
        tasks.splice(index, 1);
        saveTasks();
        renderTasks();
    }
}

renderTasks();
