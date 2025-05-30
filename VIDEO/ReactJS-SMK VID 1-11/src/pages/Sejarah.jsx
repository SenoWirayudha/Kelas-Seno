import historyIllustration from '../assets/history-illustration.svg';

function Sejarah() {
  return (
    <div className="sejarah">
      <div className="sejarah-content">
        <div className="sejarah-text">
          <h1>Sejarah</h1>
          <p>Halaman ini berisi tentang sejarah kami</p>
          <button className="btn btn-primary me-2">Pelajari Lebih Lanjut</button>
          <button className="btn btn-outline-primary">Hubungi Kami</button>
        </div>
        <div className="sejarah-image">
          <img src={historyIllustration} alt="Ilustrasi Sejarah" />
        </div>
      </div>
    </div>
  );
}

export default Sejarah;