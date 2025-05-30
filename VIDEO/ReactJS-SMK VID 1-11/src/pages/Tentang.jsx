import { useState } from 'react';

function Tentang() {
  const [count, setCount] = useState(0);

  const handleTambah = () => {
    setCount(count + 1);
  };

  const handleKurang = () => {
    setCount(count - 1);
  };

  return (
    <div className="tentang">
      <h1>Tentang</h1>
      <p>Informasi tentang kami</p>
      <div className="counter-section">
        <h2 className="mb-3">Counter: {count}</h2>
        <button className="btn btn-primary me-2" onClick={handleTambah}>Tambah</button>
        <button className="btn btn-outline-primary" onClick={handleKurang}>Kurang</button>
      </div>
    </div>
  );
}

export default Tentang;