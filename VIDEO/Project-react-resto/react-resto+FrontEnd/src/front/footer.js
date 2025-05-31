import React from 'react';
import { Container, Row, Col } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
  faEnvelope,
  faPhone,
  faMapMarkerAlt,
} from '@fortawesome/free-solid-svg-icons';

const Footer = () => {
  const currentYear = new Date().getFullYear(); // Ambil tahun saat ini

  return (
    <footer
      className="text-white py-5 mt-auto" // py-5 untuk padding vertikal, mt-auto agar footer selalu di bawah
      style={{
        background: 'linear-gradient(to right, #212529, #343a40)', // Gradien dark-grey
        // Atau jika ingin konsisten dengan navbar yang lebih gelap:
        // background: 'linear-gradient(to right, #2E7D32, #388E3C)',
      }}
    >
      <Container>
        <Row className="mb-4">
          {/* Kolom 1: Tentang Kami */}
          <Col md={4} className="mb-4 mb-md-0">
            <h5 className="text-uppercase mb-3 fw-bold text-success">Restoran Lezat</h5>
            <p className="text-white-50">
              Menyajikan hidangan lezat dan inovatif dengan bahan-bahan segar pilihan. 
              Pengalaman kuliner tak terlupakan menanti Anda di Restoran Lezat.
            </p>
          </Col>

          {/* Kolom 2: Tautan Cepat */}
          <Col md={3} className="mb-4 mb-md-0">
            <h5 className="text-uppercase mb-3 fw-bold text-success">Tautan Cepat</h5>
            <ul className="list-unstyled">
              <li className="mb-2">
                <Link to="/" className="text-white-50 text-decoration-none hover-link">Beranda</Link>
              </li>
              <li className="mb-2">
                <Link to="/menu" className="text-white-50 text-decoration-none hover-link">Menu</Link>
              </li>
              <li className="mb-2">
                <Link to="/cart" className="text-white-50 text-decoration-none hover-link">Keranjang</Link>
              </li>
              {/* Tambahkan link lain jika ada, misal: halaman kontak, galeri, dll */}
            </ul>
          </Col>

          {/* Kolom 3: Kontak Kami */}
          <Col md={3} className="mb-4 mb-md-0">
            <h5 className="text-uppercase mb-3 fw-bold text-success">Kontak Kami</h5>
            <ul className="list-unstyled text-white-50">
              <li className="mb-2">
                <FontAwesomeIcon icon={faMapMarkerAlt} className="me-2 text-warning" />
                Jl. Raya Contoh No. 123, Sidoarjo, Jawa Timur
              </li>
              <li className="mb-2">
                <FontAwesomeIcon icon={faPhone} className="me-2 text-warning" />
                (031) 1234 5678
              </li>
              <li className="mb-2">
                <FontAwesomeIcon icon={faEnvelope} className="me-2 text-warning" />
                info@restoranlezat.com
              </li>
            </ul>
          </Col>

          {/* Kolom 4: Ikuti Kami */}
            <Col md={2}>
            <h5 className="text-uppercase mb-3 fw-bold text-success">Ikuti Kami</h5>
            <ul className="list-unstyled"> {/* Menggunakan ul untuk daftar vertikal */}
              <li className="mb-2"> {/* Setiap item link dalam li */}
                <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" className="text-white-50 text-decoration-none social-icon-text">
                  Facebook
                </a>
              </li>
              <li className="mb-2">
                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" className="text-white-50 text-decoration-none social-icon-text">
                  Instagram
                </a>
              </li>
              <li className="mb-2">
                <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" className="text-white-50 text-decoration-none social-icon-text">
                  Twitter
                </a>
              </li>
              <li className="mb-2">
                <a href="https://wa.me/628123456789" target="_blank" rel="noopener noreferrer" className="text-white-50 text-decoration-none social-icon-text">
                  WhatsApp
                </a>
              </li>
            </ul>
            </Col>
          </Row>
        <hr className="bg-white-50 my-4" /> {/* Garis pemisah */}
        <div className="text-center text-white-50">
          &copy; {currentYear} Restoran Lezat. All Rights Reserved.
        </div>
      </Container>

      {/* Gaya kustom untuk efek hover */}
      <style jsx>{`
        .hover-link:hover {
          color: #28a745 !important; /* Warna hijau success Bootstrap */
          transform: translateX(5px); /* Sedikit geser ke kanan */
        }
        .hover-icon:hover {
          color: #007bff !important; /* Warna biru primary Bootstrap */
          transform: scale(1.2); /* Sedikit membesar */
        }
        /* Tambahkan transisi untuk efek yang halus */
        .hover-link, .hover-icon {
          transition: all 0.2s ease-in-out;
        }
      `}</style>
    </footer>
  );
};

export default Footer;