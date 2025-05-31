import React from 'react';
import { Routes, Route, Link } from 'react-router-dom';
import { Container, Button, Row, Col, Card } from 'react-bootstrap';
import Cart from './cart';
import Menu from './menu';


const Main = () => {
  return (
    <div className="flex-grow-1">
      <Routes>
        {/* Route untuk halaman beranda */}
        <Route
          path="/"
          element={
            <>
              {/* Hero Section - Desain Lebih Segar dengan Gradien Cerah */}
              <div
                className="hero-section text-white text-center d-flex align-items-center justify-content-center"
                style={{
                  backgroundImage: 'url("https://via.placeholder.com/1920x1080/4CAF50/FFFFFF?text=Restoran+Elegance")', // Ganti dengan URL gambar latar belakang yang sesuai tema
                  backgroundSize: 'cover',
                  backgroundPosition: 'center',
                  backgroundAttachment: 'fixed', // Efek Parallax
                  minHeight: '75vh', // Sedikit lebih tinggi dari sebelumnya
                  position: 'relative',
                  overflow: 'hidden',
                  padding: '100px 0',
                }}
              >
                {/* Overlay Gradien Warna Cerah dan Menarik */}
                <div style={{
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    width: '100%',
                    height: '100%',
                    background: 'linear-gradient(to bottom, rgba(50, 150, 80, 0.6), rgba(20, 100, 50, 0.8))', // Gradien hijau ke hijau gelap
                    zIndex: 1,
                }}></div>

                <Container className="animate__animated animate__fadeInUp" style={{ zIndex: 2, position: 'relative' }}>
                  <h1 className="display-3 fw-bolder mb-3 text-shadow-sm" // display-3 untuk ukuran yang sedikit lebih besar tapi tetap proporsional
                      style={{ letterSpacing: '1.5px', textTransform: 'uppercase' }}>
                    Sajian Istimewa untuk Anda
                  </h1>
                  <p className="lead fs-5 mb-5 fw-light text-shadow-sm">
                    Nikmati pengalaman kuliner terbaik dengan hidangan yang disiapkan penuh dedikasi.
                  </p>
                  <Link to="/menu">
                    <Button variant="light" size="lg" className="hero-button"> {/* Tombol putih dengan efek hover */}
                      Jelajahi Menu Kami <i className="bi bi-arrow-right"></i>
                    </Button>
                  </Link>
                </Container>
              </div>

              {/* Bagian Informasi/Fitur - Card Minimalis dengan Ikon dan Bayangan Elegan */}
              <Container className="my-5 py-5">
                <h2 className="text-center fw-bold text-dark mb-5 display-5">
                  Pengalaman Kuliner Tak Terlupakan
                </h2>
                <Row className="g-5 justify-content-center"> {/* g-5 untuk gap yang lebih besar */}
                  <Col lg={4} md={6}>
                    <Card className="h-100 border-0 feature-card animate__animated animate__fadeInUp"> {/* Kelas kustom baru */}
                      <Card.Body className="text-center p-4">
                        <div className="icon-box bg-success text-white mb-4 mx-auto"> {/* Warna ikon box solid */}
                            <i className="bi bi-award-fill fs-2"></i>
                        </div>
                        <Card.Title className="fw-bold mb-2 fs-5">Kualitas Premium</Card.Title>
                        <Card.Text className="text-muted fs-6">
                          Setiap bahan dipilih dengan cermat untuk memastikan kualitas dan kesegaran terbaik.
                        </Card.Text>
                      </Card.Body>
                    </Card>
                  </Col>
                  <Col lg={4} md={6}>
                    <Card className="h-100 border-0 feature-card animate__animated animate__fadeInUp animate__delay-1s">
                      <Card.Body className="text-center p-4">
                        <div className="icon-box bg-primary text-white mb-4 mx-auto">
                            <i className="bi bi-hand-thumbs-up-fill fs-2"></i>
                        </div>
                        <Card.Title className="fw-bold mb-2 fs-5">Pelayanan Terbaik</Card.Title>
                        <Card.Text className="text-muted fs-6">
                          Staf kami siap melayani Anda dengan ramah dan profesional, memastikan kenyamanan.
                        </Card.Text>
                      </Card.Body>
                    </Card>
                  </Col>
                  <Col lg={4} md={6}>
                    <Card className="h-100 border-0 feature-card animate__animated animate__fadeInUp animate__delay-2s">
                      <Card.Body className="text-center p-4">
                        <div className="icon-box bg-info text-white mb-4 mx-auto">
                            <i className="bi bi-lightbulb-fill fs-2"></i>
                        </div>
                        <Card.Title className="fw-bold mb-2 fs-5">Inovasi Kuliner</Card.Title>
                        <Card.Text className="text-muted fs-6">
                          Kami terus berinovasi menciptakan hidangan baru yang akan memanjakan lidah Anda.
                        </Card.Text>
                      </Card.Body>
                    </Card>
                  </Col>
                </Row>
              </Container>

              {/* Custom CSS untuk efek visual */}
              <style jsx>{`
                .hero-section {
                  animation-duration: 1.5s;
                  animation-fill-mode: both;
                }
                .text-shadow-sm {
                  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
                }

                .hero-button {
                  border: 2px solid white;
                  padding: 12px 30px;
                  font-size: 1.1rem;
                  transition: all 0.3s ease-in-out;
                  font-weight: bold;
                  background-color: transparent; /* Awalnya transparan */
                  color: white; /* Teks putih */
                }
                .hero-button:hover {
                  background-color: white; /* Latar belakang putih saat hover */
                  color: #28a745 !important; /* Teks hijau saat hover */
                  transform: translateY(-3px);
                  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                }

                .feature-card { /* Kelas kustom baru */
                  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
                  border-radius: 12px;
                  overflow: hidden;
                  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); /* Bayangan default yang lebih halus */
                }
                .feature-card:hover {
                  transform: translateY(-8px);
                  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); /* Bayangan yang lebih kuat saat hover */
                }

                .icon-box {
                    width: 70px;
                    height: 70px;
                    border-radius: 50%; /* Membuat lingkaran penuh */
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.15); /* Bayangan untuk ikon box */
                }

                /* Pastikan Anda sudah menginstal Animate.css jika ingin animasi ini bekerja */
                /* npm install animate.css --save */
                /* Dan import di App.js: import 'animate.css'; */

                /* Import Bootstrap Icons CSS jika ingin menggunakan ikon */
                /* @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"); */
              `}</style>
            </>
          }
        />

        {/* Route untuk Menu dan Cart tetap ada */}
        <Route path="menu" element={<Menu />} />
        <Route path="cart" element={<Cart />} />
      </Routes>
    </div>
  );
};

export default Main;