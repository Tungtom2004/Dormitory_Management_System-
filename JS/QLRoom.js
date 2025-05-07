document.addEventListener("DOMContentLoaded", () => {
    fetchRooms();
  });
  
function fetchRooms() {
    fetch("../BE/search_room.php")
      .then(res => res.json())
      .then(data => {
        const tbody = document.getElementById("roomTableBody");
        tbody.innerHTML = "";
        data.forEach((room, index) => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td class="px-6 py-4">${index + 1}</td>
            <td class="px-6 py-4" data-id="${room.Room_ID}">${room.Room_ID}</td>
            <td class="px-6 py-4">${room.Size_of_room}</td>
            <td class="px-6 py-4">${room.Dormitory_ID}</td>
            <td class="px-6 py-4">${room.Capacity}</td>
            <td class="px-6 py-4">${room.number_of_Students}</td>
            <td class="px-6 py-4">${room.Gender}</td>
            <td class="px-6 py-4 space-x-2">
              <button onclick="editRoom('${room.Room_ID}', this)" class="text-blue-600 hover:text-blue-800 font-medium">Sửa</button>
              <button onclick="deleteRoom('${room.Room_ID}')" class="text-red-600 hover:text-red-800 font-medium">Xóa</button>
            </td>
          `;
          tbody.appendChild(row);
        });
      });
}
  
function toggleRoomForm() {
    const form = document.getElementById("roomForm");
    form.classList.toggle("hidden");
  }
  
  function addRoom() {
    const data = {
      Room_ID: document.getElementById("Room_ID").value,
      number_of_Students: document.getElementById("number_of_Students").value,
      Size_of_room: document.getElementById("Size_of_room").value,
      Capacity: document.getElementById("Capacity").value,
      Gender: document.getElementById("Gender").value,
      Dormitory_ID: document.getElementById("Dormitory_ID").value
    };
    
    const numberofStudents = parseInt(data.number_of_Students, 10);
    const capacity = parseInt(data.Capacity, 10);
    if (numberofStudents > capacity) {
      alert("Số lượng sinh viên vượt quá số lượng cho phép!");
      return;
    }

    fetch("../BE/add_room.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    })
      .then(res => res.json())
      .then(res => {
        alert(res.message);
        fetchRooms();
        clearRoomForm();
      })
      .catch(err => {
        alert("Lỗi khi thêm phòng");
        console.error(err);
      });
}
  
function deleteRoom(roomID) {
    if (confirm("Bạn có chắc chắn muốn xóa phòng này?")) {
      fetch("../BE/delete_room.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ Room_ID: roomID })
      })
        .then(res => res.json())
        .then(res => {
          alert(res.message);
          fetchRooms();
        });
    }
}
  
function editRoom(roomID, btn) {
    const row = btn.closest("tr");
    const cells = row.querySelectorAll("td");
  
    const currentData = {
      Size_of_room: cells[2].innerText,
      Dormitory_ID: cells[3].innerText,
      Capacity: cells[4].innerText,
      number_of_Students: cells[5].innerText,
      Gender: cells[6].innerText
    };
  
    cells[2].innerHTML = `<input value="${currentData.Size_of_room}" class="w-full border rounded px-1">`;
    cells[3].innerHTML = `<input value="${currentData.Dormitory_ID}" class="w-full border rounded px-1">`;
    cells[4].innerHTML = `<input value="${currentData.Capacity}" class="w-full border rounded px-1">`;
    cells[5].innerHTML = `<input value="${currentData.number_of_Students}" class="w-full border rounded px-1">`;
    cells[6].innerHTML = `<input value="${currentData.Gender}" class="w-full border rounded px-1">`;
  
    cells[7].innerHTML = `
      <button onclick="saveRoom('${roomID}', this)" class="text-green-600 hover:text-green-800 font-medium">Lưu</button>
      <button onclick="fetchRooms()" class="text-gray-600 hover:text-gray-800 font-medium">Hủy</button>
    `;
}
  
function saveRoom(roomID, btn) {
    const row = btn.closest("tr");
    const inputs = row.querySelectorAll("input");
  
    const data = {
      Room_ID: roomID,
      Size_of_room: inputs[0].value,
      Dormitory_ID: inputs[1].value,
      Capacity: inputs[2].value,
      number_of_Students: inputs[3].value,
      Gender: inputs[4].value
    };
    
    const number = parseInt(data.number_of_Students, 10);
    const max = parseInt(data.Capacity, 10);
    if(number > max){
        alert("Số lượng sinh viên vượt quá số lượng cho phép!");
        return; 
    }

    fetch("../BE/update_room.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    })
      .then(res => res.json())
      .then(res => {
        alert(res.message);
        fetchRooms();
      });
}
  
function clearRoomForm() {
    ["Room_ID", "number_of_Students", "Size_of_room", "Capacity", "Gender", "Dormitory_ID"].forEach(id => {
      document.getElementById(id).value = "";
    });
}

function searchRoom() {
    const id = document.getElementById("searchRoomID").value.trim().toUpperCase();
  
    fetch("../BE/search_room.php?q=" + encodeURIComponent(id))
      .then(res => res.json())
      .then(data => {
        const tbody = document.getElementById("roomTableBody");
        tbody.innerHTML = "";
  
        data.forEach((room, index) => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td class="px-6 py-4">${index + 1}</td>
            <td class="px-6 py-4" data-id="${room.Room_ID}">${room.Room_ID}</td>
            <td class="px-6 py-4">${room.Size_of_room}</td>
            <td class="px-6 py-4">${room.Dormitory_ID}</td>
            <td class="px-6 py-4">${room.Capacity}</td>
            <td class="px-6 py-4">${room.number_of_Students}</td>
            <td class="px-6 py-4">${room.Gender}</td>
            <td class="px-6 py-4 space-x-2">
              <button onclick="editRoom('${room.Room_ID}', this)" class="text-blue-600 hover:text-blue-800 font-medium">Sửa</button>
              <button onclick="deleteRoom('${room.Room_ID}')" class="text-red-600 hover:text-red-800 font-medium">Xóa</button>
            </td>
          `;
          tbody.appendChild(row);
        });
      });
}
  