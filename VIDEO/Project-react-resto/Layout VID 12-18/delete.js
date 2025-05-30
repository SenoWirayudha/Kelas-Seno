import { link } from './link.js';

function showDeleteForm() {
    const id = document.getElementById('idInput').value;
    const endpoint = document.getElementById('endpointSelect').value;
    
    if (!endpoint) {
        showError('Silakan pilih jenis data terlebih dahulu');
        return;
    }
    
    if (!id) {
        showError('Silakan masukkan ID yang akan dihapus');
        return;
    }
    
    if (confirm(`Apakah Anda yakin ingin menghapus ${endpoint} dengan ID ${id}?`)) {
        deletePelanggan(endpoint, id);
    }
}

function deletePelanggan(endpoint, id) {
    axios({
        method: 'delete',
        url: `${link.url}/${endpoint}/${id}`,
        headers: {
            ...link.headers
        }
    }).then(response => {
        console.log('Delete Response:', response);
        showSuccess(`Data ${endpoint} berhasil dihapus`);
        getData(endpoint); // Refresh the data table
    }).catch(error => {
        console.error('Error:', error);
        showError('Error deleting data: ' + (error.response?.data?.message || error.message));
    });
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

function showSuccess(message) {
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = `
        <div class="alert alert-success">${message}</div>
        ${resultDiv.innerHTML}
    `;
}

export { showDeleteForm, deletePelanggan };