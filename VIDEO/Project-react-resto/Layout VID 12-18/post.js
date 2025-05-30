import { link } from './link.js';

function showPostForm() {
    document.getElementById('postForm').style.display = 'block';
}

function hidePostForm() {
    document.getElementById('postForm').style.display = 'none';
}

function submitPelanggan(event) {
    event.preventDefault();
    
    const pelanggan = document.getElementById('pelanggan').value;
    const alamat = document.getElementById('alamat').value;
    const telp = document.getElementById('telp').value;

    axios({
        method: 'post',
        url: `${link.url}/pelanggan`,
        headers: {
            ...link.headers,
            'Content-Type': 'application/json'
        },
        data: {
            pelanggan: pelanggan,
            alamat: alamat,
            telp: telp
        }
    }).then(response => {
        console.log('Post Response:', response);
        hidePostForm();
        showSuccess('Data pelanggan berhasil ditambahkan');
        getData('pelanggan'); // Refresh the customer data
    }).catch(error => {
        console.error('Error:', error);
        showError('Error adding customer: ' + (error.response?.data?.message || error.message));
    });
}

function showSuccess(message) {
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = `
        <div class="alert alert-success">${message}</div>
        ${resultDiv.innerHTML}
    `;
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

export { showPostForm, hidePostForm, submitPelanggan };