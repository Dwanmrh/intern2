<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
  function uploadData() {
    const fileInput = document.getElementById("uploadExcel");
    const file = fileInput.files[0];

    if (!file) {
      alert("Harap pilih file terlebih dahulu.");
      return;
    }

    if (!file.name.endsWith(".xlsx") && !file.name.endsWith(".xls")) {
      alert("Format file tidak valid. Harap unggah file Excel (.xlsx atau .xls).");
      return;
    }

    const reader = new FileReader();
    reader.readAsBinaryString(file);

    reader.onload = function (e) {
      const data = e.target.result;
      const workbook = XLSX.read(data, { type: "binary" });
      const sheet = workbook.Sheets[workbook.SheetNames[0]];
      const jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

      updateTable(jsonData);
    };

    reader.onerror = function (err) {
      alert("Gagal membaca file.");
      console.error(err);
    };
  }

  function updateTable(data) {
    const tbody = document.getElementById("nilaiBody");
    tbody.innerHTML = "";

    data.slice(1).forEach((row) => {
      if (row.length >= 7) {
        const tr = document.createElement("tr");
        row.slice(0, 7).forEach((cell) => {
          const td = document.createElement("td");
          td.textContent = cell || "-";
          tr.appendChild(td);
        });
        tbody.appendChild(tr);
      }
    });
    alert("Data berhasil diunggah.");
  }
</script>
