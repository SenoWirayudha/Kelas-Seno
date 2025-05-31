import React, { useState, useEffect } from 'react';
import { Navbar, Container, Button, Modal, Form, Nav } from 'react-bootstrap';
import axios from '../axios/link';
import 'bootstrap/dist/css/bootstrap.min.css';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSignInAlt, faUserPlus, faUtensils } from '@fortawesome/free-solid-svg-icons';

export default function Navigation() {
  const [showLogin, setShowLogin] = useState(false);
  const [showRegister, setShowRegister] = useState(false);
  const [form, setForm] = useState({ pelanggan: '', alamat: '', telp: '' });
  const [pelanggan, setPelanggan] = useState(null);

  useEffect(() => {
    const stored = localStorage.getItem('pelanggan');
    if (stored) {
      setPelanggan(JSON.parse(stored));
    }

    const handleStorageChange = () => {
      const updatedStored = localStorage.getItem('pelanggan');
      setPelanggan(updatedStored ? JSON.parse(updatedStored) : null);
    };
    window.addEventListener('storage', handleStorageChange);
    return () => {
      window.removeEventListener('storage', handleStorageChange);
    };
  }, []);

  const handleLogin = async () => {
    try {
      const res = await axios.post('http://localhost:8000/api/pelanggan/login', {
        telp: form.telp,
      });
      alert(res.data.pesan);
      localStorage.setItem('pelanggan', JSON.stringify(res.data.data));
      setPelanggan(res.data.data);
      setShowLogin(false);
      setForm({ pelanggan: '', alamat: '', telp: '' });
    } catch (err) {
      alert('Login gagal: ' + (err.response?.data?.pesan || err.message));
    }
  };

  const handleRegister = async () => {
    try {
      const res = await axios.post('http://localhost:8000/api/pelanggan/register', form);
      alert(res.data.pesan);
      localStorage.setItem('pelanggan', JSON.stringify(res.data.data));
      setPelanggan(res.data.data);
      setShowRegister(false);
      setForm({ pelanggan: '', alamat: '', telp: '' });
    } catch (err) {
      alert('Register gagal: ' + (err.response?.data?.pesan || err.message));
    }
  };

  const handleLogout = () => {
    localStorage.removeItem('pelanggan');
    setPelanggan(null);
  };

  const handleCloseLogin = () => {
    setShowLogin(false);
    setForm({ pelanggan: '', alamat: '', telp: '' });
  };

  const handleCloseRegister = () => {
    setShowRegister(false);
    setForm({ pelanggan: '', alamat: '', telp: '' });
  };

  return (
    <>
      <Navbar
        expand="lg"
        className="px-4 shadow-sm"
        // Mengubah gradien menjadi warna hijau yang lebih gelap dan kalem
        style={{
          background: 'linear-gradient(to right, #2E7D32, #388E3C)', // Hijau gelap
          color: 'white',
        }}
      >
        <Container fluid>
          <Navbar.Brand href="#" className="d-flex align-items-center text-white fs-4 fw-bold">
            <FontAwesomeIcon icon={faUtensils} className="me-2" />
            Restoran Lezat
          </Navbar.Brand>
          <Nav className="ms-auto align-items-center">
            {pelanggan ? (
              <>
                <span className="text-white me-3 fs-6">
                  Halo, <strong className="text-warning">{pelanggan.pelanggan}</strong>
                </span>
                <Button variant="outline-light" size="sm" onClick={handleLogout} className="rounded-pill px-3 py-1">
                  Logout
                </Button>
              </>
            ) : (
              <>
                <Button
                  variant="outline-light"
                  className="me-2 rounded-pill px-3 py-1"
                  onClick={() => setShowLogin(true)}
                >
                  Login
                </Button>
                <Button
                  variant="light"
                  className="rounded-pill px-3 py-1"
                  onClick={() => setShowRegister(true)}
                >
                  Daftar
                </Button>
              </>
            )}
          </Nav>
        </Container>
      </Navbar>

      {/* Modal Login */}
      <Modal show={showLogin} onHide={handleCloseLogin} centered>
        <Modal.Header closeButton
          // Mengubah warna header modal login menjadi biru tua yang lebih kalem
          style={{ background: '#3F51B5', color: 'white' }} // Warna biru tua
        >
          <Modal.Title className="d-flex align-items-center">
            <FontAwesomeIcon icon={faSignInAlt} className="me-2" /> Login Pelanggan
          </Modal.Title>
        </Modal.Header>
        <Modal.Body className="p-4">
          <Form.Control
            type="text"
            placeholder="No Telp"
            value={form.telp}
            onChange={(e) => setForm({ ...form, telp: e.target.value })}
            className="form-control-lg rounded-pill"
          />
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleCloseLogin} className="rounded-pill px-3">Batal</Button>
          <Button variant="primary" onClick={handleLogin} className="rounded-pill px-3">Login</Button>
        </Modal.Footer>
      </Modal>

      {/* Modal Register */}
      <Modal show={showRegister} onHide={handleCloseRegister} centered>
        <Modal.Header closeButton
          // Mengubah warna header modal register menjadi hijau tua yang lebih kalem
          style={{ background: '#43A047', color: 'white' }} // Warna hijau tua
        >
          <Modal.Title className="d-flex align-items-center">
            <FontAwesomeIcon icon={faUserPlus} className="me-2" /> Daftar Pelanggan
          </Modal.Title>
        </Modal.Header>
        <Modal.Body className="p-4">
          <Form.Group className="mb-3">
            <Form.Control
              type="text"
              placeholder="Nama"
              value={form.pelanggan}
              onChange={(e) => setForm({ ...form, pelanggan: e.target.value })}
              className="form-control-lg rounded-pill"
            />
          </Form.Group>
          <Form.Group className="mb-3">
            <Form.Control
              type="text"
              placeholder="Alamat"
              value={form.alamat}
              onChange={(e) => setForm({ ...form, alamat: e.target.value })}
              className="form-control-lg rounded-pill"
            />
          </Form.Group>
          <Form.Group>
            <Form.Control
              type="text"
              placeholder="No Telp"
              value={form.telp}
              onChange={(e) => setForm({ ...form, telp: e.target.value })}
              className="form-control-lg rounded-pill"
            />
          </Form.Group>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleCloseRegister} className="rounded-pill px-3">Batal</Button>
          <Button variant="success" onClick={handleRegister} className="rounded-pill px-3">Daftar</Button>
        </Modal.Footer>
      </Modal>
    </>
  );
}