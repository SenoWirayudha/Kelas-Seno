import { useState } from 'react';
import Tabel from '../components/Tabel';

function Menu() {
  const [menuItems, setMenuItems] = useState([
    {
      id: 1,
      nama: 'Nasi Goreng',
      harga: 15000,
      deskripsi: 'Nasi goreng spesial dengan telur, ayam, dan sayuran',
      kategori: 'Makanan Utama'
    },
    {
      id: 2,
      nama: 'Mie Goreng',
      harga: 12000,
      deskripsi: 'Mie goreng dengan bumbu special dan sayuran segar',
      kategori: 'Makanan Utama'
    },
    {
      id: 3,
      nama: 'Sate Ayam',
      harga: 20000,
      deskripsi: 'Sate ayam dengan bumbu kacang dan lontong',
      kategori: 'Makanan Utama'
    },
    {
      id: 4,
      nama: 'Es Teh Manis',
      harga: 5000,
      deskripsi: 'Teh manis dingin yang menyegarkan',
      kategori: 'Minuman'
    },
    {
      id: 5,
      nama: 'Es Jeruk',
      harga: 6000,
      deskripsi: 'Jeruk segar dengan es batu',
      kategori: 'Minuman'
    }
  ]);

  const [viewType, setViewType] = useState('card'); // 'card' atau 'table'

  return (
    <div className="menu container py-4">
      <div className="d-flex justify-content-between align-items-center mb-4">
        <h1>Menu Kami</h1>
        <div className="btn-group">
          <button
            className={`btn ${viewType === 'card' ? 'btn-primary' : 'btn-outline-primary'}`}
            onClick={() => setViewType('card')}
          >
            Card View
          </button>
          <button
            className={`btn ${viewType === 'table' ? 'btn-primary' : 'btn-outline-primary'}`}
            onClick={() => setViewType('table')}
          >
            Table View
          </button>
        </div>
      </div>

      {viewType === 'table' ? (
        <Tabel menuItems={menuItems} />
      ) : (
        <div className="row g-4">
          {menuItems.map((item) => (
            <div key={item.id} className="col-md-4">
              <div className="card h-100">
                <div className="card-body">
                  <h5 className="card-title">{item.nama}</h5>
                  <h6 className="card-subtitle mb-2 text-muted">Rp {item.harga.toLocaleString()}</h6>
                  <p className="card-text">{item.deskripsi}</p>
                  <span className="badge bg-primary">{item.kategori}</span>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}

export default Menu;