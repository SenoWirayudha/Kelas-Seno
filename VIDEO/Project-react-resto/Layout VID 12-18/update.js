import { link } from './link.js';

function showUpdateForm() {
    const id = document.getElementById('idInput').value;
    const endpoint = document.getElementById('endpointSelect').value;
    
    if (!endpoint) {
        showError('Silakan pilih jenis data terlebih dahulu');
        return;
    }
    
    if (!id) {
        showError('Silakan masukkan ID yang akan diupdate');
        return;
    }

    // Fetch current data
    axios({
        method: 'get',
        url: `${link.baseUrl}/${endpoint}/${id}`,
        headers: {
            'api_token': link.token
        }
    }).then(response => {
        const data = response.data;
        document.getElementById('updateId').value = id;
        document.getElementById('updatePelanggan').value = data.pelanggan;
        document.getElementById('updateAlamat').value = data.alamat;
        document.getElementById('updateTelp').value = data.telp;
        document.getElementById('updateForm').style.display = 'block';
    }).catch(error => {
        console.error('Error:', error);
        showError('Error fetching data: ' + (error.response?.data?.message || error.message));
    });
}

function hideUpdateForm() {
    document.getElementById('updateForm').style.display = 'none';
}

function submitUpdatePelanggan(event) {
    event.preventDefault();
    
    const id = document.getElementById('updateId').value;
    const pelanggan = document.getElementById('updatePelanggan').value;
    const alamat = document.getElementById('updateAlamat').value;
    const telp = document.getElementById('updateTelp').value;

    axios({
        method: 'put',
        url: `${link.baseUrl}/pelanggan/${id}`,
        headers: {
            'api_token': link.token,
            'Content-Type': 'application/json'
        },
        data: {
            pelanggan: pelanggan,
            alamat: alamat,
            telp: telp
        }
    }).then(response => {
        console.log('Update Response:', response);
        hideUpdateForm();
        showSuccess('Data pelanggan berhasil diupdate');
        getData('pelanggan'); // Refresh the customer data
    }).catch(error => {
        console.error('Error:', error);
        showError('Error updating customer: ' + (error.response?.data?.message || error.message));
    });
}

function showError(message) {
    const errorDiv = document.getElementById('errorMessage');
    if (errorDiv) {
        errorDiv.textContent = message;
        errorDiv.classList.remove('d-none');
        document.getElementById('dataTable').style.display = 'none';
    }
}

function showSuccess(message) {
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = `
        <div class="alert alert-success">${message}</div>
        ${resultDiv.innerHTML}
    `;
}

export { showUpdateForm, hideUpdateForm, submitUpdatePelanggan };