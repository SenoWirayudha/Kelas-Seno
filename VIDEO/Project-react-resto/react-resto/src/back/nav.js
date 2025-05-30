import React from 'react';

const Nav = () => {
  const email = localStorage.getItem('email'); // Ambil email dari localStorage

  const handleLogout = () => {
    localStorage.removeItem('token');
    localStorage.removeItem('level');
    localStorage.removeItem('email'); // bersihkan juga email
    window.location.href = '/login';
  };

  return (
    <nav className="navbar navbar-dark px-3 d-flex justify-content-between bg-light shadow-sm">
      <span className="navbar-brand mb-0 h1 text-dark">Dashboard Admin</span>
      <div className="d-flex align-items-center gap-3">
        {email && (
          <span className="text-dark">👤 {email}</span>
        )}
        <button className="btn btn-danger" onClick={handleLogout}>Logout</button>
      </div>
    </nav>
  );
};

export default Nav;
