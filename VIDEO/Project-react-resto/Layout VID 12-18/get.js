import { link } from './link.js';

function showError(message) {
    const errorDiv = document.getElementById('errorMessage');
    if (errorDiv) {
        errorDiv.textContent = message;
        errorDiv.classList.remove('d-none');
    }
    const table = document.getElementById('dataTable');
    if (table) {
        table.style.display = 'none';
    }
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
            td.textContent = item[column];
            tr.appendChild(td);
        });
        body.appendChild(tr);
    });
    
    // Show the table
    table.style.display = 'table';
}

export function getData(endpoint) {
    if (!endpoint) return;
    
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
        url: `${link.url}/${endpoint}`,
        headers: link.headers
    }).then(response => {
        console.log('API Response:', response);
        
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
        } else if (Array.isArray(response.data)) {
            data = response.data;
        }
        
        if (data && (Array.isArray(data) && data.length > 0)) {
            displayDataInTable(data);
            
            // Update placeholder with available IDs
            try {
                const idInput = document.getElementById('idInput');
                if (idInput && Array.isArray(data)) {
                    const ids = data.map(item => item.id).filter(id => id).join(', ');
                    idInput.placeholder = ids ? `ID tersedia: ${ids}` : 'Masukkan ID';
                }
            } catch (err) {
                console.error('Error updating placeholder:', err);
            }
        } else {
            showError('Tidak ada data yang ditemukan');
        }
    }).catch(error => {
        console.error('Error:', error);
        showError('Error fetching data: ' + (error.response?.data?.message || error.message));
    });
}