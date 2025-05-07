document.addEventListener("DOMContentLoaded", () => {
  fetchDormitories();
});

function fetchDormitories() {
  fetch("../BE/search_dormitory.php")
    .then(res => res.json())
    .then(data => {
      const tbody = document.querySelector("tbody");
      tbody.innerHTML = "";
      data.forEach((dorm, index) => {
        const row = document.createElement("tr");
        row.className = "hover:bg-blue-50 transition duration-200";
        row.setAttribute("data-personalidg", dorm.PersonalID_G);
        row.innerHTML = `
          <td class="px-6 py-4">${index + 1}</td>
          <td class="px-6 py-4" data-id="${dorm.Dormitory_ID}">Tòa ${dorm.Dormitory_ID}</td>
          <td class="px-6 py-4">${dorm.Number_of_Floors}</td>
          <td class="px-6 py-4">${dorm.Number_of_Rooms}</td>
          <td class="px-6 py-4">${dorm.Overall_Condition}</td>
          <td class="px-6 py-4 space-x-2">
            <button onclick="editDormitory('${dorm.Dormitory_ID}', this)" class="text-blue-600 hover:text-blue-800 font-medium">Sửa</button>
            <button onclick="deleteDormitory('${dorm.Dormitory_ID}')" class="text-red-600 hover:text-red-800 font-medium">Xóa</button>
          </td>
        `;
        tbody.appendChild(row);
      });
    });
}

function deleteDormitory(id) {
  if (confirm("Bạn có chắc chắn muốn xóa tòa nhà này?")) {
    fetch("../BE/delete_dormitory.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ Dormitory_ID: id })
    })
      .then(res => res.json())
      .then(res => {
        alert(res.message);
        fetchDormitories();
        clearForm();
      });
  }
}

function editDormitory(id, btn) {
  const row = btn.closest("tr");
  const cells = row.querySelectorAll("td");

  const currentData = {
    Dormitory_ID: cells[1].getAttribute("data-id"),
    Number_of_Floors: cells[2].innerText,
    Number_of_Rooms: cells[3].innerText,
    Overall_Condition: cells[4].innerText,
  };

  cells[1].innerHTML = `<input value="${currentData.Dormitory_ID}" disabled class="w-full border rounded px-1">`;
  cells[2].innerHTML = `<input value="${currentData.Number_of_Floors}" class="w-full border rounded px-1">`;
  cells[3].innerHTML = `<input value="${currentData.Number_of_Rooms}" class="w-full border rounded px-1">`;
  cells[4].innerHTML = `<input value="${currentData.Overall_Condition}" class="w-full border rounded px-1">`;

  cells[5].innerHTML = `
    <button onclick="saveDormitory('${id}', this)" class="text-green-600 hover:text-green-800 font-medium">Lưu</button>
    <button onclick="fetchDormitories()" class="text-gray-600 hover:text-gray-800 font-medium">Hủy</button>
  `;
}

function saveDormitory(id, btn) {
  const row = btn.closest("tr");
  const inputs = row.querySelectorAll("input");
  const personalID = row.getAttribute("data-personalidg") || "000001";

  const data = {
    Dormitory_ID: id,
    Number_of_Floors: inputs[1].value,
    Number_of_Rooms: inputs[2].value,
    Overall_Condition: inputs[3].value,
    Location: "",
    PersonalID_G: personalID
  };

  fetch("../BE/update_dormitory.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  })
    .then(res => res.json())
    .then(res => {
      alert(res.message);
      fetchDormitories();
      clearForm();
    });
}

function toggleForm() {
  const form = document.getElementById("addForm");
  form.classList.toggle("hidden");
}

function addDormitory() {
  const data = {
    Dormitory_ID: document.getElementById("Dormitory_ID").value,
    Number_of_Floors: document.getElementById("Number_of_Floors").value,
    Number_of_Rooms: document.getElementById("Number_of_Rooms").value,
    Overall_Condition: document.getElementById("Overall_Condition").value,
    Location: document.getElementById("Location").value,
    PersonalID_G: document.getElementById("PersonalID_G").value
  };

  fetch("../BE/add_dormitory.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  })
    .then(res => res.json())
    .then(res => {
      alert(res.message);
      fetchDormitories();
      clearForm();
    })
    .catch(err => {
      alert("Lỗi khi thêm tòa nhà");
      console.error(err);
    });
}

function searchDormitory() {
  const id = document.getElementById("searchDormID").value.trim().toUpperCase();

  fetch("../BE/search_dormitory.php?q=" + encodeURIComponent(id))
    .then(res => res.json())
    .then(data => {
      const tbody = document.querySelector("tbody");
      tbody.innerHTML = "";

      data.forEach((dorm, index) => {
        const row = document.createElement("tr");
        row.className = "hover:bg-blue-50 transition duration-200";
        row.setAttribute("data-personalidg", dorm.PersonalID_G);

        row.innerHTML = `
          <td class="px-6 py-4">${index + 1}</td>
          <td class="px-6 py-4" data-id="${dorm.Dormitory_ID}">Tòa ${dorm.Dormitory_ID}</td>
          <td class="px-6 py-4">${dorm.Number_of_Floors}</td>
          <td class="px-6 py-4">${dorm.Number_of_Rooms}</td>
          <td class="px-6 py-4">${dorm.Overall_Condition}</td>
          <td class="px-6 py-4 space-x-2">
            <button onclick="editDormitory('${dorm.Dormitory_ID}', this)" class="text-blue-600 hover:text-blue-800 font-medium">Sửa</button>
            <button onclick="deleteDormitory('${dorm.Dormitory_ID}')" class="text-red-600 hover:text-red-800 font-medium">Xóa</button>
          </td>
        `;
        tbody.appendChild(row);
      });
    });
}

function clearForm() {
  document.getElementById("Dormitory_ID").value = "";
  document.getElementById("Number_of_Floors").value = "";
  document.getElementById("Number_of_Rooms").value = "";
  document.getElementById("Overall_Condition").value = "";
  document.getElementById("Location").value = "";
  document.getElementById("PersonalID_G").value = "";
}
