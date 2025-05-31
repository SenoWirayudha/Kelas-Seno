import React, { useEffect, useState } from 'react';
import axios from '../axios/link';
import 'bootstrap/dist/css/bootstrap.min.css'; // Pastikan Bootstrap CSS diimpor
import { Card, Button, Form, Col, Row, Spinner } from 'react-bootstrap'; // Impor komponen Bootstrap
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faShoppingCart } from '@fortawesome/free-solid-svg-icons'; // Ikon keranjang belanja

const Menu = () => {
  const [menus, setMenus] = useState([]);
  const [filterKategori, setFilterKategori] = useState('Semua');
  const [kategoriOptions, setKategoriOptions] = useState([]);
  const [loading, setLoading] = useState(true); // State untuk loading
  const [error, setError] = useState(null); // State untuk error fetching

  useEffect(() => {
    const fetchMenus = async () => {
      setLoading(true); // Set loading true saat memulai fetch
      setError(null);   // Reset error state
      try {
        const res = await axios.get('/menu');
        setMenus(res.data);
        const kategoriSet = new Set(res.data.map(m => m.kategori || 'Lainnya')); // Ubah "Tidak tersedia" menjadi "Lainnya"
        setKategoriOptions(['Semua', ...Array.from(kategoriSet)]);
      } catch (err) {
        console.error('Error fetching menu:', err);
        setError('Gagal memuat menu. Silakan coba lagi nanti.'); // Set pesan error
      } finally {
        setLoading(false); // Set loading false setelah fetch selesai (berhasil/gagal)
      }
    };

    fetchMenus();
  }, []);

  const handleBuy = (menu) => {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const existingItem = cart.find(item => item.idmenu === menu.idmenu);
    if (existingItem) {
      cart = cart.map(item =>
        item.idmenu === menu.idmenu ? { ...item, qty: item.qty + 1 } : item
      );
    } else {
      cart.push({ ...menu, qty: 1 });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    alert(`✅ ${menu.menu} berhasil ditambahkan ke keranjang.`);
    // Trigger storage event for other components like Side.js
    window.dispatchEvent(new Event('storage'));
  };

  const filteredMenus = filterKategori === 'Semua'
    ? menus
    : menus.filter(menu => (menu.kategori || 'Lainnya') === filterKategori);

  return (
    <div className="container my-5"> {/* Padding vertikal lebih besar */}
      <h2 className="text-center mb-4 display-5 fw-bold text-success"> {/* Judul lebih besar dan berwarna */}
        Explore Our Delicious Menu
      </h2>

      {/* Filter Kategori */}
      <div className="mb-5 d-flex justify-content-center"> {/* Margin bawah lebih besar */}
        <Form.Select
          className="shadow-sm border-success text-success fw-bold" // Gaya seleksi lebih menarik
          style={{ width: '200px' }} // Lebar yang tetap
          value={filterKategori}
          onChange={e => setFilterKategori(e.target.value)}
        >
          {kategoriOptions.map((kat) => (
            <option key={kat} value={kat}>{kat}</option>
          ))}
        </Form.Select>
      </div>

      {loading ? (
        <div className="d-flex justify-content-center align-items-center" style={{ minHeight: '300px' }}>
          <Spinner animation="border" variant="success" role="status">
            <span className="visually-hidden">Loading Menu...</span>
          </Spinner>
        </div>
      ) : error ? (
        <div className="alert alert-danger text-center" role="alert">
          {error}
        </div>
      ) : (
        <Row xs={1} md={2} lg={3} className="g-4"> {/* Menggunakan Row dan Col dari react-bootstrap, g-4 untuk gap */}
          {filteredMenus.map((menu) => (
            <Col key={menu.idmenu}>
              <Card className="h-100 shadow-lg border-0 rounded-4 overflow-hidden menu-card"> {/* Gaya kartu lebih menonjol */}
                {/* Gambar */}
                <Card.Img
                  variant="top"
                  src={menu.gambar || 'https://via.placeholder.com/400x200?text=No+Image'} // Fallback gambar
                  alt={menu.menu}
                  style={{ objectFit: 'cover', height: '220px', transition: 'transform 0.3s ease-in-out' }}
                  onError={(e) => { e.target.onerror = null; e.target.src="https://via.placeholder.com/400x200?text=No+Image" }} // Fallback on error
                />
                <Card.Body className="d-flex flex-column p-4"> {/* Padding lebih besar */}
                  <Card.Title className="mb-2 fw-bold text-dark fs-5">{menu.menu}</Card.Title> {/* Judul menu lebih menonjol */}
                  <Card.Text className="text-muted mb-3">
                    <small className="badge bg-secondary text-white">{menu.kategori || 'Lainnya'}</small> {/* Kategori sebagai badge */}
                  </Card.Text>
                  <Card.Text className="fw-bolder fs-4 text-primary mt-auto"> {/* Harga lebih besar dan tebal */}
                    Rp {menu.harga ? menu.harga.toLocaleString() : 'N/A'}
                  </Card.Text>
                  <div className="mt-3"> {/* Margin atas tombol */}
                    <Button
                      variant="success"
                      className="w-100 rounded-pill py-2 d-flex align-items-center justify-content-center fw-bold buy-button" // Tombol Beli lebih modern
                      onClick={() => handleBuy(menu)}
                    >
                      <FontAwesomeIcon icon={faShoppingCart} className="me-2" /> Beli
                    </Button>
                  </div>
                </Card.Body>
              </Card>
            </Col>
          ))}

          {/* Pesan Menu Kosong */}
          {filteredMenus.length === 0 && !loading && !error && (
            <Col xs={12} className="text-center mt-5">
              <h3 className="text-muted">Tidak ada menu ditemukan untuk kategori "{filterKategori}".</h3>
              <p className="text-muted">Coba pilih kategori lain atau periksa kembali.</p>
            </Col>
          )}
        </Row>
      )}
    </div>
  );
};

export default Menu;