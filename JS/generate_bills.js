function addRow() {
  const table = document.getElementById("tableBody");

  const row = document.createElement("tr");
  row.innerHTML = `
    <td class="border text-center text-gray-400 italic">Tự sinh</td>
    <td class="border"><input name="Bill_Type[]" class="w-full px-2 py-1 border" required></td>
    <td class="border"><input type="number" name="Amount_Due[]" class="w-full px-2 py-1 border" required></td>
    <td class="border"><input type="date" name="Due_Date[]" class="w-full px-2 py-1 border" required></td>
    <td class="border">
      <select name="Payment_Status[]" class="w-full px-2 py-1 border">
        <option value="Chua thanh toan">Chưa thanh toán</option>
        <option value="Da thanh toan">Đã thanh toán</option>
      </select>
    </td>
    <td class="border"><input name="StudentID[]" class="w-full px-2 py-1 border" required></td>
    <td class="border"><input name="PersonalID_O[]" class="w-full px-2 py-1 border" required></td>
    <td class="border text-center">
      <button type="button" onclick="this.closest('tr').remove()" class="text-red-500">❌</button>
    </td>
  `;
  table.appendChild(row);
}
