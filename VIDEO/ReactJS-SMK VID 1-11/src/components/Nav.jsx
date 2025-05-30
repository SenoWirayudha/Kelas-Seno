import { Link } from 'react-router-dom';
import './Nav.css';

function Nav() {
  return (
    <div className="nav">
      <ul>
        <li><Link to="/">Home</Link></li>
        <li><Link to="/sejarah">Sejarah</Link></li>
        <li><Link to="/tentang">Tentang</Link></li>
        <li><Link to="/kontak">Kontak</Link></li>
        <li><Link to="/siswa">Siswa</Link></li>
        <li><Link to="/menu">Menu</Link></li>
      </ul>
    </div>
  );
}

export default Nav;