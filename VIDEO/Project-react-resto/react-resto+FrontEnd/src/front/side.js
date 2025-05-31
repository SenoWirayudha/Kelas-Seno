import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css'; // Pastikan Bootstrap CSS diimpor
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faShoppingCart } from '@fortawesome/free-solid-svg-icons';

const Side = () => {
  const [cartItems, setCartItems] = useState([]);

  useEffect(() => {
    const updateCartItems = () => {
      const items = JSON.parse(localStorage.getItem('cart')) || [];
      setCartItems(items);
    };

    updateCartItems();

    window.addEventListener('storage', updateCartItems);

    return () => {
      window.removeEventListener('storage', updateCartItems);
    };
  }, []);

  const totalItems = cartItems.reduce((sum, item) => sum + item.qty, 0);

  return (
    // Hapus 'd-flex flex-column' dan 'height: 100vh' dari div terluar
    // karena ini yang menyebabkan item Shopping Cart didorong ke bawah
    <div className="p-3 bg-light" style={{ minWidth: '280px' }}> {/* Disesuaikan */}
      <h4 className="mb-4 text-dark fw-bold">Categories</h4>
      <div className="list-group mb-4">
        <Link
          to="/menu"
          className="list-group-item list-group-item-action border-0 rounded-3 shadow-sm mb-2"
          style={{ transition: 'all 0.2s ease-in-out' }}
          onMouseEnter={(e) => e.currentTarget.style.backgroundColor = '#e9ecef'}
          onMouseLeave={(e) => e.currentTarget.style.backgroundColor = '#fff'}
        >
          All Menu
        </Link>
      </div>

      {/* Hapus 'mt-auto' dari div card */}
      <div className="card shadow-sm border-0 rounded-3"> {/* Disesuaikan */}
        <div className="card-body text-center p-4">
          <FontAwesomeIcon icon={faShoppingCart} size="2x" className="text-success mb-3" />
          <h5 className="card-title mb-2 text-dark">Shopping Cart</h5>
          <p className="card-text text-muted mb-4 fs-5">{totalItems} item{totalItems !== 1 ? 's' : ''} in cart</p>
          <Link
            to="/cart"
            className="btn btn-success w-100 rounded-pill py-2 fw-bold"
            style={{ transition: 'background-color 0.2s ease-in-out' }}
          >
            View Cart
          </Link>
        </div>
      </div>
    </div>
  );
};

export default Side;