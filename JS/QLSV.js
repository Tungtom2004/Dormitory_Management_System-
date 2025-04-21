let students = [];

function loadStudents() {
  // Chỉ để demo, bạn cần lấy dữ liệu từ server hoặc backend thực tế
  students = [
    { StudentID: "SV001", FirstName: "Nguyen", MiddleName: "Thi", LastName: "Lan", Date_of_birth: "2002-03-10", Address: "Hanoi", Gender: "Nữ", PhoneNumber: "0987654321", EmailAddress: "LanNT@stu.ptit.edu.vn" },
    { StudentID: "SV002", FirstName: "Tran", MiddleName: "Thi", LastName: "Mai", Date_of_birth: "2001-07-21", Address: "Quangninh", Gender: "Nữ", PhoneNumber: "0987654322", EmailAddress: "MaiTT@stu.ptit.edu.vn" },
    { StudentID: "SV003", FirstName: "Le", MiddleName: "Thi", LastName: "Thanh", Date_of_birth: "2000-10-11", Address: "Hungyen", Gender: "Nữ", PhoneNumber: "0987654323", EmailAddress: "ThanhLT@stu.ptit.edu.vn" },
    { StudentID: "SV004", FirstName: "Phan", MiddleName: "Thi", LastName: "Anh", Date_of_birth: "2002-05-15", Address: "Danang", Gender: "Nữ", PhoneNumber: "0987654324", EmailAddress: "AnhPT@stu.ptit.edu.vn" },
    { StudentID: "SV005", FirstName: "Hoang", MiddleName: "Thi", LastName: "Linh", Date_of_birth: "2001-12-01", Address: "TPHCM", Gender: "Nữ", PhoneNumber: "0987654325", EmailAddress: "LinhHT@stu.ptit.edu.vn" },
    { StudentID: "SV006", FirstName: "Vu", MiddleName: "Thi", LastName: "Mai", Date_of_birth: "2002-01-05", Address: "Hue", Gender: "Nữ", PhoneNumber: "0987654326", EmailAddress: "MaiVT@stu.ptit.edu.vn" },
    { StudentID: "SV007", FirstName: "Do", MiddleName: "Thi", LastName: "Nhung", Date_of_birth: "2000-04-14", Address: "Hanoi", Gender: "Nữ", PhoneNumber: "0987654327", EmailAddress: "NhungDT@stu.ptit.edu.vn" },
    { StudentID: "SV008", FirstName: "Bui", MiddleName: "Thi", LastName: "Thanh", Date_of_birth: "2001-08-22", Address: "Danang", Gender: "Nữ", PhoneNumber: "0987654328", EmailAddress: "ThanhBT@stu.ptit.edu.vn" },
    { StudentID: "SV009", FirstName: "Nguyen", MiddleName: "Thi", LastName: "My", Date_of_birth: "2002-02-18", Address: "Hanoi", Gender: "Nữ", PhoneNumber: "0987654329", EmailAddress: "MyNT@stu.ptit.edu.vn" },
    { StudentID: "SV010", FirstName: "Pham", MiddleName: "Thi", LastName: "Bao", Date_of_birth: "2000-11-29", Address: "Hanoi", Gender: "Nữ", PhoneNumber: "0987654330", EmailAddress: "BaoPT@stu.ptit.edu.vn" },
    { StudentID: "SV011", FirstName: "Trinh", MiddleName: "Thi", LastName: "Kim", Date_of_birth: "2002-06-05", Address: "Hungyen", Gender: "Nữ", PhoneNumber: "0987654331", EmailAddress: "KimTT@stu.ptit.edu.vn" },
    { StudentID: "SV012", FirstName: "Nguyen", MiddleName: "Thi", LastName: "Thao", Date_of_birth: "2001-03-10", Address: "Hanoi", Gender: "Nữ", PhoneNumber: "0987654332", EmailAddress: "ThaoNT@stu.ptit.edu.vn" },
    { StudentID: "SV013", FirstName: "Phan", MiddleName: "Thi", LastName: "Huyen", Date_of_birth: "2001-12-01", Address: "Hanoi", Gender: "Nữ", PhoneNumber: "0987654333", EmailAddress: "HuyenPT@stu.ptit.edu.vn" },
    { StudentID: "SV014", FirstName: "Do", MiddleName: "Thi", LastName: "Quyen", Date_of_birth: "2000-09-25", Address: "Danang", Gender: "Nữ", PhoneNumber: "0987654334", EmailAddress: "QuyenDT@stu.ptit.edu.vn" },
    { StudentID: "SV015", FirstName: "Le", MiddleName: "Thi", LastName: "Thu", Date_of_birth: "2002-07-05", Address: "Hungyen", Gender: "Nữ", PhoneNumber: "0987654335", EmailAddress: "ThuLT@stu.ptit.edu.vn" },
    { StudentID: "SV016", FirstName: "Pham", MiddleName: "Thi", LastName: "Thanh", Date_of_birth: "2001-04-22", Address: "Hue", Gender: "Nữ", PhoneNumber: "0987654336", EmailAddress: "ThanhPT@stu.ptit.edu.vn" },
    { StudentID: "SV017", FirstName: "Bui", MiddleName: "Thi", LastName: "Linh", Date_of_birth: "2002-03-01", Address: "Hanoi", Gender: "Nữ", PhoneNumber: "0987654337", EmailAddress: "LinhBT@stu.ptit.edu.vn" },
    { StudentID: "SV018", FirstName: "Nguyen", MiddleName: "Thi", LastName: "Chi", Date_of_birth: "2001-10-12", Address: "Hungyen", Gender: "Nữ", PhoneNumber: "0987654338", EmailAddress: "ChiNT@stu.ptit.edu.vn" },
    { StudentID: "SV019", FirstName: "Hoang", MiddleName: "Thi", LastName: "Hoa", Date_of_birth: "2000-11-01", Address: "Hanoi", Gender: "Nữ", PhoneNumber: "0987654339", EmailAddress: "HoaHT@stu.ptit.edu.vn" },
    { StudentID: "SV020", FirstName: "Tran", MiddleName: "Thi", LastName: "Kim", Date_of_birth: "2002-04-10", Address: "Hanoi", Gender: "Nữ", PhoneNumber: "0987654340", EmailAddress: "KimTT@stu.ptit.edu.vn" },
    { StudentID: "SV021", FirstName: "Le", MiddleName: "Thi", LastName: "Thao", Date_of_birth: "2001-06-22", Address: "Danang", Gender: "Nữ", PhoneNumber: "0987654341", EmailAddress: "ThaoLT@stu.ptit.edu.vn" },
    { StudentID: "SV022", FirstName: "Nguyen", MiddleName: "Minh", LastName: "Hoang", Date_of_birth: "2000-09-30", Address: "TPHCM", Gender: "Nam", PhoneNumber: "0987654326", EmailAddress: "HoangNM@stu.ptit.edu.vn" },
    { StudentID: "SV023", FirstName: "Pham", MiddleName: "Quang", LastName: "Duy", Date_of_birth: "2002-03-25", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654327", EmailAddress: "DuyPQ@stu.ptit.edu.vn" },
    { StudentID: "SV024", FirstName: "Tran", MiddleName: "Thanh", LastName: "Son", Date_of_birth: "2001-06-10", Address: "TPHCM", Gender: "Nam", PhoneNumber: "0987654328", EmailAddress: "SonTT@stu.ptit.edu.vn" },
    { StudentID: "SV025", FirstName: "Nguyen", MiddleName: "Quang", LastName: "Khai", DDate_of_birth: "2002-05-11", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654329", EmailAddress: "KhaiNQ@stu.ptit.edu.vn" },
    { StudentID: "SV026", FirstName: "Le", MiddleName: "Van", LastName: "Duy", Date_of_birth: "2000-07-21", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654330", EmailAddress: "DuyLV@stu.ptit.edu.vn" },
    { StudentID: "SV027", FirstName: "Pham", MiddleName: "Trung", LastName: "Duong", Date_of_birth: "2002-08-14", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654331", EmailAddress: "DuongPT@stu.ptit.edu.vn" },
    { StudentID: "SV028", FirstName: "Hoang", MiddleName: "Viet", LastName: "Tuan", Date_of_birth: "2001-05-30", Address: "Hungyen", Gender: "Nam", PhoneNumber: "0987654332", EmailAddress: "TuanHV@stu.ptit.edu.vn" },
    { StudentID: "SV029", FirstName: "Trinh", MiddleName: "Hieu", LastName: "Kien", DDate_of_birth: "2000-12-17", Address: "Hue", Gender: "Nam", PhoneNumber: "0987654333", EmailAddress: "KienTH@stu.ptit.edu.vn" },
    { StudentID: "SV030", FirstName: "Nguyen", MiddleName: "Hoang", LastName: "An", Date_of_birth: "2001-09-15", Address: "Quangninh", Gender: "Nam", PhoneNumber: "0987654334", EmailAddress: "AnNH@stu.ptit.edu.vn" },
    { StudentID: "SV031", FirstName: "Pham", MiddleName: "Duc", LastName: "Hoang", Date_of_birth: "2002-02-01", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654335", EmailAddress: "HoangPD@stu.ptit.edu.vn" },
    { StudentID: "SV032", FirstName: "Bui", MiddleName: "Van", LastName: "Cuong", Date_of_birth: "2000-05-05", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654336", EmailAddress: "CuongBV@stu.ptit.edu.vn" },
    { StudentID: "SV033", FirstName: "Nguyen", MiddleName: "Huu", LastName: "Hieu", Date_of_birth: "2001-08-14", Address: "TPHCM", Gender: "Nam", PhoneNumber: "0987654337", EmailAddress: "HieuNH@stu.ptit.edu.vn" },
    { StudentID: "SV034", FirstName: "Tran", MiddleName: "Thanh", LastName: "Nam", Date_of_birth: "2000-06-09", Address: "Danang", Gender: "Nam", PhoneNumber: "0987654338", EmailAddress: "NamTT@stu.ptit.edu.vn" },
    { StudentID: "SV035", FirstName: "Le", MiddleName: "Thanh", LastName: "Duy", Date_of_birth: "2002-10-22", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654339", EmailAddress: "DuyLT@stu.ptit.edu.vn" },
    { StudentID: "SV036", FirstName: "Pham", MiddleName: "Hieu", LastName: "An", Date_of_birth: "2001-01-12", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654340", EmailAddress: "AnPH@stu.ptit.edu.vn" },
    { StudentID: "SV037", FirstName: "Bui", MiddleName: "Nam", LastName: "Hieu", Date_of_birth: "2000-02-15", Address: "Quangninh", Gender: "Nam", PhoneNumber: "0987654341", EmailAddress: "HieuBN@stu.ptit.edu.vn" },
    { StudentID: "SV038", FirstName: "Nguyen", MiddleName: "Truong", LastName: "Anh", Date_of_birth: "2002-11-10", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654342", EmailAddress: "AnhNT@stu.ptit.edu.vn" },
    { StudentID: "SV039", FirstName: "Tran", MiddleName: "Tuan", LastName: "Kien", Date_of_birth: "2001-10-05", Address: "Hue", Gender: "Nam", PhoneNumber: "0987654343", EmailAddress: "KienTT@stu.ptit.edu.vn" },
    { StudentID: "SV040", FirstName: "Le", MiddleName: "Duc", LastName: "Kien", Date_of_birth: "2000-08-15", Address: "Hungyen", Gender: "Nam", PhoneNumber: "0987654344", EmailAddress: "KienLD@stu.ptit.edu.vn" },
    { StudentID: "SV041", FirstName: "Pham", MiddleName: "Long", LastName: "Khai", Date_of_birth: "2002-04-28", Address: "Danang", Gender: "Nam", PhoneNumber: "0987654345", EmailAddress: "KhaiPL@stu.ptit.edu.vn" },
    { StudentID: "SV042", FirstName: "Bui", MiddleName: "Lai", LastName: "Tuan", Date_of_birth: "2001-05-01", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654346", EmailAddress: "TuanBL@stu.ptit.edu.vn" },
    { StudentID: "SV043", FirstName: "Nguyen", MiddleName: "Duong", LastName: "Tuan", Date_of_birth: "2000-12-10", Address: "Quangninh", Gender: "Nam", PhoneNumber: "0987654347", EmailAddress: "TuanND@stu.ptit.edu.vn" },
    { StudentID: "SV044", FirstName: "Hoang", MiddleName: "Kien", LastName: "Cao", Date_of_birth: "2001-08-23", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654348", EmailAddress: "CaoHK@stu.ptit.edu.vn" },
    { StudentID: "SV045", FirstName: "Tran", MiddleName: "Thi", LastName: "Tuan", Date_of_birth: "2002-06-05", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654349", EmailAddress: "TuanTT@stu.ptit.edu.vn" },
    { StudentID: "SV046", FirstName: "Nguyen", MiddleName: "Tuan", LastName: "Hoang", Date_of_birth: "2001-03-17", Address: "Hue", Gender: "Nam", PhoneNumber: "0987654350", EmailAddress: "HoangNT@stu.ptit.edu.vn" },
    { StudentID: "SV047", FirstName: "Bui", MiddleName: "Phong", LastName: "Hieu", Date_of_birth: "2000-06-14", Address: "Quangninh", Gender: "Nam", PhoneNumber: "0987654351", EmailAddress: "HieuBP@stu.ptit.edu.vn" },
    { StudentID: "SV048", FirstName: "Nguyen", MiddleName: "Hoang", LastName: "Khai",Date_of_birth: "2002-09-29", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654352", EmailAddress: "KhaiNH@stu.ptit.edu.vn" },
    { StudentID: "SV049", FirstName: "Tran", MiddleName: "Viet", LastName: "Kien",Date_of_birth: "2001-11-16", Address: "Hanoi", Gender: "Nam", PhoneNumber: "0987654353", EmailAddress: "KienTV@stu.ptit.edu.vn" },
    { StudentID: "SV050", FirstName: "Le", MiddleName: "Minh", LastName: "Thang", Date_of_birth: "2000-02-28", Address: "TPHCM", Gender: "Nam", PhoneNumber: "0987654354", EmailAddress: "ThangLM@stu.ptit.edu.vn" }
  ];
  renderTable();
}

function renderTable(filter = '') {
  const tbody = document.querySelector("#studentTable tbody");
  tbody.innerHTML = '';
  students.filter(s =>
    s.StudentID.includes(filter) ||
    s.FirstName.toLowerCase().includes(filter.toLowerCase()) ||
    s.LastName.toLowerCase().includes(filter.toLowerCase())
  ).forEach(s => {
    const row = `
      <tr>
        <td>${s.StudentID}</td>
        <td>${s.FirstName}</td>
        <td>${s.MiddleName}</td>
        <td>${s.LastName}</td>
        <td>${s.Date_of_birth}</td>
        <td>${s.Address}</td>
        <td>${s.Gender}</td>
        <td>${s.PhoneNumber}</td>
        <td>${s.EmailAddress}</td>
        <td><button onclick="deleteStudent('${s.StudentID}')">Xóa</button></td>
      </tr>
    `;
    tbody.innerHTML += row;
  });
}

function searchStudent() {
  const keyword = document.getElementById("searchInput").value;
  renderTable(keyword);
}

function addOrEditStudent() {
  const student = {
    StudentID: document.getElementById("StudentID").value,
    FirstName: document.getElementById("FirstName").value,
    MiddleName: document.getElementById("MiddleName").value,
    LastName: document.getElementById("LastName").value,
    Date_of_birth: document.getElementById("Date_of_birth").value,
    Address: document.getElementById("Address").value,
    Gender: document.getElementById("Gender").value,
    PhoneNumber: document.getElementById("PhoneNumber").value,
    EmailAddress: document.getElementById("EmailAddress").value,
  };

  const index = students.findIndex(s => s.StudentID === student.StudentID);
  if (index >= 0) {
    students[index] = student;
  } else {
    students.push(student);
  }
  renderTable();
}

function deleteStudent(id) {
  students = students.filter(s => s.StudentID !== id);
  renderTable();
}

loadStudents();