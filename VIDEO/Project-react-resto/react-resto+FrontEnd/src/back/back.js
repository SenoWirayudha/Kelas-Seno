import React, { useEffect, useState } from 'react';
import { Navigate } from 'react-router-dom';
import Nav from './nav';
import Side from './side';
import Main from './main';
import Footer from './footer';

const Back = () => {
  const [isAuthenticated, setIsAuthenticated] = useState(null); // null = loading
  
  useEffect(() => {
    const checkAuth = () => {
      console.log('🔍 Checking authentication...');
      
      const token = localStorage.getItem('token');
      console.log('🎯 Token from localStorage:', token);
      console.log(localStorage)
      
      // Cek apakah token ada dan tidak kosong
      if (!token || token.trim() === '' || token === 'null' || token === 'undefined') {
        setIsAuthenticated(false);
        return;
      }
    
      setIsAuthenticated(true);
    };
    
    checkAuth();
  }, []);

  if (isAuthenticated === null) {
    return <div>Loading...</div>; // Tambahan penting!
  }
  
  if (!isAuthenticated) {
    return <Navigate to="/login" replace />;
  }
  

  return (
    <div className="back">
      <Nav />
      <div className="container-fluid d-flex">
        <div style={{ minWidth: 250 }}>
          <Side />
        </div>
        <div className="flex-grow-1">
          <Main />
        </div>
      </div>
      <Footer />
    </div>
  );
};

export default Back;