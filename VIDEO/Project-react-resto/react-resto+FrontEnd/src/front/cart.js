import React, { useEffect, useState } from 'react';
import axios from '../axios/link';
import { Modal, Button, Form, Table, InputGroup, FormControl, Alert, Spinner } from 'react-bootstrap'; // Impor komponen Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'; // Pastikan Bootstrap CSS diimpor

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
  faShoppingCart,
  faTrashAlt,
  faDollarSign,
  faMoneyBillWave,
  faCheckCircle,
  faTimesCircle,
  faWallet
} from '@fortawesome/free-solid-svg-icons'; // Ikon-ikon yang dibutuhkan

const Cart = () => {
  const [cart, setCart] = useState([]);
  const [showModal, setShowModal] = useState(false);
  const [bayar, setBayar] = useState(0);
  const [kembali, setKembali] = useState(0);
  const [total, setTotal] = useState(0);
  const [isSubmittingOrder, setIsSubmittingOrder] = useState(false); // State untuk loading saat submit order

  useEffect(() => {
    const loadCart = () => {
      const savedCart = JSON.parse(localStorage.getItem('cart')) || [];
      setCart(savedCart);
      const hitungTotal = savedCart.reduce((sum, item) => sum + item.harga * item.qty, 0);
      setTotal(hitungTotal);
      // Reset bayar dan kembali saat keranjang berubah
      setBayar(0);
      setKembali(0);
    };

    loadCart();

    // Listen for storage changes from other tabs/windows
    window.addEventListener('storage', loadCart);

    return () => {
      window.removeEventListener('storage', loadCart);
    };
  }, []); // [] agar useEffect hanya berjalan sekali saat mount dan cleanup saat unmount

  // Effect untuk menghitung kembali saat total atau bayar berubah
  useEffect(() => {
    setKembali(bayar - total);
  }, [bayar, total]);


  const handleRemove = (idmenu) => {
    const updatedCart = cart.filter(item => item.idmenu !== idmenu);
    localStorage.setItem('cart', JSON.stringify(updatedCart));
    setCart(updatedCart);
    // Pemicu event storage secara manual untuk komponen lain seperti Side.js
    window.dispatchEvent(new Event('storage'));
    alert('Item berhasil dihapus dari keranjang.'); // Notifikasi
  };

  const handleClear = () => {
    if (window.confirm('Apakah Anda yakin ingin menghapus semua item dari keranjang?')) {
      localStorage.removeItem('cart');
      setCart([]);
      setTotal(0); // Reset total
      setBayar(0); // Reset bayar
      setKembali(0); // Reset kembali
      // Pemicu event storage secara manual untuk komponen lain seperti Side.js
      window.dispatchEvent(new Event('storage'));
      alert('Keranjang berhasil dikosongkan.'); // Notifikasi
    }
  };

  const handleBayarChange = (e) => {
    const value = Number(e.target.value);
    setBayar(value);
    // Kembali dihitung di useEffect
  };

  const handleSubmitOrder = async () => {
    setIsSubmittingOrder(true); // Set loading state
    try {
      const pelangganData = localStorage.getItem('pelanggan');

      if (!pelangganData) {
        alert('❌ Silakan login terlebih dahulu');
        setIsSubmittingOrder(false); // Reset loading state
        return;
      }

      const pelanggan = JSON.parse(pelangganData);
      const userId = parseInt(pelanggan.id || pelanggan.idpelanggan || pelanggan.user_id, 10);

      if (isNaN(userId)) {
        console.error('User ID tidak ditemukan atau tidak valid (bukan angka) dalam data pelanggan');
        alert('❌ Data user tidak valid, silakan login ulang');
        setIsSubmittingOrder(false); // Reset loading state
        return;
      }

      if (typeof total !== 'number' || isNaN(total) ||
          typeof bayar !== 'number' || isNaN(bayar) ||
          typeof kembali !== 'number' || isNaN(kembali)) {
          alert('❌ Jumlah total, bayar, atau kembalian tidak valid.');
          setIsSubmittingOrder(false); // Reset loading state
          return;
      }

      if (!cart || cart.length === 0) {
          alert('Keranjang belanja kosong. Silakan tambahkan item.');
          setIsSubmittingOrder(false); // Reset loading state
          return;
      }

      // Validasi pembayaran harus lebih besar atau sama dengan total
      if (bayar < total) {
          alert('Jumlah bayar tidak mencukupi!');
          setIsSubmittingOrder(false); // Reset loading state
          return;
      }

      const details = cart.map(item => {
          if (!item.idmenu || !item.qty || !item.harga) {
              console.error('Item di keranjang tidak valid:', item);
              throw new Error('Data item di keranjang tidak lengkap.');
          }
          return {
              idmenu: item.idmenu,
              jumlah: item.qty,
              hargajual: item.harga
          };
      });

      // Modifikasi payload agar sesuai dengan backend (membungkus dalam 'order')
      const payload = {
        order: { // <-- Perubahan di sini
          idpelanggan: userId,
          tglorder: new Date().toISOString().slice(0, 10),
          total: total,
          bayar: bayar,
          kembali: kembali,
          status: bayar >= total ? 1 : 0,
        },
        details: details
      };

      console.log('Payload yang dikirim:', payload);

      const res = await axios.post('/order', payload);

      if (res.data.success) {
        alert('✅ Order berhasil disimpan!');
        localStorage.removeItem('cart');
        setCart([]);
        setTotal(0);
        setBayar(0);
        setKembali(0);
        setShowModal(false);
        // Pemicu event storage secara manual untuk komponen lain seperti Side.js
        window.dispatchEvent(new Event('storage'));
      } else {
        alert('❌ Gagal menyimpan order.');
      }
    } catch (error) {
      console.error('Error saat kirim order:', error);
      if (error.response) {
        const errorMessage = error.response.data?.message ||
                             error.response.data?.error ||
                             error.response.data?.pesan ||
                             `Server error (${error.response.status})`;
        alert(`❌ Error: ${errorMessage}`);
      } else if (error.request) {
        alert('❌ Tidak dapat terhubung ke server');
      } else {
        alert('❌ Terjadi error saat memproses order');
      }
    } finally {
      setIsSubmittingOrder(false); // Reset loading state di akhir
    }
  };

  return (
    <div className="container my-5">
      <h2 className="text-center mb-4 display-5 fw-bold text-success"> {/* Judul lebih menonjol */}
        <FontAwesomeIcon icon={faShoppingCart} className="me-3" />Your Shopping Cart
      </h2>

      {cart.length === 0 ? (
        <Alert variant="info" className="text-center shadow-sm p-4 rounded-3"> {/* Pesan keranjang kosong lebih menarik */}
          <FontAwesomeIcon icon={faShoppingCart} size="3x" className="mb-3 text-muted" />
          <h3>Keranjang Anda Kosong!</h3>
          <p className="lead">Mulai jelajahi menu kami dan tambahkan item favorit Anda.</p>
          <Button variant="primary" href="/menu" className="rounded-pill px-4 py-2">
            Lihat Menu
          </Button>
        </Alert>
      ) : (
        <div className="card shadow-lg border-0 rounded-4 p-4"> {/* Pembungkus keranjang */}
          <Table responsive hover className="mb-4"> {/* Tabel untuk item keranjang */}
            <thead className="table-light">
              <tr>
                <th>#</th>
                <th>Menu</th>
                <th className="text-center">Harga</th>
                <th className="text-center">Jumlah</th>
                <th className="text-end">Subtotal</th>
                <th className="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              {cart.map((item, index) => (
                <tr key={item.idmenu}>
                  <td>{index + 1}</td>
                  <td>
                    <h6 className="mb-0 fw-bold">{item.menu}</h6>
                    <small className="text-muted">{item.kategori}</small>
                  </td>
                  <td className="text-center">Rp {item.harga.toLocaleString()}</td>
                  <td className="text-center">{item.qty}</td>
                  <td className="text-end fw-bold">Rp {(item.harga * item.qty).toLocaleString()}</td>
                  <td className="text-center">
                    <Button
                      variant="outline-danger"
                      size="sm"
                      onClick={() => handleRemove(item.idmenu)}
                      className="rounded-pill px-3"
                      title="Hapus item"
                    >
                      <FontAwesomeIcon icon={faTrashAlt} />
                    </Button>
                  </td>
                </tr>
              ))}
            </tbody>
          </Table>

          <div className="d-flex justify-content-end align-items-center mb-4">
            <h4 className="me-3 mb-0 text-primary fw-bold">Total:</h4>
            <h4 className="mb-0 text-success display-6 fw-bold">Rp {total.toLocaleString()}</h4> {/* Total lebih besar */}
          </div>

          <div className="d-flex justify-content-end mt-4"> {/* Tombol aksi */}
            <Button
              variant="outline-warning"
              className="me-3 rounded-pill px-4 py-2 fw-bold"
              onClick={handleClear}
            >
              <FontAwesomeIcon icon={faTrashAlt} className="me-2" /> Hapus Semua
            </Button>
            <Button
              variant="success"
              className="rounded-pill px-5 py-2 fw-bold"
              onClick={() => setShowModal(true)}
            >
              <FontAwesomeIcon icon={faMoneyBillWave} className="me-2" /> Bayar
            </Button>
          </div>
        </div>
      )}

      {/* Modal Pembayaran */}
      <Modal show={showModal} onHide={() => setShowModal(false)} centered>
        <Modal.Header closeButton className="bg-primary text-white"> {/* Header modal berwarna */}
          <Modal.Title className="d-flex align-items-center">
            <FontAwesomeIcon icon={faWallet} className="me-2" /> Konfirmasi Pembayaran
          </Modal.Title>
        </Modal.Header>
        <Modal.Body className="p-4">
          <h5 className="mb-3">Total Belanja: <strong className="text-success">Rp {total.toLocaleString()}</strong></h5>

          <Form.Group className="mb-3">
            <Form.Label className="fw-bold">Jumlah Bayar:</Form.Label>
            <InputGroup>
              <InputGroup.Text>Rp</InputGroup.Text>
              <FormControl
                type="number"
                placeholder="Masukkan jumlah pembayaran"
                value={bayar === 0 ? '' : bayar} // Kosongkan jika 0 untuk UX
                onChange={handleBayarChange}
                min={total > 0 ? total : 0} // Minimum pembayaran adalah total
                className="rounded-end"
              />
            </InputGroup>
            {bayar < total && bayar !== 0 && ( // Pesan peringatan jika kurang
              <Form.Text className="text-danger">
                Jumlah bayar kurang Rp {(total - bayar).toLocaleString()}
              </Form.Text>
            )}
          </Form.Group>

          <Form.Group className="mb-3">
            <Form.Label className="fw-bold">Kembali:</Form.Label>
            <InputGroup>
              <InputGroup.Text>Rp</InputGroup.Text>
              <FormControl
                type="text"
                value={kembali.toLocaleString()}
                readOnly
                className={`fw-bold ${kembali >= 0 ? 'text-success' : 'text-danger'}`} // Warna teks sesuai kembali
              />
            </InputGroup>
          </Form.Group>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setShowModal(false)} className="rounded-pill px-3">
            Batal
          </Button>
          <Button
            variant={bayar >= total ? "primary" : "secondary"} // Warna tombol sesuai kondisi
            onClick={handleSubmitOrder}
            disabled={bayar < total || isSubmittingOrder} // Disable jika bayar kurang atau sedang submit
            className="rounded-pill px-4"
          >
            {isSubmittingOrder ? (
              <>
                <Spinner animation="border" size="sm" className="me-2" /> Proses...
              </>
            ) : (
              <>
                <FontAwesomeIcon icon={faCheckCircle} className="me-2" /> Konfirmasi Pembayaran
              </>
            )}
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default Cart;