
let editingStudentID = null;

function addStudent(){
  const data = {
    StudentID: document.getElementById("StudentID").value,
    firstName: document.getElementById("firstName").value,
    middleName: document.getElementById("middleName").value,
    lastName: document.getElementById("lastName").value,
    Date_of_Birth: document.getElementById('Date_of_Birth').value,
    Address: document.getElementById("Address").value,
    Gender: document.getElementById("Gender").value,
    phoneNumber: document.getElementById("phoneNumber").value,
    EmailAddress: document.getElementById("EmailAddress").value,
  };

  fetch("../BE/add_student.php", {
    method: 'POST',
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(res => {
    alert(res.message);
    searchStudent();
    clearForm(); // Clear the form after adding a student
  })
  .catch(err => alert('Lỗi khi thêm sinh viên'));
}

function searchStudent(){
  const keyword = document.getElementById("searchInput").value;
  fetch(`../BE/search_student.php?q=${encodeURIComponent(keyword)}`)
    .then(res => res.json())
    .then(data => {
      const tbody = document.querySelector("#studentTable tbody");
      tbody.innerHTML = "";

      data.forEach(student => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${student.StudentID}</td>
          <td>${student.firstName}</td>
          <td>${student.middleName}</td>
          <td>${student.lastName}</td>
          <td>${student.Date_of_Birth || ""}</td>
          <td>${student.Address}</td>
          <td>${student.Gender}</td>
          <td>${student.phoneNumber}</td>
          <td>${student.EmailAddress}</td>
          <td>
            <button onclick="editStudent('${student.StudentID}')">Sửa</button>
            <button onclick="deleteStudent('${student.StudentID}')">Xóa</button>
          </td>
        `;
        tbody.appendChild(row);
      });
    })
    .catch(error => {
      alert("Không thể tìm sinh viên!");
      console.error(error);
    });
}

function deleteStudent(StudentID){
  if (confirm("Bạn có chắc chắn muốn xóa sinh viên này?")) {
    fetch("../BE/delete_student.php", {
      method: 'POST',
      headers: {"Content-Type": "application/json"},
      body: JSON.stringify({ StudentID: StudentID })
    })
    .then(res => res.json())
    .then(res => {
      alert(res.message);
      searchStudent();
      clearForm();
    })
    .catch(err => {
      alert("Lỗi khi xóa sinh viên");
      console.error(err);
    });
  }
}

function editStudent(StudentID) {
  const row = [...document.querySelectorAll("#studentTable tbody tr")]
    .find(r => r.firstElementChild.textContent === studentID);

  if (!row) return;

  const cells = row.querySelectorAll("td");

  for (let i = 1; i <= 8; i++) {
    const value = cells[i].innerText;
    const input = document.createElement("input");
    input.value = value;
    input.style.width = "100%";
    cells[i].innerHTML = "";
    cells[i].appendChild(input);
  }

  const actionCell = cells[9];
  actionCell.innerHTML = `
    <button onclick="saveInlineStudent('${StudentID}', this)">Lưu</button>
    <button onclick="cancelInlineEdit()">Hủy</button>
  `;
}

function saveInlineStudent(StudentID, btn) {
  const row = btn.closest("tr");
  const cells = row.querySelectorAll("td");

  const data = {
    StudentID: StudentID,
    firstName: cells[1].querySelector("input").value,
    middleName: cells[2].querySelector("input").value,
    lastName: cells[3].querySelector("input").value,
    Date_of_Birth: cells[4].querySelector("input").value,
    Address: cells[5].querySelector("input").value,
    Gender: cells[6].querySelector("input").value,
    phoneNumber: cells[7].querySelector("input").value,
    EmailAddress: cells[8].querySelector("input").value,
  };

  fetch("../BE/update_student.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(res => {
    alert(res.message);
    searchStudent();
    clearForm(); // Clear the form after updating a student
  })
  .catch(err => {
    alert("Lỗi khi cập nhật");
    console.error(err);
  });
}

function cancelInlineEdit() {
  searchStudent(); // reload lại bảng
}

function clearForm() {
  document.getElementById("StudentID").value = "";
  document.getElementById("firstName").value = "";
  document.getElementById("middleName").value = "";
  document.getElementById("lastName").value = "";
  document.getElementById("Date_of_Birth").value = "";
  document.getElementById("Address").value = "";
  document.getElementById("Gender").value = "Nam";
  document.getElementById("phoneNumber").value = "";
  document.getElementById("EmailAddress").value = "";
}
