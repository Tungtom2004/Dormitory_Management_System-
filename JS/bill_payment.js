// Hàm gọi API lấy hóa đơn sinh viên
function fetchBills() {
  const StudentID = document.getElementById("StudentID").value.trim();
  if (!StudentID) {
    alert("Vui lòng nhập mã sinh viên.");
    return;
  }

  fetch(`../BE/fetch_bills.php?StudentID=${encodeURIComponent(StudentID)}`)
    .then(res => res.json())
    .then(data => {
      const tbody = document.getElementById("billTableBody");
      tbody.innerHTML = "";
      if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="px-4 py-4 text-center text-gray-500">Không có hóa đơn cần thanh toán.</td></tr>`;
        return;
      }

      data.forEach(bill => {
        const row = `
          <tr class="hover:bg-gray-100">
            <td class="px-4 py-2"><input type="checkbox" name="bills[]" value="${bill.Bill_ID}" /></td>
            <td class="px-4 py-2">${bill.Bill_ID}</td>
            <td class="px-4 py-2">${bill.Bill_Type}</td>
            <td class="px-4 py-2">${Number(bill.Amount_Due).toLocaleString()} VND</td>
            <td class="px-4 py-2">${bill.Due_Date}</td>
            <td class="px-4 py-2">${bill.Payment_Status}</td>
          </tr>
        `;
        tbody.innerHTML += row;
      });
    })
    .catch(error => {
      console.error("Lỗi khi tải hóa đơn:", error);
      alert("Không thể tải danh sách hóa đơn.");
    });
}

// Kiểm tra trước khi gửi form
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  form.addEventListener("submit", function (e) {
    const checked = document.querySelectorAll('input[name="bills[]"]:checked');
    if (checked.length === 0) {
      e.preventDefault();
      alert("Vui lòng chọn ít nhất một hóa đơn để thanh toán!");
    }
  });
});
