import { link } from './link.js';

function getDataById(endpoint, id) {
    if (!endpoint || !id) return;
    
    // Show loading state
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;
    
    axios({
        method: 'get',
        url: `${link.url}/${endpoint}/${id}`,
        headers: link.headers
    }).then(response => {
        console.log('API Response by ID:', response);
        
        // Reset result area
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = `
            <div id="errorMessage" class="alert alert-danger d-none"></div>
            <table class="table table-striped" id="dataTable" style="display: none;">
                <thead>
                    <tr id="tableHeaders"></tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        `;
        
        document.getElementById('errorMessage').classList.add('d-none');
        
        // Check if data exists in the response
        let data;
        if (response.data && response.data.data) {
            data = response.data.data;
        } else {
            data = response.data;
        }
        
        if (data && typeof data === 'object') {
            displayDataInTable(data);
        } else {
            showError('Data tidak ditemukan');
        }
    }).catch(error => {
        console.error('Error:', error);
        showError('Error mengambil data: ' + (error.response?.data?.message || error.message));
    });
}

function show() {
    const endpoint = document.getElementById('endpointSelect').value;
    if (!endpoint) {
        alert('Silakan pilih jenis data terlebih dahulu');
        return;
    }

    const id = document.getElementById('idInput').value;
    if (!id) {
        alert('Silakan masukkan ID terlebih dahulu');
        return;
    }

    getDataById(endpoint, id);
}

function displayDataInTable(data) {
    if (!data || (Array.isArray(data) && data.length === 0)) {
        showError('Tidak ada data yang ditemukan');
        return;
    }
    
    const table = document.getElementById('dataTable');
    const headers = document.getElementById('tableHeaders');
    const body = document.getElementById('tableBody');
    const errorElement = document.getElementById('errorMessage');
    
    if (!table || !headers || !body) {
        console.error('Elemen tabel tidak ditemukan');
        return;
    }
    
    // Hide error message if exists
    if (errorElement) {
        errorElement.classList.add('d-none');
    }
    
    // Clear previous content
    headers.innerHTML = '';
    body.innerHTML = '';
    
    // Handle both array and object data
    const dataArray = Array.isArray(data) ? data : [data];
    
    if (dataArray.length === 0) {
        showError('Tidak ada data yang ditemukan');
        return;
    }
    
    // Create headers
    const columns = Object.keys(dataArray[0]);
    columns.forEach(column => {
        const th = document.createElement('th');
        th.textContent = column;
        headers.appendChild(th);
    });
    
    // Create rows
    dataArray.forEach(item => {
        const tr = document.createElement('tr');
        columns.forEach(column => {
            const td = document.createElement('td');
            td.textContent = item[column] !== null && item[column] !== undefined ? item[column] : '';
            tr.appendChild(td);
        });
        body.appendChild(tr);
    });
    
    // Show table and ensure it's visible
    table.style.display = 'table';
    table.style.visibility = 'visible';
    table.classList.remove('d-none');
}

function showError(message) {
    const errorElement = document.getElementById('errorMessage');
    const dataTable = document.getElementById('dataTable');
    
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.classList.remove('d-none');
    }
    
    if (dataTable) {
        dataTable.style.display = 'none';
    }
}

export { show, getDataById };